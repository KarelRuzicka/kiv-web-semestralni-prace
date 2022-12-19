<?php

class Model{

    function data():array{

        if (!isset($_GET['id'])) {
            header('Location: /'.ROOT_DIR);
            exit();
        }


        require "php/database.php";

        $db = Database::get();


        $query = "SELECT products.id,products.name,products.description,products.price,AVG(reviews.rating) AS 'rating' FROM products LEFT JOIN reviews ON products.id = reviews.id_product WHERE products.id=? GROUP BY products.id ";

        $stmt= $db->prepare($query);
        $stmt->execute([$_GET['id']]);
        
        $result = $stmt->fetchAll();
        if (sizeof($result) == 0) {
            header('Location: /'.ROOT_DIR);
            exit();
        }


        $data["product"]["id"] = $result[0]["id"];
        $data["product"]["name"] = $result[0]["name"];
        $data["product"]["description"] = $result[0]["description"];
        $data["product"]["price"] = $result[0]["price"];
        $data["product"]["rating"] = $result[0]["rating"];


        $query = "SELECT users.name as 'author' ,reviews.rating,reviews.comment FROM reviews INNER JOIN products ON products.id=reviews.id_product INNER JOIN users ON users.username = reviews.id_user WHERE id_product=? AND hidden = 0";

        $stmt= $db->prepare($query);
        $stmt->execute([$_GET['id']]);
        
        $data["reviews"] = $stmt->fetchAll();


        if (isset($_SESSION["USER_username"])) {
           $data["USER_username"] = $_SESSION["USER_username"];
           $data["USER_access_level"] = $_SESSION["USER_access_level"];
        }

        return $data;
    }
}