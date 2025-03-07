CREATE DATABASE SeadoosafariSamosir;
USE SeadoosafariSamosir;

-- Tabel User
CREATE TABLE USER (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM ('admin', 'pengunjung'),
    email VARCHAR(100),
    telepon VARCHAR(15)
);

-- Tabel Booking
CREATE TABLE Booking (
    id_booking INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    nama_customer VARCHAR(100),
    no_telepon VARCHAR(15),
    waktu_mulai DATETIME,
    waktu_selesai DATETIME,
    jumlah_penumpang INT,
    total_harga DECIMAL(10,2),
    status_pemesanan VARCHAR(20),
    metode_pembayaran VARCHAR(50),
    FOREIGN KEY (id_user) REFERENCES USER(id_user)
);

-- Tabel Notifikasi
CREATE TABLE Notifikasi (
    id_notifikasi INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    deskripsi TEXT,
    FOREIGN KEY (id_user) REFERENCES USER(id_user)
);

-- Tabel Paket
CREATE TABLE Paket (
    id_pilih_paket INT AUTO_INCREMENT PRIMARY KEY,
    nama_paket VARCHAR(100),
    deskripsi TEXT,
    harga DECIMAL(10,2),
    stok INT CHECK (stok >= 0 AND stok <= 100)
);
-- Tabel Detail_Paket
CREATE TABLE Detail_Paket (
    id_detail_paket INT AUTO_INCREMENT PRIMARY KEY,
    id_pilih_paket INT,
    foto VARCHAR(255),
    jumlah_penumpang INT CHECK (jumlah_penumpang >= 0 AND jumlah_penumpang <= 2),
    deskripsi TEXT,
    ulasan TEXT,
    FOREIGN KEY (id_pilih_paket) REFERENCES Paket(id_pilih_paket)
);

-- Tabel Pemesanan_Harian
CREATE TABLE Pemesanan_Harian (
    id_pemesanan_harian INT AUTO_INCREMENT PRIMARY KEY,
    id_booking INT,
    tanggal DATE,
    slot_booking VARCHAR(50),
    FOREIGN KEY (id_booking) REFERENCES Booking(id_booking)
);

-- Tabel Rating
CREATE TABLE Rating (
    id_rating INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_booking INT,
    rating INT,
    komen TEXT,
    FOREIGN KEY (id_user) REFERENCES USER(id_user),
    FOREIGN KEY (id_booking) REFERENCES Booking(id_booking)
);



-- insert data

-- Insert data ke tabel User
INSERT INTO USER (username, PASSWORD, ROLE, email, telepon)
VALUES
('admin1', 'admin123', 'admin', 'admin1@seadoosafari.com', '081234567890'),
('melva', 'melva6', 'pengunjung', 'melva@gmail.com', '089876543210');

-- Insert data ke tabel Paket
INSERT INTO Paket (nama_paket, deskripsi, harga, stok)
VALUES
('Paket sibea-bea', 'Menikmati matahari terbit di Danau Toba', 500000.00, 12),
('Paket batu gantung', 'Menikmati matahari terbenam di Danau Toba', 700000.00, 5);

-- Insert data ke tabel Detail_Paket
INSERT INTO Detail_Paket (id_pilih_paket, foto, jumlah_penumpang, deskripsi, ulasan)
VALUES
(1, 'batugantung.jpg', 2, 'Paket romantis untuk dua orang', 'Pemandangannya luar biasa!'),
(2, 'sibeabea.jpg', 2, 'Paket santai menikmati senja', 'Sangat memuaskan!');

-- Insert data ke tabel Booking
INSERT INTO Booking (id_user, nama_customer, no_telepon, waktu_mulai, waktu_selesai, jumlah_penumpang, total_harga, status_pemesanan)
VALUES
(2, 'Budi Santoso', '081234567890', '2025-03-15 05:00:00', '2025-03-15 07:00:00', 2, 500000.00, 'pending'),
(2, 'Siti Aminah', '089876543210', '2025-03-16 17:00:00', '2025-03-16 19:00:00', 2, 700000.00, 'sukses');

-- Insert data ke tabel Pemesanan_Harian
INSERT INTO Pemesanan_Harian (id_booking, tanggal, slot_booking)
VALUES
(1, '2025-03-15', 'pagi'),
(2, '2025-03-16', 'malam');

-- Insert data ke tabel Notifikasi
INSERT INTO Notifikasi (id_user, deskripsi)
VALUES
(2, 'Pemesanan Anda sedang diproses'),
(2, 'Pemesanan Anda telah sukses');

-- Insert data ke tabel Rating
INSERT INTO Rating (id_user, id_booking, rating, komen)
VALUES
(2, 2, 5, 'Layanan sangat memuaskan!'),
(2, 1, 4, 'Pemandangan indah, tapi sedikit terlambat');
