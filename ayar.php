<?php // veri tabanı bağlantısı temel ayarları
$ip = "localhost"; //host
$user = "root";  // host kullanici adı
$password = "";  // password local olduğu için varsayılan şifre boş
$db = "depo2"; // db adı

//bağlantı

try {
    $baglanti = new PDO("mysql:host=$ip;dbname=$db", $user, $password);
    $baglanti->exec("SET CHARSET UTF8");
} catch (PDOException $e) {
    die ("Hata var");
}
?>