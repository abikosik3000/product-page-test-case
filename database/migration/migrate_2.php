<?php
require_once '../connection_db.php';
/** @var PDO $pdo */
global $pdo;

$pdo->query("
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Скейтборд', '11');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '2500', 'Пенниборд', '12');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '1500', 'Стикборд', '13');

INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Шлем', '20');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '3500', 'Комплект защиты', '13');

INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '15000', 'Шоссейный велосипед', '10');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '12500', 'Горный велоcипед', '4');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '5590', 'Детский велосипед', '5');


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
");

$pdo->query("
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '500', 'Гантеля', '98');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '5500', 'Штанга', '56');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '11000', 'Скамья для пресса', '5');
INSERT INTO `products` (`id`, `cost`, `title`, `amount`) VALUES (NULL, '7000', 'Гиря', '20');

INSERT INTO `categories` (`id`, `category_name`) VALUES (NULL, 'Фитнес');

INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('9', '5');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('10', '5');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('11', '5');
INSERT INTO `products_to_categories` (`product_id`, `category_id`) VALUES ('12', '5');

");