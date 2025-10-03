-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2025 pada 06.08
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(255) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `nama_surat` varchar(255) DEFAULT NULL,
  `nama_jenis_surat` varchar(255) DEFAULT NULL,
  `role_access` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode_surat`, `nomor_surat`, `nama_surat`, `nama_jenis_surat`, `role_access`) VALUES
(1, 'Pt-', '/Un.07/07/D/KP.01.1/ST', 'Surat Tugas', 'ST', 'Pemohon,Kaprodi'),
(2, 'Pt-', '/Un.07/07/PPK/KP.01.1/SPD', 'Surat Perjalanan Dinas', 'SPD', 'Pemohon,Kaprodi'),
(3, '', '', 'Surat Keputusan Tugas Mengajar', 'SKTM', 'Kaprodi'),
(4, '', '', 'Surat Keputusan Kegiatan', 'SKKEG', 'Kaprodi'),
(5, '', '', 'Surat Keputusan Kepengurusan', 'SKKEPEN', 'Kaprodi'),
(6, '', '', 'Surat Keputusan Kepanitiaan', 'SKKEPAN', 'Kaprodi'),
(9, '', '', 'Surat Keputusan Magang', 'SKMAG', 'Kaprodi'),
(10, '', '', 'Surat Keputusan Pembimbing Magang', 'SKPEMBMAG', 'Kaprodi'),
(11, '', '', 'Surat Keputusan Penguji Magang', 'SKPENGMAG', 'Kaprodi'),
(12, '', '', 'Surat Keputusan Bimbingan Magang', 'SKBIMBMAG', 'Kaprodi'),
(13, '', '', 'Surat Keputusan Pembimbing Tugas Akhir', 'SKPEMBTA', 'Kaprodi'),
(14, '', '', 'Surat Keputusan Penguji Sempro Tugas Akhir', 'SKPENGSEM', 'Kaprodi'),
(16, '', '', 'Surat Keputusan Penguji Tugas Akhir', 'SKPENGTA', 'Kaprodi'),
(17, '', '', 'Surat Keputusan Bimbingan Tugas Akhir', 'SKBIMBTA', 'Kaprodi'),
(18, 'B-', '/Un.07/07/D/PP.00.9/', 'Surat Bagian Umum', 'SBU', 'Kaprodi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `kode_jurusan` varchar(255) DEFAULT NULL,
  `nama_jurusan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `kode_jurusan`, `nama_jurusan`) VALUES
(1, 'S', 'Sains'),
(2, 'T', 'Teknologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(255) DEFAULT NULL,
  `nama_prodi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama_prodi`) VALUES
