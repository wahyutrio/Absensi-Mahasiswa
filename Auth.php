<?php
/**
 * Authentication Class
 * Kelas ini menangani otentikasi pengguna (login/logout)
 */

require_once '../config/database.php';

class Auth {
    private $conn;
    private $table_dosen = 'Dosen';
    private $table_mahasiswa = 'Mahasiswa';

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Login untuk Dosen
     * @param string $email
     * @param string $password (untuk sementara menggunakan email sebagai password)
     * @return array
     */
    public function loginDosen($email, $password) {
        try {
            // Query untuk mencari dosen berdasarkan email
            $query = "SELECT id_dosen, nama_dosen, email FROM " . $this->table_dosen . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Untuk sementara, password adalah email yang sama
                // Dalam implementasi nyata, gunakan password_verify()
                if($password === $email) {
                    return [
                        'success' => true,
                        'user_type' => 'dosen',
                        'user_data' => $row,
                        'message' => 'Login berhasil'
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Password salah'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Email tidak ditemukan'
                ];
            }
        } catch(PDOException $exception) {
            return [
                'success' => false,
                'message' => 'Error: ' . $exception->getMessage()
            ];
        }
    }

    /**
     * Login untuk Mahasiswa
     * @param string $email
     * @param string $password
     * @return array
     */
    public function loginMahasiswa($email, $password) {
        try {
            $query = "SELECT id_mahasiswa, nama_mahasiswa, email, jurusan, angkatan FROM " . $this->table_mahasiswa . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Untuk sementara, password adalah email yang sama
                if($password === $email) {
                    return [
                        'success' => true,
                        'user_type' => 'mahasiswa',
                        'user_data' => $row,
                        'message' => 'Login berhasil'
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Password salah'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Email tidak ditemukan'
                ];
            }
        } catch(PDOException $exception) {
            return [
                'success' => false,
                'message' => 'Error: ' . $exception->getMessage()
            ];
        }
    }

    /**
     * Login untuk Staf Akademik
     * Untuk sementara menggunakan kredensial hardcoded
     * @param string $username
     * @param string $password
     * @return array
     */
    public function loginStafAkademik($username, $password) {
        // Kredensial hardcoded untuk staf akademik
        $admin_username = 'admin';
        $admin_password = 'admin123';

        if($username === $admin_username && $password === $admin_password) {
            return [
                'success' => true,
                'user_type' => 'staf_akademik',
                'user_data' => [
                    'username' => $username,
                    'nama' => 'Administrator',
                    'role' => 'Staf Akademik'
                ],
                'message' => 'Login berhasil'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Username atau password salah'
            ];
        }
    }
}
?>

