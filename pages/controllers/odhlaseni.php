<?php


class Controller{

    function __construct()
    {
        //Smaže sesiony - dojde k odhlášení
        unset($_SESSION["USER_username"]);
        unset($_SESSION["USER_access_level"]);

        //Fallback na domovskou stránku, když není předchozí
        if (isset($_SERVER['HTTP_REFERER'])) {
            $previous_page = $_SERVER['HTTP_REFERER'];
         }else{
            $previous_page = "/".ROOT_DIR;
         }
         
 
        //Přesměruje na přechozí stránku
        header('Location: '.$previous_page);
        exit();
 

    }
}