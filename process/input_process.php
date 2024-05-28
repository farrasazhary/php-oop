<?php
require_once __DIR__ . '/../config/database.php';

class DataHandler {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insertStudent($name, $address, $class, $phone) {
        $query = "INSERT INTO mahasiswa (nama_mhs, alamat_mhs, kelas_mhs, no_hp) VALUES (:name, :address, :class, :phone)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

// Proses data yang dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $class = $_POST['class'];
    $phone = $_POST['phone'];

    $dataHandler = new DataHandler();

    if ($dataHandler->insertStudent($name, $address, $class, $phone)) {
        echo '<script>alert("Data mahasiswa berhasil ditambahkan!");</script>';
        header("Location: ../views/data_mhs.php"); // Redirect ke halaman sukses
    } else {
        echo "Error inserting data.";
    }
}
?>
