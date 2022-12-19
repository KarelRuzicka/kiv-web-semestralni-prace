<?php

class Model{

    function data():array{

        if (isset($_SESSION['query_edit'])) {
            $data['query_edit'] =  $_SESSION['query_edit'];
            unset($_SESSION['query_edit']);
            return $data;
        }else{
            return array();
        }

    }
}