<?php

/* You should enable error reporting for mysqli before attempting to make a connection */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = new mysqli("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);

/* Set the desired charset after establishing a connection */
$mysqli->set_charset('utf8mb4');

$mysqli->select_db("test_from_admin");

var_dump($mysqli->query("INSERT test(name) VALUES ('Nick4')  "));
//echo $mysqli->query("")

printf("Success... %s\n", $mysqli->host_info);
/*
$link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The docker database is great." . PHP_EOL;

mysqli_close($link);
*/