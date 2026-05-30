<?php
/**
 * API Endpoint untuk Manajemen Absensi
 * Endpoint ini menangani operasi CRUD untuk data absensi
 */

// Headers untuk CORS dan JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include file yang diperlukan
include_once '../config/database.php';
include_once '../classes/Absensi.php';

// Inisialisasi database dan objek Absensi
$database = new Database();
$db = $database->getConnection();
$absensi = new Absensi($db);

// Mendapatkan method HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Mendapatkan parameter dari URL
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        
        switch($action) {
            case 'get_by_kelas_date':
                // Mendapatkan absensi berdasarkan kelas dan tanggal
                if(isset($_GET['id_kelas']) && isset($_GET['tanggal'])) {
                    $absensi->id_kelas = $_GET['id_kelas'];
                    $absensi->tanggal = $_GET['tanggal'];
                    
                    $stmt = $absensi->getAbsensiByKelasAndDate();
                    $num = $stmt->rowCount();
                    
                    if($num > 0) {
                        $absensi_arr = array();
                        $absensi_arr["records"] = array();
                        
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            
                            $absensi_item = array(
                                "id_absensi" => $id_absensi,
                                "id_mahasiswa" => $id_mahasiswa,
                                "nama_mahasiswa" => $nama_mahasiswa,
                                "tanggal" => $tanggal,
                                "waktu_masuk" => $waktu_masuk,
                                "waktu_keluar" => $waktu_keluar,
                                "status" => $status,
                                "keterangan" => $keterangan
                            );
                            
                            array_push($absensi_arr["records"], $absensi_item);
                        }
                        
                        http_response_code(200);
                        echo json_encode($absensi_arr);
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "Tidak ada data absensi ditemukan."));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Parameter id_kelas dan tanggal diperlukan."));
                }
                break;
                
            case 'laporan_kelas':
                // Mendapatkan laporan absensi per kelas
                if(isset($_GET['id_kelas'])) {
                    $absensi->id_kelas = $_GET['id_kelas'];
                    
                    $stmt = $absensi->getLaporanPerKelas();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($row) {
                        http_response_code(200);
                        echo json_encode($row);
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "Data kelas tidak ditemukan."));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Parameter id_kelas diperlukan."));
                }
                break;
                
            case 'mahasiswa_bermasalah':
                // Mendapatkan mahasiswa yang sering tidak hadir
                $stmt = $absensi->getMahasiswaBermasalah();
                $num = $stmt->rowCount();
                
                if($num > 0) {
                    $mahasiswa_arr = array();
                    $mahasiswa_arr["records"] = array();
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        array_push($mahasiswa_arr["records"], $row);
                    }
                    
                    http_response_code(200);
                    echo json_encode($mahasiswa_arr);
                } else {
                    http_response_code(200);
                    echo json_encode(array("records" => array(), "message" => "Tidak ada mahasiswa bermasalah."));
                }
                break;
                
            default:
                // Mendapatkan semua data absensi
                $stmt = $absensi->read();
                $num = $stmt->rowCount();
                
                if($num > 0) {
                    $absensi_arr = array();
                    $absensi_arr["records"] = array();
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        
                        $absensi_item = array(
                            "id_absensi" => $id_absensi,
                            "id_kelas" => $id_kelas,
                            "id_mahasiswa" => $id_mahasiswa,
                            "nama_mahasiswa" => $nama_mahasiswa,
                            "nama_kelas" => $nama_kelas,
                            "nama_mk" => $nama_mk,
                            "nama_dosen" => $nama_dosen,
                            "tanggal" => $tanggal,
                            "waktu_masuk" => $waktu_masuk,
                            "waktu_keluar" => $waktu_keluar,
                            "status" => $status,
                            "keterangan" => $keterangan
                        );
                        
                        array_push($absensi_arr["records"], $absensi_item);
                    }
                    
                    http_response_code(200);
                    echo json_encode($absensi_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(array("message" => "Tidak ada data absensi ditemukan."));
                }
                break;
        }
        break;
        
    case 'POST':
        // Menambah data absensi baru
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_kelas) && !empty($data->id_mahasiswa) && 
           !empty($data->tanggal) && !empty($data->waktu_masuk) && !empty($data->status)) {
            
            // Cek apakah mahasiswa sudah absen pada hari yang sama
            $absensi->id_kelas = $data->id_kelas;
            $absensi->id_mahasiswa = $data->id_mahasiswa;
            $absensi->tanggal = $data->tanggal;
            
            if($absensi->checkExistingAbsensi()) {
                http_response_code(409);
                echo json_encode(array("message" => "Mahasiswa sudah melakukan absensi pada tanggal ini."));
            } else {
                $absensi->waktu_masuk = $data->waktu_masuk;
                $absensi->waktu_keluar = isset($data->waktu_keluar) ? $data->waktu_keluar : null;
                $absensi->status = $data->status;
                $absensi->keterangan = isset($data->keterangan) ? $data->keterangan : '';
                
                if($absensi->create()) {
                    http_response_code(201);
                    echo json_encode(array("message" => "Absensi berhasil ditambahkan."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Gagal menambahkan absensi."));
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Data tidak lengkap."));
        }
        break;
        
    case 'PUT':
        // Update data absensi
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_absensi)) {
            $absensi->id_absensi = $data->id_absensi;
            $absensi->waktu_keluar = isset($data->waktu_keluar) ? $data->waktu_keluar : null;
            $absensi->status = isset($data->status) ? $data->status : '';
            $absensi->keterangan = isset($data->keterangan) ? $data->keterangan : '';
            
            if($absensi->update()) {
                http_response_code(200);
                echo json_encode(array("message" => "Absensi berhasil diupdate."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal mengupdate absensi."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID absensi diperlukan."));
        }
        break;
        
    case 'DELETE':
        // Hapus data absensi
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_absensi)) {
            $absensi->id_absensi = $data->id_absensi;
            
            if($absensi->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "Absensi berhasil dihapus."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Gagal menghapus absensi."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID absensi diperlukan."));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method tidak diizinkan."));
        break;
}
?>

