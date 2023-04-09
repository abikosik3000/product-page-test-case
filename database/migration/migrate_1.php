<?php
require_once '../connection_db.php';
/** @var PDO $pdo */

$pdo->query("DROP TABLE IF EXISTS products");

$pdo->query("
CREATE TABLE products(
    id INT PRIMARY KEY AUTO_INCREMENT,
    cost DECIMAL(10,2) NOT NULL,
    title VARCHAR(255) NOT NULL,
    amount INT NULL DEFAULT NULL 
)
");

$pdo = null;