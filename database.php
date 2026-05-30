<?php
/**
 * Database Connection Class
 * Kelas ini menangani koneksi ke database MySQL menggunakan PDO
 */
class Database {
    private $host = 'localhost';
    private $db_name = 'absensi_mahasiswa';
    private $username = 'root';
    private $password = '';
    private $conn;

    /**
     * Membuat koneksi ke database
     * @return PDO|null
     */
    public function getConnection() {
        $this->conn = null;

        try {
            // Membuat koneksi PDO dengan pengaturan charset UTF-8
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            
            // Set error mode ke exception untuk debugging yang lebih baik
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

