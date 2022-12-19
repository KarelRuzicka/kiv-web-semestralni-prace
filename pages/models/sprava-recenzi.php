<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();

        $query = "SELECT id,id_user,rating,comment,hidden FROM reviews";
            
        $result = $db->query($query)->fetchAll();



        $data["reviews"] = $result;

        return $data;

    }
}