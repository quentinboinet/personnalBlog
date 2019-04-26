<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 27/03/2019
 * Time: 17:13
 */

Class Base
{
    protected function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=personnalBlog;charset=utf8', 'root', '');
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}