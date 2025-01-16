<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kahvesiparisi";

$conn =mysqli_connect($host, $username, $password,$dbname);
 

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

//echo "Veritabanı bağlantısı başarılı!<br>";
?>