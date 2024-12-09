<?php
require_once 'custmanager.php';

$CustManager = new CustManager();

//menangani form tambah pelanggan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $CustManager->tambahPelanggan($nama, $kontak);
    header('Location: cust.php');
}

//Menangani Penghapusan Pelanggan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $CustManager->hapusPelanggan($id);
    header('Location: cust.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Pelanggan</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="index.php">Barang</a></li>
            <li><a href="cust.php">Pelanggan</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Pencatatan Pelanggan</h1>
        <form action="" method="post">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" required>
            <button type="submit" name="tambah">Tambah</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($CustManager->getPelanggan() as $pelanggan) : ?>
                    <tr>
                        <td><?= $pelanggan['nama']; ?></td>
                        <td><?= $pelanggan['kontak']; ?></td>
                        <td><a href="cust.php?hapus=<?= $pelanggan['id']; ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
