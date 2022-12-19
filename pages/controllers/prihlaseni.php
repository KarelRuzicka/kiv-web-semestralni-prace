<?php


class Controller{

    function __construct()
    {
        if (isset($_SESSION["USER_username"])) {
            header('Location: /'.ROOT_DIR);
            exit();
        }

        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["previous_page"])) {
            
            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();



            $query = "SELECT * FROM users WHERE username=?";
            $stmt= $db->prepare($query);
            $stmt->execute([$_POST["username"]]);
            
            $query_result = $stmt->fetchAll();

            if (sizeof($query_result) == 0) {
                $_SESSION["ERROR"] = "Uživatel nenalezen";
                return;
            }

            $hash = $query_result[0]["password"];

            if (!password_verify($_POST["password"], $hash)) {
                 $_SESSION["ERROR"] = "Chybné heslo";
                return;
            }


            $_SESSION["USER_username"] = $_POST["username"];
            $_SESSION["USER_access_level"] = $query_result[0]["access_level"];

            header('Location: '.$_POST["previous_page"]);
            exit();
        }

    }
}