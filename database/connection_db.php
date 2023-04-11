<?php
$DBuser = 'root';
$DBpass = $_ENV['MYSQL_ROOT_PASSWORD'];
$GLOBALS['pdo'] = null;

try{
    global $pdo;
    $database = 'mysql:host=database:' . $_ENV['HOST_MACHINE_MYSQL_PORT'];
    $pdo = new PDO($database, $DBuser, $DBpass);
    $pdo->query("USE test_from_admin");
    //echo "Success: A proper connection to MySQL was made! The docker database is great.";    
} catch(PDOException $e) {
    echo "Error: Unable to connect to MySQL. Error:\n $e";
}

//DROP OBJECT_TYPE [ IF EXISTS ] OBJECT_NAME
