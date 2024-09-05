<?php
function hitungCertaintyFactor($id_diagnosa) {
    global $koneksi;

    // Ambil data detail diagnosa
    $query = "SELECT id_gejala, cf FROM tb_detail_diagnosa WHERE id_diagnosa = $id_diagnosa";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Error mengambil detail diagnosa: " . mysqli_error($koneksi));
    }

    $detail_diagnosa = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $detail_diagnosa[] = $row;
    }

    // Array untuk menyimpan CF per penyakit
    $penyakit_cf = [];

    // Loop melalui setiap gejala untuk menghitung CF untuk setiap penyakit
    foreach ($detail_diagnosa as $detail) {
        $id_gejala = $detail['id_gejala'];
        $cf_user = $detail['cf']; // Nilai CF yang diinput oleh pengguna

        // Ambil penyakit yang terkait dengan gejala
        $query = "SELECT p.id_penyakit, p.nama_penyakit, gp.cf AS cf_pakar 
                  FROM tb_gejala_penyakit gp
                  JOIN tb_penyakit p ON gp.id_penyakit = p.id_penyakit
                  WHERE gp.id_gejala = '$id_gejala'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Error mengambil penyakit: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id_penyakit = $row['id_penyakit'];
            $cf_pakar = $row['cf_pakar'];

            // Hitung nilai CF gabungan
            $cf_gabungan = $cf_pakar * $cf_user;

            if (!isset($penyakit_cf[$id_penyakit])) {
                $penyakit_cf[$id_penyakit] = [
                    'nama_penyakit' => $row['nama_penyakit'],
                    'cf_total' => $cf_gabungan
                ];
            } else {
                $cf_sebelumnya = $penyakit_cf[$id_penyakit]['cf_total'];
                $penyakit_cf[$id_penyakit]['cf_total'] = $cf_sebelumnya + $cf_gabungan * (1 - $cf_sebelumnya);
            }
        }
    }

    // Filter dan format CF
    $penyakit_diatas_satu_persen = [];
    $penyakit_tertinggi = null;
    $cf_tertinggi = 0;

    foreach ($penyakit_cf as $id_penyakit => $data) {
        $cf_total = $data['cf_total'] * 100; // Convert to percentage
        if ($cf_total > 1) {
            $penyakit_diatas_satu_persen[$id_penyakit] = [
                'nama_penyakit' => $data['nama_penyakit'],
                'cf_total' => number_format($cf_total, 2) . '%'
            ];
        }

        // Temukan penyakit dengan CF tertinggi
        if ($data['cf_total'] > $cf_tertinggi) {
            $cf_tertinggi = $data['cf_total'];
            $penyakit_tertinggi = [
                'nama_penyakit' => $data['nama_penyakit'],
                'cf_total' => number_format($cf_tertinggi * 100, 2) . '%'
            ];
        }
    }

    return [
        'penyakit_diatas_satu_persen' => $penyakit_diatas_satu_persen,
        'penyakit_tertinggi' => $penyakit_tertinggi
    ];
}



// CARA MENGGUNAKAN 
// $result = hitungCertaintyFactor($id_diagnosa);
// $penyakit_diatas_satu_persen = $result['penyakit_diatas_satu_persen'];
// $penyakit_tertinggi = $result['penyakit_tertinggi'];

?>
