-- Insert sample data untuk testing sistem absensi

-- Insert sample admin
INSERT INTO Admin (id_admin, nama_admin, email, no_telepon) VALUES
('A001', 'Admin 1', 'admin1@unu.ac.id', '081234567800'),
('A002', 'Admin 2', 'admin2@unu.ac.id', '081234567801'),
('A003', 'Admin 3', 'admin3@unu.ac.id', '081234567802');

-- Insert sample dosen
INSERT INTO Dosen (id_dosen, nama_dosen, email, no_telepon) VALUES
('D001', 'Dr. Ahmad Fauzi', 'ahmad.fauzi@unu.ac.id', '081234567890'),
('D002', 'Ibu Awanis Hidayati', 'awanis.hidayati@unu.ac.id', '081234567891'),
('D003', 'Dr. Budi Raharjo', 'budi.raharjo@unu.ac.id', '081234567892'),
('D004', 'Ibu Sari Dewi', 'sari.dewi@unu.ac.id', '081234567893');

-- Insert sample mata kuliah
INSERT INTO Mata_Kuliah (kode_mk, nama_mk, sks, semester) VALUES
('SI101', 'Pemrograman Web', 3, 3),
('SI102', 'Basis Data', 3, 3),
('SI103', 'Sistem Informasi', 2, 3),
('SI104', 'Algoritma dan Struktur Data', 3, 2),
('SI105', 'Jaringan Komputer', 3, 4);

-- Insert sample mahasiswa
INSERT INTO Mahasiswa (id_mahasiswa, nama_mahasiswa, jurusan, angkatan, email, no_telepon) VALUES
('M001', 'Ahmad Rizki', 'Sistem Informasi', 2022, 'ahmad.rizki@student.unu.ac.id', '081234567892'),
('M002', 'Siti Nurhaliza', 'Sistem Informasi', 2022, 'siti.nurhaliza@student.unu.ac.id', '081234567893'),
('M003', 'Budi Santoso', 'Sistem Informasi', 2022, 'budi.santoso@student.unu.ac.id', '081234567894'),
('M004', 'Dewi Sartika', 'Sistem Informasi', 2022, 'dewi.sartika@student.unu.ac.id', '081234567895'),
('M005', 'Eko Prasetyo', 'Sistem Informasi', 2022, 'eko.prasetyo@student.unu.ac.id', '081234567896'),
('M006', 'Fatimah Zahra', 'Sistem Informasi', 2022, 'fatimah.zahra@student.unu.ac.id', '081234567897'),
('M007', 'Gilang Ramadhan', 'Sistem Informasi', 2022, 'gilang.ramadhan@student.unu.ac.id', '081234567898'),
('M008', 'Hani Safitri', 'Sistem Informasi', 2022, 'hani.safitri@student.unu.ac.id', '081234567899'),
('M009', 'Indra Gunawan', 'Sistem Informasi', 2022, 'indra.gunawan@student.unu.ac.id', '081234567900'),
('M010', 'Joko Widodo', 'Sistem Informasi', 2022, 'joko.widodo@student.unu.ac.id', '081234567901');

-- Insert sample semester
INSERT INTO Semester (id_semester, nama_semester, tahun_akademik, tanggal_mulai, tanggal_selesai) VALUES
('2024-1', 'Ganjil', '2024/2025', '2024-09-01', '2025-01-31'),
('2024-2', 'Genap', '2024/2025', '2025-02-01', '2025-06-30'),
('2023-1', 'Ganjil', '2023/2024', '2023-09-01', '2024-01-31'),
('2023-2', 'Genap', '2023/2024', '2024-02-01', '2024-06-30');

-- Insert sample kelas
INSERT INTO Kelas (id_kelas, kode_mk, id_dosen, nama_kelas, tahun_akademik) VALUES
('SI001', 'SI101', 'D001', 'SI-3A', '2024/2025'),
('SI002', 'SI102', 'D002', 'SI-3A', '2024/2025'),
('SI003', 'SI103', 'D001', 'SI-3A', '2024/2025'),
('SI004', 'SI104', 'D003', 'SI-2A', '2024/2025'),
('SI005', 'SI105', 'D004', 'SI-4A', '2024/2025');

-- Insert sample absensi untuk berbagai pertemuan dan status
-- Pertemuan 1 - SI101 (Pemrograman Web)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI001', 'M001', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M002', '2024-12-01', '08:05:00', '10:00:00', 'Hadir', 'Terlambat 5 menit'),
('SI001', 'M003', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M004', '2024-12-01', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI001', 'M005', '2024-12-01', '08:15:00', '10:00:00', 'Hadir', 'Terlambat 15 menit'),
('SI001', 'M006', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M007', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M008', '2024-12-01', NULL, NULL, 'Sakit', 'Demam tinggi'),
('SI001', 'M009', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M010', '2024-12-01', '08:00:00', '10:00:00', 'Hadir', '');

-- Pertemuan 2 - SI101 (Pemrograman Web)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI001', 'M001', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M002', '2024-12-08', NULL, NULL, 'Sakit', 'Sakit demam'),
('SI001', 'M003', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M004', '2024-12-08', NULL, NULL, 'Izin', 'Keperluan keluarga'),
('SI001', 'M005', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M006', '2024-12-08', '08:10:00', '10:00:00', 'Hadir', 'Terlambat 10 menit'),
('SI001', 'M007', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M008', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M009', '2024-12-08', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI001', 'M010', '2024-12-08', '08:00:00', '10:00:00', 'Hadir', '');

-- Pertemuan 3 - SI101 (Pemrograman Web)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI001', 'M001', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M002', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M003', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M004', '2024-12-15', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI001', 'M005', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M006', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M007', '2024-12-15', NULL, NULL, 'Izin', 'Acara keluarga'),
('SI001', 'M008', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M009', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', ''),
('SI001', 'M010', '2024-12-15', '08:00:00', '10:00:00', 'Hadir', '');

-- Pertemuan 1 - SI102 (Basis Data)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI002', 'M001', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M002', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M003', '2024-12-02', '10:35:00', '12:30:00', 'Hadir', 'Terlambat 5 menit'),
('SI002', 'M004', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M005', '2024-12-02', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI002', 'M006', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M007', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M008', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M009', '2024-12-02', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M010', '2024-12-02', NULL, NULL, 'Sakit', 'Flu');

-- Pertemuan 2 - SI102 (Basis Data)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI002', 'M001', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M002', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M003', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M004', '2024-12-09', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI002', 'M005', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M006', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M007', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M008', '2024-12-09', NULL, NULL, 'Izin', 'Keperluan keluarga'),
('SI002', 'M009', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', ''),
('SI002', 'M010', '2024-12-09', '10:30:00', '12:30:00', 'Hadir', '');

-- Pertemuan 1 - SI103 (Sistem Informasi)
INSERT INTO Absensi (id_kelas, id_mahasiswa, tanggal, waktu_masuk, waktu_keluar, status, keterangan) VALUES
('SI003', 'M001', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M002', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M003', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M004', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M005', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M006', '2024-12-03', NULL, NULL, 'Tidak Hadir', 'Tanpa keterangan'),
('SI003', 'M007', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M008', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M009', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', ''),
('SI003', 'M010', '2024-12-03', '13:00:00', '15:00:00', 'Hadir', '');

