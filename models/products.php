<?php
require_once "model.php";

class Products extends Model{

    private const ALLOWED_FIELDS = array("title" , "id" , "amount" , "cost" , "category_id");

    static public function getAllApplyFilters($options = []){

        $query = new Query("SELECT DISTINCT title,cost,amount 
        FROM products 
        JOIN products_to_categories 
        ON products.id = products_to_categories.product_id"
        ,Products::ALLOWED_FIELDS);
        
        $res = $query->result($options);

        return $res;
    }
}