<?php
require_once "model.php";

class Categories extends Model{

    static public function getData($options = []){
        
        $query = new Query("SELECT id, category_name FROM categories");
        $res = $query->result();

        return $res;
    }
}