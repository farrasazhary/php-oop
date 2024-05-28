<?php
require_once __DIR__ . '/../config/database.php';

class DataHandler {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function deleteStudent($id) {
        $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

// Contoh penggunaan:
$dataHandler = new DataHandler();

// Proses penanganan penghapusan
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_mahasiswa = $_GET['id']; // ID mahasiswa yang akan dihapus
    if ($dataHandler->deleteStudent($id_mahasiswa)) {
        echo "Data mahasiswa berhasil dihapus.";
        // Redirect or display success message
        header("Location: ../views/data_mhs.php");
        exit;
    } else {
        echo "Gagal menghapus data mahasiswa.";
        // Handle error
    }
}
?>
