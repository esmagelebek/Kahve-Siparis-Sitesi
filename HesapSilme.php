<?php
// Bağlantı dosyasını dahil et
include('baglanti.php');
session_start();

// Kullanıcının oturum ID'sini kontrol et
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // SQL sorgusu için hazırlıklı ifadeler kullan
    $sql = "DELETE FROM tbl_kullanici WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // ID parametresini bağla ve sorguyu çalıştır
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();

        if ($res) {
            // Hesap başarıyla silindi
            // Oturumu sonlandır ve yönlendir
            session_destroy();
            echo "<script>alert('Hesabınız başarıyla silindi.');</script>";
            header('location: http://localhost/22040301063_Esma_Gelebek/login.html');
        } else {
            // Sorgu başarısız oldu
            echo "<script>alert('Hesap silinemedi. Lütfen daha sonra tekrar deneyin.');</script>";
            header('location: http://localhost/22040301063_Esma_Gelebek/profil.html');
        }
        $stmt->close();
    } else {
        // Sorgu hazırlanamadıysa hata mesajı
        echo "<script>alert('Bir hata oluştu. Lütfen tekrar deneyin.');</script>";
        header('location: http://localhost/22040301063_Esma_Gelebek/profil.html');
    }
} else {
    // Kullanıcı oturum açmamışsa
    echo "<script>alert('Yetkisiz erişim. Lütfen oturum açın.');</script>";
    header('location: http://localhost/22040301063_Esma_Gelebek/login.html');
}

$conn->close();
?>
