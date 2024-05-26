<?php
session_start();

// Cek apakah user sudah login
// if (!isset($_SESSION['username'])) {
//     header("Location: ../public/index.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../src/User.php';

    // Mengambil data dari form
    $nama = $_POST['nama_mhs'] ?? '';
    $alamat = $_POST['alamat_mhs'] ?? '';
    $kelas = $_POST['kelas_mhs'] ?? '';
    $hp = $_POST['no_hp'] ?? '';

    // Membuat instance User
    $user = new User();

    // Memasukkan data mahasiswa
    if ($user->addStudent($nama, $alamat, $kelas, $hp)) {
        header("Location: ../public/data_mhs.php");
        exit();
    } else {
        echo "Gagal menambahkan data mahasiswa!";
    }
} else {
    header("Location: ../public/input_mhs.php");
    exit();
}
?>
