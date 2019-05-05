<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require_once 'model/Frontend.php';
require_once 'vendor/autoload.php';

Class FrontendController
{
    public function home($action)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $template = $twig->load('homeView.php');

        //test pour vérifier si on est après l'envoi d'un e-mail via formulaire de contact ou non
        if ($action == "NULL") {
            echo $template->render(['js' => "NULL"]);
        } elseif ($action == "MailOK") {
            echo $template->render(['js' => "toaster"]); //Si après le formulaire de contact, variable js à toaster pour afficher le toaster JS sur la page
        }
    }

    public function sendContactMail($firstname, $lastname, $email, $subject, $content)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport('ssl0.ovh.net', 465))
            ->setEncryption('ssl')
            ->setAuthMode('login')
            ->setUsername('contact@quentinboinet.fr')
            ->setPassword('cvZpf7Y9Vcs9');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        $body = "Bonjour, vous avez reçu un message de contact sur votre blog. <br />";
        $body .= "<br /> De la part de : " . $firstname . " " . $lastname . " (" . $email . ") : <br /><br />";
        $body .= "<p>" . nl2br($content) . "</p>";

        // Create a message
        $subject = "Blog personnel - " . $subject;
        $message = (new Swift_Message($subject))
            ->setFrom(['contact@quentinboinet.fr' => 'Contact - Blog Quentin Boinet'])
            ->setTo(['quentinboinet@live.fr' => 'Quentin Boinet'])
            ->addPart($body, 'text/html');;

        // Send the message
        $result = $mailer->send($message);
    }

    public function homeBlog($start)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $front = new Frontend();

        //on vérifie qu'il y a au moins 1 article en BDD, sinon on affiche page "Aucun article"
        $nombrePosts = $front->getNbPosts(0);
        if ($nombrePosts >= 1)
        {
            $posts = $front->getPosts($start);
            $nbPage = ceil($front->getNbPosts(0) / 5);

            $actualPage = $start;

            $template = $twig->load('blogView.php');
            echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage]);
        }
        else
        {
            $template = $twig->load('blogView.php');
            $posts = "NoPosts";
            echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage]);
        }
    }

    public function viewPost($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $front = new Frontend();

        $nbPost = $front->getNbPosts($id);
        if ($nbPost == 1) {
            $authorID = $front->getPostAuthorId($id);

            $post = $front->getOnePost($id, $authorID);
            $comments = $front->getComments($id);
            $nbComments = $front->getNbComments($id);

            $template = $twig->load('postView.php');
            echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments]);
        } else {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'postDoesNotExist']);
        }


    }

    public function addComment($id, $comment)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $front = new Frontend();
        $retour = $front->saveComment($id, $comment);

        $authorId = $front->getPostAuthorId($id);
        $post = $front->getOnePost($id, $authorId);
        $comments = $front->getComments($id);
        $nbComments = $front->getNbComments($id);

        if ($retour == "commentAdded") {
            $template = $twig->load('postView.php');
            echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterCommentAdded']);
        } elseif ($retour == "commentAddedValidation") {
            $post = $front->getOnePost($id, $userStatus);
            $comments = $front->getComments($id);
            $nbComments = $front->getNbComments($id);

            $template = $twig->load('postView.php');
            echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterCommentValidation']);
        }
    }

    public function signUp($action)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if ($action == "validate") {

            $template = $twig->load('signUpView.php');
            echo $template->render(['js' => 'toaster']);
        } elseif ($action == "userExist") {
            $template = $twig->load('signUpView.php');
            echo $template->render(['js' => 'toasterUserExist']);
        } elseif ($action == "view") {
            $template = $twig->load('signUpView.php');
            echo $template->render();
        }
    }

    public function registerUser($lastName, $firstName, $email, $password)
    {
        $front = new Frontend();
        $retour = $front->saveUser($lastName, $firstName, $email, $password);

        return $retour;
    }

    public function logIn($action)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if ($action == "validate") {
            $template = $twig->load('homeView.php');
            echo $template->render(['js' => 'toasterLoginOK']);
        } elseif ($action == "userDoesNotExist") {
            $template = $twig->load('logInView.php');
            echo $template->render(['js' => 'toasterUserDoesNotExist']);
        } elseif ($action == "captchaError") {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'unidentified']);
        } elseif ($action == "view") {
            $template = $twig->load('logInView.php');
            echo $template->render();
        }

    }

    public function userLogIn($mail, $pass, $captcha)
    {
        $front = new Frontend();
        $retour = $front->checkUserLogIn($mail, $pass, $captcha);

        return $retour;
    }

    public function logOut()
    {
        session_destroy();

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $template = $twig->load('homeView.php');
        echo $template->render();
    }

    public function error()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $template = $twig->load('errorPageView.php');
        echo $template->render(['errorType' => 'unidentified']);
    }
}