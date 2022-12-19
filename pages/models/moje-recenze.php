<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();

        //Získá recenze daného uživatele
        $query = "SELECT reviews.id,products.name,reviews.rating,reviews.comment FROM reviews INNER JOIN products ON reviews.id_product = products.id WHERE id_user = ?";

        $stmt= $db->prepare($query);
        $stmt->execute([$_SESSION["USER_username"]]);
        
        $result = $stmt->fetchAll();



        $data["reviews"] = $result;

        return $data;

    }
}