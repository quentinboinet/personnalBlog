<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:13
 */

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=personnalBlog;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getPosts($start)
{
    $db = dbConnect();
    $requete = $db->prepare('SELECT * FROM post ORDER BY creationDate DESC LIMIT :debut,5');

    $start = ($start-1) * 5;
    $requete->bindParam(':debut', $start, PDO::PARAM_INT);
    $requete->execute();

    return $requete;
}

function getOnePost($id)
{
    $db = dbConnect();
    $requete = $db->prepare('SELECT post.*, user.lastName, user.firstName FROM post JOIN user ON post.authorId = user.id WHERE post.Id = :identifiant');
    $requete->bindParam(':identifiant', $id, PDO::PARAM_INT);
    $requete->execute();

    return $requete;
}

function getNbPosts()
{
    $db = dbConnect();
    //récupérer le nombre de posts présents
    $nbPosts =  $db->query("SELECT COUNT(id) FROM post")->fetchColumn();

    return $nbPosts;
}

function getComments($postId)
{
    $db = dbConnect();
    $requete = $db->prepare('SELECT comment.*, user.lastName, user.firstName FROM comment JOIN user ON comment.authorId = user.id WHERE comment.postId = :identifiant AND comment.status=1 ORDER BY comment.creationDate DESC');
    $requete->bindParam(':identifiant', $postId, PDO::PARAM_INT);
    $requete->execute();

    return $requete;
}

function getNbComments($postId)
{
    $db = dbConnect();
    //récupérer le nombre de commentaires présents pour un post
    $nbComments =  $db->prepare("SELECT COUNT(id) FROM comment WHERE postId = :identifiant");
    $nbComments->bindParam(':identifiant', $postId, PDO::PARAM_INT);
    $nbComments->execute();
    $nbComments = $nbComments->fetchColumn();

    return $nbComments;
}

function saveUser($lastName, $firstName, $email, $pass)
{
    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $db = dbConnect();

    //vérifier qu'il n'y a pas déjà un utilisateur avec cette adresse e-mail d'enregistré
    $nbUsers=  $db->prepare("SELECT COUNT(id) FROM user WHERE email = :mail");
    $nbUsers->bindParam(':mail', $email, PDO::PARAM_STR);
    $nbUsers->execute();
    $nbUsers = $nbUsers->fetchColumn();

    if ($nbUsers == 0)
    {
        $requete = $db->prepare("INSERT INTO user (email, password, lastName, firstName, type) VALUES (:email, :password, :lastN, :firstN, '0')");
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':password', $passHash, PDO::PARAM_STR);
        $requete->bindParam(':lastN', $lastName, PDO::PARAM_STR);
        $requete->bindParam(':firstN', $firstName, PDO::PARAM_STR);
        $requete->execute();

        return "OK";
    }
    else
    {
        return "UserAlreadyExist";
    }

}