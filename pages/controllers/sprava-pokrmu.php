<?php


class Controller{

    function __construct()
    {

        if (isset($_POST["id"]) && isset($_POST["action"])) {
            require_once dirname(__FILE__)."/../../php/database.php";
            $db = Database::get();

            switch ($_POST["action"]) {                   
                case 'edit': //Při akci edit vybere všechny údaje daného pokrmu a přesměruje na stránku uprava-pokrmu

                    $query = "SELECT id,name,description,price FROM products WHERE id = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"]]);
                    
                    $_SESSION["query_edit"] = $stmt->fetchAll()[0];

                    header('Location: /'.ROOT_DIR.'uprava-pokrmu');
                    exit();
                    
                    break;
                case 'delete': //Při akci delete rovnou smaže daný pokrm
                            
                    
                    $query = "DELETE FROM products WHERE id = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"]]);

                    //Kaskádové mazání
                    $query = "DELETE FROM reviews WHERE id_product = ?";

                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"]]);

                    break;

            }

            
        }
 

    }
}