<?php


class Controller{

    function __construct()
    {
        if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"])) {

            require dirname(__FILE__)."/../../php/database.php";
            $db = Database::get();


            //Když není zadané id, přidá nový pokrm
            if ($_POST["id"] == "") {

                $query = "INSERT INTO products (name, description, price) VALUES (?,?,?)";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["name"], $_POST["description"], $_POST["price"]]);

            //Když zadané je, pokrm upraví
            }else{
                
                $query = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
                $stmt= $db->prepare($query);
                $stmt->execute([$_POST["name"], $_POST["description"], $_POST["price"], $_POST["id"]]);
            }


             //Po odesláiní vrátí na správu pokrmů
            header('Location: /'.ROOT_DIR."sprava-pokrmu");
            exit();
        

        }

    }
}