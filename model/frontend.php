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

function getNbPosts()
{
    $db = dbConnect();
    //récupérer le nombre de posts présents
    $nbPosts =  $db->query("SELECT COUNT(id) FROM post")->fetchColumn();
    return $nbPosts;
}