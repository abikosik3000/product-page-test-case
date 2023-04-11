<?php
require_once '../connection_db.php';
/** @var PDO $pdo */
global $pdo;

$pdo->query("DROP TABLE IF EXISTS products_to_categories ");
$pdo->query("DROP TABLE IF EXISTS products");
$pdo->query("DROP TABLE IF EXISTS categories");

$pdo->query("
CREATE TABLE products(
    id INT PRIMARY KEY AUTO_INCREMENT,
    cost DECIMAL(10,2) NOT NULL,
    title VARCHAR(255) NOT NULL,
    amount INT NULL DEFAULT NULL 
)
");

$pdo->query("
CREATE TABLE categories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL
)
");

$pdo->query("
CREATE TABLE products_to_categories(
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (product_id)  REFERENCES products (id) ON DELETE CASCADE,
    FOREIGN KEY (category_id)  REFERENCES categories (id) ON DELETE CASCADE
)
");

$pdo = null;

/*
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Скейтборд', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '2500', 'Пенниборд', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '1500', 'Стикборд', '10');

INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Шлем', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Комплект защиты', '10');

INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '15000', 'Шоссейный велосипед', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '12500', 'Горный веловипед', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '5590', 'Детский велосипед', '10');


INSERT INTO `categories` (`id`, `category_name`) VALUES (NULL, 'Аксессуары');
INSERT INTO `categories` (`id`, `category_name`) VALUES (NULL, 'Активный отдых');
INSERT INTO `categories` (`id`, `category_name`) VALUES (NULL, 'Велосипеды');
INSERT INTO `categories` (`id`, `category_name`) VALUES (NULL, 'Скейтборды');


INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('4', '1');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('5', '1');

INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('1', '2');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('2', '2');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('3', '2');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('6', '2');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('7', '2');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('8', '2');

INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('6', '3');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('7', '3');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('8', '3');

INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('1', '4');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('2', '4');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('3', '4');
*/