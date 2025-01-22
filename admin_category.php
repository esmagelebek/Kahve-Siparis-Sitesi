<?php  
 
$servername = "localhost";  //veritabanı sunucu adı 
$username = "root";  //veritabanı kullanıcı adı
$password = "";  
$dbname = "kahvesiparisi";  //veritabanı adı 

  
$conn = new mysqli($servername, $username, $password, $dbname);  //bağlantı durumunu kontrol etmemiz için gerek

//veritabanı bağlantımız doğru değilse bağlantı başarısız uyarısı alıcak
if ($conn->connect_error) {  
    die("Bağlantı hatası: " . $conn->connect_error);  
}  

//name="add_product"  buna sahip butona basınca gerekli bilgiler post ile gelen verileri alır ve tbl_icecek tablosuna ekler
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {  
    $isim = $_POST["isim"];  
    $fiyat = $_POST["fiyat"];  
    $kategori = $_POST["kategori"];  
    $aciklama = $_POST["aciklama"];  
    $stok = $_POST["stok"];  
    $resim_url = $_POST["resim_url"];  
    

    $sql = "INSERT INTO tbl_icecek (isim, fiyat, kategori, aciklama, stok, resim_url)   
            VALUES ('$isim', '$fiyat', '$kategori', '$aciklama', '$stok', '$resim_url')";  
    
    if ($conn->query($sql) === TRUE) {  //sql sorgusu veritabanında doğru çalışırsa bu kısma girer
        //echo "Yeni ürün eklendi.";  
    } else {  // doğru çalışmazsa hata mesajı verir
        echo "Hata: " . $sql . "<br>" . $conn->error;  
    }  
}  

 //name="update_product"  buna sahip butona basınca gerekli bilgiler post ile gelen verileri alır ve tbl_icecek tablosunda güncelleme yapar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_product"])) {  
    $id = $_POST["id"];  
    $isim = $_POST["isim"];  
    $fiyat = $_POST["fiyat"];  
    $kategori = $_POST["kategori"];  
    $aciklama = $_POST["aciklama"];  
    $stok = $_POST["stok"];  
    $resim_url = $_POST["resim_url"];  
    

    $sql = "UPDATE tbl_icecek   
            SET isim='$isim', fiyat='$fiyat', kategori='$kategori', aciklama='$aciklama', stok='$stok', resim_url='$resim_url'  
            WHERE id=$id";  
    
    if ($conn->query($sql) === TRUE) {  //sql sorgusu veritabanında doğru çalışırsa bu kısma girer
        //echo "Ürün güncellendi.";  
    } else {  // doğru çalışmazsa hata mesajı verir
        echo "Hata: " . $sql . "<br>" . $conn->error;  
    }  
}  

  //name="delete_product"  buna sahip butona basınca gerekli bilgiler post ile gelen verileri alır ve tbl_icecek tablosundan siler
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_product"])) {  
    $id = $_POST["id"];  

    $sql = "DELETE FROM tbl_icecek WHERE id=$id";  

    if ($conn->query($sql) === TRUE) {  //sql sorgusu veritabanında doğru çalışırsa bu kısma girer
        //echo "Ürün silindi.";  
    } else {  // doğru çalışmazsa hata mesajı verir
        echo "Hata: " . $sql . "<br>" . $conn->error;  
    }  
}  

 //tüm ürünler ve bilgileri tbl_icecek tablosundan çeker
$sql = "SELECT id, isim, kategori, fiyat, aciklama, stok, resim_url FROM tbl_icecek";  
$result = $conn->query($sql);  
?>  

