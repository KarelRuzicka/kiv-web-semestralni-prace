<?php


class Controller{

    function __construct()
    {

        if (isset($_POST['id'])) {
            $_SESSION['product-id'] = $_POST['id'];

            header('Location: /'.ROOT_DIR.'recenze');
            exit();
        }
         
 
 
        
 

    }
}