CREATE DATABASE IF NOT EXISTS absensi_mahasiswa;
USE absensi_mahasiswa;

CREATE TABLE IF NOT EXISTS Dosen (
    id_dosen VARCHAR(20) PRIMARY KEY,
    nama_dosen VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Mata_Kuliah (
    kode_mk VARCHAR(10) PRIMARY KEY,
    nama_mk VARCHAR(100) NOT NULL,
    sks INT NOT NULL,
    semester INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Mahasiswa (
    id_mahasiswa VARCHAR(20) PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    angkatan INT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Semester (
    id_semester VARCHAR(10) PRIMARY KEY,
    nama_semester VARCHAR(50) NOT NULL,
    tahun_akademik VARCHAR(20) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS Kelas (
    id_kelas VARCHAR(20) PRIMARY KEY,
    kode_mk VARCHAR(10) NOT NULL,
    id_dosen VARCHAR(20) NOT NULL,
    nama_kelas VARCHAR(50) NOT NULL,
    tahun_akademik VARCHAR(20) NOT NULL,
    FOREIGN KEY (kode_mk) REFERENCES Mata_Kuliah(kode_mk),
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

CREATE TABLE IF NOT EXISTS Absensi (
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

CREATE TABLE IF NOT EXISTS Admin (
    id_admin VARCHAR(20) PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(20)
);
