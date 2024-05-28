<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php");
    exit();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/BookHandler.php';

$bookHandler = new BookHandler();

// Ambil ID buku dari query string
$id_buku = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_buku) {
    if ($bookHandler->deleteBook($id_buku)) {
        header("Location: ../views/list_buku.php");
        exit();
    } else {
        echo "Gagal menghapus buku.";
    }
} else {
    echo "ID buku tidak valid.";
}
?>
