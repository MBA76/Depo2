<?php
session_start();
if (!isset($_SESSION["oturum"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
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
    <!-- Default panel contents -->
    <div class="panel-heading"><a color="#FF000" href="index.php">
            <font color="white">Ana Sayfa </font>
        </a></div>
    <div class="panel-body">

        <?php
        date_default_timezone_set('Europe/Istanbul');


        if ($_POST) {
            include("ayar.php");

            $cikis_tarihi = date('d.m.Y');
            $barkod = $_POST["barkod"];
            $Musteri = $_POST["Musteri"];
            //$duzenle=$baglanti->query("Update   urunler set Musteri='$Musteri' cikis_tarihi='$cikis_tarihi',takip='0' where barcode=(SELECT DISTINCT barkod='$barkod') ");
            //$duzenle=$baglanti->query("Update urunler set Musteri='$Musteri',cikis_tarihi='$cikis_tarihi',takip='0' where barkod=(Select distinct barkod from urunler) ");
            //$duzenle=$baglanti->query("Update urunler set Musteri='$Musteri', cikis_tarihi='$cikis_tarihi',takip='0' WHERE urun_id= (SELECT urun_id FROM urunler WHERE urun_id = (SELECT MIN(urun_id) FROM urunler where barkod= '$barkod' AND takip= '1')" );
            //("Update urunler set Musteri='$Musteri',cikis_tarihi='$cikis_tarihi',takip='0' where barkod='$barkod');
            $duzenle = $baglanti->query("Update urunler set Musteri='$Musteri', cikis_tarihi='$cikis_tarihi',takip='0' WHERE urun_id=(SELECT MIN(urun_id) FROM urunler where barkod= '$barkod' AND takip= '1')");
            if ($duzenle) {

                echo "Ürün Çıkarma İşlemi Başarılı";
            } else {

                echo "Ürün Çıkarma İşlemi Başarılı";
            }
        }

        ?>


        <form action="" class="form-horizontal" method="post">
            <div class="row">
                <table width=90% padding=50>
                    <caption style="color:black;text-align:center;"><b>Ürün Çıkışı</b></caption>
                    <tr>
                        <td width=50%>
                            <table width=100%>
                                <h3 style="color:black;text-align:center;">BARKOD</h3>
                                <td>
                                    <input type="text" class="form-control" id="bc" name="barkod" placeholder="Barkod">
                                </td>
                                <tr>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <td>
                                                <label for="inputEmail3" class="col-sm-2 control-label">Barkod</label>
                                                <input type="button" id="btn" value="Tarat(Deneysel)" accept="image/*"/>
                                                <form id="form">
                                                    <div style="background-color: #fff; border-bottom: 1px solid #ddd;">
                                                        <input type="file" id="file"
                                                               style="width: 280px; line-height: 18px; padding: 20px;"/>
                                                    </div>

                                                    <p id="isbn"
                                                       style="font-family: Helvetica, sans-serif; width: 320px; line-height: 18px; padding: 0; text-align: center;">
                                                        Barkod
                                                    </p>


                                                    <div id="scanner-container"></div>
                                                    <canvas id="canvas" width="2000" height="1500"
                                                            style="width: 320px; height: 240px;"></canvas>
                                                </form>
                                            </td>
                                <tr>
                                    <div class="col-sm-10">


                                    </div>
                                </tr>
                                <script src="barcode.js"></script>
                                <script>
                                    try {
                                        document.getElementById('file').onchange = function () {

                                            document.getElementById('isbn').innerHTML = 'Okunuyor';

                                            var image = new Image();
                                            image.onload = function () {
                                                var canvas = document.getElementById('canvas');
                                                var width = canvas.width;
                                                var height = canvas.height;
                                                var context = canvas.getContext('2d');
                                                context.drawImage(image, 0, 0, width, height);
                                                var barcode = new Barcode(context, width, height);
                                                var line = barcode.scan();
                                                if (line) {
                                                    var Flag = document.getElementById('flag')
                                                    document.getElementById('isbn').innerHTML = line.isbn;
                                                    barcode.print(line);
                                                    document.getElementById('bc').setAttribute('value', line.isbn);

                                                    document.getElementById('bc2').setAttribute('value', line.isbn);
                                                    console.log(line.isbn);
                                                } else {
                                                    document.getElementById('isbn').innerHTML = 'Barkod okunamadı';
                                                }
                                            };
                                            image.src = window.webkitURL.createObjectURL(this.files[0]);
                                        };

                                    } catch (e) {
                                        alert(e);
                                    }
                                </script>

            </div>
            <script src="quagga.min.js"></script>
            <script>
                var _scannerIsRunning = false;

                function startScanner() {
                    Quagga.init({
                        inputStream: {
                            name: "Live",
                            type: "LiveStream",
                            target: document.querySelector('#scanner-container'),
                            constraints: {
                                width: 480,
                                height: 320,
                                facingMode: "environment"
                            },
                        },
                        decoder: {
                            readers: [
                                "code_128_reader",
                                "ean_reader",
                                "ean_8_reader",
                                "code_39_reader",
                                "code_39_vin_reader",
                                "codabar_reader",
                                "upc_reader",
                                "upc_e_reader",
                                "i2of5_reader"
                            ],
                            debug: {
                                showCanvas: true,
                                showPatches: true,
                                showFoundPatches: true,
                                showSkeleton: true,
                                showLabels: true,
                                showPatchLabels: true,
                                showRemainingPatchLabels: true,
                                boxFromPatches: {
                                    showTransformed: true,
                                    showTransformedBox: true,
                                    showBB: true
                                }
                            }
                        },

                    }, function (err) {
                        if (err) {
                            console.log(err);
                            return
                        }

                        console.log("Initialization finished. Ready to start");
                        Quagga.start();

                        // Set flag to is running
                        _scannerIsRunning = true;
                    });

                    Quagga.onProcessed(function (result) {
                        var drawingCtx = Quagga.canvas.ctx.overlay,
                            drawingCanvas = Quagga.canvas.dom.overlay;

                        if (result) {
                            if (result.boxes) {
                                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                                result.boxes.filter(function (box) {
                                    return box !== result.box;
                                }).forEach(function (box) {
                                    Quagga.ImageDebug.drawPath(box, {
                                        x: 0,
                                        y: 1
                                    }, drawingCtx, {
                                        color: "green",
                                        lineWidth: 2
                                    });
                                });
                            }

                            if (result.box) {
                                Quagga.ImageDebug.drawPath(result.box, {
                                    x: 0,
                                    y: 1
                                }, drawingCtx, {
                                    color: "#00F",
                                    lineWidth: 2
                                });
                            }

                            if (result.codeResult && result.codeResult.code) {
                                Quagga.ImageDebug.drawPath(result.line, {
                                    x: 'x',
                                    y: 'y'
                                }, drawingCtx, {
                                    color: 'red',
                                    lineWidth: 3
                                });
                            }
                        }
                    });


                    Quagga.onDetected(function (result) {
                        console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                        document.getElementById("bc").value = result.codeResult.code;
                    });
                }


                // Start/stop scanner
                document.getElementById("btn").addEventListener("click", function () {
                    if (_scannerIsRunning) {
                        Quagga.stop();
                    } else {
                        startScanner();
                    }
                }, false);
            </script>
    </div>
    </tr>
    </table>
    </td>
    <td align="center">
        <table>
            <tr>
                <th>
                    <label for="inputEmail3" class="col-sm-2 control-label">Müşteri Firma</label>
                </th>
                <th>
                    <?php
                    include('ayar.php');
                    $sql = "SELECT `Alici_Adi` FROM `alici` WHERE 1";
                    $stmt = $baglanti->prepare($sql);
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    ?>
                    <select name="Musteri">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['Alici_Adi']; ?>"><?= $user['Alici_Adi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
            </tr>
        </table>
    </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-default form-control">Ürün Satışı Yap</button>
                    </div>
                </div>
            </div>
        </td>
    </tr>

    </table>
</div>
</form>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>