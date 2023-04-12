<?php
require_once "model.php";

class Products extends Model
{

    /**
     * return all produts from db satisfying the options
     * 
     * @param QueryFilters $options
     */
    static public function getAllApplyFilters(QueryFilters $options)
    {
        $allowed_fields = array("title" , "id" , "amount" , "cost" , "category_id");

        $query = new Query("SELECT DISTINCT title,cost,amount 
        FROM products 
        JOIN products_to_categories 
        ON products.id = products_to_categories.product_id"
        ,$allowed_fields);
        
        $res = $query->result($options);
        return $res;
    }
}