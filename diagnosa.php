<?php
session_start();
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
require_once 'app/config/secret-function.php';
require_once 'app/config/function-allert.php';
require_once 'app/controller/read.php';
require_once 'app/controller/create.php';
if (empty($_SESSION['username']) && empty($_SESSION['password']) || $_SESSION['level'] != 2) {
    echo '<script>window.location.href="' . url() . 'login";</script>';
}
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
    <script type="text/javascript">
        function EnableDisableTextBox(gejala) {
            var kondisi = document.getElementById("kondisi" + gejala);
            var isCheckGejala = document.getElementById('gejala' + gejala).checked;

            if (isCheckGejala) {
                kondisi.disabled = false;
            } else {
                kondisi.disabled = true;
                kondisi.value = ""; // Clear the condition value if checkbox is unchecked
            }

            // Update the 'Proses' button state
            updateProsesButton();
        }

        function updateProsesButton() {
            var checkboxes = document.querySelectorAll('input[name="gejala[]"]:checked');
            var kondisiOptions = document.querySelectorAll('select[name="kondisi[]"]');

            // Count checked checkboxes
            var checkedCount = checkboxes.length;
            var isPastiIya = Array.from(kondisiOptions).some(function(select) {
                return select.value === "1.0" && select.parentElement.previousElementSibling.querySelector('input[type="checkbox"]').checked;
            });

            // No changes to the button state (it remains enabled)
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all checkboxes and condition selects
            document.querySelectorAll('input[name="gejala[]"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', EnableDisableTextBox.bind(null, checkbox.value));
            });

            document.querySelectorAll('select[name="kondisi[]"]').forEach(function(select) {
                select.addEventListener('change', updateProsesButton);
            });

            // Add event listener to button click
            document.getElementById('sv_diagnosa').addEventListener('click', function(event) {
                var checkboxes = document.querySelectorAll('input[name="gejala[]"]:checked');
                var checkedCount = checkboxes.length;
                var isPastiIya = Array.from(document.querySelectorAll('select[name="kondisi[]"]')).some(function(select) {
                    return select.value === "1.0" && select.parentElement.previousElementSibling.querySelector('input[type="checkbox"]').checked;
                });

                if (checkedCount === 1 && !isPastiIya) {
                    event.preventDefault(); // Prevent form submission
                    alert('Anda harus memilih "PASTI IYA" jika hanya satu gejala yang dipilih.');
                }
            });
        });
    </script>
    <title>Certainty Factor - Diagnosa Diabetes</title>
</head>

<body>
    <?php
    require_once 'view/nav-user.php';
    ?>
    <div class="container my-2 mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h3>Diagnosa Penyakit</h3>
                <hr class="my-4">
            </div>
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert">
                    <span class="fw-bold">Perhatian!</span><br>
                    Silahkan memilih gejala sesuai dengan kondisi anda, anda dapat memilih kepastian kondisi dari pasti iya sampai pasti tidak, jika sudah tekan tombol <i>Proses</i> di bawah! untuk melihat hasil.
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form name="form1" method="post" action="diagnosa"><br>
            <input type="hidden" name="id_pasien" value="<?= $_SESSION['id_pasien'] ?>">
            <div class="form-group mb-2">
                <label for="">Tanggal Diagnosa</label>
                <input type="date" name="tgl_diagnosa" class="form-control" value="<?= date('Y-m-d') ?>">
            </div>
            <table align="center" class="table table-bordered table-striped table-hover">
                <tr>
                    <th style="background-color:#95afc0;" class="text-white">KODE GEJALA</th>
                    <th style="background-color:#95afc0;" class="text-white">NAMA GEJALA</th>
                    <th style="background-color:#95afc0;" class="text-white" colspan="2">KONDISI</th>
                </tr>
                <?php
                $arrayName = data_gejala();
                foreach ($arrayName as $r) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?= $r['kode_gejala']; ?>
                        </td>
                        <td width="600">
                            <?php echo $r['nama_gejala']; ?>
                        </td>
                        <td>
                            <input id="gejala<?php echo $r['id_gejala']; ?>" name="gejala[]" type="checkbox" value="<?php echo $r['id_gejala']; ?>" onclick="EnableDisableTextBox(<?php echo $r['id_gejala']; ?>)" />
                            <br />
                        </td>
                        <td>
                            <select id="kondisi<?php echo $r['id_gejala']; ?>" name="kondisi[]" disabled="disabled">
                                <option value="1.0">IYA</option>
                                <option value="0.8">HAMPIR PASTI IYA</option>
                                <option value="0.6">KEMUNGKINAN IYA</option>
                                <option value="0.4">MUNGKIN IYA</option>
                            </select>
                            <br />
                        </td>
                    <?php
                }
                    ?>
                    <tr>
                        <td colspan="4" align="center">
                            <div class="d-grid gap-2 mt-2">
                                <input type="submit" id="sv_diagnosa" name="sv_diagnosa" value="PROSES" class="btn text-white fw-bold" style="background-color:#95afc0;">
                            </div>
                        </td>
                    </tr>
            </table>
            <br>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="assets/vendor/jquery-3/jquery-3.6.0.min.js"></script>
    <script src="assets/vendor/sweetallert/js/sweetallert.js"></script>
</body>

</html>