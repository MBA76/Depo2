<?php
session_start();
if(!isset($_SESSION["oturum"]))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
  .myDiv {
    background-color: lightblue;
    text-align: center;
    
  }
  
</style>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stok Takip Otomasyonu</title>
  <link href="public/style.css" rel="stylesheet">
  <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="panel panel-primary">
    <div class="panel-heading"><a color="#FF000" href="index.php">
        <font color="white">Ana Sayfa </font>
      </a></div>
    <div class="panel-body">
      <?php
      date_default_timezone_set('Europe/Istanbul');
      if ($_POST) {
        include("ayar.php");
        $Kat_Adi = $_POST["Kat_Adi"];
        $ekle = $baglanti->prepare("INSERT INTO `kategoriler`(`Kategori_Adi`) values(?)");
        $ekle->execute(array($Kat_Adi));

        if ($ekle) {
          echo "Başarıyla Eklendi.";
        } else {
          echo "Eklenemedi.";
        }
      }
      ?>
      <form action="" class="form-horizontal" method="post">
        <div class="row">
          <table>
            <th>
              <tr>
                <div class="myDiv"> <label for="inputEmail3" style="color:White">Bilgileri Giriniz</label> </div>
              </tr>
            </th>
            <tr>
              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <th>
                    <label for="inputEmail3" class="col-sm-2 control-label">Kategori Adı</label>
                  </th>
                  <div class="col-sm-10">
                    <th>
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Kategori Adı" name="Kat_Adi">
                    </th>
                  </div>
                </div>
              </div>
            </tr>
            <td>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"></label>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-default form-control" style="width: 250px;">Kategori Ekle</button>
                  </div>
                </div>
              </div>
            </td>
            <tr>
              <table >
                <th>
                  <tr>
                    <div class="myDiv"> <label for="inputEmail3" style="color:White">Tüm Kategoriler</label> </div>
                  </tr>
                </th>
                <div class="row">
                  <?php

                  include("ayar.php");
                  $stok = $baglanti->query("SELECT * FROM kategoriler ");
                  $stok->execute();
                  ?>

                  <div class="col-sm-12 col-md-12">
                    <div class="panel panel-default">
                     
                      <table class="table">
                        <thead>
                          <tr>
                            <th bgcolor="#dddddd" style="text-align: center; vertical-align: middle;">Kategori Adı</th>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($stok as $stokcek) {
                            $Kategori_Adi = $stokcek["Kategori_Adi"];
                            echo "<tr style='text-align: left; vertical-align: middle;'><td>" . $Kategori_Adi . "</td> ";
                          }
                          ?><t>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </table>
            </tr>
          </table>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>