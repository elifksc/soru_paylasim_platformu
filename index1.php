<?php
session_start();

if (!isset($_SESSION["kod"])) { // Giriş yapılmadıysa bu sayfayı görmesin
    header("Location: index1.php");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Content-Type: application/xml; charset=utf-8");
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
            <a style="color: #fff200;" href="index1.php">Work</a>
            <a href="profil.php">Add</a>
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
    <br>
    <?php
        

        // Veri tabanına bağlanalım...
        try {
        $vt = new PDO("mysql:dbname=proje1;host=localhost;charset=utf8","root", "");
        $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        echo $e->getMessage();
        }

        $sql ="select * from icerik ";
        $ifade = $vt->prepare($sql);
        $ifade->execute(Array(":yukleyen"=>$_SESSION["kod"]));

        while($icerik = $ifade->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="main-work">';
            $resim = $icerik['dosyayolu'];
            echo '<img class="img-soru" src="'. $resim.'">';
            echo '<div class="detaylar">';
            echo "".$icerik['soru']."<br>";
            echo '<a href="detay.php?icerikid=    '.$icerik['kod'].'   "> ';
            echo "Yorum";
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '<br>';
        }
           
    ?>
    
</body>
</html>