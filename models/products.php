<?php
require_once "model.php";

class Products extends Model{

    static public function getData($options = []){

        $query = new Query("SELECT DISTINCT title,cost,amount 
        FROM products 
        JOIN products_to_categories ON products.id = products_to_categories.product_id");
        $query->applyOption($options);
        $res = $query->result();

        return $res;
    }
}