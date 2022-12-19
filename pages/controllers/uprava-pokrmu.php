<?php


class Controller{

    function __construct()
    {
        if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"])) {

            require dirname(__FILE__)."/../../php/database.php";

            $db = Database::get();


            
            if ($_POST["id"] == "") {

                $query = "INSERT INTO products (name, description, price) VALUES (?,?,?)";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["name"], $_POST["description"], $_POST["price"]]);

            }else{
                
                $query = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["name"], $_POST["description"], $_POST["price"], $_POST["id"]]);
            }


            header('Location: /'.ROOT_DIR."sprava-pokrmu");
            exit();
        

        }

    }
}