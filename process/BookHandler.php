<?php
require_once __DIR__ . '/../config/database.php';

class BookHandler {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllBooks() {
        $query = "SELECT * FROM buku";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id) {
        $query = "SELECT * FROM buku WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook($judul, $pengarang, $penerbit, $tahun, $stok) {
        $query = "INSERT INTO buku (judul_buku, pengarang_buku, penerbit_buku, tahun_terbit, stok) VALUES (:judul, :pengarang, :penerbit, :tahun, :stok)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':pengarang', $pengarang);
        $stmt->bindParam(':penerbit', $penerbit);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->bindParam(':stok', $stok);
        return $stmt->execute();
    }

    public function updateBook($id, $judul, $pengarang, $penerbit, $tahun, $stok) {
        $query = "UPDATE buku SET judul_buku = :judul, pengarang_buku = :pengarang, penerbit_buku = :penerbit, tahun_terbit = :tahun, stok = :stok WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':pengarang', $pengarang);
        $stmt->bindParam(':penerbit', $penerbit);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->bindParam(':stok', $stok);
        return $stmt->execute();
    }

    public function deleteBook($id) {
        $query = "DELETE FROM buku WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
