<?php
$ph = ucwords(str_replace('diagnosa-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah Diagnosa</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Diagnosa <?= $ph ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <!-- <table border="2" rules="all" cellpadding="8" width="100%" class=" table table-stripped"> -->
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Tanggal Diagnosa</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pasien</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Telp</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penyakit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_diagnosa();
                            foreach ($sql as $data) {
                                $vd = hitungCertaintyFactor($data['id_diagnosa']);
                                $penyakit_tertinggi = $vd['penyakit_tertinggi'];
                            ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td><?= tanggal_indo($data['tgl_diagnosa']) ?></span>
                                    <td><?= $data['nama_pasien'] ?></td>
                                    <td><?= tanggal_indo($data['tgl_lahir']) ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                    <td><?= jenis_kelamin($data['jk']) ?></td>
                                    <td><?= $data['no_telp'] ?></td>
                                    <td>
                                        <?= $penyakit_tertinggi['nama_penyakit'] ?> /
                                        <?= $penyakit_tertinggi['cf_total'] ?><br>
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <a href="detail-diagnosa/<?= encrypt($data['id_diagnosa']) ?>" class="badge badge-sm bg-gradient-secondary text-white">
                                                Lihat Gejala
                                            </a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="delete-diagnosa/<?= encrypt($data['id_diagnosa']) ?>" class="badge badge-sm bg-gradient-danger text-white">
                                                Hapus Diagnosa
                                            </a>
                                        </div>
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

<!-- MODAL TAMBAH DATA  -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambah">Tambah <?= $ph ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="diagnosa-<?= strtolower($ph) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_diagnosa" class="form-label">Tanggal Diagnosa</label>
                        <input type="date" name="tgl_diagnosa" id="tgl_diagnosa" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                    <hr>
                    <div class="form-group">
                        <!-- Hidden data -->
                        <input type="hidden" name="jenis_diagnosa" value="<?= $ph ?>">
                        <!-- <input type="hidden" name="id_petani" value=""> -->
                        <!-- End hidden data -->
                        <label for="" class="form-label">Pilih Gejala</label>
                        <?php
                        $query = data_gejala($ph);
                        foreach ($query as $gejala) {
                        ?>
                            <div class="form-group">
                                <input type="checkbox" id="gejala_<?= $gejala['id_gejala'] ?>" name="gejala[]" value="<?= $gejala['id_gejala'] ?>">
                                <label for="gejala_<?= $gejala['id_gejala'] ?>" class="form-label"><?= $gejala['kode_gejala'] . ' - ' . $gejala['nama_gejala'] ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_diagnosa">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>