<?php

class Model{

    function data():array{

        //Získá url předchozí stránky aby se na ní šlo vrátit
        if (isset($_SERVER['HTTP_REFERER'])) {
           $previous_page = $_SERVER['HTTP_REFERER'];
        }else{
            $previous_page = "/".ROOT_DIR;
        }

        $data["previous_page"] = $previous_page;


        //Když je definován error, předá ho do pohledu
        if (isset($_SESSION["ERROR"])) {
            $data["ERROR"] = $_SESSION["ERROR"];
            unset($_SESSION["ERROR"]);
        }
        


        return $data;

    }
}