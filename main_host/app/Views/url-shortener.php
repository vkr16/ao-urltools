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

        <span class="font-poppins border-bottom border-3 border-dark h1">URL Shortener</span>

        <div class="mt-4 mb-5 row font-nunito-sans">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="inputLongUrl" class="form-label">Long URL</label>
                    <input type="text" class="form-control rounded-0" id="inputLongUrl">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputShortUrl" class="form-label">Custom Short URL</label>
                <div class="input-group">
                    <span class="input-group-text rounded-0" id="basic-addon3"> <?= $_ENV['FORWARDER_HOST'] ?></span>
                    <input type="text" class="form-control rounded-0" id="inputShortUrl" aria-describedby="basic-addon3">
                </div>
                <p class="mt-1">Leave empty to create random short url</p>
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-dark rounded-0" onclick="shortenUrl()"><i class="fa-solid fa-link"></i> Shorten URL</button>
            </div>
        </div>
        <?php
        if (isset($_SESSION['shortened_url'])) {
        ?>
            <div class="alert bg-dark text-light rounded-0 container font-nunito-sans">
                <p class="mb-0 text-center">The URL has been shortened, here is the shortened link : <a href="<?= $_ENV['FORWARDER_HOST'] . session()->getFlashdata('shortened_url') ?>" class="text-dark rounded-1 bg-light py-2 px-2"><?= $_ENV['FORWARDER_HOST'] . session()->getFlashdata('shortened_url') ?></a> </p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=<?= $_ENV['FORWARDER_HOST'] . session()->getFlashdata('shortened_url') ?>" class="mb-4">
            </div>
        <?php
        }
        ?>

        <hr>

        <div class="mt-5 font-nunito-sans table-responsive">
            <table id="urls-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unique ID</th>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hit Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($urls as $url) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $url['short_url'] ?></td>
                            <td><a href="<?= $_ENV['FORWARDER_HOST'] . $url['short_url'] ?>" class="text-danger"><?= $_ENV['FORWARDER_HOST'] . $url['short_url'] ?></a></td>
                            <td><a href="<?= $url['long_url'] ?>" class="text-danger"><?= $url['long_url'] ?></a></td>
                            <td><?= $url['hits'] ?></td>
                            <td><button class="btn btn-danger btn-sm rounded-0" onclick="deleteUrl(<?= $url['id'] ?>)"><i class="fa-solid fa-trash-alt"></i> Delete</button></td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>





    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="<?= base_url('public/assets/vendor/notiflix/notiflix-aio-3.2.6.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/vendor/jquery/jquery-3.6.1.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/vendor/datatables/datatables.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('#urls-table').DataTable();
        });

        function shortenUrl() {
            let longurl = $('#inputLongUrl').val();
            let shorturl = $('#inputShortUrl').val();

            $.post("<?= base_url('shortener/shorten') ?>", {
                    url: longurl,
                    short: shorturl
                })
                .done((data) => {
                    $("#inputLongUrl").removeClass("is-invalid");
                    $("#inputShortUrl").removeClass("is-invalid");
                    let result = JSON.parse(data);
                    if (result.status == 'success') {
                        Notiflix.Notify.success('URL shortened');
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    } else if (result.status == 'error') {
                        Notiflix.Notify.error(result.data);
                    } else {
                        let errors = JSON.parse(data);
                        for (let i in errors) {
                            Notiflix.Notify.failure(errors[i]);
                        }

                        "url" in errors ? $("#inputLongUrl").addClass("is-invalid") : $("#inputLongUrl").removeClass("is-invalid");
                        "short" in errors ? $("#inputShortUrl").addClass("is-invalid") : $("#inputShortUrl").removeClass("is-invalid");

                    }
                })
                .fail((data) => {
                    Notiflix.Notify.failure("Something went wrong");
                });
        }

        function deleteUrl(id) {
            $.post("<?= base_url('shortener/delete') ?>", {
                    id: id
                })
                .done((data) => {
                    Notiflix.Notify.success('URL deleted');
                    setTimeout(function() {
                        window.location.reload();
                    }, 500);
                })
        }
    </script>
</body>

</html>