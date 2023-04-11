<?php
require_once "model.php";

class Products extends Model{

    static public function getData($options = []){
        /** @var PDO $pdo */
        global $pdo;

        $query = new Query("SELECT title,cost,amount FROM products");

        // TODO try
        Model::applyOption($query , $options);
        
        $res = $pdo->query($query->body);
        return $res->fetchAll();
    }
}