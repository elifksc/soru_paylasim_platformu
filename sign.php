<?php

$kullanici = $_POST["kullanici"];
$eposta = $_POST["eposta"];
$parola = $_POST["parola"];

session_start(); 

// Formdan geldiğinden emin olalım...
if (!isset($_POST["formdangeliyor"])) {
    // Eğer javascript ile mesaj verip göndermek istiyorsam
    echo "<script language='javascript'>
                alert('Formu doldurmalısınız!');
                window.location.href='sign1.php';
          </script>";
    //header('Location: sign1.php');
    exit;
}

//Veritabanına bağlayalım...
try {
    $vt = new PDO("mysql:dbname=proje1;host=localhost;charset=utf8","root", "");
    $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}    
catch (PDOException $e) {
    echo $e->getMessage();
}

//şifrelerin uyuşmasını kontrol et
if($_POST["parola"] != $_POST["parola1"]){
    echo "Şifreler aynı değil!";
    exit;
}

//sifreyi gizle
$parola = password_hash($_POST["parola"], PASSWORD_DEFAULT);

// boş alan bırakılmamasını kontrol et
if (!isset($_POST["kullanici"]) or (empty($_POST["kullanici"]))){
    echo "Kullanıcı adı boş bırakılamaz";
    exit;
}
if (!isset($_POST["eposta"]) or (empty($_POST["eposta"]))){
    echo "E-posta boş bırakılamaz";
    exit;
}
if (!isset($_POST["parola"]) or (empty($_POST["parola"]))){
    echo "Şifre boş bırakılamaz";
    exit;
}

//en az 5 karakter olsun
$kullanici = trim($_POST["kullanici"]); //trimle boşlukları sildik.
if(strlen($kullanici)<5){
    echo "Kullanıcı adı en az 5 karakter olmalı!";
    exit;
    // Başka yere gönder
}

//eposta biçimsel olarak eposta mı_?
    if (!filter_var($_POST["eposta"], FILTER_VALIDATE_EMAIL)) {
        echo "Lütfen geçerli bir eposta giriniz";
        exit;
    // Başka yere gönder
}
    
// Sorgular ve diğer işlemler burada...
$sql = "insert into uyeler (kullanici, eposta, parola) values (:kullanici, :eposta, :parola)";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":kullanici"=>$kullanici, ":eposta"=>$eposta, ":parola"=>$parola));

//Mesajları ekrana yazdıralım...
$sql ="select * from uyeler";
$ifade = $vt->prepare($sql);
$ifade->execute();

while ($kayit = $ifade->fetch(PDO::FETCH_ASSOC)) {
    echo htmlentities($kayit["kullanici"])."HOŞGELDİN";
    echo "<br>";

}

//Bağlantıyı yok edelim...
$vt = null;

// Başka sayfaya yönlendir...
header('Location: home1.php');
?>