<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:05
 */

require('controller/frontend.php');

if (isset ($_GET['action']))
{
    if ($_GET['action'] == 'sendContactMail') {

            if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['email']) AND !empty($_POST['subject']) AND !empty($_POST['message'])) {

            sendContactMail($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $action = "MailOK";
            home($action);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
    elseif ($_GET['action'] == 'blog') {
        if (isset($_GET['p'])) {
            homeBlog($_GET['p']);
        }
        else {
            homeBlog(1);
        }
    }
    elseif ($_GET['action'] == 'viewPost') {
        if (isset($_GET['i'])) {
            viewPost($_GET['i']);
        }
        else {
            echo 'Erreur : aucun identifiant de billet renseigné !';
        }
    }
    elseif ($_GET['action'] == 'signup') {
        signUp();
    }
}

else {
    $action = "NULL";
    home($action);
}