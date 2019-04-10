<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require('model/frontend.php');
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
    /*
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $mail = 'quentinboinet@live.fr'; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }


    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //==========

    //=====Création du header de l'e-mail.
    $header = "From: \"" . $firstname . " " . $lastname . "\"<quentinboinet@blog.fr>".$passage_ligne;
    $header.= "Reply-to: \"" . $firstname . " " . $lastname ."\" <" . $email . ">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;


    mail($mail,$subject,$content,$header);
    */

    // Create the Transport
    $transport = (new Swift_SmtpTransport('ssl0.ovh.net', 587))
        ->setUsername('contact@quentinboinet.fr')
        ->setPassword('PNCfGcV2YiDc')
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['contact@quentinboinet.fr' => 'Quentin Boinet'])
        ->setTo(['quentinboinet@live.fr' => 'A name'])
        ->setBody('Here is the message itself')
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

    $posts = getPosts($start);
    $nbPage = ceil(getNbPosts()/5);
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

    $post = getOnePost($id);
    $comments = getComments($id);
    $nbComments = getNbComments($id);

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

    $retour = saveComment($id, $comment);
    if ($retour == "commentAdded")
    {
        $post = getOnePost($id);
        $comments = getComments($id);
        $nbComments = getNbComments($id);

        $template = $twig->load('postView.php');
        echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterCommentAdded']);
    }
    elseif ($retour == "commentAddedValidation")
    {
        $post = getOnePost($id);
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
    $retour = saveUser($lastName, $firstName, $email, $password);
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
    $retour = checkUserLogIn($mail, $pass);
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
    echo $template->render();
}