<?php
session_start();
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
require_once 'app/config/secret-function.php';
require_once 'app/config/function-allert.php';
require_once 'app/controller/read.php';
require_once 'app/controller/create.php';
require_once 'app/config/function-diagnosa.php';
if (empty($_SESSION['username']) && empty($_SESSION['password']) || $_SESSION['level'] != 2) {
    echo '<script>window.location.href="' . url() . 'login";</script>';
}
$id_diagnosa = decrypt($_GET['diagnosa']);

$result = hitungCertaintyFactor($id_diagnosa);
$penyakit_diatas_satu_persen = $result['penyakit_diatas_satu_persen'];
$penyakit_tertinggi = $result['penyakit_tertinggi'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= url() ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CF - Diagnosa Penyakit Tulang</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
</head>

<body>
    <div class="container my-2 mt-5">
        <div class="row">
            <div class="col-lg-1">
                <a class="btn btn-primary" href="diagnosa">Kembali</a>
            </div>
            <div class="col-lg-10 ms-1">
                <h3>CF - Diagnosa Penyakit Tulang</h3>
            </div>
            <hr class="my-4" />
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="nav nav-tabs" id="myTab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Hasil Perhitungan</a>
                    <a class="nav-item nav-link" id="nav-solusi-tab" data-toggle="tab" href="#nav-solusi" role="tab" aria-controls="nav-solusi" aria-selected="false">Solusi Penyakit</a>

                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade-show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <table align="center" width="600" class="table table-bordered table-striped table-hover my-5">
                                    <thead>
                                        <tr style="background-color:rgb(142, 192, 236);">
                                            <th>Nama Penyakit</th>
                                            <th>Nilai CF Tertinggi DI Kandidat Penyakit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($penyakit_diatas_satu_persen)) {
                                            foreach ($penyakit_diatas_satu_persen as $id_penyakit => $data) { ?>
                                                <tr>
                                                    <td><?= $data['nama_penyakit'] ?></td>
                                                    <td><?= $data['cf_total'] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr>
                                            <td colspan="2" class="text-center">Tidak ada penyakit yang di deteksi</td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <table align="center" width="600" class="table table-bordered table-striped table-hover my-5">
                                    <tbody>
                                        <tr style="background-color:rgb(255, 160, 147);">
                                            <th>Nilai tertinggi dari perhitungan gejala </th>
                                            <th>nilai CF</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            if ($penyakit_tertinggi) { ?>
                                                <td><?= $penyakit_tertinggi['nama_penyakit'] ?></td>
                                                <td><?= $penyakit_tertinggi['cf_total'] ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-solusi" role="tabpanel" aria-labelledby="nav-solusi-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <p><?= $penyakit_tertinggi['solusi_penyakit'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printHasil() {
            const clickButton = document.getElementById("buttonClick");
            clickButton.classList.add("d-none");
            window.print();
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>