<?php
session_start();

// Cek apakah user sudah login
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data Mahasiswa</title>
</head>
<body>
    <h2>Input Data Mahasiswa</h2>
    <form action="../process/input_process.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama_mhs" required><br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat_mhs" required><br>
        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas_mhs" required><br>
        <label for="hp">No HP:</label>
        <input type="number" id="hp" name="no_hp" required><br>
        <input type="submit" value="Simpan">
    </form>
    <p><a href="data_mhs.php">Lihat Data Mahasiswa</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
