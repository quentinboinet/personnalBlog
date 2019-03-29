<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 18:04
 */

require('model/frontend.php');
require_once 'vendor/autoload.php';


function home()
{
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'auto_reload' => 'true',
    ]);

    $template = $twig->load('homeView.php');
    echo $template->render();
}
