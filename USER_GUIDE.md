# Panduan Penggunaan Sistem Absensi Mahasiswa

## Daftar Isi

1. [Pengenalan Sistem](#pengenalan-sistem)
2. [Panduan untuk Mahasiswa](#panduan-untuk-mahasiswa)
3. [Panduan untuk Dosen](#panduan-untuk-dosen)
4. [Panduan untuk Staf Akademik](#panduan-untuk-staf-akademik)
5. [FAQ (Frequently Asked Questions)](#faq)
6. [Troubleshooting](#troubleshooting)

---

## Pengenalan Sistem

Sistem Absensi Mahasiswa Universitas Nahdlatul Ulama Kalbar adalah aplikasi web yang dirancang untuk memudahkan pengelolaan kehadiran mahasiswa dalam perkuliahan. Sistem ini menggunakan teknologi web modern dengan antarmuka yang responsif dan user-friendly.

### Fitur Utama Sistem

**Untuk Mahasiswa:**
- Melihat riwayat kehadiran lengkap
- Statistik kehadiran per mata kuliah
- Dashboard dengan visualisasi grafik
- Notifikasi peringatan kehadiran
- Profil mahasiswa

**Untuk Dosen:**
- Mencatat kehadiran mahasiswa
- Melihat jadwal mengajar
- Membuat laporan kehadiran
- Mengelola kelas yang diampu
- Dashboard dengan statistik kelas

**Untuk Staf Akademik:**
- Mengelola data mahasiswa dan dosen
- Rekapitulasi kehadiran keseluruhan
- Laporan mahasiswa bermasalah
- Manajemen sistem secara keseluruhan

### Akses Sistem

Sistem dapat diakses melalui web browser dengan alamat:
**http://localhost/absensi_system/frontend/login.html**

Pastikan XAMPP (Apache dan MySQL) sudah berjalan sebelum mengakses sistem.

---

## Panduan untuk Mahasiswa

### Login ke Sistem

1. **Buka halaman login** di browser Anda
2. **Pilih "Mahasiswa"** dari dropdown "Masuk Sebagai"
3. **Masukkan email** mahasiswa Anda (contoh: ahmad.rizki@student.unu.ac.id)
4. **Masukkan password** (untuk demo, gunakan email yang sama sebagai password)
5. **Klik tombol "Masuk"**

Setelah login berhasil, Anda akan diarahkan ke dashboard mahasiswa.

### Menggunakan Dashboard

Dashboard mahasiswa menampilkan informasi penting tentang kehadiran Anda:

**Statistik Kehadiran:**
- Total Hadir: Jumlah kehadiran Anda secara keseluruhan
- Tidak Hadir: Jumlah ketidakhadiran
- Persentase Kehadiran: Persentase kehadiran keseluruhan
- Total Mata Kuliah: Jumlah mata kuliah yang Anda ambil

**Grafik Kehadiran:**
Dashboard menampilkan grafik batang yang menunjukkan perbandingan kehadiran dan ketidakhadiran per mata kuliah. Grafik ini membantu Anda memahami pola kehadiran dengan visual yang mudah dipahami.

**Panel Peringatan:**
Sistem akan menampilkan peringatan jika persentase kehadiran Anda kurang dari 75% pada mata kuliah tertentu. Peringatan ini penting untuk memastikan Anda memenuhi syarat kehadiran minimum.

### Melihat Riwayat Absensi

1. **Klik menu "Riwayat Absensi"** di sidebar
2. **Tabel riwayat** akan menampilkan:
   - Tanggal perkuliahan
   - Nama mata kuliah
   - Nama dosen pengampu
   - Waktu masuk dan keluar
   - Status kehadiran (Hadir/Tidak Hadir/Izin/Sakit)
   - Keterangan tambahan

Data riwayat diurutkan berdasarkan tanggal terbaru, sehingga Anda dapat melihat kehadiran terkini di bagian atas tabel.

### Melihat Statistik Kehadiran

1. **Klik menu "Statistik"** di sidebar
2. **Tabel statistik** menampilkan data per mata kuliah:
   - Nama mata kuliah dan kelas
   - Total pertemuan yang sudah dilaksanakan
   - Jumlah kehadiran berdasarkan status
   - Persentase kehadiran dengan progress bar berwarna

**Interpretasi Warna Progress Bar:**
- Hijau: Kehadiran ≥ 75% (Baik)
- Kuning: Kehadiran 50-74% (Perlu Perhatian)
- Merah: Kehadiran < 50% (Bermasalah)

### Mengelola Profil

1. **Klik menu "Profil"** di sidebar
2. **Informasi profil** yang ditampilkan:
   - ID Mahasiswa
   - Nama lengkap
   - Jurusan
   - Angkatan
   - Email
   - Nomor telepon

Saat ini profil bersifat read-only. Untuk mengubah data profil, hubungi staf akademik.

### Tips untuk Mahasiswa

**Memantau Kehadiran Secara Rutin:**
- Periksa dashboard secara berkala untuk memantau persentase kehadiran
- Perhatikan peringatan yang muncul di panel peringatan
- Gunakan statistik per mata kuliah untuk fokus pada mata kuliah yang persentase kehadirannya rendah

**Komunikasi dengan Dosen:**
- Jika ada ketidaksesuaian data absensi, segera hubungi dosen pengampu
- Sampaikan alasan ketidakhadiran kepada dosen untuk pencatatan yang akurat

---

## Panduan untuk Dosen

### Login ke Sistem

1. **Buka halaman login** di browser
2. **Pilih "Dosen"** dari dropdown "Masuk Sebagai"
3. **Masukkan email** dosen (contoh: ahmad.fauzi@unu.ac.id)
4. **Masukkan password** (untuk demo, gunakan email yang sama sebagai password)
5. **Klik tombol "Masuk"**

### Menggunakan Dashboard Dosen

Dashboard dosen memberikan overview lengkap tentang aktivitas mengajar:

**Statistik Utama:**
- Total Kelas: Jumlah kelas yang Anda ampu
- Total Mahasiswa: Jumlah mahasiswa di semua kelas
- Total Pertemuan: Jumlah pertemuan yang sudah dilaksanakan
- Mahasiswa Bermasalah: Jumlah mahasiswa dengan kehadiran rendah

**Jadwal Hari Ini:**
Panel ini menampilkan jadwal mengajar Anda untuk hari ini, termasuk waktu, mata kuliah, kelas, dan ruangan.

### Mengelola Kelas

1. **Klik menu "Kelas Saya"** di sidebar
2. **Tabel kelas** menampilkan:
   - Kode kelas
   - Nama mata kuliah
   - Nama kelas
   - Jumlah SKS
   - Tahun akademik
   - Tombol aksi untuk melihat detail

Dari halaman ini, Anda dapat melihat semua kelas yang diampu dan mengakses detail masing-masing kelas.

### Mencatat Absensi Mahasiswa

#### Membuat Absensi Baru

1. **Klik menu "Kelola Absensi"** di sidebar
2. **Klik tombol "Buat Absensi Baru"**
3. **Isi form absensi:**
   - Pilih kelas dari dropdown
   - Pilih tanggal perkuliahan
4. **Setelah memilih kelas**, daftar mahasiswa akan muncul
5. **Untuk setiap mahasiswa, atur:**
   - Waktu masuk (otomatis terisi waktu saat ini)
   - Status kehadiran (Hadir/Tidak Hadir/Izin/Sakit)
   - Keterangan tambahan jika diperlukan
6. **Klik "Simpan Absensi"** untuk menyimpan data

#### Melihat Data Absensi Existing

1. **Pilih kelas** dari dropdown filter
2. **Pilih tanggal** yang ingin dilihat
3. **Klik tombol "Cari"**
4. **Tabel absensi** akan menampilkan data mahasiswa untuk tanggal tersebut

### Membuat Laporan Kehadiran

1. **Klik menu "Laporan"** di sidebar
2. **Pilih kelas** dari dropdown
3. **Klik "Generate Laporan"**
4. **Laporan akan menampilkan:**
   - Informasi kelas (mata kuliah, dosen, kelas)
   - Statistik kehadiran keseluruhan
   - Persentase kehadiran rata-rata

### Tips untuk Dosen

**Pencatatan Absensi yang Efektif:**
- Catat absensi segera setelah perkuliahan dimulai
- Pastikan status kehadiran sesuai dengan kondisi sebenarnya
- Berikan keterangan yang jelas untuk mahasiswa yang tidak hadir
- Periksa kembali data sebelum menyimpan

**Monitoring Mahasiswa:**
- Gunakan laporan untuk mengidentifikasi mahasiswa dengan kehadiran rendah
- Berikan perhatian khusus pada mahasiswa yang sering tidak hadir
- Komunikasikan dengan mahasiswa tentang pentingnya kehadiran

**Manajemen Waktu:**
- Manfaatkan fitur jadwal hari ini untuk perencanaan
- Siapkan data absensi sebelum perkuliahan dimulai
- Gunakan waktu masuk otomatis untuk efisiensi

---

## Panduan untuk Staf Akademik

### Login ke Sistem

1. **Buka halaman login** di browser
2. **Pilih "Staf Akademik"** dari dropdown "Masuk Sebagai"
3. **Masukkan username:** admin
4. **Masukkan password:** admin123
5. **Klik tombol "Masuk"**

### Dashboard Staf Akademik

Dashboard staf akademik memberikan overview menyeluruh tentang sistem absensi di tingkat fakultas atau universitas.

**Statistik Keseluruhan:**
- Total mahasiswa terdaftar
- Total dosen aktif
- Total kelas yang berjalan
- Persentase kehadiran rata-rata

**Monitoring Real-time:**
- Jumlah absensi hari ini
- Mahasiswa yang bermasalah
- Dosen yang belum melakukan absensi
- Alert sistem

### Mengelola Data Mahasiswa

#### Menambah Mahasiswa Baru

1. **Akses menu "Manajemen Mahasiswa"**
2. **Klik "Tambah Mahasiswa"**
3. **Isi form dengan data:**
   - ID Mahasiswa (unik)
   - Nama lengkap
   - Jurusan
   - Angkatan
   - Email
   - Nomor telepon
4. **Klik "Simpan"**

#### Mengedit Data Mahasiswa

1. **Cari mahasiswa** di tabel data
2. **Klik tombol "Edit"**
3. **Ubah data** yang diperlukan
4. **Klik "Update"** untuk menyimpan perubahan

### Mengelola Data Dosen

Proses pengelolaan data dosen serupa dengan mahasiswa:

1. **Akses menu "Manajemen Dosen"**
2. **Tambah/Edit/Hapus** data dosen sesuai kebutuhan
3. **Pastikan email dosen** unik untuk keperluan login

### Rekapitulasi dan Laporan

#### Laporan Kehadiran Keseluruhan

1. **Akses menu "Laporan Keseluruhan"**
2. **Pilih periode** (semester/tahun akademik)
3. **Pilih filter** (jurusan, angkatan, dll.)
4. **Generate laporan** dalam format yang diinginkan

#### Identifikasi Mahasiswa Bermasalah

1. **Akses menu "Mahasiswa Bermasalah"**
2. **Sistem akan menampilkan** mahasiswa dengan:
   - Kehadiran < 75%
   - Sering tidak hadir tanpa keterangan
   - Pola ketidakhadiran yang mengkhawatirkan
3. **Export data** untuk tindak lanjut

### Manajemen Sistem

#### Backup Data

1. **Akses menu "Backup & Restore"**
2. **Pilih jenis backup:**
   - Backup harian otomatis
   - Backup manual
   - Backup per semester
3. **Download file backup** untuk penyimpanan eksternal

#### Konfigurasi Sistem

1. **Akses menu "Pengaturan"**
2. **Konfigurasi parameter:**
   - Batas minimum kehadiran
   - Periode akademik
   - Template notifikasi
   - Pengaturan email

### Tips untuk Staf Akademik

**Monitoring Proaktif:**
- Periksa dashboard setiap hari untuk memantau aktivitas sistem
- Identifikasi tren kehadiran yang menurun
- Koordinasi dengan dosen untuk memastikan konsistensi data

**Manajemen Data:**
- Lakukan backup data secara rutin
- Verifikasi data mahasiswa dan dosen setiap semester
- Update konfigurasi sistem sesuai kebijakan akademik

**Komunikasi:**
- Berikan pelatihan kepada dosen tentang penggunaan sistem
- Sosialisasikan kepada mahasiswa tentang pentingnya kehadiran
- Koordinasi dengan bagian akademik untuk tindak lanjut mahasiswa bermasalah

---

## FAQ (Frequently Asked Questions)

### Pertanyaan Umum

**Q: Bagaimana cara mengakses sistem?**
A: Buka browser dan akses http://localhost/absensi_system/frontend/login.html. Pastikan XAMPP sudah berjalan.

**Q: Lupa password, bagaimana cara reset?**
A: Untuk demo, password sama dengan email. Untuk implementasi production, hubungi staf akademik untuk reset password.

**Q: Sistem tidak bisa diakses, apa yang harus dilakukan?**
A: Pastikan XAMPP (Apache dan MySQL) sudah berjalan. Cek juga koneksi internet dan path URL.

### Pertanyaan Mahasiswa

**Q: Data absensi saya tidak sesuai, bagaimana cara mengajukan koreksi?**
A: Hubungi dosen pengampu mata kuliah untuk verifikasi dan koreksi data absensi.

**Q: Mengapa persentase kehadiran saya rendah?**
A: Periksa riwayat absensi untuk melihat detail ketidakhadiran. Pastikan Anda hadir tepat waktu dan komunikasikan dengan dosen jika ada kendala.

**Q: Bisakah melihat jadwal kuliah di sistem?**
A: Saat ini sistem fokus pada absensi. Untuk jadwal kuliah, gunakan sistem akademik utama.

### Pertanyaan Dosen

**Q: Bagaimana cara mengoreksi data absensi yang salah?**
A: Gunakan fitur edit di menu "Kelola Absensi" untuk mengubah status atau keterangan mahasiswa.

**Q: Bisakah mencatat absensi untuk pertemuan yang sudah lewat?**
A: Ya, pilih tanggal pertemuan yang diinginkan saat membuat absensi baru.

**Q: Bagaimana cara melihat mahasiswa yang sering tidak hadir?**
A: Gunakan fitur laporan untuk melihat statistik kehadiran per mahasiswa dalam kelas Anda.

### Pertanyaan Staf Akademik

**Q: Bagaimana cara backup data sistem?**
A: Gunakan phpMyAdmin untuk export database atau fitur backup yang tersedia di menu admin.

**Q: Bisakah mengintegrasikan dengan sistem akademik lain?**
A: Ya, sistem dirancang dengan API yang dapat diintegrasikan dengan sistem lain.

**Q: Bagaimana cara menambah semester baru?**
A: Akses menu manajemen semester dan tambahkan data semester baru dengan periode yang sesuai.

---

## Troubleshooting

### Masalah Login

**Masalah: Tidak bisa login**
- **Solusi 1:** Pastikan tipe user sudah dipilih dengan benar
- **Solusi 2:** Cek email dan password (untuk demo, password = email)
- **Solusi 3:** Pastikan database sudah terisi data user

**Masalah: Redirect tidak berfungsi setelah login**
- **Solusi:** Cek console browser untuk error JavaScript
- **Solusi:** Pastikan file dashboard tersedia di folder frontend

### Masalah Database

**Masalah: Error koneksi database**
- **Solusi 1:** Pastikan MySQL service berjalan di XAMPP
- **Solusi 2:** Cek konfigurasi di file `backend/config/database.php`
- **Solusi 3:** Pastikan database `absensi_mahasiswa` sudah dibuat

**Masalah: Data tidak muncul**
- **Solusi 1:** Pastikan tabel sudah dibuat dengan menjalankan `absensi_db.sql`
- **Solusi 2:** Insert data sample dengan menjalankan `sample_data.sql`
- **Solusi 3:** Cek log error di console browser

### Masalah API

**Masalah: API tidak merespons**
- **Solusi 1:** Pastikan Apache service berjalan
- **Solusi 2:** Cek path API di konfigurasi frontend
- **Solusi 3:** Test API endpoint langsung di browser

**Masalah: CORS Error**
- **Solusi:** Pastikan header CORS sudah diset di file API PHP
- **Solusi:** Gunakan browser yang mendukung CORS

### Masalah Interface

**Masalah: Tampilan tidak responsif**
- **Solusi 1:** Pastikan Bootstrap CSS ter-load dengan benar
- **Solusi 2:** Cek koneksi internet untuk CDN
- **Solusi 3:** Clear cache browser

**Masalah: Grafik tidak muncul**
- **Solusi 1:** Pastikan Chart.js ter-load
- **Solusi 2:** Cek data yang dikirim ke fungsi chart
- **Solusi 3:** Periksa console untuk error JavaScript

### Masalah Performance

**Masalah: Sistem lambat**
- **Solusi 1:** Optimalkan query database
- **Solusi 2:** Implementasikan pagination untuk data besar
- **Solusi 3:** Gunakan caching untuk data yang sering diakses

**Masalah: Memory limit exceeded**
- **Solusi 1:** Tingkatkan memory limit di php.ini
- **Solusi 2:** Optimasi query untuk mengurangi penggunaan memory
- **Solusi 3:** Implementasikan lazy loading

### Kontak Support

Jika masalah tidak dapat diselesaikan dengan panduan ini:

1. **Dokumentasikan error** yang terjadi (screenshot, pesan error)
2. **Catat langkah** yang dilakukan sebelum error
3. **Hubungi tim IT** dengan informasi lengkap
4. **Sertakan informasi sistem** (browser, OS, versi XAMPP)

---

**Catatan:** Panduan ini dibuat untuk versi demo sistem. Untuk implementasi production, beberapa fitur dan konfigurasi mungkin berbeda. Selalu konsultasikan dengan tim pengembang untuk update dan modifikasi sistem.

