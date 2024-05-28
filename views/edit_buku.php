<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php");
    exit();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../process/BookHandler.php';

$bookHandler = new BookHandler();

// Ambil ID buku dari query string
$id_buku = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_buku) {
    $book = $bookHandler->getBookById($id_buku);

    if (!$book) {
        echo "Buku tidak ditemukan.";
        exit();
    }
} else {
    echo "ID buku tidak valid.";
    exit();
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    if ($bookHandler->updateBook($id_buku, $judul, $pengarang, $penerbit, $tahun, $stok)) {
        header("Location: list_buku.php");
        exit();
    } else {
        echo "Gagal memperbarui buku.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Buku</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Buku</h2>
        <form method="post">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku:</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($book['judul_buku']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang:</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= htmlspecialchars($book['pengarang_buku']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit:</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= htmlspecialchars($book['penerbit_buku']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun Terbit:</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="<?= htmlspecialchars($book['tahun_terbit']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($book['stok']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</html>
