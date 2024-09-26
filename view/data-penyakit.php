<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Penyakit</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Penyakit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Penyakit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Gejala</th>
                                <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penanganan</th> -->
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_penyakit();
                            foreach ($sql as $data) {
                                $id_penyakit = $data['id_penyakit'];
                                $tog = mysqli_query($koneksi, "SELECT * FROM tb_gejala_penyakit WHERE id_penyakit='$id_penyakit'");
                                $jumlah_gejala = mysqli_num_rows($tog);
                            ?>
                                <tr class="text-sm fw-bold">
                                    <td><?= $no ?></td>
                                    <td class="text-center">
                                        <a href="gejala-penyakit/<?= encrypt($data['id_penyakit']) ?>" class="badge badge-sm bg-gradient-success"><?= $data['kode_penyakit'] ?></a>
                                    <td>
                                        <?= $data['nama_penyakit'] ?>
                                    </td>
                                    <td>
                                        <?= $jumlah_gejala ?> Gejala (<?= implode(' - ', array_gejala($id_penyakit, 'kode_gejala', 'penyakit')) ?>)
                                    </td>
                                    <td>
                                        <a data-bs-target="#solusi" data-bs-toggle="modal" class="badge badge-sm bg-gradient-warning">
                                            Cara Penanganan
                                        </a>
                                    </td>
                                    <td class="">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>" class="badge badge-sm bg-gradient-info" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <a href="delete-penyakit/<?= encrypt($data['id_penyakit']) ?>" class="badge badge-sm bg-gradient-danger" data-toggle="tooltip" data-original-title="Edit user">
                                            Delete
                                        </a>
                                    </td>
                                </tr>


                                <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit<?= $no ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="edit<?= $no ?>">Edit Penyakit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="data-penyakit" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_penyakit" value="<?=$id_penyakit?>">
                                                        <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                                                        <input type="text" name="kode_penyakit" id="kode_penyakit" class="form-control" required placeholder="Kode Penyakit" value="<?=$data['kode_penyakit']?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                                                        <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" required placeholder="Nama Penyakit" value="<?=$data['nama_penyakit']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="solusi_penyakit" class="form-label">Solusi Penyakit</label>
                                                        <input type="text" name="solusi_penyakit" id="solusi_penyakit" class="form-control" required placeholder="Solusi Penyakit" value="<?=$data['solusi_penyakit']?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_penyakit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                <h1 class="modal-title fs-5" id="tambah">Tambah Penyakit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="data-penyakit" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="jenis_penyakit" value="Penyakit">
                        <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                        <input type="text" name="kode_penyakit" id="kode_penyakit" class="form-control" required placeholder="Kode Penyakit">
                    </div>
                    <div class="form-group">
                        <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                        <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" required placeholder="Nama Penyakit">
                    </div>
                    <div class="form-group">
                        <label for="solusi_penyakit" class="form-label">Solusi Penyakit</label>
                        <input type="text" name="solusi_penyakit" id="solusi_penyakit" class="form-control" required placeholder="Solusi Penyakit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_penyakit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>