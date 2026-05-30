<?php
/**
 * API Endpoint untuk Manajemen Mahasiswa
 * Endpoint ini menangani operasi CRUD untuk data mahasiswa
 */

// Headers untuk CORS dan JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include file yang diperlukan
include_once '../config/database.php';
include_once '../classes/Mahasiswa.php';

// Inisialisasi database dan objek Mahasiswa
$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

// Mendapatkan method HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        
        switch($action) {
            case 'riwayat_absensi':
                // Mendapatkan riwayat absensi mahasiswa
                if(isset($_GET['id_mahasiswa'])) {
                    $mahasiswa->id_mahasiswa = $_GET['id_mahasiswa'];
                    
                    $stmt = $mahasiswa->getRiwayatAbsensi();
                    $num = $stmt->rowCount();
                    
                    if($num > 0) {
                        $riwayat_arr = array();
                        $riwayat_arr["records"] = array();
                        
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            array_push($riwayat_arr["records"], $row);
                        }
                        
                        http_response_code(200);
                        echo json_encode($riwayat_arr);
                    } else {
                        http_response_code(200);
                        echo json_encode(array("records" => array(), "message" => "Belum ada riwayat absensi."));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Parameter id_mahasiswa diperlukan."));
                }
                break;
                
            case 'statistik_kehadiran':
                // Mendapatkan statistik kehadiran mahasiswa
                if(isset($_GET['id_mahasiswa'])) {
                    $mahasiswa->id_mahasiswa = $_GET['id_mahasiswa'];
                    
                    $stmt = $mahasiswa->getStatistikKehadiran();
                    $num = $stmt->rowCount();
                    
                    if($num > 0) {
                        $statistik_arr = array();
                        $statistik_arr["records"] = array();
                        
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            array_push($statistik_arr["records"], $row);
                        }
                        
                        http_response_code(200);
                        echo json_encode($statistik_arr);
                    } else {
                        http_response_code(200);
                        echo json_encode(array("records" => array(), "message" => "Belum ada data statistik."));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Parameter id_mahasiswa diperlukan."));
                }
                break;
                
            case 'detail':
                // Mendapatkan detail mahasiswa berdasarkan ID
                if(isset($_GET['id_mahasiswa'])) {
                    $mahasiswa->id_mahasiswa = $_GET['id_mahasiswa'];
                    
                    if($mahasiswa->readOne()) {
                        $mahasiswa_item = array(
                            "id_mahasiswa" => $mahasiswa->id_mahasiswa,
                            "nama_mahasiswa" => $mahasiswa->nama_mahasiswa,
                            "jurusan" => $mahasiswa->jurusan,
                            "angkatan" => $mahasiswa->angkatan,
                            "email" => $mahasiswa->email,
                            "no_telepon" => $mahasiswa->no_telepon
                        );
                        
                        http_response_code(200);
                        echo json_encode($mahasiswa_item);
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "Mahasiswa tidak ditemukan."));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Parameter id_mahasiswa diperlukan."));
                }
                break;
                
            default:
                // Mendapatkan semua data mahasiswa
                $stmt = $mahasiswa->read();
                $num = $stmt->rowCount();
                
                if($num > 0) {
                    $mahasiswa_arr = array();
                    $mahasiswa_arr["records"] = array();
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        
                        $mahasiswa_item = array(
                            "id_mahasiswa" => $id_mahasiswa,
                            "nama_mahasiswa" => $nama_mahasiswa,
                            "jurusan" => $jurusan,
                            "angkatan" => $angkatan,
                            "email" => $email,
                            "no_telepon" => $no_telepon
                        );
                        
                        array_push($mahasiswa_arr["records"], $mahasiswa_item);
                    }
                    
                    http_response_code(200);
                    echo json_encode($mahasiswa_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(array("message" => "Tidak ada data mahasiswa ditemukan."));
                }
                break;
        }
        break;
        
    case 'POST':
        // Menambah data mahasiswa baru
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_mahasiswa) && !empty($data->nama_mahasiswa) && 
           !empty($data->jurusan) && !empty($data->angkatan) && !empty($data->email)) {
            
            $mahasiswa->id_mahasiswa = $data->id_mahasiswa;
            $mahasiswa->nama_mahasiswa = $data->nama_mahasiswa;
            $mahasiswa->jurusan = $data->jurusan;
            $mahasiswa->angkatan = $data->angkatan;
            $mahasiswa->email = $data->email;
            $mahasiswa->no_telepon = isset($data->no_telepon) ? $data->no_telepon : '';
            
            if($mahasiswa->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Mahasiswa berhasil ditambahkan."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal menambahkan mahasiswa."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Data tidak lengkap."));
        }
        break;
        
    case 'PUT':
        // Update data mahasiswa
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_mahasiswa)) {
            $mahasiswa->id_mahasiswa = $data->id_mahasiswa;
            $mahasiswa->nama_mahasiswa = isset($data->nama_mahasiswa) ? $data->nama_mahasiswa : '';
            $mahasiswa->jurusan = isset($data->jurusan) ? $data->jurusan : '';
            $mahasiswa->angkatan = isset($data->angkatan) ? $data->angkatan : '';
            $mahasiswa->email = isset($data->email) ? $data->email : '';
            $mahasiswa->no_telepon = isset($data->no_telepon) ? $data->no_telepon : '';
            
            if($mahasiswa->update()) {
                http_response_code(200);
                echo json_encode(array("message" => "Mahasiswa berhasil diupdate."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal mengupdate mahasiswa."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID mahasiswa diperlukan."));
        }
        break;
        
    case 'DELETE':
        // Hapus data mahasiswa
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_mahasiswa)) {
            $mahasiswa->id_mahasiswa = $data->id_mahasiswa;
            
            if($mahasiswa->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "Mahasiswa berhasil dihapus."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal menghapus mahasiswa."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID mahasiswa diperlukan."));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method tidak diizinkan."));
        break;
}
?>

