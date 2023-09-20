<?php
session_start(); 

// Formdan geldiğinden emin olalım
if (!isset($_POST["formdangelen"])) {
    // Eğer javascript ile mesaj verip göndermek istiyorsam
    echo "<script language='javascript'>
                alert('Formu doldurmalısınız!');
                window.location.href='home1.php';
          </script>";
    //header('Location: home1.php');
    exit;
}

//Şifre karşılaştırılacak
//Yetkilendirme
//Yönlendir



// Veri tabanına bağlanalım...
try {
  $vt = new PDO("mysql:dbname=proje1;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}

$sql ="select * from uyeler WHERE kullanici = :kullanici";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":kullanici"=>$_POST["kullanici"]));

$kayit = $ifade->fetch(PDO::FETCH_ASSOC); 

/*
echo htmlentities($kayit["kullanici"]);
echo "<br/>";
echo htmlentities($kayit["parola"]);
echo "<br/>";
echo htmlentities($kayit["kod"]);
echo "<br/>";
*/

if (password_verify($_POST["parola"], $kayit["parola"])) {
  // Bu adam sitemize kaydolan kişi
  $_SESSION["kod"] = $kayit["kod"];
  $_SESSION["eposta"] = $kayit["eposta"];
  $_SESSION["kullanici"] = $kayit["kullanici"];
  // Başka sayfaya yönlendir...
  echo "Giriş başarılı, hemen yönlendiriliyorsunuz";
  header("Refresh:2; url=index1.php"); // 2 sn bekleyip gitsin diye isterseniz refresh'i kaldırabilirsiniz...

} 
else {
// Bu kişiyi bilmiyoruz
  echo "<script language='javascript'>
  alert('Sağladığınız bilgiler doğru değil!');
  window.location.href='home1.php';
  </script>";
}
?>