<?php


class Controller{

    function __construct()
    {

        unset($_SESSION["USER_username"]);
        unset($_SESSION["USER_access_level"]);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $previous_page = $_SERVER['HTTP_REFERER'];
         }else{
            $previous_page = "/".ROOT_DIR;
         }
         
 
 
        header('Location: '.$previous_page);
        exit();
 

    }
}