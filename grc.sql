-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2026 at 01:39 PM
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
-- Database: `grc`
--

-- --------------------------------------------------------

--
-- Table structure for table `da_audit_bond`
--

CREATE TABLE `da_audit_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `informasi_audit` varchar(255) DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  `tanggal_audit` date NOT NULL,
  `item_1_ceklis` varchar(50) DEFAULT NULL,
  `item_1_file` text DEFAULT NULL,
  `item_1_catatan` text DEFAULT NULL,
  `item_2_ceklis` varchar(50) DEFAULT NULL,
  `item_2_file` text DEFAULT NULL,
  `item_2_catatan` text DEFAULT NULL,
  `item_3_ceklis` varchar(50) DEFAULT NULL,
  `item_3_file` text DEFAULT NULL,
  `item_3_catatan` text DEFAULT NULL,
  `temuan_deskripsi` text DEFAULT NULL,
  `temuan_kategori` enum('Pelanggaran Kebijakan','Kelemahan Kontrol','Ketidakpatuhan') DEFAULT NULL,
  `temuan_dampak` enum('Rendah','Sedang','Tinggi') DEFAULT NULL,
  `temuan_rekomendasi` text DEFAULT NULL,
  `temuan_bukti` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_compliance_bond`
--

CREATE TABLE `da_compliance_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `informasi_penilaian` varchar(255) DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  `periode_penilaian` enum('Bulanan','Kuartalan','Tahunan') DEFAULT NULL,
  `tanggal_penilaian` date NOT NULL,
  `item_1_ceklis` enum('Memenuhi','Tidak Memenuhi','Sebagian') DEFAULT NULL,
  `item_1_file` text DEFAULT NULL,
  `item_1_catatan` text DEFAULT NULL,
  `item_2_ceklis` enum('Memenuhi','Tidak Memenuhi','Sebagian') DEFAULT NULL,
  `item_2_file` text DEFAULT NULL,
  `item_2_catatan` text DEFAULT NULL,
  `item_3_ceklis` enum('Memenuhi','Tidak Memenuhi','Sebagian') DEFAULT NULL,
  `item_3_file` text DEFAULT NULL,
  `item_3_catatan` text DEFAULT NULL,
  `celah_deskripsi` text DEFAULT NULL,
  `celah_dampak` enum('Rendah','Sedang','Tinggi') DEFAULT NULL,
  `celah_rekomendasi` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_formulir_insiden`
--

CREATE TABLE `da_formulir_insiden` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `informasi_pelaporan` varchar(255) DEFAULT NULL,
  `tanggal_waktu_kejadian` datetime NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `deskripsi_kejadian` text DEFAULT NULL,
  `jenis_insiden` enum('Keamanan','Operasional','Lingkungan','Lain-lain') DEFAULT NULL,
  `dampak` enum('Rendah','Sedang','Tinggi') DEFAULT NULL,
  `pihak_terlibat` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran_bukti` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_risk_bond`
--

CREATE TABLE `da_risk_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `informasi_risiko` varchar(255) DEFAULT NULL,
  `deskripsi_risiko` text DEFAULT NULL,
  `kategori_risiko` enum('Operasional','Keuangan','Reputasi','Kepatuhan') DEFAULT NULL,
  `tanggal_penilaian` date NOT NULL,
  `penyebab` text DEFAULT NULL,
  `dampak` text DEFAULT NULL,
  `kemungkinan_terjadi` enum('Sangat Rendah','Rendah','Sedang','Tinggi','Sangat Tinggi') DEFAULT NULL,
  `metode_penilaian` enum('Kualitatif','Kuantitatif') DEFAULT NULL,
  `skala_penilaian` enum('1-5','1-10') DEFAULT NULL,
  `nilai_risiko` decimal(10,2) DEFAULT NULL,
  `tingkat_risiko` enum('Rendah','Sedang','Tinggi') DEFAULT NULL,
  `mitigasi_sudah` text DEFAULT NULL,
  `mitigasi_rekomendasi` text DEFAULT NULL,
  `mitigasi_bukti` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_audit_bond`
--

