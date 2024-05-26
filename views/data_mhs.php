<?php
    session_start();

    //Cek apakah user sudah login
    // if (!isset($_SESSION['username'])) {
    //     header("Location: ../public/index.php");
    //     exit();
    // }
    
    // Koneksi ke database
    require_once __DIR__ . '/../config/database.php';
    
    $database = new Database();
    $conn = $database->getConnection();
    
    // Query untuk mengambil data mahasiswa
    $query = "SELECT * FROM mahasiswa";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    $mahasiswas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $user = new User();
    // $mahasiswas = $user->getMahasiswa();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                            <a class="nav-link" href="input_mhs.php">input</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </div>
                    </div>
                </div>
            </nav>
        </nav>
    </header>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kelas</th>
                <th scope="col">Handphone</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswas as $mahasiswa): ?>
            <tr>
                <th scope="row"><?= $mahasiswa['id_mahasiswa'] ?></th>
                <td><?= $mahasiswa['nama_mhs'] ?></td>
                <td><?= $mahasiswa['alamat_mhs'] ?></td>
                <td><?= $mahasiswa['kelas_mhs'] ?></td>
                <td><?= $mahasiswa['no_hp'] ?></td>
                <td>
                    <a href="edit_mhs.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>">Edit</a>
                    <a href="delete_mhs.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>