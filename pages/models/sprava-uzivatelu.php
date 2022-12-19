<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();


        //Získá informace o uživatelích
        $query = "SELECT username,name,access_level FROM users";
            
        $result = $db->query($query)->fetchAll();



        $data["users"] = $result;

        return $data;

    }
}