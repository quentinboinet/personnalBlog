<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require_once 'model/Backend.php';
require_once 'model/Frontend.php';
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

    $back = new Backend();
    $users = $back->getUsersList();
    $nbUsers = $back->getNbUsers();

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

    $back = new Backend();
    $retour = $back->deleteOneUser($userId);

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

    $back = new Backend();
    $comments = $back->getCommmentsPendingApproval();
    $nbComments = $back->getNbCommentsPendingApproval();

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

    $back = new Backend();
    $retour = $back->approveOneComment($id);

    $comments = $back->getCommmentsPendingApproval();
    $nbComments = $back->getNbCommentsPendingApproval();

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

    $back = new Backend();
    $retour = $back->deleteOneComment($id);

    $comments = $back->getCommmentsPendingApproval();
    $nbComments = $back->getNbCommentsPendingApproval();

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

    $front = new Frontend();
    $nbPost = $front->getNbPosts($id);

    if ($nbPost == 1)//si l'id du post existe bien
    {
        $postInfo = $front->getOnePost($id);

        $template = $twig->load('editPostView.php');
        echo $template->render(['datas' => $postInfo]);
    }
    else
    {

    }
}

function editOnePost($title, $chapo, $content, $postId)
{

    $front = new Frontend();
    $nbPost = $front->getNbPosts($postId);

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);

    if ($nbPost == 1)//si l'id du post existe bien
    {
        $back = new Backend();
        $retour = $back->editSinglePost($title, $chapo, $content, $postId);

        if ($retour == "OK")
        {
            $post = $front->getOnePost($postId);
            $comments = $front->getComments($postId);
            $nbComments = $front->getNbComments($postId);

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

    $back = new Backend();
    $front = new Frontend();
    $retour = $back->deleteOnePost($id);

    $start = 1;
    $posts = $front->getPosts($start);
    $nbPage = ceil($front->getNbPosts($id)/5);

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

function addPost()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);
    $template = $twig->load('addPostView.php');
    echo $template->render();
}
function addOnePost($title, $chapo, $content, $image)
{
    $back = new Backend();
    $back->insertOnePost($title, $chapo, $content, $image);

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);
    $twig->addGlobal('session', $_SESSION);
    $template = $twig->load('adminPageView.php');
    echo $template->render(['js' => 'toasterPostAdded']);
}