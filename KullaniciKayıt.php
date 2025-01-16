<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kahvesiparisi";

$conn = new mysqli($host, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

echo "Veritabanı bağlantısı başarılı!<br>";

// Formdan gelen veriler
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "POST isteği alındı!<br>";
    $isim = $_POST['isim'];
    $soyisim = $_POST['soyisim'];
    $email = $_POST['email'];
    $telno = $_POST['telno'];
    $adres = $_POST['adres'];
    $kullaniciadi = $_POST['kullaniciadi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    
    
    

    // Veritabanına ekleme
    $sql = "INSERT INTO tbl_kullanici (isim,soyisim,email,telno,adres,kullaniciadi, sifre ) 
            VALUES (?,?,?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssss",$isim,$soyisim, $email, $telno,$adres,$kullaniciadi,$sifre);
        if ($stmt->execute()) {
            echo "Kayıt başarılı!<br>";
            header("Location: login.html");
            exit();
        } else {
            echo "Hata: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Hata (prepare): " . $conn->error . "<br>";
    }
} else {
    echo "POST isteği alınamadı!<br>";
}

$conn->close();
?>