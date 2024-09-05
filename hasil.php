<?php
session_start();
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
require_once 'app/config/secret-function.php';
require_once 'app/config/function-allert.php';
require_once 'app/controller/read.php';
require_once 'app/controller/create.php';
require_once 'app/config/function-diagnosa.php';
if (empty($_SESSION['username']) && empty($_SESSION['password']) || $_SESSION['level'] != 2) {
    echo '<script>window.location.href="' . url() . 'login";</script>';
}
$id_diagnosa = decrypt($_GET['diagnosa']);

$result = hitungCertaintyFactor($id_diagnosa);
$penyakit_diatas_satu_persen = $result['penyakit_diatas_satu_persen'];
$penyakit_tertinggi = $result['penyakit_tertinggi'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= url() ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CF - Diagnosa Penyakit Tulang</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
</head>

<body>
    <div class="container my-2 mt-5">
        <div class="row">
            <div class="col-lg-1">
                <a class="btn btn-primary" href="diagnosa">Kembali</a>
            </div>
            <div class="col-lg-10 ms-1">
                <h3>CF - Diagnosa Penyakit Tulang</h3>
            </div>
            <hr class="my-4" />
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="nav nav-tabs" id="myTab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Hasil Perhitungan</a>
                    <a class="nav-item nav-link" id="nav-solusi-tab" data-toggle="tab" href="#nav-solusi" role="tab" aria-controls="nav-solusi" aria-selected="false">Solusi Penyakit</a>

                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade-show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <table align="center" width="600" class="table table-bordered table-striped table-hover my-5">
                                    <thead>
                                        <tr style="background-color:rgb(142, 192, 236);">
                                            <th>Nama Penyakit</th>
                                            <th>Nilai CF Tertinggi DI Kandidat Penyakit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($penyakit_diatas_satu_persen)) {
                                            foreach ($penyakit_diatas_satu_persen as $id_penyakit => $data) { ?>
                                                <tr>
                                                    <td><?= $data['nama_penyakit'] ?></td>
                                                    <td><?= $data['cf_total'] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr>
                                            <td colspan="2" class="text-center">Tidak ada penyakit yang di deteksi</td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <table align="center" width="600" class="table table-bordered table-striped table-hover my-5">
                                    <tbody>
                                        <tr style="background-color:rgb(255, 160, 147);">
                                            <th>Nilai tertinggi dari perhitungan gejala </th>
                                            <th>nilai CF</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            if ($penyakit_tertinggi) { ?>
                                                <td><?= $penyakit_tertinggi['nama_penyakit'] ?></td>
                                                <td><?= $penyakit_tertinggi['cf_total'] ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-solusi" role="tabpanel" aria-labelledby="nav-solusi-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <h2 class="my-4">Tulang TIPE 1</h2>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading1-Tulang">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-Tulang" aria-expanded="true" aria-controls="collapse1-Tulang">1. Melakukan Diet</button>
                                            </h2>
                                            <div id="collapse1-Tulang" class="accordion-collapse collapse show" aria-labelledby="heading1-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Melakukan diet dengan takaran yang sudah dianjurkan akan menjaga kadar gizi
                                                    </p>
                                                    <p>Makanan untuk penderita Tulang yang dianjurkan adalah makanan dengan komposisi seimbang dalam hal karbohidrat, protein, dan lemak, sesuai dengan kecukupan gizi baik, yakni sebagai berikut:</p>
                                                    <ul>
                                                        <li>Karbohidrat: 60-70 persen dari asupan kalori harian</li>
                                                        <li>Protein: 10-15 persen dari asupan kalori harian</li>
                                                        <li>Lemak: 20-25 persen dari asupan kalori harian</li>
                                                    </ul>
                                                    <p>Jumlah kalori disesuaikan dengan pertumbuhan, status gizi, umur, stress akut, dan kegiatan fisik, yang pada dasarnya ditujuan untuk mencapai dan mempertahankan berat ideal.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading2-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-Tulang" aria-expanded="false" aria-controls="collapse2-Tulang">
                                                    2. Perhatikan jenis bahan makanan
                                                </button>
                                            </h2>
                                            <div id="collapse2-Tulang" class="accordion-collapse collapse" aria-labelledby="heading2-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Selain melakukan diet, pilihan jenis bahan makanan juga sebaiknya diperhatikan. Masukan kolesterol tetap diperlukan, tapi jangan sampai melebihi 300 mg per hari. Sementara, sumber lemak diupayakan yang berasal
                                                        dari bahan nabati, yang mengandung lebih banyak asam lemak tak jenuh dibandingkan asam lemak jenuh. Sebagai sumber protein sebaiknya diperoleh dari ikan, ayam (terutama daging dada), tahu dan tempe, karena
                                                        tidak banyak mengandung lemak.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading3-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-Tulang" aria-expanded="false" aria-controls="collapse3-Tulang">
                                                    3. Terapi insulin
                                                </button>
                                            </h2>
                                            <div id="collapse3-Tulang" class="accordion-collapse collapse" aria-labelledby="heading3-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Tulang tipe 1 terjadi karena tubuh kekurangan atau bahkan tidak bisa sama sekali menghasilkan insulin. Itu sebabnya, pasien Tulang ini akan sangat tergantung dengan suntik insulin.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading4-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-Tulang" aria-expanded="false" aria-controls="collapse4-Tulang">
                                                    4. Monitor kadar gula darah secara rutin
                                                </button>
                                            </h2>
                                            <div id="collapse4-Tulang" class="accordion-collapse collapse" aria-labelledby="heading4-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Mengukur dan memantau kadar glukosa darah dapat membantu penderita Tulang mengendalikan penyakitnya. Misalnya, melacak membantu mereka menentukan apakah perlu melakukan penyesuaian dalam makanan atau
                                                        obat-obatan. Ini juga akan membantu para penderita Tulang mengetahui bagaimana tubuh bereaksi terhadap makanan tertentu. Coba ukur level Anda setiap hari, dan catat nomornya dalam buku catatan.
                                                    </p>
                                                    <p>Pemeriksaan gula darah memiliki beberapa manfaat bagi penderita Tulang, seperti :</p>
                                                    <ul>
                                                        <li>Untuk mengevaluasi pencapaian tujuan pengobatan secara keseluruhan.</li>
                                                        <li>Mengetahui pengaruh perubahan pola makan dan olahraga terhadap kadar gula darah.</li>
                                                        <li>Untuk mengetahui faktor lain yang kemungkinan dapat meningkatkan kadar gula darah.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading5-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5-Tulang" aria-expanded="false" aria-controls="collapse5-Tulang">5. Rajin Olahraga</button>
                                            </h2>
                                            <div id="collapse5-Tulang" class="accordion-collapse collapse" aria-labelledby="heading5-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        manfaat penting olahraga untuk penderita Tulang juga dapat membantu meningkatkan sensitivitas insulin dan menjaga gula darah tetap terkendali. Saat berolahraga tubuh membutuhkan energi ekstra yang
                                                        menyebabkan otot menyerap glukosa sehingga membantu menurunkan kadar gula darah.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading6-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6-Tulang" aria-expanded="false" aria-controls="collapse6-Tulang">6. Banyak Minum Air</button>
                                            </h2>
                                            <div id="collapse6-Tulang" class="accordion-collapse collapse" aria-labelledby="heading6-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Minum air secara teratur membantu rehidrasi darah, menurunkan kadar gula darah, dan bisa mengurangi risiko Tulang. Ingatlah, air dan minuman non-kalori lainnya adalah yang terbaik. Minuman yang dimaniskan
                                                        dengan gula meningkatkan glukosa darah, mendorong penambahan berat badan, dan meningkatkan risiko Tulang.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading7-Tulang">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7-Tulang" aria-expanded="false" aria-controls="collapse7-Tulang">7. Cukup tidur</button>
                                            </h2>
                                            <div id="collapse7-Tulang" class="accordion-collapse collapse" aria-labelledby="heading7-Tulang" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Tidur yang cukup terasa luar biasa dan diperlukan untuk kesehatan yang baik. Kebiasaan tidur yang buruk dan kurang istirahat juga memengaruhi kadar gula darah dan sensitivitas insulin. Kondisi tersebut dapat
                                                        meningkatkan nafsu makan dan meningkatkan berat badan. Kurang tidur mengurangi pelepasan hormon pertumbuhan dan meningkatkan kadar kortisol. Kedua hal ini memainkan peran penting dalam kontrol gula darah.
                                                        Selain itu, tidur yang baik adalah soal kuantitas dan kualitas. Yang terbaik adalah mendapatkan jumlah tidur berkualitas tinggi yang cukup setiap malam.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-5">
                                    <h2 class="my-4">Tulang TIPE 2</h2>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading1-nondiabet">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-nondiabet" aria-expanded="true" aria-controls="collapse1-nondiabet">1. Jaga berat badan tetap ideal</button>
                                            </h2>
                                            <div id="collapse1-nondiabet" class="accordion-collapse collapse show" aria-labelledby="heading1-nondiabet" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Memiliki berat badan berlebih (obesitas) membuat Anda berisiko tinggi mengalami Tulang tipe 2. Obesitas mengganggu kerja metabolisme yang membuat sel-sel tubuh tidak dapat merespons insulin dengan baik. Akibatnya, tubuh menjadi kurang atau tidak sensitif terhadap insulin sehingga menyebabkan resisten insulin.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading2-nondiabet">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-nondiabet" aria-expanded="false" aria-controls="collapse2-nondiabet">2. Perhatikan pola makan</button>
                                            </h2>
                                            <div id="collapse2-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading2-nondiabet" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Apa yang Anda makan berpengaruh pada kondisi kesehatan secara menyeluruh, termasuk Tulang tipe 2. Berikut ini makanan yang dianjurkan untuk mengurangi risiko Tulang:
                                                    </p>
                                                    <ul>
                                                        <li>Konsumsi buah dan sayuran.</li>
                                                        <li>Ganti lemak jenuh dengan lemak sehat (seperti alpukat, minyak sayur, kacang-kacangan, tahu).</li>
                                                        <li>Batasi minuman manis dan perbanyak minum air putih (minimal delapan gelas sehari).</li>
                                                        <li>Batasi konsumsi daging merah dan daging olahan.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading3-nondiabet">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-nondiabet" aria-expanded="false" aria-controls="collapse3-nondiabet">3. Aktif bergerak</button>
                                            </h2>
                                            <div id="collapse3-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading3-nondiabet" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Kurang aktivitas fisik meningkatkan risiko Tulang tipe 2 sehingga Anda disarankan untuk aktif bergerak, salah satunya dengan olahraga rutin 30 menit per hari, atau total 150 menit seminggu. Dengan aktif bergerak, otot-otot tubuh menjadi lebih mampu menggunakan insulin dan menyerap glukosa dengan baik.
                                                        Pilih olahraga yang Anda sukai agar nyaman melakukannya (seperti jalan kaki, lari, berenang, bersepeda) dan lakukan secara bertahap. Jangan langsung berolahraga dengan intensitas berat dan lama karena tubuh Anda perlu beradaptasi, apalagi jika tidak terbiasa melakukannya.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading4-nondiabet">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-nondiabet" aria-expanded="false" aria-controls="collapse4-nondiabet">4. Tidak merokok dan batasi konsumsi alkohol</button>
                                            </h2>
                                            <div id="collapse4-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading4-nondiabet" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Jika Anda perokok aktif, tidak ada cara yang lebih efektif untuk mencegah Tulang selain berhenti merokok. Lakukan secara perlahan dan minta bantuan dari orang sekitar saat Anda sedang dalam proses berhenti merokok. Bila perlu, Anda bisa datang ke psikolog untuk membantu janji terapi berhenti merokok langsung dengan ahlinya.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading5-nondiabet">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5-nondiabet" aria-expanded="false" aria-controls="collapse5-nondiabet">5. Konsultasi ke dokter</button>
                                            </h2>
                                            <div id="collapse5-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading5-nondiabet" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Konsultasi memungkinkan tim dokter untuk memantau perkembangan kondisi anda, mengendalikan penyakit, dan mencegah masalah kesehatan ke depannya, meningkatkan kualitas hidup dan kemampuan bergerak, serta
                                                        memperpanjang usia pasien.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-5">
                                    <h2 class="my-4">Tulang GESTASIONAL</h2>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading1-gestasional">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-gestasional" aria-expanded="true" aria-controls="collapse1-gestasional">1. Insulin</button>
                                            </h2>
                                            <div id="collapse1-gestasional" class="accordion-collapse collapse show" aria-labelledby="heading1-gestasional" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Jika tubuh tidak merespon insulin, Anda mungkin perlu suntikan insulin sebagai cara mengobati Tulang gestasional untuk menurunkan kadar glukosa pada darah.
                                                    </p>
                                                    <p>Berikut ini resep yang mungkin akan diberikan dokter sebagai cara mengobati Tulang gestasional:</p>
                                                    <ul>
                                                        <li>Analog insulin yang bekerja cepat, biasanya disuntikkan sebelum atau sesudah makan. Dapat bekerja dengan cepat, tetapi tidak berlangsung lama.</li>
                                                        <li>Insulin basal, biasanya disuntikkan pada waktu tidur atau bangun tidur.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading2-gestasional">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-gestasional" aria-expanded="false" aria-controls="collapse2-gestasional">2. Obat minum hipoglikemik</button>
                                            </h2>
                                            <div id="collapse2-gestasional" class="accordion-collapse collapse" aria-labelledby="heading2-gestasional" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Cara mengobati Tulang gestasional berikutnya adalah penggunaan obat minum.
                                                    </p>
                                                    <p>Ini adalah obat yang diminum untuk menurunkan kadar gula dalam darah Anda. Pemilihan obat metformin ini biasanya dilakukan bila gula darah dapat terkontrol.</p>
                                                    <p>Meski minum obat ini termasuk cara mengobati Tulang gestasional, metformin bisa menyebabkan efek samping, seperti:</p>
                                                    <ul>
                                                        <li>Mual (perut sakit).</li>
                                                        <li>Muntah.</li>
                                                        <li>Kram perut dan diare (buang air besar encer).</li>
                                                    </ul>
                                                    <p>Obat apa pun yang Anda konsumsi semuanya harus berdasar resep dokter.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading3-gestasional">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-gestasional" aria-expanded="false" aria-controls="collapse3-gestasional">3. Rutin cek gula darah</button>
                                            </h2>
                                            <div id="collapse3-gestasional" class="accordion-collapse collapse" aria-labelledby="heading3-gestasional" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Pemeriksaan gula pertama kali disarankan pada pagi saat bangun tidur dan setelah sarapan. Hal ini dilakukan untuk memastikan gula darah berada dalam batas yang normal.
                                                    </p>
                                                    <p>Selain di rumah sakit atau laboratorium, Anda juga bisa melakukan pemeriksaan gula darah sendiri di rumah.</p>
                                                    <p>Jangan ragu untuk bertanya langsung ke dokter atau tenaga medis lainnya jika Anda kebingungan untuk menggunakan alat cek gula darah.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-5">
                                    <h2 class="my-4">Tulang TIPE KHUSUS</h2>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading1-khusus">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-khusus" aria-expanded="true" aria-controls="collapse1-khusus">1. Pilih olahraga yang tepat</button>
                                            </h2>
                                            <div id="collapse1-khusus" class="accordion-collapse collapse show" aria-labelledby="heading1-khusus" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        Olah raga secara teratur dapat menurunkan dan menjaga kadar gula darah tetap normal. Saat ini ada dokter olah raga yang dapat dimintakan nasihat untuk mengatur jenis dan porsi olah raga yang sesuai untuk
                                                        penderita Tulang. Prinsipnya, tidak perlu olah raga berat, olah raga ringan asal dilakukan secara teratur akan sangat bagus pengaruhnya bagi kesehatan. Baca juga: Bagaimana Olahraga yang Tepat untuk
                                                        Tingkatkan Daya Tahan Tubuh? Olahraga yang disarankan adalah yang bersifat CRIPE (Continuous, Rhytmical, Interval, Progressive, Endurance Training). Sedapat mungkin mencapai zona sasaran 75-85 persen denyut
                                                        nadi maksimal (220-umur), disesuaikan dengan kemampuan dan kondisi penderita. Beberapa contoh olahraga yang disarankan, antara lain jalan atau lari pagi, bersepeda, berenang, dan lain sebagainya. Olahraga
                                                        aerobik ini paling tidak dilakukan selama total 30-40 menit per hari didahului dengan pemanasan 5-10 menit dan diakhiri pendinginan antara 5-10 menit. Olahraga akan memperbanyak jumlah dan meningkatkan
                                                        aktivitas reseptor insulin dalam tubuh dan juga meningkatkan penggunaan glukosa.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function printHasil() {
                                            const clickButton = document.getElementById("buttonClick");
                                            clickButton.classList.add("d-none");
                                            window.print();
                                        }
                                    </script>



                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>