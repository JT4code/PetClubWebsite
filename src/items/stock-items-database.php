<?php

$host = "VeiwStockItemUser@localhost";
$dbname = "Stock_items";
$username = "VeiwStockItemUser";
$password = "56s78SXKNnH";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;