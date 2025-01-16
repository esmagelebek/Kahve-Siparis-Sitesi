<!-- admin_login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('https://cdn.kahvekulturu.com.tr/img/1/25337-b-hahve-kulturu-acildi-25337.webp');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-form {
          background-color: rgba(255, 255, 255, 0.9);
          padding: 20px;
           border-radius: 10px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
           text-align: center;
            max-width: 350px;
            width: 90%;
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .login-form label {
           margin-top: 10px;
           display: block;
           font-weight: bold;
           text-align: left;
           font-size: 14px;
        }
        .login-form input[type="text"],.login-form input[type="password"] {
        
            padding: 10px;
            width: calc(100% - 20px); /* metin kutusunun boyutunu ayarlamak için */
            border: 1px solid #ccc;
            margin-top: 5px;
            box-sizing: border-box; /* kenarları kutunun boyutuna dahil eder */
            border-radius: 5px;
            font-size: 14px;
        }
        .login-form input[type="submit"] {
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #007BFF;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 16px;
        }
        .login-form input[type="submit"]:hover {
           background-color: #0056b3;
    }


    </style>
</head>
<body>
    <div class="login-form">
        <h2>Admin Giriş Sayfasına Hoşgeldiniz...</h2>
        <form action="" method="POST">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
        <!-- PHP kodu -->
        <?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Veritabanı bağlantısı
    $host = "127.0.0.1";
    $username1 = "root";
    $password1 = "";
    $dbname = "kahvesiparisi";

    $conn =mysqli_connect($host, $username1,$password1,$dbname);
 

// Bağlantı kontrolü
   if ($conn->connect_error) {
      die("Veritabanı bağlantısı başarısız: " . $conn->connect_error); 
    } 

//echo "Veritabanı bağlantısı başarılı!<br>";

    // Gelen verileri kontrol edelim
    echo "Gelen kullanıcı adı: " . htmlspecialchars($username) . "<br>";
    echo "Gelen şifre: " . htmlspecialchars($password) . "<br>";

    // Prepared statement kullanarak SQL sorgusunu düzenleyelim
    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE username = ? AND password = ?");
    if (!$stmt) {
        die("Hazırlayıcı deyim hatası: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    if (!$stmt->execute()) {
        die("Yürütme hatası: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if (!$result) {
        die("Sonuç alma hatası: " . $stmt->error);
    }

    // Sorgu sonucunu görüntüleyelim
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    // Oturum başlatma ve yönlendirme
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: admin_anasayfa.php');
        exit();
    } else {
        echo "Hatalı kullanıcı adı veya şifre.";
    }

    // Bağlantıyı kapatalım
    $stmt->close();
    $conn->close();
}
?>






    </div>
</body>
</html>