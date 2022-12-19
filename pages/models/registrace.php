<?php

class Model{

    function data():array{

        if (isset($_SERVER['HTTP_REFERER'])) {
           $previous_page = $_SERVER['HTTP_REFERER'];
        }else{
            $previous_page = "/".ROOT_DIR;
        }

        $data["previous_page"] = $previous_page;



        if (isset($_SESSION["ERROR"])) {
            $data["ERROR"] = $_SESSION["ERROR"];
            unset($_SESSION["ERROR"]);
        }
        


        return $data;

    }
}