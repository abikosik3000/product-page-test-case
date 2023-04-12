<?php
require_once '../database/connection_db.php';
require_once "../models/products.php";
require_once "../models/categories.php";
require_once "../database/query_filters.php";

$options = new QueryFilters();
$options->setLimit(0,10);

if (isset($_GET['filter_name'])) {
    $options->setWhere('title' , 'Like' , "%".$_GET['filter_name']."%");
}

if (isset($_GET['category_id'])) {
    if (is_numeric($_GET['category_id'])) {
        $options->setWhere('category_id' , '=' , (int)$_GET['category_id']);
    }
}

if (isset($_GET['order_by'])) {
    $temp = explode(" ",$_GET['order_by']);
    $options->setOrderBy($temp[0] , $temp[1]);
}

if (isset($_GET['page']) &&  isset($_GET['page_count'])) {
    if (is_numeric($_GET['page']) && is_numeric($_GET['page_count'])) {
        $page = (int)$_GET['page'] - 1;
        $page_count = (int)$_GET['page_count'];
        $options->setLimit($page * $page_count, $page_count);
    }
}

$sort_by = [
    "title asc" => "Название",
    "cost asc" => "Цена по возрастанию",
    "cost desc" => "Цена по убыванию",
    "amount asc" => "Наличие по возрастанию",
    "amount desc" => "Наличие по убыванию",
];

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$page_count = isset($_GET["page_count"]) ? $_GET["page_count"] : 10;
$filter_name = isset($_GET["filter_name"]) ? $_GET["filter_name"] : '';

$products = Products::getAllApplyFilters($options);
$categories = Categories::getAllCategory();
$pdo = null;