<?php
session_start();

$servername = "127.0.0.1";
$username = "root"; 
$password = ""; 
$dbname = "kahvesiparisi"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


$user = $_POST['kullaniciadi'];
$pass = $_POST['sifre'];


$sql = "SELECT * FROM tbl_kullanici WHERE kullaniciadi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['sifre'])) {
        
        $_SESSION['id'] = $row['id']; 
        $_SESSION['kullaniciadi'] = $row['kullaniciadi']; 
        
       
        header("Location: anasayfa.html");
        exit;
    } else {
        
        echo "<script>
            alert('Kullanıcı adı veya şifre hatalı!');
            window.location.href = 'login.html';
        </script>";
    }
} else {
   
    echo "<script>
        alert('Kullanıcı adı veya şifre hatalı!');
        window.location.href = 'login.html';
    </script>";
}


$stmt->close();
$conn->close();
?>
