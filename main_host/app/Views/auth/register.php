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
            <p class="display-5 fw-semibold font-poppins">Register</p>
            <p class="h5 fw-normal">Register for an account</p>
            <hr style="max-width: 320px" class="mt-2 mb-4">
            <div class="row p-0">
                <div class="col-md-6 mb-3">
                    <label for="inputFirstName" class="form-label">First Name</label>
                    <input required autocomplete="nickname" type="text" class="form-control rounded-0" id="inputFirstName">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input required autocomplete="family-name" type="text" class="form-control rounded-0" id="inputLastName">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input required autocomplete="email" type="email" class="form-control rounded-0" id="inputEmail">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input required autocomplete="new-password" type="password" class="form-control rounded-0" id="inputPassword">
            </div>
            <div class="d-flex justify-content-between">
                <div class="mb-3 d-flex align-items-center me-auto">
                    <input type="checkbox" class="form-check-input rounded-0 mt-0" id="checkShowpassword" onchange="passwordVisible()">
                    <label for="checkShowpassword" class="form-label mb-0 ms-2">Show password</label>
                </div>
            </div>
            <button onclick="submitRegistration()" class="btn btn-primary rounded-0">Create account</button>

            <p class="mt-3">Or <a href="<?= base_url('login') ?>">Log in instead</a></p>
            <p class="small text-muted text-center mt-5">&copy; <?= date('Y') ?> Fikri Miftah Akmaludin</p>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="<?= base_url('public/assets/vendor/notiflix/notiflix-aio-3.2.6.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/vendor/jquery/jquery-3.6.1.min.js') ?>"></script>

    <script>
        Notiflix.Notify.init({
            borderRadius: 0,
        });

        function passwordVisible() {
            if (document.getElementById('inputPassword').type == "password") {
                document.getElementById('inputPassword').type = "text"
            } else {
                document.getElementById('inputPassword').type = "password"
            }
        }

        function submitRegistration() {
            let FirstName = $("#inputFirstName").val();
            let LastName = $("#inputLastName").val();
            let Email = $("#inputEmail").val();
            let Password = $("#inputPassword").val();

            $.post("<?= base_url('register') ?>", {
                    firstname: FirstName,
                    lastname: LastName,
                    email: Email,
                    password: Password
                })
                .done((data) => {
                    if (data == "success") {
                        Notiflix.Notify.success("Registration successful");
                        setTimeout(() => {
                            window.location.href = "<?= base_url('/') ?>";
                        }, 500);


                    } else if (data == "error") {
                        Notiflix.Notify.failure("Registration failed");
                    } else if (data == "conflict") {
                        Notiflix.Notify.warning("Email already exist");
                        $("#inputEmail").focus().addClass("is-invalid");
                    } else {
                        let errors = JSON.parse(data);

                        for (let i in errors) {
                            Notiflix.Notify.failure(errors[i]);
                        }

                        "firstname" in errors ? $("#inputFirstName").addClass("is-invalid") : $("#inputFirstName").removeClass("is-invalid");
                        "lastname" in errors ? $("#inputLastName").addClass("is-invalid") : $("#inputLastName").removeClass("is-invalid");
                        "email" in errors ? $("#inputEmail").addClass("is-invalid") : $("#inputEmail").removeClass("is-invalid");
                        "password" in errors ? $("#inputPassword").addClass("is-invalid") : $("#inputPassword").removeClass("is-invalid");
                    }

                })
                .fail((data) => {
                    Notiflix.Notify.failure("Something went wrong");
                });
        }
    </script>
</body>

</html>