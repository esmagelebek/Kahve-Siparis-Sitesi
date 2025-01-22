<?php

$servername = "localhost"; //veritabanı sunucu adı  
$username = "root";  //veritabanı kullanıcı adı 
$password = "";
$dbname = "kahvesiparisi"; //veritabanı adı 

$conn = mysqli_connect($servername, $username, $password, $dbname); //bağlantı durumunu kontrol etmemiz için gerek
?>
<script src="https://kit.fontawesome.com/be8d131054.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="anasayfa.css">  <!-- CSS sayfamızı dahil ediyoruz gerekli yerlere stil özellikleri uygulansın diye  -->
<nav class="navbar">
        <div class="logo">Kahve Sepeti</div>  <!-- Menu bar için html etiketlerimiz  -->
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
//veritabanı bağlantımız doğru değilse bağlantı başarısız uyarısı alıcak
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

//oturum başlatma fonksiyonu oturuma giriş yapanın bilgilerini alma için $_SESSION değişkenine erişim sağlar 
session_start();

//oturum açmış kimse onun bilgilerini alır
if (isset($_SESSION['id'])) { //kullanıcının id'sini alır 
    $id = $_SESSION['id']; //kullanıcı idsini $id değişkenine atar

    
    $sql = "SELECT * FROM tbl_kullanici WHERE id='$id'";   //bu sorguda tbl_kullanıcı tablosunu  tarar ve id değişkeninde kullanıcıyı arar
    $res = mysqli_query($conn, $sql); //$sql sorgusunu veritabanında çalıştırır

    if ($res == true && mysqli_num_rows($res) == 1) { //eğer $res sonucu doğruysa mysqli_num_rows ile satır sayısını kontrol eder mysqli_num_rows($res) == 1  burda ise sonuçta sadece 1 satır döndüğünü belirtir
        $row = mysqli_fetch_assoc($res);  //Bu satır, sorgu sonucunu bir ilişkilendirilmiş dizi olarak alır ve her sütunun adını anahtar, değerini ise bu anahtara karşılık gelen veri olarak saklamamıza yarar

        
        $username = $row['kullaniciadi']; //Kullanıcının kullanıcı adını alır
        $email = $row['email']; //Kullanıcının emailini alır
    } else {
        echo "Kullanıcı bilgileri bulunamadı.";
    }

    //şifre değiştirme formu
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

    //form gönderme işlemi doğruysa kullanıcının girdiği şifreleri alır
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        //eski şifre forma yazdığı eski şifre ile aynı mı diye kontrol ediyoruz şifreler şifreli olarak veritabanına kayıt edildi bu yüzden password_verify fonksiyonu kullanıldı
        if (password_verify($current_password, $row['sifre'])) {
            //yeni şifre ile tekrar yeni şifre girdiği şifreler aynı mı diye kontrol ediyoruz
            if ($new_password === $confirm_password) {
               //eğer doğruysa yeni şifreyi veritabanına şifreli olarak kayıt ediliyor
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                //idsi kullanıcı id olan kişinin şifresi yeni şifre ile güncelleyen veritabanı sorgusu
                $sql_update = "UPDATE tbl_kullanici SET sifre='$hashed_password' WHERE id='$id'";
                //sorgu veritabanında çalıştırılır
                $res_update = mysqli_query($conn, $sql_update);
                //eğer sorgu doğru çalışıyorsa şifre başarıyla değiştirildi yazısını görürüz
                if ($res_update == true) {
                    echo "<p style='color:green;'>Şifre başarıyla değiştirildi!</p>";
                } else {
                    //sorg yanlışsa başka uyarı ile karşılaşırız
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

//veritabanı bağlantısı kapatılır
mysqli_close($conn);
?>
