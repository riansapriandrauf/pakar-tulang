<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cek_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
    $valid = mysqli_fetch_array($cek_user);
    if (mysqli_num_rows($cek_user) >= 1) {
        if ($password == $valid['password']) {
            // session_start();
            $_SESSION['id_user']     = $valid['id_user'];
            $_SESSION['username']    = $valid['username'];
            $_SESSION['password']    = $valid['password'];
            $_SESSION['level']       = $valid['level'];
            if($valid['level'] == 1){
                echo '<script>window.addEventListener("load", login_success)</script>';
            }else{
                $idny = $valid['id_user'];
                $cek_data = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE id_user = '$idny'");
                $valid2 = mysqli_fetch_array($cek_data);
                $_SESSION['id_pasien']       = $valid2['id_pasien'];
                $_SESSION['nama_pasien']     = $valid2['nama_pasien'];
                echo '<script>window.addEventListener("load", login_success2)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", pw_salah)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", no_user)</script>';
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $nama_pasien    = $_POST['nama_pasien'];
    $tgl_lahir      = $_POST['tgl_lahir'];
    $no_telp        = $_POST['no_telp'];
    $alamat         = $_POST['alamat'];
    $jk             = $_POST['jk'];

    $cek_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
    $valid = mysqli_fetch_array($cek_user);
    if (mysqli_num_rows($cek_user) == 0) {
        $kirim_user = mysqli_query($koneksi, "INSERT into tb_user (`username`, `password`, `level`) VALUES ('$username', '$password', '2')") or die(mysqli_error($koneksi));
        if($kirim_user){
            $id_user = mysqli_insert_id($koneksi);
            $kirim_data = mysqli_query($koneksi, "INSERT into tb_pasien
            (`id_user`, `nama_pasien`, `tgl_lahir`, `alamat`, `no_telp`, `jk`) VALUES
            ('$id_user', '$nama_pasien', '$tgl_lahir', '$alamat', '$no_telp', '$jk')") or die(mysqli_error($koneksi));
            if($kirim_data){
                echo '<script>window.addEventListener("load", berhasil_regis)</script>';
            }
        }else{
            echo '<script>window.addEventListener("load", gagal_regis)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", user_ada)</script>';
    }
}
?>