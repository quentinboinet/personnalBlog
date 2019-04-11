<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require('model/backend.php');
require_once 'model/frontend.php';
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

function approveComment($id)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $template = $twig->load('commentManagementView.php');
    $retour = approveOneComment($id);

    $comments = getCommmentsPendingApproval();
    $nbComments = getNbCommentsPendingApproval();

    if ($retour == "OK")
    {
        echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentApproved']);
    }
    else
    {
        echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentNotExist']);
    }
}

function deleteComment($id)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $template = $twig->load('commentManagementView.php');
    $retour = deleteOneComment($id);

    $comments = getCommmentsPendingApproval();
    $nbComments = getNbCommentsPendingApproval();

    if ($retour == "OK")
    {
        echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentDeleted']);
    }
    else
    {
        echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentNotExist']);
    }
}

function editPost($id)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $nbPost = getNbPosts($id);

    if ($nbPost == 1)//si l'id du post existe bien
    {
        $postInfo = getOnePost($id);

        $template = $twig->load('editPostView.php');
        echo $template->render(['datas' => $postInfo]);
    }
    else
    {

    }
}

function editOnePost($title, $chapo, $content, $postId)
{
    $nbPost = getNbPosts($postId);

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    if ($nbPost == 1)//si l'id du post existe bien
    {
        $retour = editSinglePost($title, $chapo, $content, $postId);
        if ($retour == "OK")
        {
            $post = getOnePost($postId);
            $comments = getComments($postId);
            $nbComments = getNbComments($postId);

            $template = $twig->load('postView.php');
            echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterPostEdited']);
        }
        else
        {

        }
    }
    else
    {

    }

}
function deletePost($id)
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    $retour = deleteOnePost($id);

    $start = 1;
    $posts = getPosts($start);
    $nbPage = ceil(getNbPosts()/5);
    $actualPage = $start;

    $template = $twig->load('blogView.php');

    if ($retour == "OK")
    {
        echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage, 'js' => 'toasterPostDeleted']);
    }
    else
    {
        echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage, 'js' => 'toasterNoPost']);
    }
}