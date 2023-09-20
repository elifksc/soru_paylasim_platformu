<?php
session_start();


// Oturum açık mı
if (!isset($_SESSION["kod"])) {
    header("Location: index1.php");
    exit;
}

// Formdan mı geldi, kötü niyetli direkt adresi yazan kişi
if (!isset($_GET["formdangelen"])) {
    header("Location: index1.php");
    exit;
}

// Dosya geldimi
if ($_FILES["dosyayolu"]["error"] <> 0) { // Hata oluştu mu, dosya geldi mi?
    echo "<script>
    alert('Dosya 1.5MB\'den küçük olmalıdır!');
    window.location.href='profil.php';
    </script>";
    exit;
}


// Dosya boyutu kontrol et
if ($_FILES["dosyayolu"]["size"] > 1500000) { // Dosya 1.5 MB'den büyükse
    echo "<script language='javascript'>
    alert('Dosya 1.5MB\'tan küçük olmalıdır!');
    window.location.href='profil.php';
    </script>";
    exit;
}

// Resim dosyası mı onu kontrol et
$izinli = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
if (in_array($_FILES['dosyayolu']['type'], $izinli)) {
    echo "Geçerli dosya";
}
else {
    echo "Geçersiz dosya!<br>";
    echo "Yüklemeye çalıştığınız dosya türü: ";
    echo $_FILES['dosyayolu']['type'];
    echo "<script language='javascript'>
    alert('Yüklediğiniz dosya türüne izin verilmiyor!');
    window.location.href='profil.php';
    </script>"; 
    exit;   
}


// Dosyayı kaydedeceğiz
// Aynı isimde farklı dosyalar aynı isimle kaydedilmesin
$hedef =  "resimler/".time().$_SESSION["kod"].basename($_FILES["dosyayolu"]["name"]);
move_uploaded_file($_FILES["dosyayolu"]["tmp_name"], $hedef);

// Veri tabanına bağlanalım...
try {
    $vt = new PDO("mysql:dbname=proje1;host=localhost;charset=utf8","root", "");
    $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Sorgular ve diğer işlemler burada...
if (!isset($_POST["soru"]) or empty($_POST["soru"])) {
    $soru = false;
} else {
    $soru = true;
    // trim soru
    //uzunluk kontrolü vs.     
}

if ($soru == true) { // soru girildiyse
    $sql = "insert into icerik ( soru, dosyayolu, yukleyen) values (:soru, :dosyayolu, :yukleyen)";
    $ifade = $vt->prepare($sql);
    $ifade->execute(Array(":soru"=>$_POST["soru"], ":dosyayolu"=>$hedef, ":yukleyen"=>$_SESSION["kod"]));    
} else { // soru girilmediyse
    echo "<script language='javascript'>
    alert('Lütfen soruyu giriniz!');
    window.location.href='profil.php';
    </script>";
} 
//Bağlantıyı yok edelim...
$vt = null;
echo "<script language='javascript'>
alert('Soru başarı ile kaydedildi!');
window.location.href='index1.php';
</script>";
?>