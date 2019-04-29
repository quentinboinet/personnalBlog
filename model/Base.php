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
            $db = new PDO('mysql:host=quentinbae371.mysql.db;dbname=quentinbae371;charset=utf8', 'quentinbae371', 'woargsE1');
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}