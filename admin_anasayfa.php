<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahve Sipariş Sitesi</title>
    <script src="https://kit.fontawesome.com/be8d131054.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="anasayfa.css">
</head>
<style>
    body {
            
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Navbar */
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
        /* Content */
        .content {
            background-size: cover;
            background: url("https://cdn.kahvekulturu.com.tr/img/1/25337-b-hahve-kulturu-acildi-25337.webp") no-repeat  ;
            display: flex;
            background-position:center;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 140px);
    
        }
        .navbar .logo .ikon{
          color: white;
          margin-right: 3px;
         font-size: 20px;
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
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Kahve Sepeti</div>
        <ul class="nav-links">
            <li><a href="admin_anasayfa.php"><i class="fa-solid fa-house"></i>Anasayfa</a></li>
            <li><a href="admin_category.php"><i class="bi bi-list"></i>Kategori</a></li>
            <li><a href="admin_profil.html"><i class="fa-regular fa-user"></i>Profil</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 Kahve Sipariş Sitesi. Tüm Hakları Saklıdır.</p>
    </footer>
</body>
</html>