<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();

        $query = "SELECT id,rating,comment FROM reviews WHERE id_user = ?";

        $stmt= $db->prepare($query);
        $stmt->execute([$_SESSION["USER_username"]]);
        
        $result = $stmt->fetchAll();



        $data["reviews"] = $result;

        return $data;

    }
}