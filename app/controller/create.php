<?php
if (isset($_POST['sv_penyakit'])) {
    $kode_penyakit  = $_POST['kode_penyakit'];
    $nama_penyakit  = $_POST['nama_penyakit'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_penyakit WHERE kode_penyakit = '$kode_penyakit'");
    if (mysqli_num_rows($cek) == 0) {
        $kirim = mysqli_query($koneksi, "INSERT into tb_penyakit 
        (`kode_penyakit`, `nama_penyakit`) values 
        ('$kode_penyakit', '$nama_penyakit')");
        if ($kirim) {
            echo '<script>window.addEventListener("load", berhasil)</script>';
        } else {
            echo '<script>window.addEventListener("load", gagal)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", double)</script>';
    }
}

if (isset($_POST['sv_gejala'])) {
    $kode_gejala  = $_POST['kode_gejala'];
    $nama_gejala  = $_POST['nama_gejala'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_gejala WHERE kode_gejala = '$kode_gejala'") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($cek) == 0) {
        $kirim = mysqli_query($koneksi, "INSERT into tb_gejala 
        (`kode_gejala`, `nama_gejala`) values 
        ('$kode_gejala', '$nama_gejala')");
        if ($kirim) {
            echo '<script>window.addEventListener("load", berhasil)</script>';
        } else {
            echo '<script>window.addEventListener("load", gagal)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", double)</script>';
    }
}

if (isset($_POST['sv_gejala_penyakit'])) {
    $id_penyakit  = $_POST['id_penyakit'];
    $id_gejala  = $_POST['id_gejala'];
    $cf  = $_POST['cf'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_gejala_penyakit WHERE id_gejala = '$id_gejala' and id_penyakit = '$id_penyakit'") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($cek) == 0) {
        $kirim = mysqli_query($koneksi, "INSERT into tb_gejala_penyakit 
        (`id_penyakit`, `id_gejala`, `cf`) values 
        ('$id_penyakit', '$id_gejala', '$cf')");
        if ($kirim) {
            echo '<script>window.addEventListener("load", berhasil)</script>';
        } else {
            echo '<script>window.addEventListener("load", gagal)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", double)</script>';
    }
}


if (isset($_POST['sv_diagnosa'])) {
    $id_pasien = $_POST['id_pasien'];
    $tgl_diagnosa = $_POST['tgl_diagnosa'];
    $gejala = $_POST['gejala']; // Array id_gejala yang dipilih
    $kondisi = $_POST['kondisi']; // Array nilai CF yang sesuai dengan id_gejala

    // Simpan data umum ke dalam tabel tb_diagnosa
    $query_diagnosa = mysqli_query($koneksi, "INSERT INTO tb_diagnosa
    (`id_pasien`, `tgl_diagnosa`) VALUES 
    ('$id_pasien', '$tgl_diagnosa')") or die(mysqli_error($koneksi));

    // Dapatkan ID diagnosa yang baru saja dimasukkan
    $id_diagnosa = mysqli_insert_id($koneksi);

    // Simpan id_gejala dan nilai cf ke dalam tabel tb_detail_diagnosa
    foreach ($gejala as $index => $id_gejala) {
        $cf = $kondisi[$index]; // Ambil nilai CF yang sesuai dengan index id_gejala
        $query_detail = mysqli_query($koneksi, "INSERT INTO tb_detail_diagnosa 
        (`id_diagnosa`, `id_gejala`, `cf`) VALUES
        ('$id_diagnosa', '$id_gejala', '$cf')") or die(mysqli_error($koneksi));
    }
    if ($query_detail) { ?>
        <script>
            function berhasil_diagnosa() {
                swal.fire({
                    title: "Berhasil",
                    text: "Menyimpan data diagnosa",
                    icon: "success",
                    button: true,
                });
                setTimeout(
                    function() {
                        window.location = "<?= url() ?>hasil?diagnosa=<?=encrypt($id_diagnosa)?>";
                    },
                    1500); // waktu tunggu atau delay
            }
        </script>
<?php echo '<script>window.addEventListener("load", berhasil_diagnosa)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}

if (isset($_POST['sv_penanganan'])) {
    $id_ph          = $_POST['id_ph'];
    $penanganan     = $_POST['penanganan'];
    $kirim = mysqli_query($koneksi, "INSERT INTO tb_penanganan (`id_ph`, `penanganan`) VALUES ('$id_ph', '$penanganan')");
    if ($kirim) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}
