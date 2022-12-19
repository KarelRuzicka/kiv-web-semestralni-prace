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
                case 'approve'://Shválí uživatele = nastaví mu access level na 1

                    $query = "UPDATE users SET access_level = 1 WHERE username = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);
                    
                    
                    break;
                case 'promote': //Povýší uživatele = nastaví mu access level na 2

                    $query = "UPDATE users SET access_level = 2 WHERE username = ?";
                
                    $stmt = $db->prepare($query);
        
                    $stmt->execute([$_POST["username"]]);
                    
                        
                    break;

                case 'demote': //Sníží daného uživatele é nastaví mu access level na 1

                        $query = "UPDATE users SET access_level = 1 WHERE username = ?";
                    
                        $stmt = $db->prepare($query);
            
                        $stmt->execute([$_POST["username"]]);
                        
                            
                        break;
                case 'delete': //Smaže daného uživatele
                            
                    
                    $query = "DELETE FROM users WHERE username = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);


                    //Kaskádové mazání
                    $query = "DELETE FROM reviews WHERE id_user = ?";
            
                    $stmt = $db->prepare($query);
    
                    $stmt->execute([$_POST["username"]]);

                    break;

            }

            
        }
 

    }
}