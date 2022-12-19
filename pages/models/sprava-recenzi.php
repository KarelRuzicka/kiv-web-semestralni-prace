<?php

class Model{

    function data():array{

        require_once dirname(__FILE__)."/../../php/database.php";

        $db = Database::get();

        //Získá informace o recenzích
        $query = "SELECT reviews.id,reviews.id_user,products.name,reviews.rating,reviews.comment,reviews.hidden FROM reviews INNER JOIN products ON reviews.id_product = products.id";
            
        $result = $db->query($query)->fetchAll();



        $data["reviews"] = $result;

        return $data;

    }
}