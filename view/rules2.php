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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Hama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Hama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_penyakit();
                            foreach ($sql as $data) {
                                $id_penyakit = $data['id_penyakit'];
                                $c_gjl = mysqli_query($koneksi, "SELECT * FROM tb_gejala_penyakit INNER JOIN tb_gejala on tb_gejala.id_gejala = tb_gejala_penyakit.id_gejala WHERE tb_gejala_penyakit.id_penyakit = '$id_penyakit'");
                            ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td>
                                        <a href="gejala-<?= strtolower('Hama') ?>/<?= encrypt($data['id_penyakit']) ?>" class="badge badge-sm bg-gradient-success"><?= $data['kode_penyakit'] ?></a>
                                    <td>
                                        <?= $data['nama_penyakit'] ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php
                                        foreach ($c_gjl as $dvgejala) { ?>
                                        <p>
                                            <?= $dvgejala['kode_gejala'].' - '.$dvgejala['nama_gejala']; ?>
                                        </p>
                                        <?php
                                            $number++;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($c_gjl as $dvgejala) { ?>
                                        <p>
                                            <?= $dvgejala['cf'] ?>
                                        </p>
                                        <?php
                                        }
                                        ?>
                                    </td>
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