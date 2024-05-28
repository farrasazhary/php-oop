<?php
// require 'database.php';
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $username;
    private $password;

    public function __construct($username, $password) {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate() {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                return true;
            }
        }
        return false;
    }

    public function register() {
        if ($this->isUsernameTaken()) {
            return false;
        }

        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function isUsernameTaken() {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function addStudent($name, $address, $class, $phone) {
        $query = "INSERT INTO students (name, address, class, phone) VALUES (:name, :address, :class, :phone)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':phone', $phone);

        return $stmt->execute();
    }
    
}
?>
