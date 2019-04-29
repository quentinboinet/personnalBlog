<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:13
 */

require_once 'model/Base.php';

Class Frontend extends Base
{

    public function getPosts($start)
    {
        $db = $this->dbConnect();
        $requete = $db->prepare('SELECT * FROM post ORDER BY creationDate DESC LIMIT :debut,5');

        $start = ($start - 1) * 5;
        $requete->bindParam(':debut', $start, PDO::PARAM_INT);
        $requete->execute();

        return $requete;
    }

    public function getOnePost($id, $userStatus)
    {
        $db = $this->dbConnect();

        if ($userStatus == "NULL")//si l'id de l'auteur vaut NULL (user supprimé), alors on fait juste la requête sur la table post, sans jointure
        {
            $requete = $db->prepare('SELECT * FROM post WHERE id = :identifiant');
            $requete->bindParam(':identifiant', $id, PDO::PARAM_INT);
            $requete->execute();
        }
        else
        {
            $requete = $db->prepare('SELECT post.*, user.lastName, user.firstName FROM post JOIN user ON post.authorId = user.id WHERE post.id = :identifiant');
            $requete->bindParam(':identifiant', $id, PDO::PARAM_INT);
            $requete->execute();
        }


        return $requete;
    }

    public function getNbPosts($id)
    {
        $db = $this->dbConnect();

        if ($id == 0) {
            //récupérer le nombre de posts présents
            $nbPosts = $db->query("SELECT COUNT(id) FROM post")->fetchColumn();
        } else {
            $nbPosts = $db->prepare('SELECT COUNT(id) FROM post WHERE id = :identifiant');
            $nbPosts->bindParam(':identifiant', $id, PDO::PARAM_INT);
            $nbPosts->execute();
            $nbPosts = $nbPosts->fetchColumn();
        }

        return $nbPosts;
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $requete = $db->prepare('SELECT comment.*, user.lastName, user.firstName FROM comment LEFT OUTER JOIN user ON comment.authorId = user.id WHERE comment.postId = :identifiant AND comment.status="1" ORDER BY comment.creationDate DESC');
        $requete->bindParam(':identifiant', $postId, PDO::PARAM_INT);
        $requete->execute();

        return $requete;
    }

    public function getNbComments($postId)
    {
        $db = $this->dbConnect();
        //récupérer le nombre de commentaires présents pour un post
        $nbComments = $db->prepare("SELECT COUNT(id) FROM comment WHERE postId = :identifiant AND status=1");
        $nbComments->bindParam(':identifiant', $postId, PDO::PARAM_INT);
        $nbComments->execute();
        $nbComments = $nbComments->fetchColumn();

        return $nbComments;
    }

    public function saveUser($lastName, $firstName, $email, $pass)
    {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        $db = $this->dbConnect();

        //vérifier qu'il n'y a pas déjà un utilisateur avec cette adresse e-mail d'enregistré
        $nbUsers = $db->prepare("SELECT COUNT(id) FROM user WHERE email = :mail");
        $nbUsers->bindParam(':mail', $email, PDO::PARAM_STR);
        $nbUsers->execute();
        $nbUsers = $nbUsers->fetchColumn();

        if ($nbUsers == 0) {
            $requete = $db->prepare("INSERT INTO user (email, password, lastName, firstName, type) VALUES (:email, :password, :lastN, :firstN, '0')");
            $requete->bindParam(':email', $email, PDO::PARAM_STR);
            $requete->bindParam(':password', $passHash, PDO::PARAM_STR);
            $requete->bindParam(':lastN', $lastName, PDO::PARAM_STR);
            $requete->bindParam(':firstN', $firstName, PDO::PARAM_STR);
            $requete->execute();

            return "OK";
        } else {
            return "UserAlreadyExist";
        }

    }

    public function checkUserLogIn($email, $password, $captcha)
    {
        $db = $this->dbConnect();

        //vérifier que les identifiants entrés sont les bon
        $nbUsers = $db->prepare("SELECT COUNT(id) FROM user WHERE email = :mail");
        $nbUsers->bindParam(':mail', $email, PDO::PARAM_STR);
        $nbUsers->execute();
        $nbUsers = $nbUsers->fetchColumn();

        if ($nbUsers == 0) //aucun utilisateur avec mail/pass correspondant
        {
            return "UserDoesNotExist";
        } else {

            //on vérifie le captcha Google

            // Ma clé privée
            $secret = "6LdVzqAUAAAAAHut8_YPbdWQ7JUJ4fFXXJsTHCin";
            // Paramètre renvoyé par le recaptcha
            $response = $captcha;
            // On récupère l'IP de l'utilisateur
            $remoteip = $_SERVER['REMOTE_ADDR'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret
                . "&response=" . $response
                . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true) {
                // C'est un humain
                $mdp = $db->prepare("SELECT * FROM user WHERE email = :mail");
                $mdp->bindParam(':mail', $email, PDO::PARAM_STR);
                $mdp->execute();
                $mdp = $mdp->fetch();

                if (password_verify($password, $mdp['password'])) {
                    $_SESSION['userId'] = $mdp['id'];
                    $_SESSION['mail'] = $email;
                    $_SESSION['lastName'] = $mdp['lastName'];
                    $_SESSION['firstName'] = $mdp['firstName'];
                    $_SESSION['type'] = $mdp['type'];
                    return "OK";
                } else {
                    return "UserDoesNotExist";
                }
            }
            else {
                // C'est un robot ou le code de vérification est incorrecte
                return "ErrorCaptcha";
            }

        }
    }

    public function saveComment($postId, $contenu)
    {
        $db = $this->dbConnect();

        if ($_SESSION['type'] == 1) //si c'est un administrateur, alors on valide automatiquement le commentaire
        {
            $status = 1;
        } else //sinon on mets le commentaire en attente de validation
        {
            $status = 0;
        }

        $auteur = $_SESSION['userId'];

        date_default_timezone_set('Europe/Paris');
        $creationDate = time();

        $requete = $db->prepare("INSERT INTO comment (postId, authorId, content, creationDate, status) VALUES (:postId, :authorId, :content, :creationDate, :status)");
        $requete->bindParam(':postId', $postId, PDO::PARAM_INT);
        $requete->bindParam(':authorId', $auteur, PDO::PARAM_INT);
        $requete->bindParam(':content', $contenu, PDO::PARAM_STR);
        $requete->bindParam(':creationDate', $creationDate, PDO::PARAM_INT);
        $requete->bindParam(':status', $status, PDO::PARAM_INT);
        $requete->execute();

        if ($_SESSION['type'] == 1) //si c'est un administrateur, alors on valide automatiquement le commentaire
        {
            return "commentAdded";
        } else //sinon on mets le commentaire en attente de validation
        {
            return "commentAddedValidation";
        }

    }

    public function getPostAuthorId($id)
    {
        $db = $this->dbConnect();

        $authorId =  $db->prepare("SELECT authorId FROM post WHERE id = :identifiant");
        $authorId->bindParam(':identifiant', $id, PDO::PARAM_STR);
        $authorId->execute();
        $authorId = $authorId->fetchColumn();

        if (empty($authorId))
        {
            return "NULL";
        }
        else
        {
            return "OK";
        }
    }

}

function getPostAuthorId($id)
{
    $db = dbConnect();

    $authorId =  $db->prepare("SELECT authorId FROM post WHERE id = :identifiant");
    $authorId->bindParam(':identifiant', $id, PDO::PARAM_STR);
    $authorId->execute();
    $authorId = $authorId->fetchColumn();

    if (empty($authorId))
    {
        return "NULL";
    }
    else
    {
        return "OK";
    }
}