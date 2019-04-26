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

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $template = $twig->load('adminPageView.php');
            echo $template->render();
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
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

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $template = $twig->load('userManagementView.php');
            echo $template->render(['users' => $users, 'nbUser' => $nbUsers]);
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
    }

    function deleteUser($userId)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $back = new Backend();
            $retour = $back->deleteOneUser($userId);

            $template = $twig->load('userManagementView.php');

            if ($retour == "OK") {
                echo $template->render(['js' => 'toasterUserDeleted']);
            } else {
                echo $template->render(['js' => 'toasterUserNotDeleted']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
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

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $template = $twig->load('commentManagementView.php');
            echo $template->render(['comments' => $comments, 'nbComment' => $nbComments]);
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
    }

    function approveComment($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        $template = $twig->load('commentManagementView.php');

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $back = new Backend();
            $retour = $back->approveOneComment($id);

            $comments = $back->getCommmentsPendingApproval();
            $nbComments = $back->getNbCommentsPendingApproval();

            if ($retour == "OK") {
                echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentApproved']);
            } else {
                echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentNotExist']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
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

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $back = new Backend();
            $retour = $back->deleteOneComment($id);

            $comments = $back->getCommmentsPendingApproval();
            $nbComments = $back->getNbCommentsPendingApproval();


            if ($retour == "OK") {
                echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentDeleted']);
            } else {
                echo $template->render(['comments' => $comments, 'nbComment' => $nbComments, 'js' => 'toasterCommentNotExist']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
    }

    function editPost($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $front = new Frontend();
            $nbPost = $front->getNbPosts($id);
            $authorId = $front->getPostAuthorId($id);

            if ($nbPost == 1)//si l'id du post existe bien
            {
                $postInfo = $front->getOnePost($id, $authorId);

                $template = $twig->load('editPostView.php');
                echo $template->render(['datas' => $postInfo]);
            } else
                {
                $template = $twig->load('errorPageView.php');
                echo $template->render(['errorType' => 'postDoesNotExist']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
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


        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            if ($nbPost == 1)//si l'id du post existe bien
            {
                $back = new Backend();
                $retour = $back->editSinglePost($title, $chapo, $content, $postId);

                if ($retour == "OK") {
                    $authorId = $front->getPostAuthorId($postId);

                    $post = $front->getOnePost($postId, $authorId);
                    $comments = $front->getComments($postId);
                    $nbComments = $front->getNbComments($postId);

                    $template = $twig->load('postView.php');
                    echo $template->render(['datas' => $post, 'comments' => $comments, 'nbComments' => $nbComments, 'js' => 'toasterPostEdited']);
                } else {
                    $template = $twig->load('errorPageView.php');
                    echo $template->render(['errorType' => 'unidentified']);
                }
            } else {
                $template = $twig->load('errorPageView.php');
                echo $template->render(['errorType' => 'postDoesNotExist']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }

    }

    function deletePost($id)
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $back = new Backend();
            $front = new Frontend();
            $retour = $back->deleteOnePost($id);

            $start = 1;
            $posts = $front->getPosts($start);
            $nbPage = ceil($front->getNbPosts($id) / 5);

            $actualPage = $start;

            $template = $twig->load('blogView.php');


            if ($retour == "OK") {
                echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage, 'js' => 'toasterPostDeleted']);
            } else {
                echo $template->render(['datas' => $posts, 'nbPage' => $nbPage, 'actualPage' => $actualPage, 'js' => 'toasterNoPost']);
            }
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
    }

    function addPost()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'auto_reload' => 'true',
        ]);
        $twig->addGlobal('session', $_SESSION);

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1")
        {
            $template = $twig->load('addPostView.php');
            echo $template->render();
        }
        else
        {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
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

        if (isset($_SESSION['type']) AND $_SESSION['type'] == "1") {
            $template = $twig->load('adminPageView.php');
            echo $template->render(['js' => 'toasterPostAdded']);
        } else {
            $template = $twig->load('errorPageView.php');
            echo $template->render(['errorType' => 'notAdmin']);
        }
    }