CREATE TABLE `igrc_audit_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_lisensi` varchar(100) DEFAULT NULL,
  `organisasi` varchar(255) DEFAULT NULL,
  `tgl_penugasan` date DEFAULT NULL,
  `jadwal_audit_tahunan` varchar(255) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `tujuan_audit` text DEFAULT NULL,
  `hasil_audit_lapangan` text DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `item_1_ceklis` varchar(50) DEFAULT NULL,
  `item_1_file` text DEFAULT NULL,
  `item_1_catatan` text DEFAULT NULL,
  `item_2_ceklis` varchar(50) DEFAULT NULL,
  `item_2_file` text DEFAULT NULL,
  `item_2_catatan` text DEFAULT NULL,
  `item_3_ceklis` varchar(50) DEFAULT NULL,
  `item_3_file` text DEFAULT NULL,
  `item_3_catatan` text DEFAULT NULL,
  `temuan_deskripsi` text DEFAULT NULL,
  `temuan_kategori` varchar(100) DEFAULT NULL,
  `temuan_dampak` varchar(100) DEFAULT NULL,
  `temuan_bukti` text DEFAULT NULL,
  `rtl_akar_masalah` text DEFAULT NULL,
  `rtl_tindakan` text DEFAULT NULL,
  `rtl_pj` varchar(255) DEFAULT NULL,
  `rtl_jadwal` date DEFAULT NULL,
  `rtl_status` enum('Belum Dimulai','Dalam Proses','Selesai') DEFAULT NULL,
  `rtl_tgl_pelaksanaan` date DEFAULT NULL,
  `rtl_deskripsi` text DEFAULT NULL,
  `rtl_dokumen` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_compliance_bond`
--

CREATE TABLE `igrc_compliance_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_peraturan` varchar(255) DEFAULT NULL,
  `no_peraturan` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` enum('Hukum','Industri','Internal') DEFAULT NULL,
  `kebijakan_nama` varchar(255) DEFAULT NULL,
  `kebijakan_no` varchar(100) DEFAULT NULL,
  `kebijakan_tgl_terbit` date DEFAULT NULL,
  `kebijakan_tgl_efektif` date DEFAULT NULL,
  `kebijakan_file` text DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `periode_penilaian` varchar(100) DEFAULT NULL,
  `status_kepatuhan` enum('Memenuhi','Tidak Memenuhi','Sebagian') DEFAULT NULL,
  `kepatuhan_bukti` text DEFAULT NULL,
  `kepatuhan_catatan` text DEFAULT NULL,
  `celah_tindakan` text DEFAULT NULL,
  `celah_jadwal` date DEFAULT NULL,
  `celah_status` enum('Belum Dimulai','Dalam Proses','Selesai') DEFAULT NULL,
  `bk_tgl` date DEFAULT NULL,
  `bk_deskripsi` text DEFAULT NULL,
  `bk_dokumen` text DEFAULT NULL,
  `bk_tindakan_darurat` text DEFAULT NULL,
  `bk_lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_continuity_bond`
--

CREATE TABLE `igrc_continuity_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bia_proses` text DEFAULT NULL,
  `bia_dampak_keuangan` text DEFAULT NULL,
  `bia_dampak_operasional` text DEFAULT NULL,
  `bia_rto` varchar(100) DEFAULT NULL,
  `bia_rpo` varchar(100) DEFAULT NULL,
  `drp_lokasi` varchar(255) DEFAULT NULL,
  `drp_prosedur` text DEFAULT NULL,
  `drp_tim` text DEFAULT NULL,
  `drp_kontak` text DEFAULT NULL,
  `bcp_strategi` text DEFAULT NULL,
  `bcp_prosedur` text DEFAULT NULL,
  `bcp_tim` text DEFAULT NULL,
  `uji_tgl` date DEFAULT NULL,
  `uji_skenario` text DEFAULT NULL,
  `uji_hasil` text DEFAULT NULL,
  `uji_perbaikan` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_control_bond`
--

CREATE TABLE `igrc_control_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_kontrol` varchar(255) DEFAULT NULL,
  `tujuan_kontrol` text DEFAULT NULL,
  `jenis_kontrol` enum('Preventif','Detektif','Korektif') DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `nilai_metode` varchar(255) DEFAULT NULL,
  `nilai_frekuensi` varchar(255) DEFAULT NULL,
  `nilai_hasil` text DEFAULT NULL,
  `nilai_bukti` text DEFAULT NULL,
  `perbaikan_tindakan` text DEFAULT NULL,
  `perbaikan_pj` varchar(255) DEFAULT NULL,
  `perbaikan_jadwal` date DEFAULT NULL,
  `pantau_kci` text DEFAULT NULL,
  `pantau_ambang` varchar(255) DEFAULT NULL,
  `pantau_frekuensi` varchar(255) DEFAULT NULL,
  `pantau_hasil` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_cyber_bond`
