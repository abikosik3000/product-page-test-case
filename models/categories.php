<?php
require_once "model.php";

class Categories extends Model{
    
    /**
     * return all category from db
     * 
     * @param array $options
     */
    static public function getAllCategory(){
        
        $query = new Query("SELECT id, category_name FROM categories");
        $res = $query->result();
        return $res;
    }
}