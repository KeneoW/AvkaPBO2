<?php

class BarangManager {
    private $dataFile = 'data.json';
    private $barangList = [];

    public function __construct() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->barangList = json_decode($data, true) ?? [];
        }
    }
    
    public function tambahBarang($nama, $harga, $stok) {
        $id = uniqid();
        $barang = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ];
        $this->barangList[] = $barang;
        $this->simpanData();
    }

    public function getBarang() {
        return $this->barangList;
    }

    public function hapusBarang($id) {
        $this->barangList = array_filter($this->barangList, function ($barang) use ($id) {
            return $barang['id'] !== $id;
        });
        $this->simpanData();
    }

    public function updateStokBarang($id, $stokBaru) {
        foreach ($this->barangList as &$barang) {
            if ($barang['id'] === $id) {
                $barang['stok'] = $stokBaru;
                break;
            }
        }
        $this->simpanData();
    }

    private function simpanData() {
        file_put_contents($this->dataFile, json_encode($this->barangList, JSON_PRETTY_PRINT));
    }
}
?>
