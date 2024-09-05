<?php
if (isset($_POST['edit_penyakit'])) {
    $id_penyakit = $_POST['id_penyakit'];
    $nama_penyakit = $_POST['nama_penyakit'];

    $update = mysqli_query($koneksi, "UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit' WHERE id_penyakit = '$id_penyakit'");
    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}
