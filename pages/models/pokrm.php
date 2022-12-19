<?php

class Model{

    function data():array{

        require_once "php/database.php";
        $db = Database::get();

        //Získá informace o produktu
        $query = "SELECT products.id,products.name,products.description,products.price,AVG(reviews.rating) AS 'rating' FROM products LEFT JOIN reviews ON products.id = reviews.id_product WHERE products.id=? GROUP BY products.id ";

        $stmt= $db->prepare($query);
        $stmt->execute([$_GET['id']]);
        
        $result = $stmt->fetchAll();



        $data["product"]["id"] = $result[0]["id"];
        $data["product"]["name"] = $result[0]["name"];
        $data["product"]["description"] = $result[0]["description"];
        $data["product"]["price"] = $result[0]["price"];
        $data["product"]["rating"] = $result[0]["rating"];


        //Získá informace o všech recenzích
        $query = "SELECT users.name as 'author' ,reviews.rating,reviews.comment FROM reviews INNER JOIN products ON products.id=reviews.id_product INNER JOIN users ON users.username = reviews.id_user WHERE id_product=? AND hidden = 0 ORDER BY reviews.id DESC";

        $stmt= $db->prepare($query);
        $stmt->execute([$_GET['id']]);
        
        $data["reviews"] = $stmt->fetchAll();


        return $data;
    }
}