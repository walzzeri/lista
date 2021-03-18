<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    return 0;
}

try {
$db = new PDO("mysql:host=localhost;dbname=shoppingList;charset=utf8", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql = "select * from item";
$query =  $db->query($sql);
$results = $query->fetchAll(PDO::FETCH_ASSOC);
header("HTTP/1.1 200 OK");
echo json_encode($results);
}
catch (PDOException $pdoex) {
    header("HTTP/1.1 500 Internal Server Error");
    $error = array("error" => $pdoex->getMessage());
    echo json_encode($error);
}