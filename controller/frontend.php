<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require_once 'model/Frontend.php';
require_once 'vendor/autoload.php';


function home($action)
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
    }
    elseif ($action == "MailOK") {
        echo $template->render(['js' => "toaster"]); //Si après le formulaire de contact, variable js à toaster pour afficher le toaster JS sur la page
    }
}

function sendContactMail($firstname, $lastname, $email, $subject, $content)
{
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.quentinboinet.fr', 587))
        ->setUsername('contact@quentinboinet.fr')
        ->setPassword('PNCfGcV2YiDc')
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    $body = "Bonjour, vous avez reçu un message de contact sur votre blog. <br />";
    $body .= "<br /> De la part de : " . $firstname . " " . $lastname . " (" . $email . ") : <br /><br />";
    $body .= "<p>" . nl2br($content) . "</p>";

    // Create a message
    $message = (new Swift_Message($subject))
        ->setFrom(['contact@quentinboinet.fr' => 'Contact - Blog Quentin Boinet'])
        ->setTo(['quentinboinet@live.fr' => 'Quentin Boinet'])
        ->addPart($body, 'text/html');
    ;

    // Send the message
    $result = $mailer->send($message);
}

function homeBlog($start)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $front = new Frontend();
    $posts = $front->getPosts($start);
    $nbPage = ceil($front->getNbPosts(0)/5);

    $actualPage = $start;

    $template = $twig->load('blogView.php');
    echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage]);
}

function viewPost($id)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $front = new Frontend();

    $authorID = $front->getPostAuthorId($id);

    $post = $front->getOnePost($id, $authorID);
    $comments = $front->getComments($id);
    $nbComments = $front->getNbComments($id);

    $template = $twig->load('postView.php');
    echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments]);
}

function addComment($id, $comment)
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

    if ($retour == "commentAdded")
    {
        $template = $twig->load('postView.php');
        echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterCommentAdded']);
    }
    elseif ($retour == "commentAddedValidation")
    {
        $post = getOnePost($id, $userStatus);
        $comments = getComments($id);
        $nbComments = getNbComments($id);

        $template = $twig->load('postView.php');
        echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments,  'js' => 'toasterCommentValidation']);
    }
}

function signUp($action)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    if ($action == "validate") {

        $template = $twig->load('signUpView.php');
        echo $template->render(['js' => 'toaster']);
    }
    elseif ($action == "userExist") {
        $template = $twig->load('signUpView.php');
        echo $template->render(['js' => 'toasterUserExist']);
    }
    elseif ($action == "view")
    {
        $template = $twig->load('signUpView.php');
        echo $template->render();
    }
}

function registerUser($lastName, $firstName, $email, $password)
{
    $front = new Frontend();
    $retour = $front->saveUser($lastName, $firstName, $email, $password);

    return $retour;
}

function logIn($action)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    if ($action == "validate") {
        $template = $twig->load('homeView.php');
        echo $template->render(['js' => 'toasterLoginOK']);
    }
    elseif ($action == "userDoesNotExist") {
        $template = $twig->load('logInView.php');
        echo $template->render(['js' => 'toasterUserDoesNotExist']);
    }
    elseif ($action == "view") {
        $template = $twig->load('logInView.php');
        echo $template->render();
    }

}

function userLogIn ($mail, $pass)
{
    $front = new Frontend();
    $retour = $front->checkUserLogIn($mail, $pass);

    return $retour;
}

function logOut()
{
    session_destroy();

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $template = $twig->load('homeView.php');
    echo $template->render(['js' => 'toasterLogout']);
}

function error()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $template = $twig->load('errorPageView.php');
    echo $template->render(['errorType' => 'unidentified']);
}