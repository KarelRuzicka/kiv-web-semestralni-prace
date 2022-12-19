<?php


class Database{

    /** Odkaz na jedináčka */
    private static $database;

    /** Odkaz na připojení do databáze */
    private $pdo;

    private function __construct(){
        // Připojení k databázi
        $this->pdo = new \PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $this->pdo->exec("set names utf8");
    }

    public static function get(){
        if(empty(self::$database)){
            self::$database = new Database();
        }
        return self::$database->pdo;
    }


}