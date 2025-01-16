<?php
session_start();
// Veritabanı bağlantı bilgileri
$servername = "127.0.0.1";
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "kahvesiparisi"; // Veritabanı adı

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri al
$user = $_POST['kullaniciadi'];
$pass = $_POST['sifre'];

// SQL sorgusu
$sql = "SELECT * FROM tbl_kullanici WHERE kullaniciadi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Kullanıcı bulundu, hashlenmiş şifreyi kontrol et
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['sifre'])) {
        // Şifre doğru, oturumda kullanıcı bilgilerini sakla
        $_SESSION['id'] = $row['id']; // Kullanıcı ID'sini oturuma kaydet
        $_SESSION['kullaniciadi'] = $row['kullaniciadi']; // Kullanıcı adını oturuma kaydet
        
        // Anasayfaya yönlendir
        header("Location: anasayfa.html");
        exit;
    } else {
        // Şifre yanlış, hata mesajı göster
        echo "<script>
            alert('Kullanıcı adı veya şifre hatalı!');
            window.location.href = 'login.html';
        </script>";
    }
} else {
    // Kullanıcı bulunamadı, hata mesajı göster
    echo "<script>
        alert('Kullanıcı adı veya şifre hatalı!');
        window.location.href = 'login.html';
    </script>";
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
