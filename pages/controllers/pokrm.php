<?php


class Controller{

    function __construct()
    {

        if (isset($_POST['id'])) {
            //Uloží id produktu do sessiony 
            $_SESSION['product-id'] = $_POST['id'];

            //Přesměruje na přidání recenze
            header('Location: /'.ROOT_DIR.'recenze');
            exit();
        }

        //Když není dané id, vrátí na hlavní stránku aby se předešlo chybě
        if (!isset($_GET['id'])) {
            header('Location: /'.ROOT_DIR);
            exit();
        }

        require_once "php/database.php";
        $db = Database::get();

        //Získá informace o produktu
        $query = "SELECT * FROM products WHERE products.id=? ";

        $stmt= $db->prepare($query);
        $stmt->execute([$_GET['id']]);
        
        $result = $stmt->fetchAll();
        //Při neexistujícím produktu vrátí na hlavní stránku aby se předešlo chybě
        if (sizeof($result) == 0) {
            header('Location: /'.ROOT_DIR);
            exit();
        }

    }
}