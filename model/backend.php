<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:13
 */

require_once 'model/Base.php';

Class Backend extends Base
{

    public function getUsersList()
    {
        $db = $this->dbConnect();
        $requete = $db->prepare('SELECT * FROM user ORDER BY id DESC');
        $requete->execute();

        return $requete;
    }

    public function deleteOneUser($userId)
    {
        $db = $this->dbConnect();

        //on vérifie que cet utilisateur existe et que ce n'est pas nous
        if ($_SESSION['userId'] != $userId) {
            $nbUser = $db->prepare("SELECT COUNT(id) FROM user WHERE id = :userId");
            $nbUser->bindParam(':userId', $userId, PDO::PARAM_INT);
            $nbUser->execute();
            $nbUser = $nbUser->fetchColumn();

            if ($nbUser == 1) {
                $requete = $db->prepare('DELETE FROM user WHERE id = :userId');
                $requete->bindParam(':userId', $userId, PDO::PARAM_INT);
                $requete->execute();

                return "OK";
            } else {
                return "noUser";
            }
        } else {
            return "userIsCurrent";
        }
    }

    public function getNbUsers()
    {
        $db = $this->dbConnect();

        $nbUser = $db->prepare("SELECT COUNT(id) FROM user");
        $nbUser->bindParam(':userId', $userId, PDO::PARAM_INT);
        $nbUser->execute();
        $nbUser = $nbUser->fetchColumn();
        $nbUser--; //on enlève 1 car on ne compte pas l'utilisateur actuellement connecté

        return $nbUser;
    }

    public function getCommmentsPendingApproval()
    {
        $db = $this->dbConnect();
        $requete = $db->prepare('SELECT comment.*, user.lastName, user.firstName, post.title FROM comment JOIN user ON user.id = comment.authorId JOIN post ON post.id = comment.postId WHERE comment.status=0 ORDER BY comment.creationDate DESC');
        $requete->execute();

        return $requete;
    }

    public function getNbCommentsPendingApproval()
    {
        $db = $this->dbConnect();

        $nbComments = $db->prepare("SELECT COUNT(id) FROM comment WHERE status=0");
        $nbComments->bindParam(':userId', $userId, PDO::PARAM_INT);
        $nbComments->execute();
        $nbComments = $nbComments->fetchColumn();

        return $nbComments;
    }

    public function approveOneComment($commentId)
    {
        $db = $this->dbConnect();

        //on vérifie que ce commentaire existe
        $nbComment = $db->prepare("SELECT COUNT(id) FROM comment WHERE id = :commentId");
        $nbComment->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $nbComment->execute();
        $nbComment = $nbComment->fetchColumn();

        if ($nbComment == 1) {
            $requete = $db->prepare('UPDATE comment SET status="1" WHERE id = :commentId');
            $requete->bindParam(':commentId', $commentId, PDO::PARAM_INT);
            $requete->execute();

            return "OK";
        } else {
            return "noCommenr";
        }

    }

    public function deleteOneComment($commentId)
    {
        $db = $this->dbConnect();

        //on vérifie que ce commentaire existe
        $nbComment = $db->prepare("SELECT COUNT(id) FROM comment WHERE id = :commentId");
        $nbComment->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $nbComment->execute();
        $nbComment = $nbComment->fetchColumn();

        if ($nbComment == 1) {
            $requete = $db->prepare('DELETE FROM comment WHERE id = :commentId');
            $requete->bindParam(':commentId', $commentId, PDO::PARAM_INT);
            $requete->execute();

            return "OK";
        } else {
            return "noCommenr";
        }

    }

    public function deleteOnePost($postId)
    {
        $db = $this->dbConnect();

        //on vérifie que ce ppost existe
        $nbPost = $db->prepare("SELECT COUNT(id) FROM post WHERE id = :postId");
        $nbPost->bindParam(':postId', $postId, PDO::PARAM_INT);
        $nbPost->execute();
        $nbPost = $nbPost->fetchColumn();

        if ($nbPost == 1) {
            $requete = $db->prepare('DELETE FROM post WHERE id = :postId');
            $requete->bindParam(':postId', $postId, PDO::PARAM_INT);
            $requete->execute();

            //ne pas oublier de supprimer aussi les commentaires de ce post
            $requete = $db->prepare('DELETE FROM comment WHERE postId = :postId');
            $requete->bindParam(':postId', $postId, PDO::PARAM_INT);
            $requete->execute();

            return "OK";
        } else {
            return "noPost";
        }

    }

    public function editSinglePost($title, $chapo, $content, $id)
    {
        $db = $this->dbConnect();

        date_default_timezone_set('Europe/Paris');
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

    public function insertOnePost($titre, $chapo, $content, $image)
    {
        $db = $this->dbConnect();

        date_default_timezone_set('Europe/Paris');
        $creationDate = time();
        $authorId = $_SESSION['userId'];

        $requete = $db->prepare("INSERT INTO post (authorId, title, chapo, content, picture, creationDate, lastModifiedDate) VALUES (:author, :title, :chapo, :content, :picture, :creationDate, :lastModifiedDate)");
        $requete->bindParam(':author', $authorId, PDO::PARAM_INT);
        $requete->bindParam(':title', $titre, PDO::PARAM_STR);
        $requete->bindParam(':chapo', $chapo, PDO::PARAM_STR);
        $requete->bindParam(':content', $content, PDO::PARAM_STR);
        $requete->bindParam(':picture', $image, PDO::PARAM_STR);
        $requete->bindParam(':creationDate', $creationDate, PDO::PARAM_INT);
        $requete->bindParam(':lastModifiedDate', $creationDate, PDO::PARAM_INT);
        $requete->execute();

        return "OK";
    }

}