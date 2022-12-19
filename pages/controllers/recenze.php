<?php

class Controller{

    function __construct()
    {

        if (isset($_POST["id"]) && isset($_POST["rating"]) && isset($_POST["comment"]) && isset($_POST["id_product"]) && isset($_POST["previous_page"])) {


            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();

           
            

            //Ošetření XSS útoků
            $comment = htmlspecialchars($_POST["comment"], ENT_QUOTES);

            //Vrátíme povolené tagy
            $comment = preg_replace('#&lt;(/?(?:br|p|b|i|u|strike|sup|sub))&gt;#', '<\1>', $comment);


            
            //Když není zadané id, přidá novou recenzi
            if ($_POST["id"] == "") {

                $query = "INSERT INTO reviews (rating, comment, id_user, id_product, hidden) VALUES (?,?,?,?,0)";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["rating"], $comment, $_SESSION["USER_username"], $_POST["id_product"]]);

            //Když zadané je, recenzi upraví
            }else{
                
                $query = "UPDATE reviews SET rating = ?, comment = ? WHERE id = ? AND id_user = ?";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["rating"], $comment, $_POST["id"], $_SESSION["USER_username"]]);

                //Je selektováno také podle id uživatele, aby nemohl uživatel podstrčit jinou recenzi
            }


            //Po odesláiní vrátí na přechozí stránku
            header('Location: '.$_POST["previous_page"]);
            exit();
        }


        //Bez product-id není co hodnotit
        if(!isset($_SESSION['product-id']) && !isset($_SESSION['query_edit'])){
            header('Location: /'.ROOT_DIR);
            exit();
        }

    }

}