--

CREATE TABLE `igrc_cyber_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aset` varchar(255) DEFAULT NULL,
  `ancaman` text DEFAULT NULL,
  `kerentanan` text DEFAULT NULL,
  `dampak` varchar(100) DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `kontrol_jenis` enum('Teknis','Administratif','Fisik') DEFAULT NULL,
  `kontrol_deskripsi` text DEFAULT NULL,
  `pantau_log` text DEFAULT NULL,
  `pantau_deteksi` text DEFAULT NULL,
  `pantau_analisis` text DEFAULT NULL,
  `pantau_uji` text DEFAULT NULL,
  `insiden_jenis` varchar(255) DEFAULT NULL,
  `insiden_target` varchar(255) DEFAULT NULL,
  `insiden_dampak` varchar(100) DEFAULT NULL,
  `insiden_penanganan` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_fraud_bond`
--

CREATE TABLE `igrc_fraud_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tgl_pelaporan` date DEFAULT NULL,
  `pelapor` enum('Anonim','Identitas Terungkap') DEFAULT NULL,
  `pihak_diduga` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `nilai_kerugian` decimal(15,2) DEFAULT NULL,
  `tindakan_korektif` text DEFAULT NULL,
  `tindakan_disiplin` text DEFAULT NULL,
  `tuntutan_hukum` text DEFAULT NULL,
  `perbaikan_sistem` text DEFAULT NULL,
  `peningkatan_kontrol` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_incident_bond`
--

CREATE TABLE `igrc_incident_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tgl_waktu` datetime DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `dampak` varchar(100) DEFAULT NULL,
  `pihak_terlibat` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `rca_metode` varchar(255) DEFAULT NULL,
  `rca_faktor_penyebab` text DEFAULT NULL,
  `rca_faktor_kontributor` text DEFAULT NULL,
  `tp_pendek` text DEFAULT NULL,
  `tp_panjang` text DEFAULT NULL,
  `tp_pj` varchar(255) DEFAULT NULL,
  `pemulihan_langkah` text DEFAULT NULL,
  `pemulihan_biaya` decimal(15,2) DEFAULT NULL,
  `pemulihan_waktu` varchar(255) DEFAULT NULL,
  `pemulihan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_risk_bond`
--

CREATE TABLE `igrc_risk_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `penyebab` text DEFAULT NULL,
  `dampak` text DEFAULT NULL,
  `kemungkinan` varchar(100) DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `periode_penilaian` varchar(100) DEFAULT NULL,
  `metode_penilaian` enum('Kualitatif','Kuantitatif') DEFAULT NULL,
  `nilai_risiko` decimal(10,2) DEFAULT NULL,
  `mitigasi_tindakan` text DEFAULT NULL,
  `mitigasi_pj` varchar(255) DEFAULT NULL,
  `mitigasi_jadwal` date DEFAULT NULL,
  `mitigasi_biaya` decimal(15,2) DEFAULT NULL,
  `pantau_kri` text DEFAULT NULL,
  `pantau_ambang` text DEFAULT NULL,
  `pantau_frekuensi` varchar(100) DEFAULT NULL,
  `pantau_hasil` text DEFAULT NULL,
  `pantau_tindakan` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igrc_third_party_bond`
--

CREATE TABLE `igrc_third_party_bond` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `jenis_layanan` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `risiko_jenis` enum('Operasional','Keuangan','Reputasi','Kepatuhan') DEFAULT NULL,
  `risiko_tingkat` varchar(100) DEFAULT NULL,
  `due_diligence` text DEFAULT NULL,
  `klausul_keamanan` text DEFAULT NULL,
  `klausul_kepatuhan` text DEFAULT NULL,
  `klausul_audit` text DEFAULT NULL,
  `pantau_kpi` text DEFAULT NULL,
  `pantau_laporan` text DEFAULT NULL,
  `pantau_audit` text DEFAULT NULL,
  `pantau_review` text DEFAULT NULL,
  `tindakan_darurat` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('proses','approve_ku','approve_spv','approve_mgr','approve_pt','ditolak') DEFAULT 'proses',
  `alasan_tolak` text DEFAULT NULL,
  `penolak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_company_profile`
