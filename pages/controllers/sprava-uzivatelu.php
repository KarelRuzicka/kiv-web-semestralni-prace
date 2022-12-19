<?php


class Controller{

    function __construct()
    {

        if (isset($_POST["username"]) && isset($_POST["action"])) {
            require_once dirname(__FILE__)."/../../php/database.php";
            $db = Database::get();


            //Kontrola injekce přihlašovacího jména. Administrátor nemá mít právo upravovat ostatní administrátory
            $query = "SELECT access_level FROM users WHERE username=?";
            $stmt= $db->prepare($query);
            $stmt->execute([$_POST["username"]]);
            
            if($stmt->fetchAll()[0][0] >= 3){
                return;
            }


            switch ($_POST["action"]) {                   
                case 'approve':

                    $query = "UPDATE users SET access_level = 1 WHERE username = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);
                    
                    
                    break;
                case 'promote':

                    $query = "UPDATE users SET access_level = 2 WHERE username = ?";
                
                    $stmt = $db->prepare($query);
        
                    $stmt->execute([$_POST["username"]]);
                    
                        
                    break;

                case 'demote':

                        $query = "UPDATE users SET access_level = 1 WHERE username = ?";
                    
                        $stmt = $db->prepare($query);
            
                        $stmt->execute([$_POST["username"]]);
                        
                            
                        break;
                case 'delete':
                            
                    
                    $query = "DELETE FROM users WHERE username = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);


                    $query = "DELETE FROM reviews WHERE id_user = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);

                    break;

            }

            
        }
 

    }
}