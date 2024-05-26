<?php
require '../src/User.php';
// require_once __DIR__ . '/../src/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password);

    if ($user->authenticate()) {
        $_SESSION['username'] = $username; // Simpan username ke session
        header("Location: ../views/data_mhs.php"); // Alihkan ke halaman data mahasiswa
        exit();
    } else {
        echo "Login failed! Invalid username or password.";
    }
} else {
    header("Location: ../public/index.php");
    exit();
}
?>
