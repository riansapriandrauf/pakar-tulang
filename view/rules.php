<?php
$dt_penyakit = data_penyakit();
$jumlah_penyakit = mysqli_num_rows($dt_penyakit);

function cek_cf($kode_penyakit, $kode_gejala) {
    global $koneksi;
    $sql_qwe = mysqli_query($koneksi, "SELECT * FROM tb_gejala
    INNER JOIN tb_gejala_penyakit ON tb_gejala_penyakit.id_gejala= tb_gejala.id_gejala
    INNER JOIN tb_penyakit ON tb_penyakit.id_penyakit = tb_gejala_penyakit.id_penyakit
    WHERE tb_penyakit.kode_penyakit = '$kode_penyakit' and tb_gejala.kode_gejala ='$kode_gejala'");
    $data = mysqli_fetch_array($sql_qwe);

    return $data['cf'];
}
?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Rules</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Gejala</th>
                                <th colspan="<?= $jumlah_penyakit ?>" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Penyakit</th>
                            </tr>
                            <tr>
                                <?php
                                for ($i = 1; $i <= $jumlah_penyakit; $i++) {  ?>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Penyakit <?= $i ?>
                                    </th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data_gejala = data_gejala();
                            foreach ($data_gejala as $data) {
                                ?>
                                <tr class="text-center">
                                    <td><?= $no ?></td>
                                    <td><?= $data['kode_gejala'] ?></td>
                                    <?php
                                    for ($i = 1; $i <= $jumlah_penyakit; $i++) { 
                                        ?>
                                        <td>
                                            <?= cek_cf('P0'.$i, $data['kode_gejala']) ?>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>