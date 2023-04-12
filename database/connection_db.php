<?php
$ini = parse_ini_file('config.ini');
$DBuser = $ini["db_user"];
$DBpass = $ini["db_password"];
$GLOBALS['pdo'] = null;
try{
    global $pdo;
    $database = $ini["db_for_pdo"];
    $pdo = new PDO($database, $DBuser, $DBpass);
    $pdo->query("USE {$ini["db_basename"]}");
    //echo "Success: A proper connection to MySQL was made! The docker database is great.";    
} catch(PDOException $e) {
    echo "Error: Unable to connect to MySQL. Error:\n $e";
}