<!DOCTYPE html>  
<html lang="tr">  
<head>  
    <meta charset="UTF-8">  
    <title>Kategori Yönetimi</title>  
    <script src="https://kit.fontawesome.com/be8d131054.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">  
    <link rel="stylesheet" href="anasayfa.css">  <!-- CSS sayfamızı dahil ediyoruz gerekli yerlere stil özellikleri uygulansın diye  -->
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            margin: 0;  
            padding: 0;  
            background-color: #f4f4f4;  
        }  
        h1 {  
            text-align: center;  
            background-color: black;  
            color: #fff;  
            padding: 20px;  
            margin: 0;  
        }  
        h2 {  
            color: #333;  
            text-align: center;  
        }  
        div {  
            margin: 20px auto;  
            max-width: 800px;  
            background: #fff;  
            padding: 20px;  
            border-radius: 8px;  
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);  
        }  
        table tr th {  
            background-color: #4CAF50;  
        }  
        table {  
            width: 100%;  
            border-collapse: collapse;  
            margin-top: 20px;  
        }  
        th, td {  
            border: 1px solid #ddd;  
            padding: 10px;  
            text-align: center;  
        }  
        th {  
            background-color: #333;  
            color: #fff;  
        }  
        input, textarea {  
            width: 100%;  
            box-sizing: border-box;  
        }  
        button {  
            background-color: #4CAF50;  
            color: #fff;  
            border: none;  
            padding: 8px 12px;  
            cursor: pointer;  
        }  
        button:hover {  
            background-color: #555;  
        }  
        .navbar {  
            display: flex;  
            justify-content: space-between;  
            align-items: center;  
            background-color: black;  
            padding: 10px 20px;  
            color: white;  
        }  
        
        .navbar .logo {  
            font-size: 20px;  
            font-weight: bold;  
        }  
        
        .navbar .nav-links {  
            list-style: none;  
            display: flex;  
            gap: 15px;  
        }  
        
        .navbar .nav-links li {  
            display: inline;  
        }  
        
        .navbar .nav-links a {  
            color: white;  
            text-decoration: none;  
            font-size: 14px;  
        }  
        
        .navbar .nav-links a:hover {  
            text-decoration: underline;  
        }  
    
        .footer {  
            text-align: center;  
            background-color: #f1f1f1;  
            padding: 15px;  
            position: relative;  
            bottom: 0;  
            width: 100%;  
            border-top: 1px solid #ddd;  
        }  
    </style>  
</head>  
<body>  
    
    <nav class="navbar">  
        <h1>Kategori Yönetim Paneli</h1>  
        <ul class="nav-links">  
            <li><a href="admin_anasayfa.php"><i class="fa-solid fa-house"></i>Anasayfa</a></li>  
            <li><a href="admin_category.php"><i class="bi bi-list"></i>Kategori</a></li>  
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>  
        </ul>  
    </nav>  
    
    <div>  
        <h2>Yeni Ürün Ekle</h2>  
        <form method="post">  
            <input type="text" name="isim" placeholder="Ürün Adı" required><br><br>  
            <input type="number" name="fiyat" placeholder="Fiyat" required><br><br>  
            <input type="text" name="kategori" placeholder="Kategori" required><br><br>  
            <textarea name="aciklama" placeholder="Açıklama" required></textarea><br><br>  
            <input type="number" name="stok" placeholder="Stok" required><br><br>  
            <input type="text" name="resim_url" placeholder="Resim URL" required><br><br>   
            <button type="submit" name="add_product">Ürün Ekle</button><br><br>  
        </form>  
    </div>  
    
    <div>  
        <h2>Ürün Listesi</h2>  <!-- ürün listesi h2 formatında başlık olarak yazar  -->
        <table>  
            <tr>  <!-- Sütun isimleri  -->
                <th>İsim</th>   
                <th>Kategori</th>  
                <th>Fiyat</th>  
                <th>Açıklama</th>  
                <th>Stok</th>  
                <th>Resim</th>  
                  
            </tr>  
            <?php  
            if ($result->num_rows > 0) {  
                while($row = $result->fetch_assoc()) {  
                    //her ürün bilgisi tabloya satır satır eklenir  ve burda düzenleme yapabilirsin o alandır burası
                    echo "<tr>  
                            <form method='post'>  
                                <td><input type='text' name='isim' value='{$row['isim']}'></td>  
                                <td><input type='text' name='kategori' value='{$row['kategori']}'></td>  
                                <td><input type='number' name='fiyat' value='{$row['fiyat']}'></td>  
                                <td><textarea name='aciklama'>{$row['aciklama']}</textarea></td>  
                                <td><input type='number' name='stok' value='{$row['stok']}'></td>  
                                <td><input type='text' name='resim_url' value='{$row['resim_url']}'></td>  
                                 
                                <td>  
                                    <input type='hidden' name='id' value='{$row['id']}'>  
                                    <button type='submit' name='update_product'>Kaydet</button><br> <br>  
                                    <button type='submit' name='delete_product'>Sil</button>  
                                </td>  
                            </form>  
                          </tr>";  
                }  
            } else {  
                echo "<tr><td colspan='9'>Kayıt bulunamadı.</td></tr>";  
            }  
            ?>  
        </table>  
    </div>  
    <footer class="footer">  
        <p>© 2025 Kahve Sipariş Sitesi. Tüm Hakları Saklıdır.</p>  
    </footer>  
</body>  
</html>