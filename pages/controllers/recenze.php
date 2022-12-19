<?php

class Controller{

    function __construct()
    {

        if (isset($_POST["id"]) && isset($_POST["rating"]) && isset($_POST["comment"]) && isset($_POST["id_product"]) && isset($_POST["previous_page"])) {


            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();


            //Ošetření XSS útoků
            $comment = htmlspecialchars($_POST["comment"]);


            if ($_POST["id"] == "") {

                $query = "INSERT INTO reviews (rating, comment, id_user, id_product, hidden) VALUES (?,?,?,?,0)";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["rating"], $comment, $_SESSION["USER_username"], $_POST["id_product"]]);

            }else{
                
                $query = "UPDATE reviews SET rating = ?, comment = ? WHERE id = ? AND id_user = ?";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["rating"], $comment, $_POST["id"], $_SESSION["USER_username"]]);
            }


            header('Location: '.$_POST["previous_page"]);
            exit();
        }

    }

}
