<?php
session_start();
if (!isset($_SESSION["kod"])) { // Giriş yapılmadıysa bu sayfayı görmesin
    header("Location: home1.php");
    exit;
}
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
            <a  href="index1.php">Work</a>
            <a style="color: #fff200;" href="profil.php">Add</a>
            <a href="cikis.php">Exit</a>
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

    <div class="main-profil">
        <div class="cont">
            <div class="detail">
                <p class="sorular">
                    Sitemize hoşgeldin
                    <?php echo htmlentities($_SESSION["kullanici"]); ?> <br>
                    Bu kısımdan istediğin soruyu yükleyebilirsin... <br>
                </p>
            </div>
                <form action="dosyayuklekontrol.php?formdangelen=1" method="post" enctype="multipart/form-data">
                    <div class="form-group row mb-4">    
                        <label for="soru"> Soru:  </label><br>
                        <textarea name="soru" id="soru" rows="6"></textarea><br>     
                    </div>   
                    <input type="hidden" name="MAX_FILE_SIZE" value="1500000" />  
                    <div>                     
                        <label for="dosyayolu"> Sorunun resimi (png, jpg):</label><br>
                        <input type="file" id="dosyayolu" name="dosyayolu">
                    </div>
                                    
                    <div class="form-group row text-right">
                        <div class="col-12">                    
                            <input type="submit" value="Paylaş">
                        </div>
                    </div>
                </form>
        
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