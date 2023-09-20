
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
            <a style="color: #fff200;" href="home1.php">Home</a>
            <a href="about.html">About</a>
            <a href="sign1.php">SıgnUp</a> 
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

    <div class="main">
        <div class="main-left">
            <h1> WEB KODLAMAYA HOŞ GELDİNİZ</h1>
            <p> Bu sayfanın temel amacı kodlamaya yeni başlayanların,<br> projelerinde bir yere takılanların yardımlaşarak <br>
                sorunlarını çözebilmesidir.
            </p>
            <p> Sayfamızda herkes kodunun resmini paylaşabilir, <br>
                paylaşım yapmış diğer insanların kodlarına <br> yorum yapabilir,
                hatalarını fark edip yardım edebilir.
            </p>
            <br>
            <img class="main-img" src="web.jpg" alt="web">
        </div>
        <div class="main-right">
                <div class="login-box">
                  <h4 class="login-text">Giriş</h4>
                  <form class="login-giris" action="home.php" method="post">
                   <label for="kullanici"></label>
                   <input type="text" placeholder="Kullanıcı Adı" name="kullanici">
                   <label for="parola"></label>
                   <input type="password" placeholder="Şifre" name="parola">
                   <input type="submit" id="btn-login" name="formdangelen" value="Giriş Yap">
                  </form>
                </div>
        </div>
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