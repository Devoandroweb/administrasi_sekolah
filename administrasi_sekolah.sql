-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 06:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administrasi_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrasi`
--

CREATE TABLE `administrasi` (
  `id_administrasi` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_jenis_administrasi` int(11) DEFAULT NULL,
  `nominal` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ini juga di sebut biaya siswa';

--
-- Dumping data for table `administrasi`
--

INSERT INTO `administrasi` (`id_administrasi`, `id_siswa`, `id_jenis_administrasi`, `nominal`) VALUES
(4, 13, 1, 0),
(5, 13, 3, 0),
(6, 14, 1, 0),
(7, 14, 3, 0),
(8, 15, 1, 110000),
(9, 15, 3, 800000),
(10, 15, 5, 800000),
(11, 16, 1, 110000),
(12, 16, 3, 800000),
(13, 16, 5, 800000),
(14, 17, 1, 110000),
(15, 17, 3, 800000),
(16, 17, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `h_transaksi`
--

CREATE TABLE `h_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode` varchar(150) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `id_siswa` int(11) NOT NULL,
  `biaya` text DEFAULT NULL,
  `tunggakan` text DEFAULT NULL,
  `terbayar` bigint(20) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_transaksi`
--

INSERT INTO `h_transaksi` (`id_transaksi`, `kode`, `tanggal`, `id_siswa`, `biaya`, `tunggakan`, `terbayar`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '1', '2022-08-03 16:07:13', 13, '[]', '[{\"nama_biaya\":\"SPP\",\"nominal\":510000},{\"nama_biaya\":\"LKS\",\"nominal\":90000},{\"nama_biaya\":\"SPP\",\"nominal\":300000}]', 900000, '2022-08-03 09:07:13', 1, '2022-08-03 09:07:13', 1),
(2, '2', '2022-08-03 16:50:49', 13, '[]', '[{\"nama_biaya\":\"LKS\",\"nominal\":90000}]', 90000, '2022-08-03 09:50:49', 1, '2022-08-03 09:50:49', 1),
(3, '0', '2022-08-05 12:34:55', 13, '[{\"nama_biaya\":\"SPP\",\"nominal\":77000,\"ajaran\":\"2021 - 2022\"},{\"nama_biaya\":\"LKS\",\"nominal\":500000,\"ajaran\":\"2021 - 2022\"}]', '[{\"nama_biaya\":\"SPP\",\"nominal\":200000,\"ajaran\":\"2020 - 2021\"},{\"nama_biaya\":\"LKS\",\"nominal\":23000,\"ajaran\":\"2020 - 2021\"}]', 0, '2022-08-05 05:34:55', 1, '2022-08-05 05:34:55', 1),
(4, '0', '2022-08-05 12:41:32', 13, '[{\"nama_biaya\":\"SPP\",\"nominal\":77000,\"ajaran\":\"2021 - 2022\"},{\"nama_biaya\":\"LKS\",\"nominal\":500000,\"ajaran\":\"2021 - 2022\"}]', '[{\"nama_biaya\":\"SPP\",\"nominal\":200000,\"ajaran\":\"2020 - 2021\"},{\"nama_biaya\":\"LKS\",\"nominal\":23000,\"ajaran\":\"2020 - 2021\"}]', 0, '2022-08-05 05:41:32', 1, '2022-08-05 05:41:32', 1),
(5, '0', '2022-08-05 13:00:48', 13, '[{\"nama_biaya\":\"SPP\",\"nominal\":77000,\"ajaran\":\"2021 - 2022\"},{\"nama_biaya\":\"LKS\",\"nominal\":500000,\"ajaran\":\"2021 - 2022\"}]', '[{\"nama_biaya\":\"SPP\",\"nominal\":200000,\"ajaran\":\"2020 - 2021\"},{\"nama_biaya\":\"LKS\",\"nominal\":23000,\"ajaran\":\"2020 - 2021\"}]', 0, '2022-08-05 06:00:48', 1, '2022-08-05 06:00:48', 1),
(6, '0', '2022-08-07 18:24:26', 13, '[]', '[{\"nama_biaya\":\"SPP\",\"nominal\":9000,\"ajaran\":\"2019 - 2020\"}]', 0, '2022-08-07 11:24:25', 2, '2022-08-07 11:24:25', 2),
(7, '0', '2022-08-10 10:21:15', 17, '[{\"nama_biaya\":\"LKS3\",\"nominal\":800000,\"ajaran\":\"2021 - 2022\"}]', '[]', 0, '2022-08-10 10:21:15', 1, '2022-08-10 10:21:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_user`
--

CREATE TABLE `h_user` (
  `id_h_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_user`
--

INSERT INTO `h_user` (`id_h_user`, `id_user`, `date_login`) VALUES
(5, 2, '2022-08-08 12:41:01'),
(15, 1, '2022-08-10 09:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `m_ajaran`
--

CREATE TABLE `m_ajaran` (
  `id` int(11) NOT NULL,
  `tahun_awal` varchar(11) DEFAULT NULL,
  `tahun_akhir` varchar(11) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_ajaran`
--

INSERT INTO `m_ajaran` (`id`, `tahun_awal`, `tahun_akhir`, `status`) VALUES
(1, '2021', '2022', 1),
(2, '2019', '2020', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_administrasi`
--

CREATE TABLE `m_jenis_administrasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` bigint(20) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_jenis_administrasi`
--

INSERT INTO `m_jenis_administrasi` (`id`, `nama`, `biaya`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SPP', 110000, 1, 1, 1, '2022-07-29 12:33:58', '2022-07-29 13:50:31'),
(3, 'LKS1', 800000, 1, 1, 1, '2022-07-29 22:42:14', '2022-08-08 17:27:30'),
(5, 'LKS3', 800000, 1, 1, 1, '2022-08-08 17:27:48', '2022-08-08 17:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `m_jurusan`
--

CREATE TABLE `m_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_jurusan`
--

INSERT INTO `m_jurusan` (`id_jurusan`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'IPS', '2022-07-29 13:43:01', 1, '2022-07-29 22:26:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE `m_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id_kelas`, `nama`, `id_jurusan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'I', 1, '2022-07-30 06:45:07', 1, '2022-07-30 01:44:53', 1),
(2, 'II', 1, '2022-08-02 03:31:37', 1, '2022-08-02 03:31:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_saldo`
--

CREATE TABLE `m_saldo` (
  `id` int(11) NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_saldo`
--

INSERT INTO `m_saldo` (`id`, `saldo`) VALUES
(1, 12270000);

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE `m_siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` bigint(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` int(11) NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id_siswa`, `username`, `password`, `nis`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `no_telp`, `alamat`, `foto`, `id_kelas`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', '$2y$10$.ygTYs.fGxglJoLFE1zCQeXPomt44l4TFP.7ogMCYIZeDXEI7Tdr2', 1, 'Fathur', NULL, NULL, 1, '6288861662661', 'raadasdasd', '1659235037_Cristiano_Ronaldo_2018.jpg.jpg', 1, 0, 1, 1, '2022-07-31 02:37:17', '2022-07-31 02:37:17'),
(2, '2', '$2y$10$6gBqmjgsBS53D9XtgGAOV.DPyH2kvnhilu7PpRClypRBndZcoc6o2', 2, 'Fatah', NULL, NULL, 1, '628878876651', 'asdasdasd', NULL, 1, 1, 1, 1, '2022-07-31 02:44:52', '2022-08-09 23:02:40'),
(17, '3', '$2y$10$pSiENOdwYsJqrtzc4aFl6O5t09IjKzGuPg9jKUwIUa4MwRSY3CzLS', 3, 'Fathur', 'Malang', '2022-08-10', 1, '6285608727991', 'Jl. Keramat', NULL, 2, 0, 1, 1, '2022-08-10 10:09:59', '2022-08-10 10:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_whatsapp`
--

CREATE TABLE `m_whatsapp` (
  `id_whatsapp` int(11) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `pesan` text DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL COMMENT '1 : Text\n2 : File',
  `file` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 : Success\n2 : Failed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_whatsapp`
--

INSERT INTO `m_whatsapp` (`id_whatsapp`, `no_telp`, `pesan`, `tipe`, `file`, `created_by`, `created_at`, `updated_at`, `updated_by`, `status`) VALUES
(6, '6288861662661', 'Siswa ini melanggar peraturan', 1, NULL, 1, '2022-08-04 00:57:22', '2022-08-04 00:57:22', 1, 1),
(7, '6285608727991', 'asdasdas', 1, NULL, 1, '2022-08-05 07:18:56', '2022-08-05 07:18:56', 1, 1),
(9, '6288861662661', 'adadadadasd', 1, NULL, 1, '2022-08-05 10:54:10', '2022-08-05 10:54:10', 1, 2),
(10, '6285608727991', 'Terima Kasih,\r\nPembayaran atas nama :\r\n*Fathur* \r\ntelah kami terima.\r\n\r\nDengan detail pembayaran sebagai berikut: \r\n\r\n------------------------------------------------- \r\n\r\n\r\n# Tanggungan Pada Tahun Ajaran 2019 - 2020 # \r\n1. SPP Rp. 9.000 \r\n\r\n# Total #\r\nRp. 9.000 \r\n\r\n# Uang Diterima #\r\nRp. 800.000 \r\n\r\n# Uang Kembalian #\r\nRp. 791.000 \r\n\r\n', 1, NULL, 2, '2022-08-07 11:24:25', '2022-08-07 11:24:25', 2, 2),
(11, '6285608727991', 'Terima Kasih,\r\nPembayaran atas nama :\r\n*Fathur* \r\ntelah kami terima.\r\n\r\nDengan detail pembayaran sebagai berikut: \r\n\r\n------------------------------------------------- \r\n\r\n# Tanggungan Pada Tahun Ajaran 2021 - 2022 # \r\n1. LKS3 Rp. 800.000 \r\n\r\n# Total #\r\nRp. 800.000 \r\n\r\n# Uang Diterima #\r\nRp. 900.000 \r\n\r\n# Uang Kembalian #\r\nRp. 100.000 \r\n\r\n', 1, NULL, 1, '2022-08-10 10:21:15', '2022-08-10 10:21:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendanaan`
--

CREATE TABLE `pendanaan` (
  `id_pemasukan` int(11) NOT NULL,
  `tipe` tinyint(4) DEFAULT NULL COMMENT '1 : Pemasukan\n2 : Pengeluaran',
  `tipe_pemasukan` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 : Siswa\r\n2 : Lain-lain',
  `id_siswa` int(11) DEFAULT 0,
  `nama` varchar(255) DEFAULT NULL COMMENT 'untuk nama dana',
  `detail` text DEFAULT NULL COMMENT 'pemasukan dari siswa atau tipe pemasukan 1 \nformat json :\n[''spp'':10000,...] or [''BOS'':20000000]',
  `total` bigint(20) DEFAULT 0,
  `saldo` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendanaan`
--

INSERT INTO `pendanaan` (`id_pemasukan`, `tipe`, `tipe_pemasukan`, `id_siswa`, `nama`, `detail`, `total`, `saldo`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 13, 'Siswa', '[{\"nama_biaya\":\"SPP\",\"nominal\":90000},{\"nama_biaya\":\"LKS\",\"nominal\":20000}]', 110000, 110000, '2022-07-31 16:57:12', '2022-07-31 11:53:13', 1, 1),
(2, 1, 2, 0, 'BOS', '[{\"nama_biaya\":\"BOS\",\"nominal\":200000}]', 200000, 310000, '2022-07-31 16:57:12', '2022-07-31 11:53:13', 1, 1),
(5, 1, 2, 0, 'Sumbangan', '[{\"nama_biaya\":\"Sumbangan Wali\",\"nominal\":1000000}]', 1000000, 1260000, '2022-08-01 15:30:21', NULL, NULL, NULL),
(6, 1, 2, 0, 'BPOM', '[{\"nama_biaya\":\"BPOM\",\"nominal\":8000000}]', 8000000, 9260000, '2022-08-01 15:49:31', NULL, NULL, NULL),
(7, 1, 2, 0, 'BPOIM', '[{\"nama_biaya\":\"NPM\",\"nominal\":1200000}]', 1200000, 10460000, '2022-08-01 16:05:35', NULL, NULL, NULL),
(8, 2, 0, 0, 'Operional Tukang', '[{\"nama_biaya\":\"Makan\",\"nominal\":90000}]', 90000, 10370000, '2022-08-01 20:34:43', NULL, NULL, NULL),
(9, 1, 1, 14, 'Siswa', '[{\"nama_biaya\":\"SPP\",\"nominal\":30000},{\"nama_biaya\":\"LKS\",\"nominal\":50000}]', 110000, 110000, '2022-07-31 16:57:12', '2022-07-31 11:53:13', 1, 1),
(10, 1, 1, 14, 'Siswa', '[{\"nama_biaya\":\"SPP\",\"nominal\":30000},{\"nama_biaya\":\"LKS\",\"nominal\":50000}]', 80000, 110000, '2022-08-31 16:57:12', '2022-07-31 11:53:13', 1, 1),
(11, 1, 2, 0, 'BOS', '[{\"nama_biaya\":\"NOS\",\"nominal\":1900000}]', 1900000, 12270000, '2022-08-09 00:06:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tunggakan`
--

CREATE TABLE `tunggakan` (
  `id_tunggakan` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama_tunggakan` varchar(150) DEFAULT NULL,
  `nominal` bigint(20) UNSIGNED DEFAULT NULL,
  `ajaran` varchar(20) DEFAULT NULL COMMENT 'untuk tahun ajaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunggakan`
--

INSERT INTO `tunggakan` (`id_tunggakan`, `id_siswa`, `nama_tunggakan`, `nominal`, `ajaran`) VALUES
(3, 13, 'SPP', 0, '2019 - 2020'),
(5, 14, 'BPOM', 0, '2019 - 2020'),
(6, 14, 'BPOM1', 4000, '2019 - 2020');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1 : Admin\n2 : Bendahara\n3 :  Kepala Sekolah',
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', 1, '2022-08-09 16:43:28', '$2y$10$VJk3LuiQ8kS7Gacl3pzUK.q5JMGHwczGiY5FlWJ9J1rn3YdlOvkgK', 0, NULL, '2022-07-29 09:36:27', '2022-07-29 09:36:27'),
(2, 'kepala sekolah', 'kepala_sekolah@mail.com', 3, '2022-08-09 16:43:39', '$2y$10$IKPqoPu53aBmf1MmQKtLPeqXOuOfBWPrMN7f3o2EkGgaDJRYyOEkK', 0, NULL, '2022-07-29 22:59:15', '2022-07-29 22:59:15'),
(4, 'bendahara', 'bendahara@mail.com', 2, '2022-08-09 16:43:44', '$2y$10$az0jfHUNTFgGbF9Z8tW/rO9OyuVViUZeQaxzC4lmB3EYWOdSRPsku', 0, NULL, '2022-08-02 14:04:50', '2022-08-02 14:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_send`
--

CREATE TABLE `whatsapp_send` (
  `id` int(11) NOT NULL,
  `id_whatsapp` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 : Sukses\n2 : Gagal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`id_administrasi`);

--
-- Indexes for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `h_user`
--
ALTER TABLE `h_user`
  ADD PRIMARY KEY (`id_h_user`);

--
-- Indexes for table `m_ajaran`
--
ALTER TABLE `m_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_administrasi`
--
ALTER TABLE `m_jenis_administrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `m_kelas`
--
ALTER TABLE `m_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `m_saldo`
--
ALTER TABLE `m_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_siswa`
--
ALTER TABLE `m_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `m_whatsapp`
--
ALTER TABLE `m_whatsapp`
  ADD PRIMARY KEY (`id_whatsapp`);

--
-- Indexes for table `pendanaan`
--
ALTER TABLE `pendanaan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indexes for table `tunggakan`
--
ALTER TABLE `tunggakan`
  ADD PRIMARY KEY (`id_tunggakan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_send`
--
ALTER TABLE `whatsapp_send`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrasi`
--
ALTER TABLE `administrasi`
  MODIFY `id_administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `h_user`
--
ALTER TABLE `h_user`
  MODIFY `id_h_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_ajaran`
--
ALTER TABLE `m_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_jenis_administrasi`
--
ALTER TABLE `m_jenis_administrasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_kelas`
--
ALTER TABLE `m_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_saldo`
--
ALTER TABLE `m_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_siswa`
--
ALTER TABLE `m_siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_whatsapp`
--
ALTER TABLE `m_whatsapp`
  MODIFY `id_whatsapp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pendanaan`
--
ALTER TABLE `pendanaan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tunggakan`
--
ALTER TABLE `tunggakan`
  MODIFY `id_tunggakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `whatsapp_send`
--
ALTER TABLE `whatsapp_send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
