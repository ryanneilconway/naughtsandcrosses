<?php
/**
 * Created by PhpStorm.
 * User: ryann_000
 * Date: 20/08/2017
 * Time: 07:54 PM
 */

class DB {

    // Access Through Instance
    private static $instance = NULL;

    // Prevent Use of new DB()
    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if(!isset(self::$instance)) {
            $host = "localhost";
            $database = "myDB";
            $username = "root";
            $password = "";
            $charset = "utf8";


            self::$instance = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $username, $password);
        }
        return self::$instance;
    }
}