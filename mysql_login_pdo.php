<?php

$host = "localhost"; //Host Name
$port = '3306'; //Default MySQL Port
$dbname = "ergo_webform"; //Database Name
$db_username = "ergo"; //MySQL Username
$db_password = "ergo"; //MySQL Password

$dsn = "mysql:host=$host;port=$port;dbname=$dbname"; //Data Source Name = Mysql
try {
    $db = new PDO($dsn, $db_username, $db_password); //Connect to DB
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Cannot connect to database");
}

