<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kahvesiparisi";

$conn =mysqli_connect($host, $username, $password,$dbname);
 


if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}


?>