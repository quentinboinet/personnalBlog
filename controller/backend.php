<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require('model/backend.php');
require_once 'vendor/autoload.php';


function adminPage()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $template = $twig->load('adminPageView.php');
    echo $template->render();
}

function userManagement()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $users = getUsersList();
    $nbUsers = getNbUsers();

    $template = $twig->load('userManagementView.php');
    echo $template->render(['users' => $users, 'nbUser' => $nbUsers]);
}

function deleteUser($userId)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $retour = deleteOneUser($userId);
    $template = $twig->load('userManagementView.php');

    if ($retour == "OK")
    {
        echo $template->render(['js' => 'toasterUserDeleted']);
    }
    else
    {
        echo $template->render(['js' => 'toasterUserNotDeleted']);
    }
}

function commentManagement()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $comments = getCommmentsPendingApproval();
    $nbComments = getNbCommentsPendingApproval();

    $template = $twig->load('commentManagementView.php');
    echo $template->render(['comments' => $comments, 'nbComment' => $nbComments]);
}