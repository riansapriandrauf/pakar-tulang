<script>
    function berhasil_hapus_hapus() {
        swal.fire({
            title: "Berhasil_hapus Menghapus Data",
            icon: "success",
            button: true,
        });
        setTimeout(
            function() {
                <?= kembali() ?>
            },
            1000);
    }

    function gagal_hapu_hapus() {
        swal.fire({
            title: "Gagal_hapu menghapus Data",
            icon: "error",
            button: true,
        });
        setTimeout(
            function() {
                <?= kembali() ?>
            },
            1000);
    }

    function no_data() {
        swal.fire({
            title: "Data Tidak Ditemukan",
            icon: "error",
            button: true,
        });
        setTimeout(
            function() {
                <?= kembali() ?>
            },
            1000);
    }
</script>
<?php
if (!empty($_GET['id'])) {
    $id = decrypt($_GET['id']);

    if ($queris['page'] == "delete-gejala") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_gejala where id_gejala ='$id'");
        if (mysqli_num_rows($cek) > 0) {
            $delete = mysqli_query($koneksi, "DELETE FROM tb_gejala WHERE id_gejala ='$id' ");
            if ($delete) {
                echo '<script>window.addEventListener("load", berhasil_hapus)</script>';
            } else {
                echo '<script>window.addEventListener("load", gagal_hapu)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", no_data)</script>';
        }
    }

    if ($queris['page'] == "delete-penyakit") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_penyakit where id_penyakit ='$id'");
        if (mysqli_num_rows($cek) > 0) {
            $delete = mysqli_query($koneksi, "DELETE FROM tb_penyakit WHERE id_penyakit ='$id' ");
            if ($delete) {
                echo '<script>window.addEventListener("load", berhasil_hapus)</script>';
            } else {
                echo '<script>window.addEventListener("load", gagal_hapu)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", no_data)</script>';
        }
    }

    if ($queris['page'] == "delete-diagnosa") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_diagnosa where id_diagnosa ='$id'");
        if (mysqli_num_rows($cek) > 0) {
            $delete = mysqli_query($koneksi, "DELETE FROM tb_diagnosa WHERE id_diagnosa ='$id' ");
            if ($delete) {
                echo '<script>window.addEventListener("load", berhasil_hapus)</script>';
            } else {
                echo '<script>window.addEventListener("load", gagal_hapu)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", no_data)</script>';
        }
    }

    if ($queris['page'] == "delete-gejala-penyakit") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_gejala_penyakit where id_gejala_penyakit ='$id'");
        if (mysqli_num_rows($cek) > 0) {
            $delete = mysqli_query($koneksi, "DELETE FROM tb_gejala_penyakit WHERE id_gejala_penyakit ='$id' ");
            if ($delete) {
                echo '<script>window.addEventListener("load", berhasil_hapus)</script>';
            } else {
                echo '<script>window.addEventListener("load", gagal_hapu)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", no_data)</script>';
        }
    }
} else {
    echo '<script>window.addEventListener("load", no_data)</script>';
}
?>