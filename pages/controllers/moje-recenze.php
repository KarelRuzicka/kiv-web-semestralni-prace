<?php


class Controller{

    function __construct()
    {

        if (isset($_POST["id"]) && isset($_POST["action"])) {

            require_once dirname(__FILE__)."/../../php/database.php";
            $db = Database::get();

           

            switch ($_POST["action"]) {                   
                case 'edit': //Při akci edit vybere všechny údaje dané recenze a přesměruje na stránku recenze

                    $query = "SELECT id,rating,comment,id_product FROM reviews WHERE id = ? AND id_user = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"], $_SESSION["USER_username"]]);
                    
                    $_SESSION["query_edit"] = $stmt->fetchAll()[0];

                    header('Location: /'.ROOT_DIR.'recenze');
                    exit();

                    break;
                case 'delete': //Při akci delete rovnou smaže danou recenze
                            
                
                    $query = "DELETE FROM reviews WHERE id = ? AND id_user = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"], $_SESSION["USER_username"]]);

                    break;

                    //U obou příkazů je selektováno také podle id uživatele, aby nemohl uživatel podstrčit jinou recenzi

            }

            
        }
 

    }
}