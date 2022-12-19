<?php

class Model{

    function data():array{

        require "php/database.php";

        $PDO = Database::get();


        $q = "SELECT products.id,products.name,products.description,products.price,AVG(reviews.rating) AS 'rating' FROM products LEFT JOIN reviews ON products.id = reviews.id_product GROUP BY products.id";

        $data["products"] = $PDO->query($q)->fetchAll();

        return $data;
    }
}