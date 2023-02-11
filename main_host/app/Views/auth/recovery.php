<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/assets/img/shortener.png') ?>" type="image/x-icon">

    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/custom.css') ?>">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?= base_url('public/assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body>

    <div class="wh-screen d-flex justify-content-center align-items-center bg-white font-nunito-sans">
        <div class="col-10" style="max-width: 480px">
            <p class="display-5 fw-semibold font-poppins">Reset Password</p>
            <p class="h5 fw-normal">Request password reset link</p>
            <hr style="max-width: 320px" class="mt-2 mb-4">
            <form action="">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input required autocomplete="email" type="email" class="form-control rounded-0" id="inputEmail">
                </div>
                <button class="btn btn-primary rounded-0">Create account</button>
            </form>

            <p class="mt-3">Or <a href="<?= base_url('login') ?>">Log in instead</a></p>
            <p class="small text-muted text-center mt-5">&copy; <?= date('Y') ?> Fikri Miftah Akmaludin</p>
        </div>
    </div>


    <script src="../assets/library/bootstrap-5.2.1/js/bootstrap.min.js"></script>
    <script>
        function passwordVisible() {
            if (document.getElementById('inputPassword').type == "password") {
                document.getElementById('inputPassword').type = "text"
            } else {
                document.getElementById('inputPassword').type = "password"
            }
        }
    </script>
</body>

</html>