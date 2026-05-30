<?php
/**
 * Dosen Management Class
 * Kelas ini menangani operasi CRUD untuk data dosen
 */

class Dosen {
    private $conn;
    private $table_name = 'Dosen';

    // Properties sesuai dengan struktur tabel
    public $id_dosen;
    public $nama_dosen;
    public $email;
    public $no_telepon;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Membaca semua data dosen
     * @return PDOStatement
     */
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nama_dosen ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Membaca data dosen berdasarkan ID
     * @return bool
     */
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_dosen = :id_dosen LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_dosen', $this->id_dosen);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nama_dosen = $row['nama_dosen'];
            $this->email = $row['email'];
            $this->no_telepon = $row['no_telepon'];
            return true;
        }
        return false;
    }

    /**
     * Menambah data dosen baru
     * @return bool
     */
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_dosen=:id_dosen, nama_dosen=:nama_dosen, email=:email, no_telepon=:no_telepon";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id_dosen = htmlspecialchars(strip_tags($this->id_dosen));
        $this->nama_dosen = htmlspecialchars(strip_tags($this->nama_dosen));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->no_telepon = htmlspecialchars(strip_tags($this->no_telepon));

        // Bind parameters
        $stmt->bindParam(':id_dosen', $this->id_dosen);
        $stmt->bindParam(':nama_dosen', $this->nama_dosen);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':no_telepon', $this->no_telepon);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Update data dosen
     * @return bool
     */
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_dosen=:nama_dosen, email=:email, no_telepon=:no_telepon 
                  WHERE id_dosen=:id_dosen";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->nama_dosen = htmlspecialchars(strip_tags($this->nama_dosen));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->no_telepon = htmlspecialchars(strip_tags($this->no_telepon));
        $this->id_dosen = htmlspecialchars(strip_tags($this->id_dosen));

        // Bind parameters
        $stmt->bindParam(':nama_dosen', $this->nama_dosen);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':no_telepon', $this->no_telepon);
        $stmt->bindParam(':id_dosen', $this->id_dosen);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Hapus data dosen
     * @return bool
     */
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_dosen = :id_dosen";
        $stmt = $this->conn->prepare($query);

        $this->id_dosen = htmlspecialchars(strip_tags($this->id_dosen));
        $stmt->bindParam(':id_dosen', $this->id_dosen);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Mendapatkan kelas yang diampu oleh dosen
     * @return PDOStatement
     */
    public function getKelas() {
        $query = "SELECT k.*, mk.nama_mk, mk.sks 
                  FROM Kelas k 
                  JOIN Mata_Kuliah mk ON k.kode_mk = mk.kode_mk 
                  WHERE k.id_dosen = :id_dosen 
                  ORDER BY mk.nama_mk ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_dosen', $this->id_dosen);
        $stmt->execute();
        
        return $stmt;
    }
}
?>

