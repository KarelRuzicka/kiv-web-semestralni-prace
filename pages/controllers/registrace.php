<?php

class Controller{

    function __construct()
    {
        //Když je uživatel již přihlášen, přesměruje na hlavní stránku
        if (isset($_SESSION["USER_username"])) {
            header('Location: /'.ROOT_DIR);
            exit();
        }


        if (isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["previous_page"])) {
            
            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();


            //Kontrola jestli je už. jméno volné
            $query = "SELECT * FROM users WHERE username=?";
            $stmt= $db->prepare($query);
            $stmt->execute([$_POST["username"]]);
            
            if (sizeof($stmt->fetchAll()) > 0) {
                $_SESSION["ERROR"] = "Uživatelské jméno již existuje";
                return;
            }


            //Ošetření XSS útoků
            $username = htmlspecialchars($_POST["username"]);
            $name = htmlspecialchars($_POST["name"]);

            //Šifrování hesla
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            //Základní nepotvrzený uživatel
            $access_level = 0;

            //Přidání uživatele
            $query = "INSERT INTO users (username, name, password, access_level) VALUES (?,?,?,?)";
            $stmt= $db->prepare($query);
            $stmt->execute([$username, $name, $password, $access_level]);

            //Přihlášení
            $_SESSION["USER_username"] = $username;
            $_SESSION["USER_access_level"] = $access_level;

            //Přesměrování na předchozí stránku
            header('Location: '.$_POST["previous_page"]);
            exit();
        }

    }
}