<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, arahkan mereka ke halaman login
    header("Location: login_form.php");
    exit();
}
require_once __DIR__ . '/../config/database.php';

class DataHandler {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getStudentById($id) {
        $query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStudent($id, $name, $address, $class, $phone) {
        $query = "UPDATE mahasiswa SET nama_mhs = :name, alamat_mhs = :address, kelas_mhs = :class, no_hp = :phone WHERE id_mahasiswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }
}

// Contoh penggunaan:
$dataHandler = new DataHandler();

$id_mahasiswa = $_GET['id'];
$mahasiswa = $dataHandler->getStudentById($id_mahasiswa);

if ($mahasiswa) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $class = $_POST['class'];
        $phone = $_POST['phone'];

        if ($dataHandler->updateStudent($id_mahasiswa, $name, $address, $class, $phone)) {
            header("Location: ../views/data_mhs.php");
            exit();
        } else {
            $error_message = "Gagal memperbarui data mahasiswa.";
        }
    }
} else {
    $error_message = "Data mahasiswa tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Mahasiswa</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" id="name" class="form-control" name="name" value="<?php echo htmlspecialchars($mahasiswa['nama_mhs']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat:</label>
                <input type="text" id="address" class="form-control" name="address" value="<?php echo htmlspecialchars($mahasiswa['alamat_mhs']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Kelas:</label>
                <input type="text" id="class" class="form-control" name="class" value="<?php echo htmlspecialchars($mahasiswa['kelas_mhs']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Handphone:</label>
                <input type="text" id="phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($mahasiswa['no_hp']); ?>" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
