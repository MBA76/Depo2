<?php
error_reporting(0);
if (!isset($_SESSION['kadi_admin'])) {
    header('Localtion:index.php');
}
?>
    <!DOCTYPE html>
    <html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Depo Otomasyonu</title>
    <link href="public/style.css" rel="stylesheet">
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Depo Takip</div>
    <div class="panel-body">
        <center>
            <?php
            echo '<br>';
            if ($_GET['hata'] == 'yanlis') {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
        swal("Hata!", "Şifre veya Kullanıcı Adi Yanlış!", "error");
        </script>';
            }
            ?>
            <form action="#" method="post">
                <h4>Kullancı Adı
                    <input type="mail" name="kadi_admin"></h4>
                <h4>Kullancı Şifre
                    <input type="password" name="password"></h4>
                <input type="submit" name="basla" value="Giriş yap">
            </form>
        </center>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
</div>
<?php
include('ayar.php');
if (isset($_POST['basla'])) {
    $kadi_admin = $_POST['kadi_admin'];
    $password = $_POST['password'];
    $query = $baglanti->query("SELECT * FROM users where username='$kadi_admin' and password='$password'");
    $query->execute();
    $count = $query->FetchColumn();
    if ($count > 0) {
        session_start();
        $_SESSION['kadi'] = $kadi_admin;
        $_SESSION['oturum'] = true;
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
        swal("Basarılı Giriş!", "' . $kadi_admin . ' Hoş geldin!", "success");
        </script>';
        $giris = true;

    } else {
        header('Location:login.php?hata=yanlis');
        $giris = false;
    }
    if ($giris == true) {
        header('Location:index.php?');

    }
}
?>