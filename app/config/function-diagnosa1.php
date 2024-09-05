<?php
class Diagnosa {
    private $koneksi;
    private $gejala;
    private $tableEntities;
    private $tableGejalaEntities;
    private $idEntityField;
    private $namaEntityField;
    private $idGejalaEntityField;

    public function __construct($koneksi, $gejala, $tableEntities, $tableGejalaEntities, $idEntityField, $namaEntityField, $idGejalaEntityField) {
        $this->koneksi = $koneksi;
        $this->gejala = $gejala;
        $this->tableEntities = $tableEntities;
        $this->tableGejalaEntities = $tableGejalaEntities;
        $this->idEntityField = $idEntityField;
        $this->namaEntityField = $namaEntityField;
        $this->idGejalaEntityField = $idGejalaEntityField;
    }

    private function getEntities() {
        $query = "SELECT {$this->idEntityField}, {$this->namaEntityField} FROM {$this->tableEntities}";
        $result = $this->koneksi->query($query);
        if (!$result) {
            die('Query Error: ' . $this->koneksi->error);
        }
        $entities = [];
        while ($row = $result->fetch_assoc()) {
            $entities[$row[$this->idEntityField]] = $row[$this->namaEntityField];
        }
        return $entities;
    }

    private function getProbabilitasEntities() {
        $entities = $this->getEntities();
        $totalEntities = count($entities);
        $probabilitasEntities = [];
        foreach ($entities as $id => $nama) {
            $probabilitasEntities[$id] = 1 / $totalEntities;
        }
        return $probabilitasEntities;
    }

    private function getProbabilitasGejalaEntities() {
        $query = "SELECT {$this->idEntityField}, id_gejala FROM {$this->tableGejalaEntities}";
        $result = $this->koneksi->query($query);
        if (!$result) {
            die('Query Error: ' . $this->koneksi->error);
        }
        $probabilitasGejalaEntities = [];
        while ($row = $result->fetch_assoc()) {
            if (!isset($probabilitasGejalaEntities[$row['id_gejala']])) {
                $probabilitasGejalaEntities[$row['id_gejala']] = [];
            }
            $probabilitasGejalaEntities[$row['id_gejala']][$row[$this->idEntityField]] = 1; // Default to 1
        }
        return $probabilitasGejalaEntities;
    }

    private function getProbabilitasGejala() {
        $query = "SELECT id_gejala FROM tb_gejala";
        $result = $this->koneksi->query($query);
        if (!$result) {
            die('Query Error: ' . $this->koneksi->error);
        }
        $totalGejala = $result->num_rows;
        $probabilitasGejala = [];
        while ($row = $result->fetch_assoc()) {
            $probabilitasGejala[$row['id_gejala']] = 1 / $totalGejala;
        }
        return $probabilitasGejala;
    }

    public function hitungProbabilitasEntities() {
        $entities = $this->getEntities();
        $probabilitasEntities = $this->getProbabilitasEntities();
        $probabilitasGejalaEntities = $this->getProbabilitasGejalaEntities();
        $probabilitasGejala = $this->getProbabilitasGejala();

        $hasil = [];
        foreach ($entities as $id => $nama) {
            $probabilitas = $probabilitasEntities[$id];
            foreach ($this->gejala as $id_gejala) {
                if (isset($probabilitasGejalaEntities[$id_gejala][$id])) {
                    $probabilitas *= $probabilitasGejalaEntities[$id_gejala][$id];
                }
            }
            $probabilitasGejalaGabungan = 1;
            foreach ($this->gejala as $id_gejala) {
                if (isset($probabilitasGejala[$id_gejala])) {
                    $probabilitasGejalaGabungan *= $probabilitasGejala[$id_gejala];
                }
            }
            $hasil[$id] = $probabilitas / $probabilitasGejalaGabungan;
        }
        return $hasil;
    }

    public function diagnosa() {
        $probabilitasEntities = $this->hitungProbabilitasEntities();
        arsort($probabilitasEntities);
        return array_key_first($probabilitasEntities);
    }
}

function getGejalaByDiagnosa($koneksi, $id_diagnosa) {
    $query = "SELECT id_gejala FROM tb_detail_diagnosa WHERE id_diagnosa = $id_diagnosa";
    $result = $koneksi->query($query);
    if (!$result) {
        die('Query Error: ' . $koneksi->error);
    }
    $gejala = [];
    while ($row = $result->fetch_assoc()) {
        $gejala[] = $row['id_gejala'];
    }
    return $gejala;
}

function getNamaEntity($koneksi, $id, $tableEntities, $namaEntityField, $idEntityField) {
    $query = "SELECT {$namaEntityField} FROM {$tableEntities} WHERE {$idEntityField} = $id";
    $result = $koneksi->query($query);
    if (!$result) {
        die('Query Error: ' . $koneksi->error);
    }
    $entity = $result->fetch_assoc();
    return $entity[$namaEntityField];
}

function diagnosa($id_diagnosa, $type) {
    global $koneksi;
    $gejala = getGejalaByDiagnosa($koneksi, $id_diagnosa);
    
    if ($type === 'penyakit') {
        $tableEntities = 'tb_penyakit';
        $tableGejalaEntities = 'tb_gejala_penyakit';
        $idEntityField = 'id_penyakit';
        $namaEntityField = 'nama_penyakit';
        $idGejalaEntityField = 'id_gpenyakit';
    } elseif ($type === 'hama') {
        $tableEntities = 'tb_hama';
        $tableGejalaEntities = 'tb_gejala_hama';
        $idEntityField = 'id_hama';
        $namaEntityField = 'nama_hama';
        $idGejalaEntityField = 'id_ghama';
    } else {
        die('Invalid type specified.');
    }

    $diagnosa = new Diagnosa($koneksi, $gejala, $tableEntities, $tableGejalaEntities, $idEntityField, $namaEntityField, $idGejalaEntityField);
    $id_entity = $diagnosa->diagnosa();
    return getNamaEntity($koneksi, $id_entity, $tableEntities, $namaEntityField, $idEntityField);
}
?>