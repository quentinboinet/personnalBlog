<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:13
 */

function getUsersList()
{
    $db = dbConnect();
    $requete = $db->prepare('SELECT * FROM user ORDER BY id DESC');
    $requete->execute();

    return $requete;
}

function deleteOneUser($userId)
{
    $db = dbConnect();

    //on vérifie que cet utilisateur existe et que ce n'est pas nous
    if ($_SESSION['userId'] != $userId)
    {
        $nbUser =  $db->prepare("SELECT COUNT(id) FROM user WHERE id = :userId");
        $nbUser->bindParam(':userId', $userId, PDO::PARAM_INT);
        $nbUser->execute();
        $nbUser = $nbUser->fetchColumn();

        if ($nbUser == 1)
        {
            $requete = $db->prepare('DELETE FROM user WHERE id = :userId');
            $requete->bindParam(':userId', $userId, PDO::PARAM_INT);
            $requete->execute();

            return "OK";
        }
        else
        {
            return "noUser";
        }
    }
    else
    {
        return "userIsCurrent";
    }
}

function getNbUsers()
{
    $db = dbConnect();

    $nbUser =  $db->prepare("SELECT COUNT(id) FROM user");
    $nbUser->bindParam(':userId', $userId, PDO::PARAM_INT);
    $nbUser->execute();
    $nbUser = $nbUser->fetchColumn();
    $nbUser--; //on enlève 1 car on ne compte pas l'utilisateur actuellement connecté

    return $nbUser;
}

function getCommmentsPendingApproval()
{
    $db = dbConnect();
    $requete = $db->prepare('SELECT comment.*, user.lastName, user.firstName, post.title FROM comment JOIN user JOIN post ON post.id = comment.postId WHERE comment.status=0 ORDER BY comment.creationDate DESC');
    $requete->execute();

    return $requete;
}

function getNbCommentsPendingApproval()
{
    $db = dbConnect();

    $nbComments =  $db->prepare("SELECT COUNT(id) FROM comment WHERE status=0");
    $nbComments->bindParam(':userId', $userId, PDO::PARAM_INT);
    $nbComments->execute();
    $nbComments = $nbComments->fetchColumn();

    return $nbComments;
}

function approveOneComment($commentId)
{
    $db = dbConnect();

    //on vérifie que ce commentaire existe
    $nbComment =  $db->prepare("SELECT COUNT(id) FROM comment WHERE id = :commentId");
    $nbComment->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $nbComment->execute();
    $nbComment = $nbComment->fetchColumn();

    if ($nbComment == 1)
    {
        $requete = $db->prepare('UPDATE comment SET status="1" WHERE id = :commentId');
        $requete->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $requete->execute();

        return "OK";
    }
    else
    {
        return "noCommenr";
    }

}

function deleteOneComment($commentId)
{
    $db = dbConnect();

    //on vérifie que ce commentaire existe
    $nbComment =  $db->prepare("SELECT COUNT(id) FROM comment WHERE id = :commentId");
    $nbComment->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $nbComment->execute();
    $nbComment = $nbComment->fetchColumn();

    if ($nbComment == 1)
    {
        $requete = $db->prepare('DELETE FROM comment WHERE id = :commentId');
        $requete->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $requete->execute();

        return "OK";
    }
    else
    {
        return "noCommenr";
    }

}

function deleteOnePost($postId)
{
    $db = dbConnect();

    //on vérifie que ce ppost existe
    $nbPost =  $db->prepare("SELECT COUNT(id) FROM post WHERE id = :postId");
    $nbPost->bindParam(':postId', $postId, PDO::PARAM_INT);
    $nbPost->execute();
    $nbPost = $nbPost->fetchColumn();

    if ($nbPost == 1)
    {
        $requete = $db->prepare('DELETE FROM post WHERE id = :postId');
        $requete->bindParam(':postId', $postId, PDO::PARAM_INT);
        $requete->execute();

        //ne pas oublier de supprimer aussi les commentaires de ce post
        $requete = $db->prepare('DELETE FROM comment WHERE postId = :postId');
        $requete->bindParam(':postId', $postId, PDO::PARAM_INT);
        $requete->execute();

        return "OK";
    }
    else
    {
        return "noPost";
    }

}

function editSinglePost($title, $chapo, $content, $id)
{
    $db = dbConnect();

    $time = time();

    $requete = $db->prepare("UPDATE post SET title = :title, chapo = :chapo, content = :content, lastModifiedDate = :time WHERE id = :identifiant");
    $requete->bindParam(':title', $title, PDO::PARAM_STR);
    $requete->bindParam(':chapo', $chapo, PDO::PARAM_STR);
    $requete->bindParam(':content', $content, PDO::PARAM_STR);
    $requete->bindParam(':time', $time, PDO::PARAM_INT);
    $requete->bindParam(':identifiant', $id, PDO::PARAM_INT);
    $requete->execute();

    return "OK";

}