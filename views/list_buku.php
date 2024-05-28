<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php");
    exit();
}

// Koneksi ke database
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../process/BookHandler.php';

$bookHandler = new BookHandler();
$books = $bookHandler->getAllBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Daftar Buku</title>
</head>

<body>
     <header>
        <nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Daftar Mahasiswa</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                            <a class="nav-link" href="data_mhs.php">Mahasiswa</a>
                            <a class="nav-link" href="list_buku.php">Buku</a>
                            <!-- <a class="nav-link" href="input_mhs.php">input</a> -->
                            <a class="nav-link" href="../process/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </nav>
    </header>
    <div class="container mt-5">
        <a href="input_buku.php" class="btn btn-primary mb-3" role="button">Input Buku</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= htmlspecialchars($book['judul_buku']); ?></td>
                        <td><?= htmlspecialchars($book['pengarang_buku']); ?></td>
                        <td><?= htmlspecialchars($book['penerbit_buku']); ?></td>
                        <td><?= htmlspecialchars($book['tahun_terbit']); ?></td>
                        <td><?= htmlspecialchars($book['stok']); ?></td>
                        <td>
                            <a class="btn btn-primary" href="edit_buku.php?id=<?= htmlspecialchars($book['id_buku']); ?>">Edit</a>
                            <a class="btn btn-danger" href="../process/delete_buku.php?id=<?= htmlspecialchars($book['id_buku']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>
