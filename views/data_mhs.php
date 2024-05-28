<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, arahkan mereka ke halaman login
    header("Location: login_form.php");
    exit();
}

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
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                            <a class="nav-link" href="input_mhs.php">input</a>
                            <a class="nav-link" href="../process/logout.php">Logout</a>
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
            <?php $no = 1; ?>
            <?php foreach ($mahasiswas as $mahasiswa): ?>
                <tr>
                <th scope="row"><?= $no++; ?></th> 
                <td><?= $mahasiswa['nama_mhs'] ?></td>
                <td><?= $mahasiswa['alamat_mhs'] ?></td>
                <td><?= $mahasiswa['kelas_mhs'] ?></td>
                <td><?= $mahasiswa['no_hp'] ?></td>
                <td>
                    <a class="btn btn-primary" href="edit_mhs.php?id=<?php echo $mahasiswa['id_mahasiswa'] ?>">Edit</a>
                    <a class="btn btn-danger" href="../process/delete_process.php?id=<?php echo $mahasiswa['id_mahasiswa'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="print.php" class="btn btn-primary">Print Data</a>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>