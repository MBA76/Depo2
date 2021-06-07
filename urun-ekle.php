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
            $urun_adi = $_POST["urun_adi"];
            $barkod = $_POST["barkod"];
            $urun_kodu = $_POST["Urun_Kodu"];
            $Kategori = $_POST["Kategori"];
            $G_Firma = $_POST["G_Firma"];
            $giris_tarihi = date('d.m.Y');
            $ekle = $baglanti->prepare("insert into urunler (urun_adi,barkod,Urun_Kodu,Kategori,G_Firma,giris_tarihi,takip) values(?,?,?,?,?,?,?)");
            $ekle->execute(array($urun_adi, $barkod, $urun_kodu, $Kategori, $G_Firma, $giris_tarihi, '1'));

            if ($ekle) {
                echo "Başarıyla Eklendi.";
            } else {
                echo "Eklenemedi.";
            }
        }
        ?>
        <form action="" class="form-horizontal" method="post">
            <div class="row">

                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ürün adı</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Ürün Adı"
                                   name="urun_adi">
                        </div>
                    </div>
                </div>

                <!--################# O R  G ####################################################################################################-->
                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Barkod</label>
                        <div class="col-sm-10">
                            <form id="form">
                                <div style="background-color: #fff; border-bottom: 1px solid #ddd;">
                                    <input type="file" id="file"
                                           style="width: 280px; line-height: 18px; padding: 20px;"/>
                                    <input type="button" id="btn" value="Tarat(Deneysel)" accept="image/*"/>
                                </div>

                                <p id="isbn"
                                   style="font-family: Helvetica, sans-serif; width: 320px; line-height: 18px; padding: 0; text-align: center;">
                                    Barkod
                                </p>

                                <canvas id="canvas" width="2000" height="1500"
                                        style="width: 320px; height: 240px;"></canvas>
                            </form>
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

                            <input type="text" class="form-control" id="bc" name="barkod"
                                   placeholder="Barkod Taratın yada yazın">
                        </div>
                    </div>

                    <!-- Div to show the scanner -->
                    <div id="scanner-container"></div>
                    <!-- Include the image-diff library -->
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


                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ürün Kodu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="Urun_Kodu" value=""
                                   placeholder="ürün Kodu">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <table>
                                <tr>
                                    <th>
                                        <label for="inputEmail3" class="col-sm-2 control-label">Kategorisi</label>
                                    </th>
                                    <th>
                                        <div class="col-sm-10">

                                            <?php
                                            include('ayar.php');
                                            $sql = "SELECT `Kategori_Adi` FROM `kategoriler` WHERE 1";
                                            $stmt = $baglanti->prepare($sql);
                                            $stmt->execute();
                                            $Kategoriler = $stmt->fetchAll();
                                            ?>
                                            <select name="Kategori">
                                                <?php foreach ($Kategoriler as $kat1) : ?>
                                                    <option value="<?= $kat1['Kategori_Adi']; ?>"><?= $kat1['Kategori_Adi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <th>
                                            <label for="inputEmail3" class="col-sm-2 control-label">Geldiği
                                                Firma</label>
                                        </th>
                                        <th>
                                            <div class="col-sm-10">

                                                <?php
                                                include('ayar.php');
                                                $sql = "SELECT `Disp_Adi` FROM `distributor` WHERE 1";
                                                $stmt = $baglanti->prepare($sql);
                                                $stmt->execute();
                                                $users = $stmt->fetchAll();
                                                ?>
                                                <select name="G_Firma">
                                                    <?php foreach ($users as $user) : ?>
                                                        <option value="<?= $user['Disp_Adi']; ?>"><?= $user['Disp_Adi']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-default form-control">Ürün Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>