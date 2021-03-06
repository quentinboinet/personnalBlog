<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:05
 */

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'controller/Frontend.php';
require_once 'controller/Backend.php';

if (isset ($_GET['action']))
{
    $frontController = new FrontendController();
    $backController = new BackendController();

    if ($_GET['action'] == 'sendContactMail') {

            if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['email']) AND !empty($_POST['subject']) AND !empty($_POST['message'])) {
            $frontController->sendContactMail($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $action = "MailOK";
            $frontController->home($action);
            }
            else {
                $frontController->error();
            }
        }
    elseif ($_GET['action'] == 'blog') {
        if (isset($_GET['p'])) {
            $frontController->homeBlog($_GET['p']);
        }
        else {
            $frontController->homeBlog(1);
        }
    }
    elseif ($_GET['action'] == 'viewPost') {
        if (isset($_GET['i'])) {
            if (isset($_POST['comment'])) {
                $frontController->addComment($_GET['i'], $_POST['comment']);
            }
            else {
                $frontController->viewPost($_GET['i']);
            }
        }
        else {
            $frontController->error();
        }
    }
    elseif ($_GET['action'] == 'signup') {
        if (isset($_POST['lastName']) OR isset($_POST['firstName']) OR isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = $frontController->registerUser($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password']);
            if ($retour == "OK") {
                $frontController->signUp('validate');
            }
            else
            {
                $frontController->signUp('userExist');
            }
        }
        else {
            $frontController->signUp('view');
        }
    }
    elseif ($_GET['action'] == "login") {
        if (isset($_POST['email']) OR isset($_POST['password'])) {
            $retour = $frontController->userLogIn($_POST['email'], $_POST['password'], $_POST['g-recaptcha-response']);
            if ($retour == "OK") {
                $frontController->logIn('validate');
            }
            elseif ($retour == "ErrorCaptcha")
            {
                $frontController->logIn('captchaError');
            }
            else
            {
                $frontController->logIn('userDoesNotExist');
            }
        }
        else {
            $frontController->logIn('view');
        }
    }
    elseif ($_GET['action'] == "logout") {
        $frontController->logOut();
    }
    elseif ($_GET['action'] == "adminPage") {
        $backController->adminPage();
    }
    elseif ($_GET['action'] == "userManagement") {
        $backController->userManagement();
    }
    elseif ($_GET['action'] == "deleteUser") {
        if (isset($_GET['i'])) {
            $backController->deleteUser($_GET['i']);
        }
        else {
            $backController->deleteUser("0");
        }
    }
    elseif ($_GET['action'] == "commentManagement") {
        $backController->commentManagement();
    }
    elseif ($_GET['action'] == "approveComment") {
        if (isset($_GET['i'])) {
            $backController->approveComment($_GET['i']);
        }
        else {
            $frontController->error();
        }
    }
    elseif ($_GET['action'] == "deleteComment") {
        if (isset($_GET['i'])) {
            $backController->deleteComment($_GET['i']);
        }
        else {
            $frontController->error();
        }
    }
    elseif ($_GET['action'] == "editPost") {
        if (isset($_GET['i'])) {
            if (isset($_POST['title']) OR isset($_POST['content']) OR isset($_POST['chapo'])) {
                $backController->editOnePost($_POST['title'], $_POST['chapo'], $_POST['content'], $_GET['i']);

            }
            else {
                $backController->editPost($_GET['i']);
            }
        }
        else {
            $frontController->error();
        }
    }
    elseif ($_GET['action'] == "deletePost") {
        if (isset($_GET['i'])) {
            $backController->deletePost($_GET['i']);
        }
        else {
            $frontController->error();
        }
    }
    elseif ($_GET['action'] == "addPost") {
        if (isset($_POST['title']) OR isset($_POST['image']) OR isset($_POST['content']) OR isset($_POST['chapo'])) {
            if (empty($_POST['image'])) { $image = "public/images/defaultCover.jpg"; } else { $image = $_POST['image']; }//si l'user n'a rempli aucune image pour l'article, alors on mets le chemin vers l'image par défaut
            $backController->addOnePost($_POST['title'], $_POST['chapo'], $_POST['content'], $image);
        }
        else {
            $backController->addPost();
        }
    }
    elseif ($_GET['action'] == "addPost") {
        if (isset($_POST['title']) OR isset($_POST['image']) OR isset($_POST['content']) OR isset($_POST['chapo'])) {
            $backController->addOnePost($_POST['title'], $_POST['chapo'], $_POST['content'], $_POST['image']);
        }
        else {
            $backController->addPost();
        }
    }

}

else {
    $frontController = new FrontendController();
    $action = "NULL";
    $frontController->home($action);
}