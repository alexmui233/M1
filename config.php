<?php

$appConfig=array(
    "appTitle" => "Happy Polling", 
);

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');//webserver
define('DB_PASSWORD', '');//eie3117
define('DB_NAME', 'poll');
 
//Attempt to connect to MySQL database
$pdo = new PDO("mysql:host=" .DB_SERVER."; dbname=" .DB_NAME, DB_USERNAME, DB_PASSWORD);
$pdo->exec("SET CHARACTER SET utf8");
//turn on errors in the form of exceptions
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>