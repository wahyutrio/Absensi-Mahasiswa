# Dokumentasi Sistem Absensi Mahasiswa

## Ringkasan Proyek

Sistem Absensi Mahasiswa adalah aplikasi web yang dikembangkan menggunakan PHP dan MySQL (XAMPP) untuk mengelola kehadiran mahasiswa di Universitas Nahdlatul Ulama Kalbar. Sistem ini memisahkan antara backend (API) dan frontend (UI/UX) untuk fleksibilitas dan maintainability yang lebih baik.

## Arsitektur Sistem

### Backend (API)
- **Bahasa**: PHP
- **Database**: MySQL
- **Arsitektur**: RESTful API
- **Struktur**: MVC (Model-View-Controller) pattern

### Frontend (UI/UX)
- **Teknologi**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Responsif**: Ya, mendukung desktop dan mobile
- **Framework CSS**: Bootstrap 5
- **Icons**: Font Awesome 6
- **Charts**: Chart.js

## Struktur Database

Berdasarkan ERD yang diberikan, sistem menggunakan 6 tabel utama:

1. **Dosen** - Data dosen pengampu
2. **Mahasiswa** - Data mahasiswa
3. **Mata_Kuliah** - Data mata kuliah
4. **Semester** - Data semester akademik
5. **Kelas** - Data kelas perkuliahan
6. **Absensi** - Data kehadiran mahasiswa

## Fitur Utama

### Untuk Mahasiswa:
- Login dengan email
- Dashboard dengan statistik kehadiran
- Riwayat absensi lengkap
- Statistik kehadiran per mata kuliah
- Grafik visualisasi kehadiran
- Peringatan jika kehadiran kurang dari 75%

### Untuk Dosen:
- Login dengan email
- Dashboard dengan overview kelas
- Kelola absensi mahasiswa
- Buat absensi baru untuk pertemuan
- Laporan kehadiran per kelas
- Jadwal mengajar hari ini

### Untuk Staf Akademik:
- Login dengan username/password
- Manajemen data mahasiswa dan dosen
- Rekapitulasi absensi keseluruhan
- Laporan mahasiswa bermasalah
- Export data untuk keperluan akademik

## Keamanan

- Input sanitization untuk mencegah SQL injection
- Password hashing (untuk implementasi production)
- Session management
- CORS headers untuk API
- Validasi data di frontend dan backend

## Responsive Design

Sistem dirancang dengan pendekatan mobile-first:
- Sidebar yang dapat di-collapse
- Tabel responsive dengan horizontal scroll
- Card layout yang adaptif
- Touch-friendly interface

## API Endpoints

### Authentication
- `POST /api/login.php` - Login user
- `POST /api/logout.php` - Logout user

### Mahasiswa
- `GET /api/mahasiswa.php` - Get all mahasiswa
- `GET /api/mahasiswa.php?action=detail&id_mahasiswa=X` - Get mahasiswa detail
- `GET /api/mahasiswa.php?action=riwayat_absensi&id_mahasiswa=X` - Get riwayat absensi
- `GET /api/mahasiswa.php?action=statistik_kehadiran&id_mahasiswa=X` - Get statistik kehadiran
- `POST /api/mahasiswa.php` - Create mahasiswa
- `PUT /api/mahasiswa.php` - Update mahasiswa
- `DELETE /api/mahasiswa.php` - Delete mahasiswa

### Absensi
- `GET /api/absensi.php` - Get all absensi
- `GET /api/absensi.php?action=get_by_kelas_date&id_kelas=X&tanggal=Y` - Get absensi by kelas and date
- `GET /api/absensi.php?action=laporan_kelas&id_kelas=X` - Get laporan per kelas
- `GET /api/absensi.php?action=mahasiswa_bermasalah` - Get mahasiswa bermasalah
- `POST /api/absensi.php` - Create absensi
- `PUT /api/absensi.php` - Update absensi
- `DELETE /api/absensi.php` - Delete absensi

## Instalasi dan Setup

### Prasyarat
- XAMPP (Apache + MySQL + PHP)
- Web browser modern
- Text editor (opsional)

### Langkah Instalasi

1. **Setup Database**
   - Buka XAMPP Control Panel
   - Start Apache dan MySQL
   - Buka phpMyAdmin (http://localhost/phpmyadmin)
   - Import file `absensi_db.sql`

2. **Setup Backend**
   - Copy folder `backend` ke `htdocs/absensi_system/`
   - Pastikan konfigurasi database di `config/database.php` sesuai

3. **Setup Frontend**
   - Copy folder `frontend` ke `htdocs/absensi_system/`
   - Buka `http://localhost/absensi_system/frontend/login.html`

### Konfigurasi

Edit file `backend/config/database.php` sesuai setup MySQL Anda:

```php
private $host = 'localhost';
private $db_name = 'absensi_mahasiswa';
private $username = 'root';
private $password = '';
```

## Testing

### Demo Credentials

**Staf Akademik:**
- Username: admin
- Password: admin123

**Dosen:**
- Email: (gunakan email dosen yang ada di database)
- Password: (sama dengan email untuk demo)

**Mahasiswa:**
- Email: (gunakan email mahasiswa yang ada di database)
- Password: (sama dengan email untuk demo)

### Test Cases

1. **Login Test**
   - Test login dengan berbagai tipe user
   - Test validasi input
   - Test redirect setelah login

2. **Dashboard Test**
   - Test loading data dashboard
   - Test responsivitas
   - Test navigasi menu

3. **Absensi Test**
   - Test create absensi baru
   - Test view riwayat absensi
   - Test laporan kehadiran

## Troubleshooting

### Masalah Umum

1. **Error koneksi database**
   - Pastikan MySQL berjalan di XAMPP
   - Cek konfigurasi database
   - Pastikan database sudah dibuat

2. **CORS Error**
   - Pastikan header CORS sudah diset di API
   - Test dengan browser yang berbeda

3. **File tidak ditemukan**
   - Pastikan struktur folder sesuai
   - Cek path di konfigurasi

## Pengembangan Lanjutan

### Fitur yang Dapat Ditambahkan

1. **Notifikasi Real-time**
   - Push notification untuk mahasiswa
   - Email reminder untuk dosen

2. **Mobile App**
   - Aplikasi Android/iOS
   - QR Code scanning untuk absensi

3. **Integrasi Eksternal**
   - Integrasi dengan SIAKAD
   - Export ke PDDikti

4. **Analytics**
   - Dashboard analytics untuk admin
   - Prediksi kehadiran mahasiswa

### Optimisasi

1. **Performance**
   - Caching untuk query yang sering digunakan
   - Pagination untuk data besar
   - Lazy loading untuk gambar

2. **Security**
   - Implementasi JWT untuk authentication
   - Rate limiting untuk API
   - Input validation yang lebih ketat

## Kontribusi

Untuk berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

Proyek ini dikembangkan untuk keperluan akademik Universitas Nahdlatul Ulama Kalbar.

## Kontak

Untuk pertanyaan atau dukungan, hubungi tim pengembang sistem absensi.

