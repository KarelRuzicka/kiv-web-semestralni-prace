<?php


class Controller{

    function __construct()
    {   
        //Když je uživatel již přihlášen, přesměruje na hlavní stránku
        if (isset($_SESSION["USER_username"])) {
            header('Location: /'.ROOT_DIR);
            exit();
        }

        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["previous_page"])) {
            
            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();


            //Kontrola uživatelského jména
            $query = "SELECT * FROM users WHERE username=?";
            $stmt= $db->prepare($query);
            $stmt->execute([$_POST["username"]]);
            
            $query_result = $stmt->fetchAll();

            if (sizeof($query_result) == 0) {
                $_SESSION["ERROR"] = "Uživatel nenalezen";
                return;
            }

            //Kontrola hesla
            $hash = $query_result[0]["password"];

            if (!password_verify($_POST["password"], $hash)) {
                 $_SESSION["ERROR"] = "Chybné heslo";
                return;
            }

            //Přihlášení
            $_SESSION["USER_username"] = $_POST["username"];
            $_SESSION["USER_access_level"] = $query_result[0]["access_level"];

            //Přesměrování na předchozí stránku
            header('Location: '.$_POST["previous_page"]);
            exit();
        }

    }
}