<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kahvesiparisi";

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<script src="https://kit.fontawesome.com/be8d131054.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="anasayfa.css">
<nav class="navbar">
        <div class="logo">Kahve Sepeti</div>
        <ul class="nav-links">
            <li><a href="anasayfa.html"><i class="fa-solid fa-house"></i>Anasayfa</a></li>
            <li><a href="category.php"><i class="bi bi-list"></i>Kategori</a></li>
            <li><a href="profil.html"><i class="fa-regular fa-user"></i>Profil</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
        </ul>
</nav>
<style>
    /* Genel stiller */
body {
    font-family: Arial, sans-serif;
    background:url("https://cdn.kahvekulturu.com.tr/img/1/25337-b-hahve-kulturu-acildi-25337.webp") no-repeat ;
    margin: 0;
    padding: 0;
    box-sizing: border-box;

}


h3 {
    color: #333;
    text-align: center;
    margin-top: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

form label {
    display: block;
    margin-bottom: 8px;
}

form input[type="password"],
form input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

p {
    text-align: center;
}

</style>
<?php
// Bağlantıyı kontrol et
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Oturum başlat
session_start();

// Oturumdan ID al
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // Kullanıcı bilgilerini al
    $sql = "SELECT * FROM tbl_kullanici WHERE id='$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == true && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        // Kullanıcı bilgilerini değişkenlere ata
        $username = $row['kullaniciadi'];
        $email = $row['email'];
    } else {
        echo "Kullanıcı bilgileri bulunamadı.";
    }

    // Şifre değiştirme formu
    echo "<br><br>";
    echo "<form method='POST' action=''>
            <label>Mevcut Şifre:</label><br>
            <input type='password' name='current_password' required><br><br>
            <label>Yeni Şifre:</label><br>
            <input type='password' name='new_password' required><br><br>
            <label>Yeni Şifre (Tekrar):</label><br>
            <input type='password' name='confirm_password' required><br><br>
            <input type='submit' name='change_password' value='Şifre Değiştir'>
          </form>";

    // Şifre değiştirme işlemi
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Mevcut şifre kontrolü
        if (password_verify($current_password, $row['sifre'])) {
            // Yeni şifreler eşleşiyor mu?
            if ($new_password === $confirm_password) {
                // Yeni şifreyi hashle ve kaydet
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql_update = "UPDATE tbl_kullanici SET sifre='$hashed_password' WHERE id='$id'";
                $res_update = mysqli_query($conn, $sql_update);

                if ($res_update == true) {
                    echo "<p style='color:green;'>Şifre başarıyla değiştirildi!</p>";
                } else {
                    echo "<p style='color:red;'>Şifre değiştirme başarısız. Lütfen tekrar deneyin.</p>";
                }
            } else {
                echo "<p style='color:red;'>Yeni şifreler eşleşmiyor!</p>";
            }
        } else {
            echo "<p style='color:red;'>Mevcut şifre hatalı.</p>";
        }
    }
} else {
    echo "Oturum açık değil.";
}

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>
