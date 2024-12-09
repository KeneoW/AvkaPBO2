<?php
require_once 'barang.php';
require_once 'barangmanager.php';

$barangManager = new BarangManager();

//menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: index.php');
}

//Menangani Penghapusan Barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <head>
    <body>
    <nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="index.php">Barang</a></li>
        <li><a href="cust.php">Pelanggan</a></li>
    </ul>
</nav>

<div class="container">
    <div class="cards">
        <?php foreach ($barangManager->getBarang() as $barang) : ?>
            <div class="card">
                <div class="card-content">
                    <div class="card-title"><?= $barang['nama']; ?></div>
                    <div class="card-price">Rp<?= number_format($barang['harga'], 0, ',', '.'); ?></div>
                    <div class="card-stock">Stok: <?= $barang['stok']; ?></div>
                </div>
                <div class="card-actions">
                    <a href="index.php?hapus=<?= $barang['id']; ?>" class="btn btn-delete">Hapus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

        <div class="container">
            <h1>Pencatatan Barang</h1>
            <form method="POST" action="">
                <div>
                    <label for="nama">Nama Barang:</label><br>
                    <input type="text" id="nama" name="nama" required>
                </div>    
                <div>
                    <label for="harga">Harga Barang:</label><br>
                    <input type="number" id="harga" name="harga" required>
                </div>    
                <div>
                    <label for="stok">Stok Barang:</label><br>
                    <input type="number" id="stok" name="stok" required>
                </div>
                <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
            </form>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barangManager->getBarang() as $barang) : ?>
                        <tr>
                            <td><?= $barang['id']; ?></td>
                            <td><?= $barang['nama']; ?></td>
                            <td><?= $barang['harga']; ?></td>
                            <td><?= $barang['stok']; ?></td>
                            <td>
                                <a href="index.php?hapus=<?= $barang['id']; ?>" class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</head>      
</html>
