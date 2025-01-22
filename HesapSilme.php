<?php

include('baglanti.php');
session_start();


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    
    $sql = "DELETE FROM tbl_kullanici WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();

        if ($res) {
            
            session_destroy();
            echo "<script>alert('Hesabınız başarıyla silindi.');</script>";
            header('location: http://localhost/22040301063_Esma_Gelebek/login.html');
        } else {
           
            echo "<script>alert('Hesap silinemedi. Lütfen daha sonra tekrar deneyin.');</script>";
            header('location: http://localhost/22040301063_Esma_Gelebek/profil.html');
        }
        $stmt->close();
    } else {
       
        echo "<script>alert('Bir hata oluştu. Lütfen tekrar deneyin.');</script>";
        header('location: http://localhost/22040301063_Esma_Gelebek/profil.html');
    }
} else {
   
    echo "<script>alert('Yetkisiz erişim. Lütfen oturum açın.');</script>";
    header('location: http://localhost/22040301063_Esma_Gelebek/login.html');
}

$conn->close();
?>
