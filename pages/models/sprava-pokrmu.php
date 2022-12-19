<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();

        $query = "SELECT id,name,description,price FROM products";
            
        $result = $db->query($query)->fetchAll();



        $data["products"] = $result;

        return $data;

    }
}