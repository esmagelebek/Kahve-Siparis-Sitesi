<?php
include('baglanti.php');
?>
<script src="https://kit.fontawesome.com/be8d131054.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="category.css">
<nav class="navbar">
        <div class="logo">Kahve Sepeti</div>
        <ul class="nav-links">
            <li><a href="anasayfa.html"><i class="fa-solid fa-house"></i>Anasayfa</a></li>
            <li><a href="category.php"><i class="bi bi-list"></i>Kategori</a></li>
            <li><a href="profil.html"><i class="fa-regular fa-user"></i>Profil</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
        </ul>
</nav>
<?php
// Oturum başlatma
session_start();

// Kategori seçimine dayalı veri çekme
if (isset($_POST['kategori'])) {
    $kategori = $_POST['kategori'];
} else {
    $kategori = 'varsayilan_kategori';  // Varsayılan kategori
}

$sql = "SELECT * FROM tbl_icecek WHERE kategori='$kategori'";
$result = $conn->query($sql);

$urunler = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $urunler[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Sayfası</title>
    <link rel="stylesheet" href="category.css">
</head>
<body>
    <br><br><br>
    <h1>Kategori Seçin:</h1>
    <form method="post" class="kategori-form">
        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" class="kategori-select">
            <option value="varsayilan_kategori">Varsayılan</option>
            <option value="Kahve">Kahve</option>
            <option value="Diğer">Diğer</option>
        </select>
        <button type="submit" class="submit-button">Göster</button>
    </form>
    <h2>Kategori: <?php echo htmlspecialchars($kategori); ?></h2>

    <?php if (!empty($urunler)): ?>
        <table class="urun-tablosu">
            <tr>
                
                <th>İsim</th>
                <th>Kategori</th>
                <th>Fiyat</th>
                <th>Açıklama</th>
                <th>Stok</th>
                <th>Resim</th>
            </tr>
            <?php foreach ($urunler as $urun): ?>
                <tr>
                    
                    <td><?php echo htmlspecialchars($urun['isim']); ?></td>
                    <td><?php echo htmlspecialchars($urun['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($urun['fiyat']); ?></td>
                    <td><?php echo htmlspecialchars($urun['aciklama']); ?></td>
                    <td><?php echo htmlspecialchars($urun['stok']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($urun['resim_url']); ?>" alt="<?php echo htmlspecialchars($urun['isim']); ?>" /></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Kategoriye ait ürün bulunamadı.</p>
    <?php endif; ?>
</body>
</html>
