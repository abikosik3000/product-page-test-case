<?php
require_once '../database/connection_db.php';
require_once "../models/products.php";
require_once "../models/categories.php";

$options = [
    'limit' => [
        'from' => 0,
        'count' => 10
    ],
    'sort_by' => [
        'title' => 'asc'
    ]
];

if(isset($_GET['filter_name'])){
    $options['where'][] = [
        'field' => 'title',
        'sign' => 'Like',
        'value' => "%".$_GET['filter_name']."%",
    ];
}

if(isset($_GET['category_id'])){
    if(is_numeric($_GET['category_id'])){
        $options['where'][] = [
            'field' => 'category_id',
            'sign' => '=',
            'value' => (int)$_GET['category_id'],
        ];
    }
}

if(isset($_GET['order_by'])){
    $temp = explode(" ",$_GET['order_by']);
    $options['order_by'][$temp[0]] = $temp[1];
}

if(isset($_GET['page']) &&  isset($_GET['page_count'])){
    if(is_numeric($_GET['page']) && is_numeric($_GET['page_count']) ){
        $page = (int)$_GET['page'] - 1;
        $page_count = (int)$_GET['page_count'];
        $options['limit']['from'] = $page * $page_count;
        $options['limit']['count'] = $page_count;
    }
}
//var_dump($options);
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