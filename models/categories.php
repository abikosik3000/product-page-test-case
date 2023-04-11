<?php
require_once "model.php";

class Categories extends Model{

    static public function getData($options = []){
        /** @var PDO $pdo */
        global $pdo;

        $query = "SELECT id, category_name FROM categories";
        
        $res = $pdo->query($query);
        return $res->fetchAll();
    }
}