(1, 'BIO', 'Biologi'),
(2, 'IK', 'Ilmu Kelautan'),
(3, 'MAT', 'Matematika'),
(4, 'ART', 'Arsitektur'),
(5, 'TL', 'Teknik Lingkungan'),
(6, 'SI', 'Sistem Informasi'),
(7, 'TS', 'Teknik Sipil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `id_pengajuan_surat` varchar(50) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `update_status` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `id_pengajuan_surat`, `id_user`, `status`, `update_status`) VALUES
(1, '1', '12', 'Diajukan Ke Prodi', '2025-07-10 12:03:34'),
(2, '2', '2', 'Diajukan Ke Prodi', '2025-07-11 09:06:12'),
(3, '3', '11', 'Diajukan Ke Prodi', '2025-07-11 13:34:29'),
(4, '4', '24', 'Diajukan Ke Prodi', '2025-07-12 11:15:50'),
(5, '5', '12', 'Diajukan Ke Prodi', '2025-07-13 14:22:34'),
(6, '6', '2', 'Diajukan Ke Prodi', '2025-07-13 15:24:35'),
(7, '7', '2', 'Diajukan Ke Prodi', '2025-07-14 10:29:33'),
(8, '8', '11', 'Diajukan Ke Prodi', '2025-07-14 12:38:09'),
(9, '9', '11', 'Diajukan Ke Prodi', '2025-07-15 08:40:11'),
(10, '1', '14', 'Disetujui Kaprodi', '2025-07-10 12:43:34'),
(11, '2', '16', 'Disetujui Kaprodi', '2025-07-11 10:00:12'),
(12, '3', '22', 'Ditolak Kaprodi', '2025-07-11 13:44:29'),
(13, '4', '20', 'Disetujui Kaprodi', '2025-07-12 11:55:50'),
(14, '5', '14', 'Ditolak Kaprodi', '2025-07-13 14:30:34'),
(15, '6', '16', 'Disetujui Kaprodi', '2025-07-13 15:44:35'),
(16, '8', '22', 'Disetujui Kaprodi', '2025-07-14 13:00:09'),
(17, '1', '14', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-10 13:00:34'),
(18, '2', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-11 10:29:51'),
(19, '4', '20', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-12 12:15:50'),
(20, '1', '15', 'Disetujui Kajur', '2025-07-10 13:10:34'),
(21, '2', '17', 'Disetujui Kajur', '2025-07-11 10:40:51'),
(22, '4', '17', 'Ditolak Kajur', '2025-07-12 12:35:50'),
(23, '1', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-10 13:25:34'),
(24, '2', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-11 11:00:51'),
(25, '1', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1, Wadek 2, Wadek 3', '2025-07-10 13:55:34'),
(26, '2', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1, Wadek 2', '2025-07-11 11:50:51'),
(27, '1', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-10 14:20:37'),
(28, '1', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-10 14:21:42'),
(29, '1', '19', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-10 14:22:07'),
(30, '2', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-11 12:28:39'),
(31, '2', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-11 12:33:10'),
(32, '1', '6', 'Surat Masih Dicetak Staf', '2025-07-10 14:35:19'),
(33, '2', '6', 'Surat Masih Dicetak Staf', '2025-07-11 12:42:18'),
(34, '1', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-10 14:53:40'),
(35, '1', '3', 'Surat Selesai', '2025-07-10 15:00:00'),
(36, '2', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-11 13:00:18'),
(37, '2', '3', 'Surat Selesai', '2025-07-11 13:10:18'),
(38, '6', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-13 16:00:35'),
(39, '6', '17', 'Disetujui Kajur', '2025-07-13 16:10:35'),
(40, '6', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-13 16:20:35'),
(41, '6', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1', '2025-07-13 16:30:35'),
(42, '6', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-13 16:44:35'),
(43, '6', '6', 'Surat Masih Dicetak Staf', '2025-07-13 16:55:35'),
(44, '6', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-13 17:00:35'),
(45, '6', '3', 'Surat Selesai', '2025-07-13 17:15:35'),
(46, '8', '22', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-14 13:20:09'),
(47, '8', '15', 'Disetujui Kajur', '2025-07-14 13:25:09'),
(48, '8', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-14 13:45:09'),
(49, '8', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1, Wadek 2', '2025-07-14 13:55:09'),
(50, '8', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-14 14:05:09'),
(51, '8', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-14 14:15:09'),
(52, '8', '6', 'Surat Masih Dicetak Staf', '2025-07-14 14:25:09'),
(53, '8', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-14 14:35:09'),
(54, '9', '22', 'Disetujui Kaprodi', '2025-07-15 08:45:11'),
(55, '9', '22', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-15 08:55:11'),
(56, '9', '15', 'Disetujui Kajur', '2025-07-15 09:25:11'),
(57, '9', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-15 09:40:11'),
(58, '9', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1', '2025-07-15 10:00:11'),
(59, '9', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-15 10:10:11'),
(60, '9', '6', 'Surat Masih Dicetak Staf', '2025-07-15 10:15:11'),
(61, '10', '12', 'Diajukan Ke Prodi', '2025-07-16 11:07:02'),
(62, '10', '14', 'Disetujui Kaprodi', '2025-07-16 11:17:02'),
(63, '10', '14', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-16 11:27:02'),
(64, '10', '15', 'Disetujui Kajur', '2025-07-16 11:35:02'),
(65, '10', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-16 11:40:02'),
(66, '10', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1, Wadek 2', '2025-07-16 11:50:02'),
(67, '10', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-16 11:55:02'),
(68, '10', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-16 12:00:02'),
(69, '11', '11', 'Diajukan Ke Prodi', '2025-07-16 12:27:08'),
(70, '11', '22', 'Disetujui Kaprodi', '2025-07-16 12:29:06'),
(71, '11', '22', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-16 12:40:06'),
(72, '11', '15', 'Disetujui Kajur', '2025-07-16 12:45:06'),
(73, '11', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-16 13:00:06'),
(74, '11', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1', '2025-07-16 13:15:06'),
(75, '7', '16', 'Disetujui Kaprodi', '2025-07-14 10:40:33'),
(76, '7', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-14 10:45:33'),
(77, '7', '17', 'Disetujui Kajur', '2025-07-14 10:55:33'),
(78, '7', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-14 11:05:33'),
(79, '12', '2', 'Diajukan Ke Prodi', '2025-07-18 08:37:27'),
(80, '12', '16', 'Disetujui Kaprodi', '2025-07-18 08:45:27'),
(81, '12', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-18 08:55:27'),
(82, '12', '17', 'Disetujui Kajur', '2025-07-18 09:00:27'),
(83, '13', '2', 'Diajukan Ke Prodi', '2025-07-18 12:56:00'),
(84, '13', '16', 'Disetujui Kaprodi', '2025-07-18 12:58:52'),
(85, '13', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-18 12:10:00'),
(86, '14', '2', 'Diajukan Ke Prodi', '2025-07-18 14:06:07'),
(87, '14', '16', 'Disetujui Kaprodi', '2025-07-18 14:16:47'),
(88, '15', '2', 'Diajukan Ke Prodi', '2025-07-21 11:18:12'),
(89, '16', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-21 12:52:19'),
(90, '16', '17', 'Disetujui Kajur', '2025-07-21 13:02:19'),
(91, '16', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-21 13:12:19'),
(92, '16', '4', 'Lembar Disposisi Diteruskan Ke Wadek 2, Wadek 3', '2025-07-21 13:20:19'),
(93, '16', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-21 13:25:19'),
(94, '16', '19', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-21 13:30:19'),
(95, '16', '6', 'Surat Masih Dicetak Staf', '2025-07-21 13:35:19'),
(96, '16', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-21 13:45:19'),
(97, '16', '3', 'Surat Selesai', '2025-07-21 13:50:19'),
(98, '17', '22', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-21 14:00:00'),
(99, '17', '15', 'Disetujui Kajur', '2025-07-21 14:10:00'),
(100, '17', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-21 14:20:00'),
(101, '17', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1', '2025-07-21 14:30:00'),
(102, '17', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-21 14:35:00'),
(103, '17', '6', 'Surat Masih Dicetak Staf', '2025-07-21 14:40:00'),
(104, '17', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-21 14:50:00'),
(105, '17', '3', 'Surat Selesai', '2025-07-21 14:55:00'),
(106, '18', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-21 15:17:11'),
(107, '18', '17', 'Ditolak Kajur', '2025-07-21 15:25:11'),
(108, '19', '11', 'Diajukan Ke Prodi', '2025-07-22 16:21:00'),
(110, '15', '16', 'Disetujui Kaprodi', '2025-07-23 10:30:49'),
(111, '22', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-23 10:46:09'),
(112, '22', '17', 'Disetujui Kajur', '2025-07-23 10:47:10'),
(113, '22', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-23 10:49:11'),
(114, '22', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1', '2025-07-23 10:52:54'),
(115, '22', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-23 10:54:15'),
(116, '22', '6', 'Surat Masih Dicetak Staf', '2025-07-23 10:55:01'),
(117, '22', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-23 10:56:09'),
(118, '22', '3', 'Surat Selesai', '2025-07-23 10:56:53'),
(119, '23', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-28 21:05:27'),
(120, '24', '2', 'Diajukan Ke Prodi', '2025-07-30 13:57:06'),
(121, '24', '16', 'Disetujui Kaprodi', '2025-07-30 13:58:18'),
(122, '24', '16', 'Surat Pengantar Selesai Dibuat Kaprodi', '2025-07-30 13:59:11'),
(123, '24', '17', 'Disetujui Kajur', '2025-07-30 14:01:00'),
(124, '24', '3', 'Lembar Disposisi Diteruskan Ke Dekan', '2025-07-30 14:02:17'),
(125, '24', '4', 'Lembar Disposisi Diteruskan Ke Wadek 1, Wadek 2, Wadek 3', '2025-07-30 14:04:49'),
(126, '24', '5', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-30 14:05:43'),
(127, '24', '9', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-30 14:06:43'),
(128, '24', '19', 'Lembar Disposisi Diteruskan Ke Kabag TU', '2025-07-30 14:07:40'),
(129, '24', '6', 'Surat Masih Dicetak Staf', '2025-07-30 14:08:14'),
(130, '24', '3', 'Surat Masih Ditandatangani Dekan', '2025-07-30 14:09:26'),
(131, '24', '3', 'Surat Selesai', '2025-07-30 14:10:22'),
(132, '25', '25', 'Diajukan Ke Prodi', '2025-09-25 17:23:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `id_pemohon` varchar(50) DEFAULT NULL,
  `id_jurusan` varchar(50) DEFAULT NULL,
  `id_prodi` varchar(50) DEFAULT NULL,
  `nomor_urut_pengajuan` varchar(255) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `tempat_pelaksanaan` text DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `berkas_file` varchar(1500) DEFAULT NULL,
  `jenis_surat` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `alasan_kaprodi` text DEFAULT NULL,
  `alasan_kajur` text DEFAULT NULL,
  `id_pembuat_sm` varchar(50) DEFAULT NULL,
  `nomor_sm` varchar(255) DEFAULT NULL,
  `tanggal_buat_sm` datetime DEFAULT NULL,
  `isi_sm` text DEFAULT NULL,
  `pilih_kajur` varchar(50) DEFAULT NULL,
  `buat_sm` varchar(2) DEFAULT '0',
  `id_pembuat_disposisi` varchar(50) DEFAULT NULL,
  `nomor_urut_disposisi` varchar(255) DEFAULT NULL,
  `tanggal_terima_sm` datetime DEFAULT NULL,
  `isi_ringkas` text DEFAULT NULL,
  `buat_disposisi` varchar(2) DEFAULT '0',
  `pilih_wadek` varchar(50) DEFAULT NULL,
  `isi_disposisi_dekan` text DEFAULT NULL,
  `isi_disposisi_wadek1` text DEFAULT NULL,
  `isi_disposisi_wadek2` text DEFAULT NULL,
  `isi_disposisi_wadek3` text DEFAULT NULL,
  `isi_disposisi_kabagtu` text DEFAULT NULL,
  `diteruskan_kepada_dekan` varchar(50) DEFAULT NULL,
  `diteruskan_kepada_wadek1` varchar(50) DEFAULT NULL,
  `diteruskan_kepada_wadek2` varchar(50) DEFAULT NULL,
  `diteruskan_kepada_wadek3` varchar(50) DEFAULT NULL,
  `diteruskan_kepada_kabagtu` varchar(50) DEFAULT NULL,
  `id_pembuat_sk` varchar(50) DEFAULT NULL,
  `tanggal_buat_sk` datetime DEFAULT NULL,
  `nomor_st` varchar(255) DEFAULT NULL,
  `nomor_spd` varchar(255) DEFAULT NULL,
  `nomor_sktm` varchar(255) DEFAULT NULL,
  `nomor_skkeg` varchar(255) DEFAULT NULL,
  `nomor_skkepen` varchar(255) DEFAULT NULL,
  `nomor_skkepan` varchar(255) DEFAULT NULL,
  `nomor_skmag` varchar(255) DEFAULT NULL,
  `nomor_skpembmag` varchar(255) DEFAULT NULL,
  `nomor_skpengmag` varchar(255) DEFAULT NULL,
  `nomor_skbimbmag` varchar(255) DEFAULT NULL,
  `nomor_skpembta` varchar(255) DEFAULT NULL,
  `nomor_skpengsem` varchar(255) DEFAULT NULL,
  `nomor_skpengta` varchar(255) DEFAULT NULL,
  `nomor_skbimbta` varchar(255) DEFAULT NULL,
  `nomor_sbu` varchar(255) DEFAULT NULL,
  `buat_sk` varchar(2) DEFAULT '0',
  `file_st` varchar(255) DEFAULT NULL,
  `file_spd` varchar(255) DEFAULT NULL,
  `file_sktm` varchar(255) DEFAULT NULL,
  `file_skkeg` varchar(255) DEFAULT NULL,
  `file_skkepen` varchar(255) DEFAULT NULL,
  `file_skkepan` varchar(255) DEFAULT NULL,
  `file_skmag` varchar(255) DEFAULT NULL,
  `file_skpembmag` varchar(255) DEFAULT NULL,
  `file_skpengmag` varchar(255) DEFAULT NULL,
  `file_skbimbmag` varchar(255) DEFAULT NULL,
  `file_skpembta` varchar(255) DEFAULT NULL,
  `file_skpengsem` varchar(255) DEFAULT NULL,
  `file_skpengta` varchar(255) DEFAULT NULL,
  `file_skbimbta` varchar(255) DEFAULT NULL,
  `file_sbu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id`, `id_pemohon`, `id_jurusan`, `id_prodi`, `nomor_urut_pengajuan`, `tanggal_pengajuan`, `perihal`, `tempat_pelaksanaan`, `tanggal_pelaksanaan`, `berkas_file`, `jenis_surat`, `status`, `alasan_kaprodi`, `alasan_kajur`, `id_pembuat_sm`, `nomor_sm`, `tanggal_buat_sm`, `isi_sm`, `pilih_kajur`, `buat_sm`, `id_pembuat_disposisi`, `nomor_urut_disposisi`, `tanggal_terima_sm`, `isi_ringkas`, `buat_disposisi`, `pilih_wadek`, `isi_disposisi_dekan`, `isi_disposisi_wadek1`, `isi_disposisi_wadek2`, `isi_disposisi_wadek3`, `isi_disposisi_kabagtu`, `diteruskan_kepada_dekan`, `diteruskan_kepada_wadek1`, `diteruskan_kepada_wadek2`, `diteruskan_kepada_wadek3`, `diteruskan_kepada_kabagtu`, `id_pembuat_sk`, `tanggal_buat_sk`, `nomor_st`, `nomor_spd`, `nomor_sktm`, `nomor_skkeg`, `nomor_skkepen`, `nomor_skkepan`, `nomor_skmag`, `nomor_skpembmag`, `nomor_skpengmag`, `nomor_skbimbmag`, `nomor_skpembta`, `nomor_skpengsem`, `nomor_skpengta`, `nomor_skbimbta`, `nomor_sbu`, `buat_sk`, `file_st`, `file_spd`, `file_sktm`, `file_skkeg`, `file_skkepen`, `file_skkepan`, `file_skmag`, `file_skpembmag`, `file_skpengmag`, `file_skbimbmag`, `file_skpembta`, `file_skpengsem`, `file_skpengta`, `file_skbimbta`, `file_sbu`) VALUES
(1, '12', '2', '6', '01', '2025-07-10 12:03:34', 'Permohonan Surat Tugas Pembimbing Lomba', 'Semarang', '2025-07-17', 'b254d1dc8c4cf9591b5aad2e39741a45.pdf', '1,2', 'Surat Selesai', '', '', '14', 'SI/01/07/2025', '2025-07-10 13:00:34', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum hendrerit nulla vel dictum. Donec mi mauris, egestas eu neque et, commodo pellentesque risus. Nam molestie nibh sed blandit suscipit. Curabitur sit amet auctor massa. Vivamus a tempus est, at sagittis eros. Nam in diam finibus, iaculis velit eu, gravida ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consectetur pulvinar diam, ac molestie purus tempus eget. Sed faucibus finibus urna, in consectetur sapien aliquam ac. Nulla facilisi. Aliquam posuere lacus eu justo euismod laoreet. Pellentesque eleifend magna ipsum, vehicula luctus risus luctus vitae. Phasellus vehicula a neque scelerisque varius. Suspendisse vel augue id est fermentum bibendum. Phasellus at leo rutrum, convallis mi commodo, ullamcorper orci. Integer porttitor vehicula auctor.</p>', '15', '1', '3', '01', '2025-07-10 13:25:34', 'ST dan SPD Pembimbing Lomba', '1', '5,9,19', 'Mohon dibuatkan surat ST dan SPD untuk pembimbingan lomba', 'Mohon dibuatkan surat ST dan SPD untuk pembimbingan lomba', 'Mohon dibuatkan surat ST dan SPD untuk pembimbingan lomba', 'Mohon dibuatkan surat ST dan SPD untuk pembimbingan lomba', 'Mohon dibuatkan surat ST dan SPD untuk pembimbingan lomba', 'Dekan', 'Wadek 1', 'Wadek 2', 'Wadek 3', 'Kabag TU', '3', '2025-07-10 14:53:40', 'Pt-01/Un.07/07/D/KP.01.1/ST/07/2025', 'Pt-01/Un.07/07/PPK/KP.01.1/SPD/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2580f8090c759c8302381eb7c14e7999.pdf', '156f4ed1838d8391255b3bafc0fa18a6.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2', '1', '1', '01', '2025-07-11 09:06:12', 'Pengajuan Surat Tugas Konferensi Ilmiah Nasional', 'Malang', '2025-07-18', '823e3c8b2050ba58dc1078167567ade3.pdf,fb090a7d654261073de216909df0c753.pdf,71d7d10cc18ea3a0d51d9b6a9a207dcc.pdf', '1,2', 'Surat Selesai', '', '', '16', 'B/01/07/2025', '2025-07-11 10:29:51', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum hendrerit nulla vel dictum. Donec mi mauris, egestas eu neque et, commodo pellentesque risus. Nam molestie nibh sed blandit suscipit. Curabitur sit amet auctor massa. Vivamus a tempus est, at sagittis eros. Nam in diam finibus, iaculis velit eu, gravida ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consectetur pulvinar diam, ac molestie purus tempus eget. Sed faucibus finibus urna, in consectetur sapien aliquam ac. Nulla facilisi. Aliquam posuere lacus eu justo euismod laoreet. Pellentesque eleifend magna ipsum, vehicula luctus risus luctus vitae. Phasellus vehicula a neque scelerisque varius. Suspendisse vel augue id est fermentum bibendum. Phasellus at leo rutrum, convallis mi commodo, ullamcorper orci. Integer porttitor vehicula auctor.<br>Sed at blandit ante. Maecenas elementum sed nisi sed consectetur. Etiam tortor justo, vestibulum ut lectus a, tincidunt gravida ipsum. Aenean ac justo in magna fringilla blandit a id leo. Fusce vehicula nisl sit amet porttitor viverra. Praesent commodo ipsum sed quam eleifend pharetra. Proin congue, eros eget luctus porttitor, mauris mauris vehicula purus, ultricies vestibulum metus tellus in nisl. In consequat semper risus. Aenean quam leo, egestas vitae arcu vel, lacinia cursus diam. Aenean dapibus risus sed est gravida, a placerat sapien volutpat. Praesent suscipit porta felis, a accumsan diam eleifend et. Duis tortor ligula, tincidunt at quam id, facilisis iaculis orci. Nullam vitae laoreet eros. Curabitur tristique scelerisque sapien, at mattis ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;</p>', '17', '1', '3', '02', '2025-07-11 11:00:51', 'ST dan SPD Konferensi Ilmiah Nasional', '1', '5,9', 'Mohon dibuatkan surat ST dan SPD untuk Konferensi Ilmiah Nasional', 'Mohon dibuatkan surat ST dan SPD untuk Konferensi Ilmiah Nasional', 'Mohon dibuatkan surat ST dan SPD untuk Konferensi Ilmiah Nasional', NULL, 'Mohon dibuatkan surat ST dan SPD untuk Konferensi Ilmiah Nasional', 'Dekan', 'Wadek 1', 'Wadek 2', NULL, 'Kabag TU', '3', '2025-07-11 13:00:18', 'Pt-02/Un.07/07/D/KP.01.1/ST/07/2025', 'Pt-02/Un.07/07/PPK/KP.01.1/SPD/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '550b1b55ac3d3017271933dfd2311e3f.pdf', 'ed3c8ecb08d243d4b31301d7129f8c07.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '11', '2', '5', '01', '2025-07-11 13:34:29', 'Permohonan Surat Tugas Menghadiri Seminar Internasional', 'Jakarta', '2025-07-21', 'e8e750b2f98998054c3e7cd9352c053e.pdf,618c3bf3013acfea0a93bc3a14dee79d.pdf', '1,2', 'Ditolak Kaprodi', 'Berkas File Salah', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '24', '1', '3', '01', '2025-07-12 11:15:50', 'Pengajuan Surat Tugas Mengikuti Pelatihan Kewirausahaan', 'Surabaya', '2025-07-23', '3c71d7062ae4b4a8c1fcf44e7cf60aad.pdf', '1', 'Ditolak Kajur', '', 'Isi surat masuk terdapat kesalahan', '20', 'MTK/01/07/2025', '2025-07-12 12:15:50', '<p xss=removed>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum hendrerit nulla vel dictum. Donec mi mauris, egestas eu neque et, commodo pellentesque risus. Nam molestie nibh sed blandit suscipit. Curabitur sit amet auctor massa. Vivamus a tempus est, at sagittis eros. Nam in diam finibus, iaculis velit eu, gravida ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consectetur pulvinar diam, ac molestie purus tempus eget. Sed faucibus finibus urna, in consectetur sapien aliquam ac. Nulla facilisi. Aliquam posuere lacus eu justo euismod laoreet. Pellentesque eleifend magna ipsum, vehicula luctus risus luctus vitae. Phasellus vehicula a neque scelerisque varius. Suspendisse vel augue id est fermentum bibendum. Phasellus at leo rutrum, convallis mi commodo, ullamcorper orci. Integer porttitor vehicula auctor. Sed at blandit ante. Maecenas elementum sed nisi sed consectetur. Etiam tortor justo, vestibulum ut lectus a, tincidunt gravida ipsum. Aenean ac justo in magna fringilla blandit a id leo. Fusce vehicula nisl sit amet porttitor viverra. Praesent commodo ipsum sed quam eleifend pharetra. Proin congue, eros eget luctus porttitor, mauris mauris vehicula purus, ultricies vestibulum metus tellus in nisl. In consequat semper risus. Aenean quam leo, egestas vitae arcu vel, lacinia cursus diam. Aenean dapibus risus sed est gravida, a placerat sapien volutpat. Praesent suscipit porta felis, a accumsan diam eleifend et. Duis tortor ligula, tincidunt at quam id, facilisis iaculis orci. Nullam vitae laoreet eros. Curabitur tristique scelerisque sapien, at mattis ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Praesent lobortis viverra neque quis finibus. Nullam aliquet justo ac elit volutpat tempus. Fusce efficitur, arcu ut iaculis eleifend, ligula neque feugiat arcu, vehicula sagittis nulla urna vel purus. In eu felis sit amet purus rutrum auctor. Praesent congue nulla ut quam varius, in volutpat nulla iaculis. Proin risus risus, bibendum luctus turpis a, consectetur dignissim erat. Nunc et dapibus libero, sit amet volutpat eros.</p>', '17', '1', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '12', '2', '6', '02', '2025-07-13 14:22:34', 'Permohonan Surat Tugas Mengikuti Workshop', 'Bandung', '2025-07-22', '1786b9b2356dac3e1dc4ab9a9c56d8f9.pdf,2fdeeb3f40fa211e6262d947b7a8800a.pdf', '1,2', 'Ditolak Kaprodi', 'Lampiran tidak sesuai dengan yang diajukan', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2', '1', '1', '01', '2025-07-13 15:24:35', 'Pengajuan Surat Tugas Mengikuti Rapat Koordinasi Kampus', 'Surabaya', '2025-07-24', '4b14674c3f9cb18cc10782af1e58726d.pdf', '1', 'Surat Selesai', '', '', '16', 'B/01/07/2025', '2025-07-13 16:00:35', '<p xss=removed><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ullamcorper, diam nec rutrum auctor, augue diam ultrices ligula, at bibendum erat tortor vitae sem. Duis quis augue id leo sollicitudin vehicula ut fringilla velit. Maecenas sollicitudin maximus elit, quis tristique mauris tempus in. Pellentesque ex velit, viverra id turpis in, consequat malesuada libero. Nulla porta aliquam nunc sed dictum. Donec rhoncus tortor quis nisl placerat tincidunt. Mauris tincidunt, felis at volutpat congue, arcu diam euismod ex, vel tristique mauris neque nec justo. Donec porttitor iaculis arcu. Sed ac turpis non arcu posuere vulputate sit amet in velit. Aenean ipsum leo, mollis sit amet lacus vitae, mollis porta sem. Vestibulum eu congue magna.</strong></p>', '17', '1', '3', '03', '2025-07-13 16:20:35', 'ST Rapat Koordinasi Kampus', '1', '5', 'Nam sed aliquet odio, ut semper mauris. Etiam massa felis, ornare quis commodo efficitur, aliquam at ante. Nullam viverra est elit, id condimentum velit porta quis. Pellentesque condimentum ipsum viverra, ullamcorper enim ac, elementum leo. Proin a sapien congue, vulputate ipsum eu, pulvinar ipsum. Ut ante urna, molestie non tempus id, luctus non ligula. Vestibulum et eleifend odio. Etiam nec lorem vel erat pellentesque fermentum.', 'Phasellus blandit ligula arcu, sit amet imperdiet ligula malesuada eget. Duis magna orci, semper sed augue volutpat, ullamcorper convallis odio. Suspendisse tempus lectus hendrerit volutpat suscipit. Curabitur porta fringilla tortor in elementum. Donec vehicula tincidunt malesuada. Quisque blandit tempus consequat. Aliquam quis lacus pharetra, malesuada risus eget, semper dolor. Nunc vel pretium ipsum. Integer mollis in mi ut rhoncus.', NULL, NULL, 'In sed vestibulum urna. Donec blandit ornare purus non fringilla. Vestibulum vel finibus nunc, et interdum dolor. Suspendisse eget nisi nec augue fermentum gravida. Aliquam ultrices quis felis id tempor. Nam congue dapibus lectus, sed consectetur massa molestie ut. Curabitur massa ex, viverra id rhoncus et, gravida ut leo. Phasellus tempus augue ipsum, et rhoncus lectus aliquet quis. Ut suscipit risus ac elit volutpat, id consequat erat hendrerit. Curabitur non risus est. Donec a bibendum risus, vel dignissim augue. Phasellus sed iaculis arcu.', 'Dekan', 'Wadek 1', NULL, NULL, 'Kabag TU', '3', '2025-07-13 17:00:35', 'Pt-03/Un.07/07/D/KP.01.1/ST/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '5ed8fba776c8da070bf50fe7e12cdf8f.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2', '1', '1', '02', '2025-07-14 10:29:33', 'Permohonan Surat Tugas Penelitian Lapangan', 'Bali', '2025-07-25', 'ef9ee7a722a71807c4773d9e2ab4f55b.pdf', '1,2', 'Lembar Disposisi Diteruskan Ke Dekan', '', '', '16', 'B/02/07/2025', '2025-07-14 10:45:33', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dictum vel risus et rhoncus. Mauris vel justo maximus arcu consequat tincidunt eu sit amet libero. Cras lobortis quam id sapien fermentum, lacinia faucibus odio scelerisque. Morbi sed erat commodo, porttitor mi eget, efficitur leo. Phasellus sit amet purus nec ex elementum accumsan. Phasellus tempus quis turpis id posuere. Nulla elementum ac orci non scelerisque. Cras egestas vestibulum nisi, a imperdiet augue iaculis quis. Nulla non convallis sapien, vitae malesuada ipsum. Aliquam urna eros, consectetur in felis et, ultrices eleifend est. Ut mi tortor, gravida sed massa malesuada, bibendum pretium lorem. Suspendisse in egestas felis.</p>', '17', '1', '3', '08', '2025-07-14 11:05:33', 'ST dan SPD Penelitian Lapangan', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '11', '2', '5', '02', '2025-07-14 12:38:09', 'Pengajuan Surat Tugas Pelatihan Penggunaan Software', 'Yogyakarta', '2025-07-16', '6b8adf020d2120f833a6d0cda6c78d10.pdf,954444e25063c7b5378fb9acf6eb313c.pdf', '1,2', 'Surat Masih Ditandatangani Dekan', '', '', '22', 'TL/02/07/2025', '2025-07-14 13:20:09', '<p>Vestibulum viverra, dolor vitae porttitor ullamcorper, risus nisl auctor nulla, a congue massa odio sed nulla. Etiam ut diam efficitur, rutrum ante quis, sollicitudin leo. Sed lacinia diam accumsan egestas pretium. Quisque accumsan, justo ut sollicitudin gravida, mauris dolor dapibus risus, id consectetur purus mauris nec ex. Sed tincidunt faucibus aliquam. Integer vestibulum rhoncus ultrices. Phasellus ullamcorper, augue eget placerat aliquam, libero erat luctus lorem, nec vestibulum dolor lectus et tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam elementum eget ipsum at ultrices. Donec quis lorem dolor. Vestibulum lacus metus, suscipit eget dapibus quis, vehicula non metus. Etiam ac pellentesque urna. Donec consectetur rhoncus nisi vel imperdiet. Donec sed nisi orci. Curabitur nisl leo, malesuada sed semper volutpat, consectetur sed felis. Morbi in diam mattis, convallis libero suscipit, congue nulla.</p>', '15', '1', '3', '04', '2025-07-14 13:45:09', 'ST dan SPD Pelatihan Penggunaan Software', '1', '5,9', 'Mohon dibuatkan ST dan SPD untuk pelatihan software', 'Mohon dibuatkan ST dan SPD untuk pelatihan software', 'Mohon dibuatkan ST dan SPD untuk pelatihan software', NULL, 'Mohon dibuatkan ST dan SPD untuk pelatihan software', 'Dekan', 'Wadek 1', 'Wadek 2', NULL, 'Kabag TU', '3', '2025-07-14 14:35:09', 'Pt-04/Un.07/07/D/KP.01.1/ST/07/2025', 'Pt-04/Un.07/07/PPK/KP.01.1/SPD/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '11', '2', '5', '01', '2025-07-15 08:40:11', 'Permohonan Surat Tugas Pelatihan Kewirausahaan Kampus', 'Surabaya', '2025-07-28', '0338066d6533acd3f0a0c8bc8f0b8cc6.pdf', '1', 'Surat Masih Dicetak Staf', '', '', '22', 'TL/01/07/2025', '2025-07-15 08:55:11', '<p>Donec iaculis nibh nec magna venenatis, a accumsan enim sodales. Mauris non dui venenatis, viverra purus ut, iaculis quam. Curabitur id pulvinar metus, ac consectetur nisl. Ut sollicitudin tellus a varius laoreet. Duis lobortis ullamcorper egestas. Nam ac ultrices velit, non vestibulum augue. Etiam vel dignissim nunc, auctor sollicitudin est. Phasellus aliquet lectus sit amet tellus tempus tempus. Phasellus aliquet nulla consectetur, efficitur sapien pulvinar, sagittis tortor. Vivamus dignissim elementum odio, eget fermentum eros dignissim facilisis. Pellentesque laoreet quis turpis non tristique. Nullam posuere magna et augue tincidunt, sed suscipit leo fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque gravida tellus ac mi bibendum mattis. Mauris in lorem sit amet arcu cursus posuere sed eu ipsum.</p>', '15', '1', '3', '05', '2025-07-15 09:40:11', 'ST Pelatihan Kewirausahaan Kampus', '1', '5', 'Mohon dibuatkan ST untuk pelatihan kewirausahaan kampus', 'Mohon dibuatkan ST untuk pelatihan kewirausahaan kampus', NULL, NULL, 'Mohon dibuatkan ST untuk pelatihan kewirausahaan kampus', 'Dekan', 'Wadek 1', NULL, NULL, 'Kabag TU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '12', '2', '6', '03', '2025-07-16 11:07:02', 'Permohonan Surat Tugas Menghadiri Rapat Kerja Nasional', 'Medan', '2025-07-29', '2a7629f28762b9ea8e49abcf2c4ce0cd.pdf', '1,2', 'Lembar Disposisi Diteruskan Ke Kabag TU', '', '', '14', 'SI/03/07/2025', '2025-07-16 11:27:02', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel ante tellus. Morbi vitae lorem ut ante egestas rutrum sit amet sit amet nulla. Aliquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas finibus, neque aliquam consequat fermentum, orci lacus convallis eros, non laoreet quam erat eget dolor. Vivamus dapibus elit condimentum tortor lobortis, a rhoncus dui aliquam. Vivamus a posuere odio, non dictum velit. Fusce varius ligula a risus mattis, ut sollicitudin mauris lobortis. Aliquam nec venenatis quam. Aenean vitae dictum augue. Curabitur ut volutpat neque.</p>', '15', '1', '3', '06', '2025-07-16 11:40:02', 'ST dan SPD Rapat Kerja Nasional', '1', '5,9', 'Mohon dibuatkan ST  dan SPD untuk rapat kerja nasional', 'Mohon dibuatkan ST dan SPD untuk rapat kerja nasional', 'Mohon dibuatkan ST dan SPD untuk rapat kerja nasional', NULL, NULL, 'Dekan', 'Wadek 1', 'Wadek 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '11', '2', '5', '02', '2025-07-16 12:27:08', 'Permohonan Surat Tugas Kegiatan Pengenalan Kampus bagi Mahasiswa Baru', 'Surabaya', '2025-07-30', '23840f8338ba5fd240013f91828923f3.pdf', '1', 'Lembar Disposisi Diteruskan Ke Wadek 1', '', '', '22', 'TL/02/07/2025', '2025-07-16 12:40:06', '<p>In sed vestibulum urna. Donec blandit ornare purus non fringilla. Vestibulum vel finibus nunc, et interdum dolor. Suspendisse eget nisi nec augue fermentum gravida. Aliquam ultrices quis felis id tempor. Nam congue dapibus lectus, sed consectetur massa molestie ut. Curabitur massa ex, viverra id rhoncus et, gravida ut leo. Phasellus tempus augue ipsum, et rhoncus lectus aliquet quis. Ut suscipit risus ac elit volutpat, id consequat erat hendrerit. Curabitur non risus est. Donec a bibendum risus, vel dignissim augue. Phasellus sed iaculis arcu.</p>', '15', '1', '3', '07', '2025-07-16 13:00:06', 'ST Kegiatan Pengenalan Kampus bagi Mahasiswa Baru', '1', '5', 'Mohon dibuatkan ST untuk kegiatan pengenalan kampus bagi mahasiswa baru', NULL, NULL, NULL, NULL, 'Dekan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2', '1', '1', '02', '2025-07-18 08:37:27', 'Permohonan Surat Tugas Mengikuti Seminar Kampus', 'Surabaya', '2025-07-31', '142a33403ca24a47cb6219f48e9beae9.pdf', '1', 'Disetujui Kajur', '', '', '16', 'B/02/07/2025', '2025-07-18 08:55:27', '<p>Nulla in sapien eu est sodales tempor. Pellentesque pharetra dapibus pretium. Duis rhoncus sem ligula, in mattis ante vehicula ac. Curabitur et lacinia orci. Pellentesque eget suscipit tellus. Proin tincidunt lacus et mauris pulvinar, vitae lobortis dolor mattis. Sed sodales felis lectus, ac aliquet eros facilisis non.</p>', '17', '1', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2', '1', '1', '03', '2025-07-18 12:56:00', 'Pengajuan Surat Tugas Menghadiri Pelatihan Manajemen Proyek', 'Padang', '2025-08-01', 'ffbe2c9ef6bf3ece7dd77f31cca27899.pdf,677c63da9335077bd7c0648f0a99b3ed.pdf', '1,2', 'Surat Pengantar Selesai Dibuat Kaprodi', '', NULL, '16', 'B/03/07/2025', '2025-07-18 12:10:00', '<p style=\"text-align: justify;\"><strong>Aliquam gravida auctor leo ac lobortis</strong>. Phasellus ac tristique diam, quis fermentum augue. Nam euismod libero ut nibh tempor, rhoncus posuere purus ornare. Integer molestie facilisis dui ut ultrices. Phasellus et sagittis neque. Aenean convallis mauris feugiat feugiat bibendum. Pellentesque blandit dapibus lacus sed hendrerit. Suspendisse laoreet, velit mattis eleifend tincidunt, eros arcu tristique lorem, ac euismod elit massa laoreet nisi. Pellentesque dui quam, condimentum iaculis porta in, malesuada quis velit. Nam fermentum aliquam velit, sed convallis tortor lacinia in. Aliquam ac mauris ex. Suspendisse posuere ipsum venenatis quam congue, sed blandit nisl scelerisque. Aliquam sagittis libero neque, et blandit velit condimentum vel. Vivamus odio arcu, pulvinar ut volutpat a, consequat non sapien. Sed justo purus, tristique id fermentum non, lacinia a mi. Maecenas mollis bibendum dolor a efficitur.</p>\r\n<table style=\"border-collapse: collapse; width: 100.834%; height: 175px;\" border=\"1\"><colgroup><col style=\"width: 24.9568%;\"><col style=\"width: 24.9568%;\"><col style=\"width: 24.9568%;\"><col style=\"width: 25.0437%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 174px;\">\r\n<td>Hai</td>\r\n<td>Halo</td>\r\n<td>Kau</td>\r\n<td>Kah</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<ol>\r\n<li style=\"text-align: justify;\">Nama</li>\r\n<li style=\"text-align: justify;\">Alamat</li>\r\n<li style=\"text-align: justify;\">Umur</li>\r\n</ol>\r\n<ul>\r\n<li style=\"text-align: justify;\">Warna</li>\r\n<li style=\"text-align: justify;\">Meja</li>\r\n</ul>\r\n<h1 style=\"text-align: justify;\">World</h1>\r\n<p><span style=\"background-color: #f1c40f;\">My</span></p>', '17', '1', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2', '1', '1', '04', '2025-07-18 14:06:07', 'Pengajuan Surat Tugas Menghadiri Acara Kolaborasi Penelitian', 'Aceh', '2025-08-11', '13822a9156bd15eacfad4e1fd9477954.pdf,370201c82e1fae6c95b8234a8534f93d.pdf,e006426f8fabfea3ec58166d820845d4.pdf', '1,2', 'Disetujui Kaprodi', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2', '1', '1', '03', '2025-07-21 11:18:12', 'Pengajuan Surat Tugas Mengikuti Rapat Penelitian Fakultas', 'Surabaya', '2025-07-25', '1285a6ef0c1ffd3b9abfcb1ca818b64f.pdf', '1', 'Disetujui Kaprodi', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '16', '1', '1', '01', '2025-07-21 12:52:19', 'Permohonan Surat Keputusan Kegiatan, Kepengurusan, dan Kepanitiaan', NULL, NULL, '38de4eb495da6d5cc0a208944b2675bc.pdf,10c071adeecb113c469dd19e94b935c2.pdf,6fab92fd031dd868dfddc2784f499e9f.pdf', '4,5,6', 'Surat Selesai', NULL, '', '16', 'B/01/07/2025', '2025-07-21 12:52:19', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean malesuada mollis lacus a pharetra. Proin bibendum gravida massa, ut lobortis metus volutpat et. Duis maximus, magna ac egestas tempus, libero nulla maximus ligula, ac ultricies ligula erat tempor ex. Donec non elit pulvinar, lacinia diam sit amet, pharetra elit. Nunc lacinia dignissim tortor vel consequat. Aenean nibh ipsum, placerat non luctus nec, rhoncus eu nulla. Nullam efficitur ultricies velit ac aliquam. Nunc commodo lorem erat, nec dignissim odio dapibus posuere. Praesent rutrum enim at sollicitudin gravida. Vivamus feugiat nisl eget ullamcorper porta. Sed vulputate laoreet lacinia. Sed commodo, odio a fringilla auctor, mauris nunc dignissim nisi, non sodales massa ligula tristique odio. Sed ultrices dolor vitae ornare bibendum. Vivamus consectetur quis nulla nec tempor. Nullam lobortis est eu mi finibus, et eleifend metus sodales.</p>', '17', '1', '3', '09', '2025-07-21 13:12:19', 'SK Kegiatan, Kepengurusan, dan Kepanitiaan', '1', '9,19', 'Mohon dibuatkan SK kegiatan, kepengurusan, dan kepanitiaan', NULL, 'Mohon dibuatkan SK kegiatan, kepengurusan, dan kepanitiaan', 'Mohon dibuatkan SK kegiatan, kepengurusan, dan kepanitiaan', 'Mohon dibuatkan SK kegiatan, kepengurusan, dan kepanitiaan', 'Dekan', NULL, 'Wadek 2', 'Wadek 3', 'Kabag TU', '3', '2025-07-21 13:45:19', NULL, NULL, NULL, '09/07/2025', '09/07/2025', '09/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'cb43b1a196bcd42758ca298e8e152707.pdf', 'df07d14360d24da642c2479d74df85d1.pdf', '5f1384ae608b699493e36e09fbbe6cd0.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '22', '2', '5', '01', '2025-07-21 14:00:00', 'Permohonan Surat Keputusan Tugas Mengajar dan Magang', NULL, NULL, '39afa6669518e4e6b7fdbe2da7418b41.pdf,920093408e93045a65372f53f49f63a2.pdf', '3,9', 'Surat Selesai', NULL, '', '22', 'TL/01/07/2025', '2025-07-21 14:00:00', '<p>Nam massa tortor, congue a urna in, iaculis scelerisque arcu. Quisque sollicitudin magna tortor. Aenean vel nisi at diam scelerisque feugiat ut vitae quam. In porttitor lacus a mi mattis, quis rhoncus leo vulputate. Sed augue mauris, tempor eget velit sit amet, dictum molestie leo. Duis ut sapien nec libero cursus faucibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In finibus, ipsum quis elementum vestibulum, diam orci elementum risus, quis tempus eros dui a felis. Aliquam consectetur turpis ornare nibh elementum, in blandit sapien varius.</p>', '15', '1', '3', '10', '2025-07-21 14:20:00', 'SK Tugas Mengajar dan Magang', '1', '5', 'Mohon dibuatkan SK tugas mengajar dan magang', 'Mohon dibuatkan SK tugas mengajar dan magang', NULL, NULL, 'Mohon dibuatkan SK tugas mengajar dan magang', 'Dekan', 'Wadek 1', NULL, NULL, 'Kabag TU', '3', '2025-07-21 14:50:00', NULL, NULL, '10/07/2025', NULL, NULL, NULL, '10/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '486993c052c88ef3b44cfb8c68976650.pdf', NULL, NULL, NULL, '048f49d37e28e52decf075124dadf8a6.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '16', '1', '1', '05', '2025-07-21 15:17:11', 'Permohonan Surat Tugas dan Perjalanan Dinas', NULL, NULL, '069211b3ceabe88cbc7ab9c62b0d39d7.pdf,1554e443ee257e89c43891a813ee42a6.pdf', '1,2', 'Ditolak Kajur', NULL, 'File lampiran salah', '16', 'B/05/07/2025', '2025-07-21 15:17:11', '<p>Integer ullamcorper aliquet molestie. Aliquam in rutrum ipsum, eu pharetra lacus. Aenean fermentum tempor quam. Integer et odio dui. Proin ac aliquet libero, in dapibus leo. Nam nec sapien vulputate, tempor odio sit amet, sagittis metus. Curabitur accumsan iaculis ornare. Sed efficitur, lectus eu finibus dapibus, nulla ante aliquet tortor, commodo consectetur turpis turpis at dui.</p>', '17', '1', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '11', '2', '5', '03', '2025-07-22 16:21:00', 'Permohonan Surat Tugas Mengikuti Pelatihan Kewirausahaan', 'Surabaya', '2025-07-25', 'e9f875a2670c5e2ce89f01f57899a75b.pdf', '1', 'Diajukan Ke Prodi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '16', '1', '1', '02', '2025-07-23 10:46:09', 'Permohonan Surat Tugas Penguji Tugas Akhir', NULL, NULL, '97e7c326e7fc3eaf171e24571ce34be3.pdf', '16', 'Surat Selesai', NULL, '', '16', 'B/02/07/2025', '2025-07-23 10:46:09', '<p>pokok surat</p>', '17', '1', '3', '11', '2025-07-23 10:49:11', 'ST penguji TA', '1', '5', 'tolong buatkan ST penguji TA', 'tolong buatkan ST penguji TA', NULL, NULL, 'tolong buatkan ST penguji TA', 'Dekan', 'Wadek 1', NULL, NULL, 'Kabag TU', '3', '2025-07-23 10:56:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11/07/2025', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33a0deb36a4a9774a1207c1cd4eb12fb.pdf', NULL, NULL),
(23, '16', '1', '1', '01', '2025-07-28 21:05:27', 'Permohonan Surat Keputusan Tugas Mengajar', NULL, NULL, '54fad1ce84dd4c12da32f9e6358d7002.pdf', '3', 'Surat Pengantar Selesai Dibuat Kaprodi', NULL, NULL, '16', 'BIO/01/09/2025', '2025-07-28 21:05:27', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor eros vel enim dapibus, vitae aliquet libero sagittis. Praesent condimentum condimentum urna, eu consequat libero porttitor ut. Sed massa felis, porta vel auctor at, scelerisque sed quam. Nulla justo sapien, tempus nec elit eleifend, tempus elementum sem. Sed tincidunt arcu id ex viverra sollicitudin sit amet tincidunt leo. Integer tincidunt metus non lacus dapibus, et interdum dui pretium. Sed fringilla egestas semper. Aliquam pulvinar elit et purus commodo viverra nec id odio. Aliquam fermentum interdum nibh, et vestibulum dolor vestibulum vitae. Nunc sed libero vel erat vulputate fermentum vel in massa. Ut posuere quam eu pulvinar congue. Duis eros nulla, egestas ac tortor a, pellentesque tristique nunc.</p>', '17', '1', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2', '1', '1', '06', '2025-07-30 13:57:06', 'Permohonan Surat Tugas Pembimbing Lomba', 'Malang', '2025-07-31', 'b86488009f28989b760183839cfd1ad6.pdf,3b4ee469d82fa30bb9e92eca1dcc5fea.pdf,0e276d93484f391c661b74ce1f1f7eab.pdf', '1,2', 'Surat Selesai', '', '', '16', 'B/06/07/2025', '2025-07-30 13:59:11', '<p>pokok surat</p>', '17', '1', '3', '12', '2025-07-30 14:02:17', 'Permohonan ST Pembimbing Lomba', '1', '5,9,19', 'buatkan ST pembimbing lomba', 'wadek 1', 'wadek 2', 'wadek 3', 'kabagtu', 'Dekan', 'Wadek 1', 'Wadek 2', 'Wadek 3', 'Kabag TU', '3', '2025-07-30 14:09:26', 'Pt-12/Un.07/07/D/KP.01.1/ST/07/2025', 'Pt-12/Un.07/07/PPK/KP.01.1/SPD/07/2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '73cac1eac9f67bbb1605309481ead48b.pdf', '499ee36e6d57fe42221b85e9e916409e.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '25', '2', '4', '01', '2025-09-25 17:23:33', 'Permohonan Surat Tugas Mengikuti Workshop', 'Jambi', '2025-09-29', '276d4db4d1e16aea2a4ff05dc43f0a0a.pdf', '1,2', 'Diajukan Ke Prodi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_jurusan` varchar(50) DEFAULT NULL,
  `id_prodi` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `role` enum('Dekan','Wadek','Kabag_TU','Staf','Pemohon','Kaprodi','Kajur','Admin') NOT NULL,
  `ttd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_jurusan`, `id_prodi`, `username`, `password`, `nama`, `nip`, `pangkat`, `golongan`, `jabatan`, `role`, `ttd`) VALUES
(1, '', '', 'admin', '$2a$12$h2h/jYX06iayuszUM64Rye4B0lcFU/cHrAtMDYuPDykayO20HLyUC', 'MyAdmin', '-', '-', '-', '', 'Admin', NULL),
(2, '1', '1', 'pemohon', '$2a$12$FTMUrBm8E4X/JJsnDPPhaOkAgClzbeAp3cslPbmMVhzC2wKAZq0fy', 'Nirmala Fitria Firdhausi, S.Si., M.Si', '198506252011012010', 'Penata', 'III/c', 'Dosen', 'Pemohon', NULL),
(3, '', '', 'staf', '$2a$12$b5IsU3nk13chR8jtbdNW1uwBLc07YPR50ERlmjPbtAel/oDKRk/BS', 'Khusnul Inayah, S.Ag', '197709272009012008', 'Penata Tk.I', 'III/d', 'Staf', 'Staf', NULL),
(4, '', '', 'dekan', '$2a$12$G2XlHqfFBH2V9WKmgBJA8.j9tMbBLuXVceQv1Z8oEEsbGkUJeO2YG', 'Dr. A. Saepul Hamdani, M.Pd', '196507312000031002', 'Pembina', 'IV/a', 'Dekan', 'Dekan', '978af7d17b5174d80862f913535550da.png'),
(5, '', '', 'wadek', '$2a$12$Y48xtuRBaY4Ptat1w8BHDO7cMTomOUgot8kLKH1bvsCbA0ZGIR6Wy', 'Dr. Moh. Hafiyusholeh, M. Si', '198002042014031001', 'Penata Tk.I', 'III/d', 'Wadek 1', 'Wadek', NULL),
(6, '', '', 'kabagtu', '$2a$12$GAGzGhEox4QWCd3kkTMr9Odh7LiuchxWvXO66l5UWhgTJ61iwA7SO', 'Hj. Yuliati Bararah, S.Ag, MH', '197407232000032002', 'Pembina Tk.I', 'IV/b', 'Kabag TU', 'Kabag_TU', NULL),
(7, '1', '2', 'pemohon1', '$2a$12$2uiYkZYyIDqecnTo5C0V8OtI2dzT72zA8ofOe6CEv74Kl6w3UZeC6', 'Rizqi Abdi Perdanawati, MT', '198809262014032002', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL),
(8, '', '', 'staf1', '$2y$10$axJA8s3mYttxhOrIVThtUemaMegtDn1BQEKKgSkHQULjYKRUxvPAW', 'Edika Aferi, S.E', '198202282009101003', 'Penata Muda Tk.I', 'III/b', 'Staf', 'Staf', NULL),
(9, '', '', 'wadek1', '$2y$10$Csj31IHQb5iX2kCXrBYPout5c3YcZyPu1kdkuO4.tzIgws7/OiPO.', 'Dr. Abid Rohman, S.Ag, M.Pd.I', '197706232007101006', 'Penata Tk.I', 'III/d', 'Wadek 2', 'Wadek', NULL),
(10, '', '', 'staf2', '$2y$10$DV8.UGhfVz9ct/6S8gAV0ufITLesNe1adkvxDwkP8k/.RTyWdFedu', 'Supriyadi, SH., MM', '196510051989021001', 'Pembina Tk.I', 'IV/b', 'Staf', 'Staf', NULL),
(11, '2', '5', 'pemohon2', '$2y$10$D8lWGLJmDoBEjnQC1xri3ONPl19z8mz3DhN6RZFP1kaiQ9aphrzhK', 'Abdul Hakim, S.T.,M.T', '198008062014031002', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL),
(12, '2', '6', 'dosen', '$2y$10$6Brbyjlmz1henvqmTXGnY.rtLrDPs7XxWDio3ktrDFfqscAyJKIaq', 'Ahmad Yusuf, M. Kom', '199001202014031003', 'Penata', 'III/c', 'Dosen', 'Pemohon', NULL),
(13, '2', '7', 'World', '$2y$10$x5nRaoiO2Bh5B86l2A4xJuu8eVF.vB/FHYoN8I05mKoMwTDRBlzCS', 'Efa Suriani, M. Eng', '197902242014032003', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL),
(14, '2', '6', 'kaprodi', '$2y$10$Yzia7t0zIQT/n11tgl2qfuoOG9nx2mdx3HosEHJ9Es/4BXHr874xK', 'Dwi Rolliawati, MT', '197909272014032001', 'Penata Tk.I', 'III/d', 'Kaprodi', 'Kaprodi', 'c85d811586679d345f1adaa57d71e6c7.png'),
(15, '2', '', 'kajur', '$2y$10$oB3vcKXv3GbxwuI2AxTi5O6egLOJbd0gtTfeRoDeBhwZkDr7oKLr6', 'Mujib Ridwan, S.Kom., M.T', '198604272014031004', 'Penata Tk.I', 'III/d', 'Kajur', 'Kajur', '1123640447e363696996cce6b61cdf3c.png'),
(16, '1', '1', 'kaprodi1', '$2y$10$iTav2/fAEMk.yaSnSf36euoJUSTPnn9K851fq5IbsPEHGz7UgI/Ra', 'Esti Tyastirin, M. KM', '198706242014032001', 'Penata', 'III/c', 'Kaprodi', 'Kaprodi', 'c5ed886d14f86c21e209f5c247365a06.png'),
(17, '1', '', 'kajur1', '$2y$10$HiGLAeQ6Vo1YECUxvLaJueuYFYF7HWSkUJ2uD//ygCeAfy6rjRFK2', 'Asri Sawiji, MT', '198706262014032003', 'Penata Tk.I', 'III/d', 'Kajur', 'Kajur', '7ed974d82cdd5eb075c6495f14721ae3.png'),
(18, '1', '2', 'kaprodi2', '$2y$10$S5DPDC/jPlZ7BXBbYS0mxu5cDcjRS9/OfK9rSBtSL6ewVscsp19xi', 'Andik Dwi Muttaqin, MT', '198204102014031001', 'Penata', 'III/c', 'Kaprodi', 'Kaprodi', '32d47d9a19ad6b2cabe8148360cbd2d1.png'),
(19, '', '', 'wadek2', '$2y$10$VwnmRjh8.i428qQOOx7VsOA602y6yK8vImR/haMoEKB9Kpkmpwbqq', 'Dr. Khoirul Yahya, S.Ag, M.Si', '197202062007101003', 'Penata', 'III/c', 'Wadek 3', 'Wadek', NULL),
(20, '1', '3', 'kaprodi3', '$2y$10$du2fsXhVtw7AauR3BqV00.u8Se/4bo.BbapOFrwnjh.XW6MJGQxUK', 'Yuniar Farida, MT', '197905272014032002', 'Penata Tk.I', 'III/d', 'Kaprodi', 'Kaprodi', 'dde05c280c24ee85b2b5cacb815b67fe.png'),
(21, '2', '4', 'kaprodi4', '$2y$10$IYYuJHuVxNY3sGK3wTgkJOejTdR4163JXnPOly/G6eREEbwCBVfli', 'Dr. Rita Ernawati, MT', '198008032014032001', 'Penata', 'III/c', 'Kaprodi', 'Kaprodi', 'c43cc8805eaa8d599446be20264db165.png'),
(22, '2', '5', 'kaprodi5', '$2y$10$21Ik6ZI5m.oVBiNMGi.S9.qzOrLinf1peJBNyUSETU0ytgzscz26.', 'Ir. Shinfi Wazna Auvaria, MT', '198603282015032001', 'Penata Tk.I', 'III/d', 'Kaprodi', 'Kaprodi', '01aa3a0d8e8e8656a0d1c7a3b843ee69.png'),
(23, '2', '7', 'kaprodi7', '$2y$10$KK97b/deqDV7CHyIyEEUJez5pyBC7l0z36BAjsuvFcW/wlfsQMqAi', 'Arqowi Pribadi, M. Eng', '198701032014031001', 'Penata', 'III/c', 'Kaprodi', 'Kaprodi', '978af7d17b5174d80862f913535550da.png'),
(24, '1', '3', 'pemohon3', '$2y$10$c/PBOzq0Eh3zI.nuAkKb2uGhNo19GuJ.lUZbOaC/lrvMSlAtSctL2', 'Ahmad Hanif Asyhar, M. Si', '198601232014031001', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL),
(25, '2', '4', 'pemohon4', '$2y$10$oS38jMJfy5WFaFdnX2LkE.L12I1joocJppKnJQf9AgkiYLMiqIGjS', 'Rahmad Junaidi, ST, MT', '198306242014031002', 'Penata', 'III/c', 'Dosen', 'Pemohon', NULL),
(26, '2', '5', 'pemohon5', '$2y$10$odz2qFhhEFmM9cc1YxhDFeNoh0nNAYZji3rSZJf5ZNSlgv7hsvY0y', 'Yusrianti, MT', '198210222014032001', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL),
(27, '2', '7', 'pemohon7', '$2y$10$4.ryQatusq.EUybrIVYsJ.rZcJTLdQNIIBR4fBLPHjOptug03LfxO', 'Efa Suriani, M. Eng', '197902242014032003', 'Penata Tk.I', 'III/d', 'Dosen', 'Pemohon', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
