# Dokumentasi Teknis Sistem Absensi Mahasiswa

## Daftar Isi

1. [Arsitektur Sistem](#arsitektur-sistem)
2. [Struktur Database](#struktur-database)
3. [Backend API Documentation](#backend-api-documentation)
4. [Frontend Architecture](#frontend-architecture)
5. [Security Implementation](#security-implementation)
6. [Deployment Guide](#deployment-guide)
7. [Maintenance & Monitoring](#maintenance--monitoring)

---

## Arsitektur Sistem

### Overview Arsitektur

Sistem Absensi Mahasiswa menggunakan arsitektur 3-tier yang terdiri dari:

1. **Presentation Layer (Frontend)**
   - HTML5, CSS3, JavaScript
   - Bootstrap 5 untuk responsive design
   - Chart.js untuk visualisasi data
   - AJAX untuk komunikasi dengan backend

2. **Application Layer (Backend)**
   - PHP 7.4+ dengan PDO untuk database access
   - RESTful API architecture
   - MVC pattern implementation
   - JSON response format

3. **Data Layer (Database)**
   - MySQL 8.0+ database
   - Normalized database design
   - Foreign key constraints
   - Indexed columns for performance

### Technology Stack

**Frontend Technologies:**
```
- HTML5: Semantic markup dan struktur
- CSS3: Styling dengan Flexbox dan Grid
- JavaScript ES6+: Client-side logic
- Bootstrap 5.1.3: UI framework
- Font Awesome 6.0: Icon library
- Chart.js 3.9.1: Data visualization
```

**Backend Technologies:**
```
- PHP 7.4+: Server-side programming
- PDO: Database abstraction layer
- MySQL 8.0+: Relational database
- Apache 2.4+: Web server
- JSON: Data exchange format
```

### System Flow

```
User Request → Frontend (HTML/JS) → AJAX Call → Backend API (PHP) → Database (MySQL) → Response (JSON) → Frontend Update
```

---

## Struktur Database

### Entity Relationship Diagram

Sistem menggunakan 6 tabel utama dengan relasi sebagai berikut:

```sql
Dosen (1) ←→ (M) Kelas (M) ←→ (1) Mata_Kuliah
   ↓                ↓
   ↓         Absensi (M) ←→ (1) Mahasiswa
   ↓                ↓
   ↓         Semester (1) ←→ (M) Kelas
```

### Detailed Table Structure

#### Tabel Dosen
```sql
CREATE TABLE Dosen (
    id_dosen VARCHAR(20) PRIMARY KEY,
    nama_dosen VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(20)
);
```

**Penjelasan Kolom:**
- `id_dosen`: Primary key, format D001, D002, dst.
- `nama_dosen`: Nama lengkap dosen
- `email`: Email unik untuk login
- `no_telepon`: Nomor telepon (opsional)

#### Tabel Mahasiswa
```sql
CREATE TABLE Mahasiswa (
    id_mahasiswa VARCHAR(20) PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    angkatan INT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(20)
);
```

**Penjelasan Kolom:**
- `id_mahasiswa`: Primary key, format M001, M002, dst.
- `nama_mahasiswa`: Nama lengkap mahasiswa
- `jurusan`: Program studi mahasiswa
- `angkatan`: Tahun masuk mahasiswa
- `email`: Email unik untuk login
- `no_telepon`: Nomor telepon (opsional)

#### Tabel Mata_Kuliah
```sql
CREATE TABLE Mata_Kuliah (
    kode_mk VARCHAR(10) PRIMARY KEY,
    nama_mk VARCHAR(100) NOT NULL,
    sks INT NOT NULL,
    semester INT NOT NULL
);
```

**Penjelasan Kolom:**
- `kode_mk`: Primary key, kode mata kuliah (SI101, SI102, dst.)
- `nama_mk`: Nama mata kuliah
- `sks`: Jumlah SKS
- `semester`: Semester mata kuliah diajarkan

#### Tabel Kelas
```sql
CREATE TABLE Kelas (
    id_kelas VARCHAR(20) PRIMARY KEY,
    kode_mk VARCHAR(10) NOT NULL,
    id_dosen VARCHAR(20) NOT NULL,
    nama_kelas VARCHAR(50) NOT NULL,
    tahun_akademik VARCHAR(20) NOT NULL,
    FOREIGN KEY (kode_mk) REFERENCES Mata_Kuliah(kode_mk),
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);
```

**Penjelasan Kolom:**
- `id_kelas`: Primary key, identifier unik kelas
- `kode_mk`: Foreign key ke tabel Mata_Kuliah
- `id_dosen`: Foreign key ke tabel Dosen
- `nama_kelas`: Nama kelas (SI-3A, SI-3B, dst.)
- `tahun_akademik`: Tahun akademik (2024/2025)

#### Tabel Absensi
```sql
CREATE TABLE Absensi (
    id_absensi INT AUTO_INCREMENT PRIMARY KEY,
    id_kelas VARCHAR(20) NOT NULL,
    id_mahasiswa VARCHAR(20) NOT NULL,
    tanggal DATE NOT NULL,
    waktu_masuk TIME NOT NULL,
    waktu_keluar TIME,
    status ENUM('Hadir', 'Tidak Hadir', 'Izin', 'Sakit') NOT NULL,
    keterangan TEXT,
    FOREIGN KEY (id_kelas) REFERENCES Kelas(id_kelas),
    FOREIGN KEY (id_mahasiswa) REFERENCES Mahasiswa(id_mahasiswa)
);
```

**Penjelasan Kolom:**
- `id_absensi`: Primary key auto increment
- `id_kelas`: Foreign key ke tabel Kelas
- `id_mahasiswa`: Foreign key ke tabel Mahasiswa
- `tanggal`: Tanggal perkuliahan
- `waktu_masuk`: Waktu mahasiswa masuk kelas
- `waktu_keluar`: Waktu mahasiswa keluar kelas (opsional)
- `status`: Status kehadiran dengan 4 pilihan
- `keterangan`: Keterangan tambahan (opsional)

#### Tabel Semester
```sql
CREATE TABLE Semester (
    id_semester VARCHAR(10) PRIMARY KEY,
    nama_semester VARCHAR(50) NOT NULL,
    tahun_akademik VARCHAR(20) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL
);
```

**Penjelasan Kolom:**
- `id_semester`: Primary key (2024-1, 2024-2, dst.)
- `nama_semester`: Nama semester (Ganjil/Genap)
- `tahun_akademik`: Tahun akademik
- `tanggal_mulai`: Tanggal mulai semester
- `tanggal_selesai`: Tanggal selesai semester

### Database Indexes

Untuk optimasi performance, sistem menggunakan index pada kolom yang sering di-query:

```sql
-- Index untuk optimasi query
CREATE INDEX idx_absensi_tanggal ON Absensi(tanggal);
CREATE INDEX idx_absensi_kelas ON Absensi(id_kelas);
CREATE INDEX idx_absensi_mahasiswa ON Absensi(id_mahasiswa);
CREATE INDEX idx_kelas_dosen ON Kelas(id_dosen);
CREATE INDEX idx_mahasiswa_jurusan ON Mahasiswa(jurusan);
```

---

## Backend API Documentation

### API Base URL
```
http://localhost/absensi_system/backend/api/
```

### Authentication Endpoints

#### POST /login.php
Endpoint untuk autentikasi pengguna.

**Request Body:**
```json
{
    "user_type": "mahasiswa|dosen|staf_akademik",
    "username": "email_or_username",
    "password": "password"
}
```

**Response Success (200):**
```json
{
    "success": true,
    "user_type": "mahasiswa",
    "user_data": {
        "id_mahasiswa": "M001",
        "nama_mahasiswa": "Ahmad Rizki",
        "email": "ahmad.rizki@student.unu.ac.id",
        "jurusan": "Sistem Informasi",
        "angkatan": 2022
    },
    "message": "Login berhasil"
}
```

**Response Error (401):**
```json
{
    "success": false,
    "message": "Email atau password salah"
}
```

#### POST /logout.php
Endpoint untuk logout pengguna.

**Response (200):**
```json
{
    "success": true,
    "message": "Logout berhasil"
}
```

### Mahasiswa Endpoints

#### GET /mahasiswa.php
Mendapatkan semua data mahasiswa.

**Response (200):**
```json
{
    "records": [
        {
            "id_mahasiswa": "M001",
            "nama_mahasiswa": "Ahmad Rizki",
            "jurusan": "Sistem Informasi",
            "angkatan": 2022,
            "email": "ahmad.rizki@student.unu.ac.id",
            "no_telepon": "081234567892"
        }
    ]
}
```

#### GET /mahasiswa.php?action=detail&id_mahasiswa=M001
Mendapatkan detail mahasiswa berdasarkan ID.

#### GET /mahasiswa.php?action=riwayat_absensi&id_mahasiswa=M001
Mendapatkan riwayat absensi mahasiswa.

**Response (200):**
```json
{
    "records": [
        {
            "id_absensi": 1,
            "tanggal": "2024-12-01",
            "nama_mk": "Pemrograman Web",
            "nama_dosen": "Dr. Ahmad Fauzi",
            "waktu_masuk": "08:00:00",
            "waktu_keluar": "10:00:00",
            "status": "Hadir",
            "keterangan": ""
        }
    ]
}
```

#### GET /mahasiswa.php?action=statistik_kehadiran&id_mahasiswa=M001
Mendapatkan statistik kehadiran mahasiswa per mata kuliah.

**Response (200):**
```json
{
    "records": [
        {
            "nama_mk": "Pemrograman Web",
            "nama_kelas": "SI-3A",
            "total_pertemuan": 10,
            "hadir": 8,
            "tidak_hadir": 1,
            "izin": 1,
            "sakit": 0,
            "persentase_kehadiran": 80.00
        }
    ]
}
```

#### POST /mahasiswa.php
Menambah data mahasiswa baru.

**Request Body:**
```json
{
    "id_mahasiswa": "M011",
    "nama_mahasiswa": "Nama Mahasiswa",
    "jurusan": "Sistem Informasi",
    "angkatan": 2022,
    "email": "email@student.unu.ac.id",
    "no_telepon": "081234567890"
}
```

#### PUT /mahasiswa.php
Update data mahasiswa.

#### DELETE /mahasiswa.php
Hapus data mahasiswa.

### Absensi Endpoints

#### GET /absensi.php
Mendapatkan semua data absensi.

#### GET /absensi.php?action=get_by_kelas_date&id_kelas=SI001&tanggal=2024-12-01
Mendapatkan data absensi berdasarkan kelas dan tanggal.

#### GET /absensi.php?action=laporan_kelas&id_kelas=SI001
Mendapatkan laporan kehadiran per kelas.

**Response (200):**
```json
{
    "nama_mk": "Pemrograman Web",
    "nama_kelas": "SI-3A",
    "nama_dosen": "Dr. Ahmad Fauzi",
    "total_pertemuan": 10,
    "total_absensi": 100,
    "total_hadir": 80,
    "total_tidak_hadir": 15,
    "total_izin": 3,
    "total_sakit": 2,
    "persentase_kehadiran": 80.00
}
```

#### GET /absensi.php?action=mahasiswa_bermasalah
Mendapatkan daftar mahasiswa dengan kehadiran rendah (< 75%).

#### POST /absensi.php
Menambah data absensi baru.

**Request Body:**
```json
{
    "id_kelas": "SI001",
    "id_mahasiswa": "M001",
    "tanggal": "2024-12-01",
    "waktu_masuk": "08:00:00",
    "waktu_keluar": "10:00:00",
    "status": "Hadir",
    "keterangan": ""
}
```

#### PUT /absensi.php
Update data absensi.

#### DELETE /absensi.php
Hapus data absensi.

### Error Handling

Semua endpoint menggunakan HTTP status code standar:

- **200**: Success
- **201**: Created
- **400**: Bad Request
- **401**: Unauthorized
- **404**: Not Found
- **405**: Method Not Allowed
- **409**: Conflict
- **503**: Service Unavailable

Format error response:
```json
{
    "success": false,
    "message": "Deskripsi error"
}
```

---

## Frontend Architecture

### File Structure

```
frontend/
├── login.html                 # Halaman login
├── dashboard_mahasiswa.html   # Dashboard mahasiswa
├── dashboard_dosen.html       # Dashboard dosen
├── dashboard_admin.html       # Dashboard staf akademik
├── assets/
│   ├── css/
│   │   └── custom.css         # Custom styles
│   ├── js/
│   │   ├── common.js          # Common functions
│   │   ├── mahasiswa.js       # Mahasiswa specific
│   │   └── dosen.js           # Dosen specific
│   └── images/
│       └── logo.png           # Logo universitas
```

### JavaScript Architecture

#### Common Functions (common.js)

```javascript
// API Configuration
const API_BASE_URL = 'http://localhost/absensi_system/backend/api';

// Utility Functions
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID');
}

function getStatusBadgeClass(status) {
    switch(status) {
        case 'Hadir': return 'bg-success';
        case 'Tidak Hadir': return 'bg-danger';
        case 'Izin': return 'bg-warning';
        case 'Sakit': return 'bg-info';
        default: return 'bg-secondary';
    }
}

// AJAX Helper
async function apiCall(endpoint, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        }
    };
    
    if (data) {
        options.body = JSON.stringify(data);
    }
    
    try {
        const response = await fetch(`${API_BASE_URL}/${endpoint}`, options);
        return await response.json();
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}
```

#### Authentication Flow

```javascript
// Login Process
async function login(userType, username, password) {
    const result = await apiCall('login.php', 'POST', {
        user_type: userType,
        username: username,
        password: password
    });
    
    if (result.success) {
        localStorage.setItem('user_data', JSON.stringify(result.user_data));
        localStorage.setItem('user_type', result.user_type);
        redirectToDashboard(result.user_type);
    } else {
        showAlert(result.message, 'danger');
    }
}

// Session Check
function checkSession() {
    const userData = localStorage.getItem('user_data');
    const userType = localStorage.getItem('user_type');
    
    if (!userData || !userType) {
        window.location.href = 'login.html';
        return false;
    }
    
    return { userData: JSON.parse(userData), userType };
}

// Logout Process
async function logout() {
    await apiCall('logout.php', 'POST');
    localStorage.removeItem('user_data');
    localStorage.removeItem('user_type');
    window.location.href = 'login.html';
}
```

### CSS Architecture

#### Custom CSS Structure

```css
/* Variables */
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
}

/* Base Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--light-color);
}

/* Component Styles */
.sidebar {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    transition: all 0.3s ease;
}

.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    
    .main-content {
        margin-left: 0;
    }
}
```

### Chart.js Implementation

```javascript
// Attendance Chart Configuration
function createAttendanceChart(data) {
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.nama_mk),
            datasets: [{
                label: 'Hadir',
                data: data.map(item => parseInt(item.hadir)),
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 1
            }, {
                label: 'Tidak Hadir',
                data: data.map(item => parseInt(item.tidak_hadir)),
                backgroundColor: 'rgba(220, 53, 69, 0.8)',
                borderColor: 'rgba(220, 53, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Statistik Kehadiran per Mata Kuliah'
                },
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}
```

---

## Security Implementation

### Input Validation

#### Backend Validation (PHP)

```php
// Input Sanitization
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Email Validation
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Date Validation
function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

// Example Usage in API
$email = sanitizeInput($_POST['email']);
if (!validateEmail($email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email tidak valid']);
    exit;
}
```

#### Frontend Validation (JavaScript)

```javascript
// Form Validation
function validateLoginForm(userType, username, password) {
    if (!userType) {
        showAlert('Pilih tipe user', 'danger');
        return false;
    }
    
    if (!username || !password) {
        showAlert('Email dan password harus diisi', 'danger');
        return false;
    }
    
    if (!validateEmail(username)) {
        showAlert('Format email tidak valid', 'danger');
        return false;
    }
    
    return true;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
```

### SQL Injection Prevention

Sistem menggunakan PDO prepared statements untuk mencegah SQL injection:

```php
// Secure Query Example
public function readOne() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id_mahasiswa = :id_mahasiswa LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Avoid Direct Query (Vulnerable)
// $query = "SELECT * FROM mahasiswa WHERE id = " . $_GET['id']; // DON'T DO THIS
```

### CORS Configuration

```php
// CORS Headers in API files
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
```

### Session Management

```php
// Session Configuration
session_start();

// Session Validation
function validateSession() {
    if (!isset($_SESSION['user_type']) || !isset($_SESSION['user_data'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Session tidak valid']);
        exit;
    }
}

// Session Cleanup
function destroySession() {
    session_start();
    session_destroy();
    session_unset();
}
```

### Password Security (Production Implementation)

```php
// Password Hashing (for production)
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Password Verification
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Example Usage
$hashedPassword = hashPassword($plainPassword);
// Store $hashedPassword in database

// During login
if (verifyPassword($inputPassword, $storedHash)) {
    // Login successful
}
```

---

## Deployment Guide

### Production Environment Setup

#### Server Requirements

**Minimum Requirements:**
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Apache 2.4 or higher
- 2GB RAM
- 10GB Storage

**Recommended Requirements:**
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache 2.4 with mod_rewrite
- 4GB RAM
- 50GB Storage
- SSL Certificate

#### Apache Configuration

```apache
# .htaccess for backend API
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Security Headers
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    
    # CORS Headers
    Header always set Access-Control-Allow-Origin "*"
    Header always set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    Header always set Access-Control-Allow-Headers "Content-Type, Authorization"
    
    # Handle preflight requests
    RewriteCond %{REQUEST_METHOD} OPTIONS
    RewriteRule ^(.*)$ $1 [R=200,L]
</IfModule>
```

#### PHP Configuration (php.ini)

```ini
; Security Settings
expose_php = Off
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log

; Performance Settings
memory_limit = 256M
max_execution_time = 30
max_input_time = 60
post_max_size = 50M
upload_max_filesize = 50M

; Session Settings
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
```

#### MySQL Configuration

```sql
-- Create production database
CREATE DATABASE absensi_mahasiswa_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create dedicated user
CREATE USER 'absensi_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT SELECT, INSERT, UPDATE, DELETE ON absensi_mahasiswa_prod.* TO 'absensi_user'@'localhost';
FLUSH PRIVILEGES;

-- Performance optimization
SET GLOBAL innodb_buffer_pool_size = 1073741824; -- 1GB
SET GLOBAL query_cache_size = 268435456; -- 256MB
```

### SSL Certificate Setup

```apache
# SSL Virtual Host Configuration
<VirtualHost *:443>
    ServerName absensi.unu.ac.id
    DocumentRoot /var/www/html/absensi_system
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt
    
    # Security Headers
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' cdn.jsdelivr.net cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' cdn.jsdelivr.net cdnjs.cloudflare.com; img-src 'self' data:; font-src 'self' cdnjs.cloudflare.com"
</VirtualHost>
```

### Environment Configuration

```php
// config/environment.php
<?php
define('ENVIRONMENT', 'production'); // development, staging, production

// Database Configuration
if (ENVIRONMENT === 'production') {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'absensi_mahasiswa_prod');
    define('DB_USER', 'absensi_user');
    define('DB_PASS', 'strong_password_here');
    define('DEBUG_MODE', false);
} else {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'absensi_mahasiswa');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DEBUG_MODE', true);
}

// API Configuration
define('API_BASE_URL', 'https://absensi.unu.ac.id/api/');
define('FRONTEND_URL', 'https://absensi.unu.ac.id/');
?>
```

### Backup Strategy

#### Automated Database Backup

```bash
#!/bin/bash
# backup_database.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/backups/absensi"
DB_NAME="absensi_mahasiswa_prod"
DB_USER="absensi_user"
DB_PASS="strong_password_here"

# Create backup directory if not exists
mkdir -p $BACKUP_DIR

# Create database backup
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/absensi_backup_$DATE.sql

# Compress backup
gzip $BACKUP_DIR/absensi_backup_$DATE.sql

# Remove backups older than 30 days
find $BACKUP_DIR -name "*.sql.gz" -mtime +30 -delete

echo "Backup completed: absensi_backup_$DATE.sql.gz"
```

#### Cron Job Setup

```bash
# Add to crontab (crontab -e)
# Daily backup at 2 AM
0 2 * * * /path/to/backup_database.sh

# Weekly full system backup at 3 AM on Sunday
0 3 * * 0 tar -czf /var/backups/system/absensi_full_$(date +\%Y\%m\%d).tar.gz /var/www/html/absensi_system
```

---

## Maintenance & Monitoring

### Performance Monitoring

#### Database Performance

```sql
-- Monitor slow queries
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 2;
SET GLOBAL slow_query_log_file = '/var/log/mysql/slow.log';

-- Check table sizes
SELECT 
    table_name AS 'Table',
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.tables 
WHERE table_schema = 'absensi_mahasiswa_prod'
ORDER BY (data_length + index_length) DESC;

-- Check index usage
SELECT 
    t.table_name,
    s.index_name,
    s.column_name,
    s.seq_in_index,
    s.cardinality
FROM information_schema.tables t
LEFT JOIN information_schema.statistics s ON t.table_name = s.table_name
WHERE t.table_schema = 'absensi_mahasiswa_prod'
ORDER BY t.table_name, s.seq_in_index;
```

#### Application Monitoring

```php
// Performance Logging
class PerformanceLogger {
    private static $startTime;
    
    public static function start() {
        self::$startTime = microtime(true);
    }
    
    public static function end($operation) {
        $endTime = microtime(true);
        $executionTime = ($endTime - self::$startTime) * 1000; // Convert to milliseconds
        
        error_log("Performance: $operation took {$executionTime}ms");
        
        // Alert if operation takes too long
        if ($executionTime > 1000) { // 1 second
            error_log("SLOW QUERY ALERT: $operation took {$executionTime}ms");
        }
    }
}

// Usage in API
PerformanceLogger::start();
$result = $mahasiswa->getStatistikKehadiran();
PerformanceLogger::end('getStatistikKehadiran');
```

### Log Management

#### Error Logging Configuration

```php
// config/logging.php
<?php
class Logger {
    private static $logFile = '/var/log/absensi/application.log';
    
    public static function log($level, $message, $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? json_encode($context) : '';
        $logEntry = "[$timestamp] [$level] $message $contextStr" . PHP_EOL;
        
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public static function error($message, $context = []) {
        self::log('ERROR', $message, $context);
    }
    
    public static function warning($message, $context = []) {
        self::log('WARNING', $message, $context);
    }
    
    public static function info($message, $context = []) {
        self::log('INFO', $message, $context);
    }
}
?>
```

#### Log Rotation

```bash
# /etc/logrotate.d/absensi
/var/log/absensi/*.log {
    daily
    missingok
    rotate 30
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
    postrotate
        systemctl reload apache2
    endscript
}
```

### Security Monitoring

#### Failed Login Attempts

```php
// Security monitoring
class SecurityMonitor {
    private static $maxAttempts = 5;
    private static $lockoutTime = 900; // 15 minutes
    
    public static function recordFailedLogin($username, $ip) {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'username' => $username,
            'ip' => $ip,
            'event' => 'failed_login'
        ];
        
        Logger::warning('Failed login attempt', $logEntry);
        
        // Check if IP should be blocked
        self::checkBruteForce($ip);
    }
    
    private static function checkBruteForce($ip) {
        // Implementation for brute force detection
        // This could use database or file-based tracking
    }
}
```

### Health Check Endpoints

```php
// api/health.php
<?php
header('Content-Type: application/json');

$health = [
    'status' => 'healthy',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => []
];

// Database connectivity check
try {
    $database = new Database();
    $db = $database->getConnection();
    $health['checks']['database'] = 'healthy';
} catch (Exception $e) {
    $health['checks']['database'] = 'unhealthy';
    $health['status'] = 'unhealthy';
}

// Disk space check
$diskFree = disk_free_space('/');
$diskTotal = disk_total_space('/');
$diskUsage = (($diskTotal - $diskFree) / $diskTotal) * 100;

if ($diskUsage > 90) {
    $health['checks']['disk_space'] = 'critical';
    $health['status'] = 'unhealthy';
} elseif ($diskUsage > 80) {
    $health['checks']['disk_space'] = 'warning';
} else {
    $health['checks']['disk_space'] = 'healthy';
}

// Memory usage check
$memoryUsage = memory_get_usage(true);
$memoryLimit = ini_get('memory_limit');
$health['checks']['memory'] = [
    'usage' => $memoryUsage,
    'limit' => $memoryLimit,
    'status' => 'healthy'
];

http_response_code($health['status'] === 'healthy' ? 200 : 503);
echo json_encode($health, JSON_PRETTY_PRINT);
?>
```

### Maintenance Scripts

#### Database Optimization

```php
// scripts/optimize_database.php
<?php
require_once '../backend/config/database.php';

$database = new Database();
$db = $database->getConnection();

echo "Starting database optimization...\n";

// Optimize tables
$tables = ['Dosen', 'Mahasiswa', 'Mata_Kuliah', 'Kelas', 'Absensi', 'Semester'];

foreach ($tables as $table) {
    echo "Optimizing table: $table\n";
    $stmt = $db->prepare("OPTIMIZE TABLE $table");
    $stmt->execute();
}

// Update statistics
echo "Updating table statistics...\n";
$stmt = $db->prepare("ANALYZE TABLE " . implode(', ', $tables));
$stmt->execute();

// Clean up old sessions (if using database sessions)
echo "Cleaning up old sessions...\n";
$stmt = $db->prepare("DELETE FROM sessions WHERE last_activity < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$stmt->execute();

echo "Database optimization completed.\n";
?>
```

#### Cache Management

```php
// scripts/clear_cache.php
<?php
echo "Clearing application cache...\n";

// Clear file-based cache
$cacheDir = '/var/cache/absensi/';
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "File cache cleared.\n";
}

// Clear OPcache if available
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache cleared.\n";
}

echo "Cache clearing completed.\n";
?>
```

### Monitoring Dashboard

Untuk monitoring yang lebih komprehensif, pertimbangkan implementasi dashboard monitoring menggunakan tools seperti:

1. **Grafana + Prometheus** untuk metrics visualization
2. **ELK Stack (Elasticsearch, Logstash, Kibana)** untuk log analysis
3. **Nagios** atau **Zabbix** untuk infrastructure monitoring
4. **New Relic** atau **DataDog** untuk application performance monitoring

---

**Catatan:** Dokumentasi ini mencakup implementasi teknis lengkap sistem absensi mahasiswa. Untuk deployment production, pastikan semua aspek keamanan dan performance telah diimplementasikan sesuai dengan standar industri dan kebijakan institusi.