--

CREATE TABLE `tb_company_profile` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nama_pimpinan` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT 'default-logo.png',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_company_profile`
--

INSERT INTO `tb_company_profile` (`id`, `nama_perusahaan`, `alamat`, `nama_pimpinan`, `logo`, `updated_at`) VALUES
(1, 'PT. GRC Indonesia', 'Jl. Sudirman No. 1, Jakarta', 'Bapak Direktur Utama', 'default-logo.png', '2026-03-02 03:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_area`
--

CREATE TABLE `tb_master_area` (
  `id` int(11) NOT NULL,
  `nama_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_lokasi`
--

CREATE TABLE `tb_master_lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `level` enum('ADMIN','PIMPINAN TINGGI','MANAGERIAL','SUPERVISOR','KEPALA UNIT','STAFF') NOT NULL,
  `foto` varchar(255) DEFAULT 'default-profile.png',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`, `nama_lengkap`, `level`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$EgD8ouTFxM4.lHQOBeWPNei0Xdnut8nUzJfsv6yJZ/OToIH7x119C', 'Administrator Utama', 'ADMIN', 'default-profile.png', '2026-03-02 03:21:42', '2026-03-02 04:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_hierarchy`
--

CREATE TABLE `tb_user_hierarchy` (
  `id` int(11) NOT NULL,
  `atasan_id` int(11) NOT NULL,
  `bawahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `da_audit_bond`
--
ALTER TABLE `da_audit_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_compliance_bond`
--
ALTER TABLE `da_compliance_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_formulir_insiden`
--
ALTER TABLE `da_formulir_insiden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_risk_bond`
--
ALTER TABLE `da_risk_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_audit_bond`
--
ALTER TABLE `igrc_audit_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_compliance_bond`
--
ALTER TABLE `igrc_compliance_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_continuity_bond`
--
ALTER TABLE `igrc_continuity_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_control_bond`
--
ALTER TABLE `igrc_control_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_cyber_bond`
--
ALTER TABLE `igrc_cyber_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_fraud_bond`
--
ALTER TABLE `igrc_fraud_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_incident_bond`
--
ALTER TABLE `igrc_incident_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_risk_bond`
--
ALTER TABLE `igrc_risk_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igrc_third_party_bond`
--
ALTER TABLE `igrc_third_party_bond`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_company_profile`
--
ALTER TABLE `tb_company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master_area`
--
ALTER TABLE `tb_master_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master_lokasi`
--
ALTER TABLE `tb_master_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_user_hierarchy`
--
ALTER TABLE `tb_user_hierarchy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bawahan_id` (`bawahan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `da_audit_bond`
--
ALTER TABLE `da_audit_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_compliance_bond`
--
ALTER TABLE `da_compliance_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_formulir_insiden`
--
ALTER TABLE `da_formulir_insiden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_risk_bond`
--
ALTER TABLE `da_risk_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_audit_bond`
--
ALTER TABLE `igrc_audit_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_compliance_bond`
--
ALTER TABLE `igrc_compliance_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_continuity_bond`
--
ALTER TABLE `igrc_continuity_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_control_bond`
--
ALTER TABLE `igrc_control_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_cyber_bond`
--
ALTER TABLE `igrc_cyber_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_fraud_bond`
--
ALTER TABLE `igrc_fraud_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_incident_bond`
--
ALTER TABLE `igrc_incident_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_risk_bond`
--
ALTER TABLE `igrc_risk_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igrc_third_party_bond`
--
ALTER TABLE `igrc_third_party_bond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_company_profile`
--
ALTER TABLE `tb_company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_master_area`
--
ALTER TABLE `tb_master_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_master_lokasi`
--
ALTER TABLE `tb_master_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user_hierarchy`
--
ALTER TABLE `tb_user_hierarchy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
