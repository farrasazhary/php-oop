<?php
    session_start();

    // Koneksi ke database
    require_once __DIR__ . '/../config/database.php';

    $database = new Database();
    $conn = $database->getConnection();

    // Query untuk mengambil data mahasiswa
    $query = "SELECT * FROM mahasiswa";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $mahasiswas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Daftar Mahasiswa</title>
</head>
<body>
   
    <div class="container mt-5">
        <div class=" d-flex justify-content-between">
            <button class="btn btn-success mb-3" onclick="window.print()">Print PDF</button>
            <button><a href="data_mhs.php" class="btn btn-primary"> Kembali</a></button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Handphone</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mahasiswas as $mahasiswa): ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= htmlspecialchars($mahasiswa['nama_mhs']); ?></td>
                    <td><?= htmlspecialchars($mahasiswa['alamat_mhs']); ?></td>
                    <td><?= htmlspecialchars($mahasiswa['kelas_mhs']); ?></td>
                    <td><?= htmlspecialchars($mahasiswa['no_hp']); ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
