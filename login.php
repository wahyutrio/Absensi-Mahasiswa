<?php
/**
 * API Endpoint untuk Login
 * Endpoint ini menangani proses otentikasi pengguna
 */

// Headers untuk CORS dan JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include file yang diperlukan
include_once '../config/database.php';
include_once '../classes/Auth.php';

// Inisialisasi database dan objek Auth
$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

// Mendapatkan data dari request
$data = json_decode(file_get_contents("php://input"));

// Validasi input
if(!empty($data->user_type) && !empty($data->username) && !empty($data->password)) {
    
    $user_type = $data->user_type;
    $username = $data->username;
    $password = $data->password;
    
    $result = array();
    
    // Proses login berdasarkan tipe user
    switch($user_type) {
        case 'dosen':
            $result = $auth->loginDosen($username, $password);
            break;
            
        case 'mahasiswa':
            $result = $auth->loginMahasiswa($username, $password);
            break;
            
        case 'staf_akademik':
            $result = $auth->loginStafAkademik($username, $password);
            break;
            
        default:
            $result = array(
                'success' => false,
                'message' => 'Tipe user tidak valid'
            );
            break;
    }
    
    // Set HTTP response code berdasarkan hasil login
    if($result['success']) {
        http_response_code(200);
        
        // Simpan session (opsional, untuk implementasi session management)
        session_start();
        $_SESSION['user_type'] = $result['user_type'];
        $_SESSION['user_data'] = $result['user_data'];
        
    } else {
        http_response_code(401);
    }
    
    // Return response dalam format JSON
    echo json_encode($result);
    
} else {
    // Set response code - 400 bad request
    http_response_code(400);
    
    // Return error message
    echo json_encode(array(
        'success' => false,
        'message' => 'Data tidak lengkap. Diperlukan user_type, username, dan password.'
    ));
}
?>

