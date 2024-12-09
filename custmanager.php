<?php

class CustManager {
    private $custList = [];
    private $dataFile = 'custdata.json';

    public function __construct() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->custList = json_decode($data, true) ?? [];
        }
    }

    public function tambahPelanggan($nama, $kontak) {
        $id = uniqid();
        $pelanggan = [
            'id' => $id,
            'nama' => $nama,
            'kontak' => $kontak
        ];
        $this->custList[] = $pelanggan;
        $this->simpanData();
    }

    public function getPelanggan() {
        return $this->custList;
    }

    public function hapusPelanggan($id) {
        $this->custList = array_filter($this->custList, function ($pelanggan) use ($id) {
            return $pelanggan['id'] !== $id;
        });
        $this->simpanData();
    }

    private function simpanData() {
        file_put_contents($this->dataFile, json_encode($this->custList, JSON_PRETTY_PRINT));
    }
}
?>
