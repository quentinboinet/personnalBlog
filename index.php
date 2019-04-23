<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:05
 */

session_start();

require_once 'controller/Frontend.php';
require_once 'controller/Backend.php';

if (isset ($_GET['action']))
{
    if ($_GET['action'] == 'sendContactMail') {

            if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['email']) AND !empty($_POST['subject']) AND !empty($_POST['message'])) {

            sendContactMail($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $action = "MailOK";
            home($action);
            }
            else {
                error();
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
            if (isset($_POST['comment'])) {
                addComment($_GET['i'], $_POST['comment']);
            }
            else {
                viewPost($_GET['i']);
            }
        }
        else {
            error();
        }
    }
    elseif ($_GET['action'] == 'signup') {
        if (isset($_POST['lastName']) OR isset($_POST['firstName']) OR isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = registerUser($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password']);
            if ($retour == "OK") {
                signUp('validate');
            }
            else
            {
                signUp('userExist');
            }
        }
        else {
            signUp('view');
        }
    }
    elseif ($_GET['action'] == "login") {
        if (isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = userLogIn($_POST['email'], $_POST['password']);
            if ($retour == "OK") {
                logIn('validate');
            }
            else
            {
                logIn('userDoesNotExist');
            }
        }
        else {
            logIn('view');
        }
    }
    elseif ($_GET['action'] == "logout") {
        logOut();
    }
    elseif ($_GET['action'] == "adminPage") {
        adminPage();
    }
    elseif ($_GET['action'] == "userManagement") {
        userManagement();
    }
    elseif ($_GET['action'] == "deleteUser") {
        if (isset($_GET['i'])) {
            deleteUser($_GET['i']);
        }
        else {
            deleteUser("0");
        }
    }
    elseif ($_GET['action'] == "commentManagement") {
        commentManagement();
    }
    elseif ($_GET['action'] == "approveComment") {
        if (isset($_GET['i'])) {
            approveComment($_GET['i']);
        }
        else {
            error();
        }
    }
    elseif ($_GET['action'] == "deleteComment") {
        if (isset($_GET['i'])) {
            deleteComment($_GET['i']);
        }
        else {
            error();
        }
    }
    elseif ($_GET['action'] == "editPost") {
        if (isset($_GET['i'])) {
            if (isset($_POST['title']) OR isset($_POST['content']) OR isset($_POST['chapo'])) {
                editOnePost($_POST['title'], $_POST['chapo'], $_POST['content'], $_GET['i']);

            }
            else {
                editPost($_GET['i']);
            }
        }
        else {
            error();
        }
    }
    elseif ($_GET['action'] == "deletePost") {
        if (isset($_GET['i'])) {
            deletePost($_GET['i']);
        }
        else {
            error();
        }
    }
    elseif ($_GET['action'] == "addPost") {
        if (isset($_POST['title']) OR isset($_POST['image']) OR isset($_POST['content']) OR isset($_POST['chapo'])) {
            if (empty($_POST['image'])) { $image = "public/images/defaultCover.jpg"; } else { $image = $_POST['image']; }//si l'user n'a rempli aucune image pour l'article, alors on mets le chemin vers l'image par défaut
            addOnePost($_POST['title'], $_POST['chapo'], $_POST['content'], $image);
        }
        else {
            addPost();
        }
    }

}

else {
    $action = "NULL";
    home($action);
}