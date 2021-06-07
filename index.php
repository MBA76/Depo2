<?php
session_start();
if (!isset($_SESSION["oturum"])) {
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
    .space {
        padding: 1%;
    }

    .header {
        padding: 2%;
        text-align: center;
        background: rgb(0, 150, 255);
        color: aliceblue;
        font-size: 30px;
        font-family: Arial, Helvetica, sans-serif;
        border-radius: 25px;
    }
</style>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Depo Otomasyonu</title>

    <link href="public/style.css" rel="stylesheet">
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="space">
        <div class="header"><b>Depo Takip Otomasyonu</b>
            <?php echo '<p> Hoş gelidiniz ' . $_SESSION['kadi'] . '</p>'; ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/siparis-icon.png" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="urun-ekle.php" class="btn btn-primary" role="button">Yeni Ürün Ekle</a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/product.png" style="height: 170px;" alt="...">
                    <div class="caption">

                        <center><a href="urun-cikar.php" class="btn btn-primary" role="button">Ürün Satışı</a></center>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/packing.png" style="height: 170px;" alt="...">
                    <div class="caption">

                        <center><a href="stokta-bulunan-urunler.php" class="btn btn-primary" role="button">Stokta
                                Bulunan Ürünler</a></center>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/Archive.png" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="tum-urunler.php" class="btn btn-primary" role="button">Tüm Ürünler</a></center>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/disp.png" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="distributor-ekle.php" class="btn btn-primary" role="button">Distributor
                                Ekle</a></center>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/client.jpg" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="alici-ekle.php" class="btn btn-primary" role="button">Alıcı Ekle</a></center>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/list.png" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="kategori-ekle.php" class="btn btn-primary" role="button">Kategori Ekle</a>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="public/img/cikis.svg" style="height: 170px;" alt="...">
                    <div class="caption">
                        <center><a href="logout.php" class="btn btn-primary" role="button">Oturumu Kapat</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
</div>
</body>

</html>