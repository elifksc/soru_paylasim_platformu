<?php
session_start();
if (!isset($_GET["icerikid"])) { // Kod boş bırakılamasın
    header("Location: index1.php");
    exit;
}
if (!is_numeric($_GET["icerikid"])) { // Kod sayısal bir değer olsun
    header("Location: index1.php");
    exit;
}

if (!isset($_SESSION["kod"])) { // Giriş yapılmadıysa bu sayfayı görmesin
    header("Location: home1.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title>Öğreniyoruz</title>
    <link href="home.css" rel="stylesheet">
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
    <br>
        <?php
            $icerik_id = $_GET['icerikid'];


                // Veri tabanına bağlanalım...
            try {
                $vt = new PDO("mysql:dbname=proje1;host=localhost;charset=utf8","root", "");
                $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            // İçeriği Basıyor
            $sql ="select * from icerik WHERE kod = :icerikid";
            $ifade = $vt->prepare($sql);
            $ifade->execute(Array(":icerikid"=>$icerik_id));
            $icerik = $ifade->fetch(PDO::FETCH_ASSOC);
            echo '<div class="main-work">';
            $resim = $icerik['dosyayolu'];
            echo '<img class="img-detay" src="'. $resim.'">';
            echo '<div class="detaylar">';
            echo "".htmlentities($icerik['soru'])."<br>";
            echo '</div>';
            echo '</div>';
            echo '<br>';
            

            // Yorumları çekiyor 
            $sql ="select * from yorum WHERE yapilan = :yapilan";
            $ifade = $vt->prepare($sql);
            $ifade->execute(Array(":yapilan"=>$icerik_id));
            echo '<p style="color:#f6f4e6; font-size:24px;">Yorumlar</p>';
            while($yorum = $ifade->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="yorumlar">';
                echo '<div class="yorum">';
                echo "<br>". htmlentities($yorum['metin'])."<br>";
                echo "<br>". htmlentities($yorum['vakit'])."<br>";

                $sql2 ="select * from uyeler WHERE kod = :yapan";
                $ifade2 = $vt->prepare($sql2);
                $ifade2->execute(Array(":yapan"=>$yorum['yapan']));
                $kullanici = $ifade2->fetch(PDO::FETCH_ASSOC);
                
                echo "" .htmlentities($kullanici['kullanici'])."<br>";
                echo '</div>';
                echo '</div>';
                echo '<br>';

            }

        ?>

        <form action="yorumkontrol.php" method="post" class="yorumekle">
            <h2 style="color:#f6f4e6;">Yorum ekleyin</h2>
            <div>
                <textarea name="yorum" rows="6" ></textarea>
            </div>
            <input type="hidden" name="kod" value="<?php echo $icerik_id; ?>">
            <div>
                <input type="submit" class="" name="formdangelen" value="Gönder"> <br>
            </div>                                
        </form>  


    
</body>
</html>
