<?php
session_start();
require_once 'app/config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="<?= url() ?>">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .jumbotron {
            height: 100vh;
            background-image: url("assets/img/background-index.jpg");
            background-size: cover;
        }
    </style>
    <title>Certainty Factor - Diagnosa Penyakit Tulang</title>
</head>

<body>
    <?php
    require_once 'view/nav-user.php';
    ?>

    <div class="jumbotron jumbotron-fluid text-white">
        <div class="container text-center py-5">
            <h1 class="display-5 font-weight-bold">CF - DIAGNOSA PENYAKIT TULANG</h1>
            <p class="lead mb-5">Aplikasi Diagnosa Penyakit Tulang Secara Online</p>
            <a href="diagnosa" class="btn btn-primary btn-lg">Mulai Diagnosa</a>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="assets/vendor/jquery-3/jquery-3.6.0.min.js"></script>
    <script src="assets/vendor/sweetallert/js/sweetallert.js"></script>
</body>

</html>