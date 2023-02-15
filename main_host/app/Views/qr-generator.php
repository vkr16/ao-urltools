<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/assets/img/shortener.png') ?>" type="image/x-icon">

    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?= base_url('public/assets/vendor/fontawesome/css/all.min.css') ?>">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?= base_url('public/assets/vendor/datatables/datatables.min.css') ?>">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/custom.css') ?>">

</head>

<body>
    <div class="container py-3">
        <?= $this->include("templates/navbar.php") ?>

        <span class="font-poppins border-bottom border-3 border-dark h1">QR Code Generator</span>


        <div class="d-flex justify-content-center">
            <div class="col-12">
                <div class="my-3 col-md-6 mx-auto">
                    <label for="inputRawString" class="form-label">String to encode</label>
                    <textarea type="text" class="form-control rounded-0 mb-3" id="inputRawString"></textarea>
                    <button class="btn btn-dark rounded-0" onclick="generateQR()"><i class="fa-solid fa-qrcode"></i> Generate QR</button>
                </div>
                <div id="showcase" class="d-flex justify-content-center">
                    <img id="qrcode" src="https://chart.googleapis.com/chart?cht=qr&chs=350x350">
                </div>
            </div>
        </div>
    </div>





    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="<?= base_url('public/assets/vendor/notiflix/notiflix-aio-3.2.6.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/vendor/jquery/jquery-3.6.1.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/vendor/datatables/datatables.min.js') ?>"></script>

    <script>
        function generateQR() {
            const prefixurl = "https://chart.googleapis.com/chart?cht=qr&chs=350x350&chl=";
            let rawString = $("#inputRawString").val();
            let srcQR = prefixurl + rawString;
            if (rawString != "") {
                $("#inputRawString").removeClass("is-invalid");
                $('#qrcode').attr('src', srcQR).load();
            } else {
                Notiflix.Notify.warning("Please enter a string to encode");
                $('#qrcode').attr('src', prefixurl).load();
                $("#inputRawString").addClass("is-invalid");
            }
        }
    </script>
</body>

</html>