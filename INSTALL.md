# Panduan Instalasi Sistem Absensi Mahasiswa

## Langkah-langkah Instalasi di XAMPP

### 1. Persiapan XAMPP

1. **Download dan Install XAMPP**
   - Download XAMPP dari https://www.apachefriends.org/
   - Install XAMPP di komputer Anda
   - Jalankan XAMPP Control Panel

2. **Start Services**
   - Klik tombol "Start" pada Apache
   - Klik tombol "Start" pada MySQL
   - Pastikan kedua service berjalan (status hijau)

### 2. Setup Database

1. **Buka phpMyAdmin**
   - Buka browser dan akses http://localhost/phpmyadmin
   - Login dengan username: root (tanpa password)

2. **Buat Database**
   - Klik tab "Databases"
   - Masukkan nama database: `absensi_mahasiswa`
   - Klik "Create"

3. **Import SQL File**
   - Pilih database `absensi_mahasiswa` dari sidebar kiri
   - Klik tab "Import"
   - Klik "Choose File" dan pilih file `absensi_db.sql`
   - Klik "Go" untuk mengeksekusi

### 3. Setup Backend

1. **Copy Files Backend**
   - Copy seluruh folder `backend` ke dalam folder `htdocs/absensi_system/`
   - Path lengkap: `C:\xampp\htdocs\absensi_system\backend\`

2. **Konfigurasi Database**
   - Buka file `backend/config/database.php`
   - Pastikan konfigurasi sesuai:
   ```php
   private $host = 'localhost';
   private $db_name = 'absensi_mahasiswa';
   private $username = 'root';
   private $password = '';
   ```

### 4. Setup Frontend

1. **Copy Files Frontend**
   - Copy seluruh folder `frontend` ke dalam folder `htdocs/absensi_system/`
   - Path lengkap: `C:\xampp\htdocs\absensi_system\frontend\`

2. **Test Akses**
   - Buka browser dan akses http://localhost/absensi_system/frontend/login.html
   - Pastikan halaman login muncul dengan benar

### 5. Insert Data Sample

Untuk testing, insert data sample berikut ke database:

```sql
-- Insert sample dosen
INSERT INTO Dosen (id_dosen, nama_dosen, email, no_telepon) VALUES
('D001', 'Dr. Ahmad Fauzi', 'ahmad.fauzi@unu.ac.id', '081234567890'),
('D002', 'Ibu Awanis Hidayati', 'awanis.hidayati@unu.ac.id', '081234567891');

-- Insert sample mata kuliah
INSERT INTO Mata_Kuliah (kode_mk, nama_mk, sks, semester) VALUES
('SI101', 'Pemrograman Web', 3, 3),
('SI102', 'Basis Data', 3, 3),
('SI103', 'Sistem Informasi', 2, 3);

-- Insert sample mahasiswa
INSERT INTO Mahasiswa (id_mahasiswa, nama_mahasiswa, jurusan, angkatan, email, no_telepon) VALUES
('M001', 'Ahmad Rizki', 'Sistem Informasi', 2022, 'ahmad.rizki@student.unu.ac.id', '081234567892'),
('M002', 'Siti Nurhaliza', 'Sistem Informasi', 2022, 'siti.nurhaliza@student.unu.ac.id', '081234567893'),
('M003', 'Budi Santoso', 'Sistem Informasi', 2022, 'budi.santoso@student.unu.ac.id', '081234567894'),
('M004', 'Dewi Sartika', 'Sistem Informasi', 2022, 'dewi.sartika@student.unu.ac.id', '081234567895'),
('M005', 'Eko Prasetyo', 'Sistem Informasi', 2022, 'eko.prasetyo@student.unu.ac.id', '081234567896');

-- Insert sample semester
INSERT INTO Semester (id_semester, nama_semester, tahun_akademik, tanggal_mulai, tanggal_selesai) VALUES
('2024-1', 'Ganjil', '2024/2025', '2024-09-01', '2025-01-31'),
('2024-2', 'Genap', '2024/2025', '2025-02-01', '2025-06-30');

-- Insert sample kelas
INSERT INTO Kelas (id_kelas, kode_mk, id_dosen, nama_kelas, tahun_akademik) VALUES
('SI001', 'SI101', 'D001', 'SI-3A', '2024/2025'),
('SI002', 'SI102', 'D002', 'SI-3B', '2024/2025'),
('SI003', 'SI103', 'D001', 'SI-3A', '2024/2025');

-- Insert sample absensi
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI001', 'M001', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M002', '2024-12-01', '08:05:00', '10:00:00', 'Hadir', ''),
('SI001', 'M003', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M004', '2024-12-01', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI001', 'M005', '2024-12-01', '08:15:00', '10:00:00', 'Hadir', 'Terlambat'),

('SI001', 'M001', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M002', '2024-12-08', NULL, NULL, 'Sakit', 'Sakit demam'),
('SI001', 'M003', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M004', '2024-12-08', NULL, NULL, 'Izin', 'Keperluan keluarga'),
('SI001', 'M005', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', '');
```

### 6. Testing Login

Gunakan kredensial berikut untuk testing:

**Staf Akademik:**
- Username: admin
- Password: admin123

**Dosen:**
- Email: ahmad.fauzi@unu.ac.id
- Password: ahmad.fauzi@unu.ac.id

**Mahasiswa:**
- Email: ahmad.rizki@student.unu.ac.id
- Password: ahmad.rizki@student.unu.ac.id

### 7. Troubleshooting

**Jika mengalami error "Connection failed":**
1. Pastikan MySQL service berjalan di XAMPP
2. Cek konfigurasi database di `backend/config/database.php`
3. Pastikan nama database sudah benar

**Jika halaman tidak muncul:**
1. Pastikan Apache service berjalan
2. Cek path file di browser
3. Pastikan file sudah di-copy ke folder htdocs yang benar

**Jika API tidak berfungsi:**
1. Cek console browser untuk error JavaScript
2. Pastikan URL API sudah benar
3. Test API endpoint langsung di browser

### 8. Struktur Folder Final

```
C:\xampp\htdocs\absensi_system\
├── backend\
│   ├── api\
│   │   ├── login.php
│   │   ├── logout.php
│   │   ├── absensi.php
│   │   └── mahasiswa.php
│   ├── classes\
│   │   ├── Auth.php
│   │   ├── Dosen.php
│   │   ├── Mahasiswa.php
│   │   └── Absensi.php
│   └── config\
│       └── database.php
├── frontend\
│   ├── login.html
│   ├── dashboard_mahasiswa.html
│   └── dashboard_dosen.html
├── absensi_db.sql
└── README.md
```

### 9. Akses Sistem

Setelah instalasi selesai, akses sistem melalui:
- **Login Page**: http://localhost/absensi_system/frontend/login.html
- **API Base URL**: http://localhost/absensi_system/backend/api/

Sistem siap digunakan!

