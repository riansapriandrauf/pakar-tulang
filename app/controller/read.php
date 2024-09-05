<?php
function data_penyakit()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_penyakit ORDER by kode_penyakit ASC");
}

function data_hama()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_hama ORDER by kode_hama ASC");
}

function data_gejala()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_gejala ORDER by kode_gejala ASC");
}

function data_diagnosa()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_diagnosa INNER JOIN tb_pasien on tb_pasien.id_pasien = tb_diagnosa.id_pasien ORDER by tb_diagnosa.tgl_diagnosa ASC");
}

function detail_diagnosa($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_detail_diagnosa INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_detail_diagnosa.id_gejala WHERE tb_detail_diagnosa.id_diagnosa='$id' ORDER by tb_gejala.kode_gejala ASC");
}

function gejala_penyakit($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_gejala_penyakit 
        INNER JOIN tb_penyakit ON tb_penyakit.id_penyakit = tb_gejala_penyakit.id_penyakit
        INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_gejala_penyakit.id_gejala
        WHERE tb_penyakit.id_penyakit = '$id' order by kode_gejala ASC");
}
function array_gejala($id, $target, $jenis)
{
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM tb_gejala_$jenis INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_gejala_$jenis.id_gejala WHERE tb_gejala_$jenis.id_$jenis = $id order by tb_gejala.kode_gejala ASC");
    $data_array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row[$target];
        }
    }
    return $data_array;
}

function data_penanganan($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_penanganan WHERE id_ph = $id");
}
