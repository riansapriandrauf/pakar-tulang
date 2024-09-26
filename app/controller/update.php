<?php
if (isset($_POST['edit_penyakit'])) {
    $id_penyakit = $_POST['id_penyakit'];
    $nama_penyakit = $_POST['nama_penyakit'];
    $solusi_penyakit = $_POST['solusi_penyakit'];

    $update = mysqli_query($koneksi, "UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit', solusi_penyakit='$solusi_penyakit' WHERE id_penyakit = '$id_penyakit'");
    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}
if (isset($_POST['edit_gejala'])) {
    $id_gejala = $_POST['id_gejala'];
    $nama_gejala = $_POST['nama_gejala'];
    $update = mysqli_query($koneksi, "UPDATE tb_gejala SET nama_gejala='$nama_gejala' WHERE id_gejala = '$id_gejala'");
    
    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}


if(isset($_POST['edit_gejala_penyakit'])){
    $id_gejala_penyakit = $_POST['id_gejala_penyakit'];
    $id_gejala          = $_POST['id_gejala'];
    $cf                 = $_POST['cf'];
    $update = mysqli_query($koneksi, "UPDATE tb_gejala_penyakit SET 
    id_gejala='$id_gejala',
    cf='$cf'
    WHERE id_gejala_penyakit = '$id_gejala_penyakit'");
    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}