<?php


class Controller{

    function __construct()
    {

        if (isset($_POST["id"]) && isset($_POST["action"])) {

            require_once dirname(__FILE__)."/../../php/database.php";
            $db = Database::get();


            switch ($_POST["action"]) {                   
                case 'hide':

                    $query = "UPDATE reviews SET hidden = 1 WHERE id = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"]]);
                    
                    
                    break;
                case 'show':

                    $query = "UPDATE reviews SET hidden = 0 WHERE id = ?";
                
                    $stmt = $db->prepare($query);
        
                    $stmt->execute([$_POST["id"]]);
                    
                        
                    break;

                case 'delete':
                            
                
                    $query = "DELETE FROM reviews WHERE id = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["id"]]);

                    break;

            }

            
        }
 

    }
}