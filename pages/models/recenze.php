
<?php

class Model{

    function data():array{

        if(isset($_SESSION['product-id'])){
            $data['review']['id_product'] = $_SESSION['product-id'];
            $data['previous_page'] = "/".ROOT_DIR."pokrm?id=".$_SESSION['product-id'];
            unset($_SESSION['product-id']);
            return $data;
        }

        if(isset($_SESSION['query_edit'])){
            $data['review'] = $_SESSION['query_edit'];
            $data['previous_page'] = "/".ROOT_DIR."moje-recenze";
            unset($_SESSION['query_edit']);
            return $data;
        }



        
        return array();

        
    }
}