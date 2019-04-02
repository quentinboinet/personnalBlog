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
}