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