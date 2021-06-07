<?php
session_start();
if (!isset($_SESSION["oturum"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.4">
    <title>Stok Takip Otomasyonu</title>

    <link href="public/style.css" rel="stylesheet">
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading"><a ="#FF0000" href="index.php"><font color="white">Ana Sayfa</font></a></div>
    <div class="panel-body">


        <div class="row">
            <?php

            include("ayar.php");
            $stok = $baglanti->query("SELECT * FROM urunler ");
            $stok->execute();
            ?>

            <div class="col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Tüm Ürünler</div>

                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Ürün Adı</th>
                            <th>Barkod</th>
                            <th>Ürün Kodu</th>
                            <th>$Kategorisi</th>
                            <th>Geldiği Firma</th>
                            <th>Müşteri</th>
                            <th>Giriş Tarihi</th>
                            <th>Çıkış Tarihi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($stok as $stokcek) {
                            $urun_adi = $stokcek["urun_adi"];
                            $barkod = $stokcek["barkod"];
                            $urun_kodu = $stokcek["Urun_Kodu"];
                            $Kategorisi = $stokcek["Kategori"];
                            $G_Firma = $stokcek["G_Firma"];
                            $Musteri = $stokcek["Musteri"];
                            $giris_tarihi = $stokcek["giris_tarihi"];
                            $cikis_tarihi = $stokcek["cikis_tarihi"];
                            echo "<tr><td>" . $urun_adi . "</td> 
                            <td>" . $barkod . "</td>
                            <td>" . $urun_kodu . " </td>
                            <td>" . $Kategorisi . " </td>
                            <td>" . $G_Firma . "</td>
                            <td>" . $Musteri . "</td>
                            <td>" . $giris_tarihi . "</td>
                            <td>" . $cikis_tarihi . "</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>