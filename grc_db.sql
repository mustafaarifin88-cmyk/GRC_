-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2026 at 02:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `area_id` int(11) NOT NULL,
  `tanggal_audit` date NOT NULL,
  `catatan_kebijakan` text DEFAULT NULL,
  `catatan_akses_fisik` text DEFAULT NULL,
  `catatan_cctv` text DEFAULT NULL,
  `temuan_deskripsi` text DEFAULT NULL,
  `temuan_kategori` enum('Pelanggaran Kebijakan','Kelemahan Kontrol','Ketidakpatuhan') NOT NULL,
  `temuan_dampak` enum('Rendah','Sedang','Tinggi') NOT NULL,
  `rekomendasi` text DEFAULT NULL,
  `status` enum('PROSES','APPROVE_KU','APPROVE_SPV','APPROVE_MGR','APPROVE_PT','DITOLAK') DEFAULT 'PROSES',
  `ditolak_oleh` int(11) DEFAULT NULL,
  `alasan_tolak` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_files`
--

CREATE TABLE `audit_files` (
  `id` int(11) NOT NULL,
  `audit_id` int(11) NOT NULL,
  `kategori_file` enum('Kebijakan','Akses Fisik','CCTV','Bukti Lainnya') NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hierarchy`
--

CREATE TABLE `hierarchy` (
  `id` int(11) NOT NULL,
  `atasan_id` int(11) NOT NULL,
  `bawahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hierarchy`
--

INSERT INTO `hierarchy` (`id`, `atasan_id`, `bawahan_id`) VALUES
(1, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE `master_data` (
  `id` int(11) NOT NULL,
  `nama_area` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `nama_area`, `created_at`, `updated_at`) VALUES
(1, 'Gedung IT', '2026-03-02 05:40:25', '2026-03-02 05:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nama_pimpinan` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT 'default_logo.png',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama_perusahaan`, `alamat`, `nama_pimpinan`, `logo`, `updated_at`) VALUES
(1, 'PT. GRC Indonesia', 'Jl. Jenderal Sudirman No. 1, Jakarta', 'Bpk. Direktur Utama', 'default_logo.png', '2026-03-01 09:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT 'default_user.png',
  `level` enum('ADMIN','PIMPINAN TINGGI','MANAGERIAL','SUPERVISOR','KEPALA UNIT','STAFF') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `foto`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$zf6Z8FnV3pohBEPYtXSODugsPLU9F2LsXc75TQEqpX7YSPTCDvHSe', 'Administrator System', 'default_user.png', 'ADMIN', '2026-03-01 09:31:50', '2026-03-01 14:16:52'),
(2, 'staff', '$2y$10$onIXEh7zg5H6S6WXPcckSeuQXRpQx752j6p05BV4u3NvR4VSb1VxW', 'STAFF', 'default_user.png', 'STAFF', '2026-03-02 05:38:10', '2026-03-02 05:38:10'),
(3, 'kepalaunit', '$2y$10$8u2t8pvjg.j.UebcohkKs.ODEfLUwh7jDiyBSdclHsy7uBi5cmvMK', 'Kepala Unit', 'default_user.png', 'KEPALA UNIT', '2026-03-02 05:38:45', '2026-03-02 05:38:45'),
(4, 'supervisor', '$2y$10$Qzqilr6pGCXHyW9P2My4B.tVVJQtuCd4eiV0w.3aH5TD2EA9GC4DS', 'Supervisor', 'default_user.png', 'SUPERVISOR', '2026-03-02 05:39:10', '2026-03-02 05:39:10'),
(5, 'manager', '$2y$10$GbiMp7iGmqW.z191yyEAx.Z9Uth.sJaOG6XKMS5DImIiOI2YwfCwy', 'Manager', 'default_user.png', 'MANAGERIAL', '2026-03-02 05:39:38', '2026-03-02 05:39:38'),
(6, 'pimpinan', '$2y$10$sZYf34G5GFCRrWJfri0uPOCcq.kFiS1opASdoMp40F3Pcv9GLi2MK', 'Mustafa Arifin', 'default_user.png', 'PIMPINAN TINGGI', '2026-03-02 05:40:03', '2026-03-02 05:40:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `area_id` (`area_id`),
  ADD KEY `ditolak_oleh` (`ditolak_oleh`);

--
-- Indexes for table `audit_files`
--
ALTER TABLE `audit_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_id` (`audit_id`);

--
-- Indexes for table `hierarchy`
--
ALTER TABLE `hierarchy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atasan_id` (`atasan_id`),
  ADD KEY `bawahan_id` (`bawahan_id`);

--
-- Indexes for table `master_data`
--
ALTER TABLE `master_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_files`
--
ALTER TABLE `audit_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hierarchy`
--
ALTER TABLE `hierarchy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audit_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `master_data` (`id`),
  ADD CONSTRAINT `audit_ibfk_3` FOREIGN KEY (`ditolak_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `audit_files`
--
ALTER TABLE `audit_files`
  ADD CONSTRAINT `audit_files_ibfk_1` FOREIGN KEY (`audit_id`) REFERENCES `audit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hierarchy`
--
ALTER TABLE `hierarchy`
  ADD CONSTRAINT `hierarchy_ibfk_1` FOREIGN KEY (`atasan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hierarchy_ibfk_2` FOREIGN KEY (`bawahan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
