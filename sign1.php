<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="home.css">
    <title>Öğreniyoruz</title>
</head>
<body>
    <header>

        <div class="logo">
            <img class="logimg" src="code.png" alt="logo">
        </div>

        <nav class="navMenu">
            <a href="home1.php">Home</a>
            <a href="about.html">About</a>
            <a style="color: #fff200;" href="sign1.php">SıgnUp</a>
        </nav>

        <div class="search">
            <div class="search-main">
                <input type="text" class="tbox-search">
                <a class="btn-search">
                    <img src="search.png" alt="search">
                </a>
            </div>
        </div>
    </header>
        <div id="kayitFormu">
            <form action="sign.php" method="post">
                <h3>KULLANICI KAYIT FORMU</h3>
                <input class="kayit-input" type="text" name="kullanici" placeholder="kullanıcı adı"> 
                <input class="kayit-input" type="email" name="eposta" placeholder="eposta giriniz">
                <input class="kayit-input" type="password" name="parola" placeholder="şifrenizi giriniz">
                <input class="kayit-input" type="password" name="parola1" placeholder="şifrenizi tekrar giriniz">
                <input class="kayit-btn" name="formdangeliyor" type="submit" value="KAYDOL">
            </form>
        </div>
    <footer class="footer">
        <div class="social"> 
            <a href="https://www.instagram.com/" target="_blank"><img class="icon" src="Instagram.png" alt="instagram">  </a>
            <a href="https://twitter.com/" target="_blank"><img class="icon" src="twitter.png" alt="twitter">  </a>
            <a href="https://www.linkedin.com/" target="_blank"><img class="icon" src="link.png" alt="linkedin">  </a>
        </div>
        <div class="info">© all right reserved.</div>

    </footer>
</body>
</html>