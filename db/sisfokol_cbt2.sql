-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Agu 2020 pada 12.01
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfokol_cbt2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `adminx`
--

CREATE TABLE `adminx` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) DEFAULT NULL,
  `passwordx` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `adminx`
--

INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`, `nama`, `postdate`) VALUES
('e807f1fcf82d132f9bb018ca6738a19f', 'admin', '14e1398817e2ff21d2268eb5e169de65', 'ADMIN', '2019-12-23 00:00:00'),
('4cb41b873b12fb451a0535798c834822', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', '2020-08-03 16:56:26'),
('c8fc79e5b2815d6614f2187b0e3dc93e', '2', 'c81e728d9d4c2f636f067f89cc14862c', '2', '2020-08-03 07:36:58'),
('a83a780bda57323fdcb17f334bde5039', '3', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '3', '2020-08-03 07:37:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_log`
--

CREATE TABLE `login_log` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_jadwal`
--

CREATE TABLE `m_jadwal` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(100) DEFAULT NULL,
  `waktu` varchar(100) DEFAULT NULL,
  `pukul` varchar(100) DEFAULT NULL,
  `durasi` varchar(100) DEFAULT NULL,
  `mapel` longtext DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL,
  `aktif` enum('true','false') DEFAULT 'false',
  `postdate_mulai` datetime DEFAULT NULL,
  `postdate_selesai` datetime DEFAULT NULL,
  `soal_jml` varchar(10) DEFAULT NULL,
  `soal_postdate` datetime DEFAULT NULL,
  `proses` enum('true','false') DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_jadwal`
--

INSERT INTO `m_jadwal` (`kd`, `no`, `waktu`, `pukul`, `durasi`, `mapel`, `tingkat`, `postdate`, `aktif`, `postdate_mulai`, `postdate_selesai`, `soal_jml`, `soal_postdate`, `proses`) VALUES
('55c95c485a333e54bd44ca716dcb1b94', '1', 'Senin, 03 Agustus 2020', '08.00 xstrix 08.45', '45', 'MTK', 'X', '2020-08-03 07:33:46', 'false', '2020-08-03 16:58:08', '2020-08-03 17:01:24', '4', '2020-08-03 16:57:00', 'false'),
('1bef0fe8e6c4ef1995620af41625a812', '2', 'Senin, 03 Agustus 2020', '08.45 xstrix 09.30', '45', 'Bahasa Indonesia', 'XI', '2020-08-03 07:34:22', 'false', NULL, NULL, '3', '2020-08-03 09:40:12', 'false'),
('869d3f414e0079c089dfc584b20a777b', '3', 'Senin, 03 Agustus 2020', '09.30 xstrix 10.15', '45', 'PPKn', 'XII', '2020-08-03 07:34:58', 'false', NULL, NULL, '2', '2020-08-03 07:57:39', 'false'),
('1d431e0b88fb2563f810ea59141aa1ba', '4', 'Senin, 03 Agustus 2020', '10.15 &ndashxkommax 11.00', '45', 'FISIKA', 'X IPA 1', '2020-08-03 07:45:35', 'false', NULL, NULL, '2', '2020-08-03 07:58:21', 'false'),
('83fb625a31b8f0f0020681c706c392b6', '5', 'Senin, 03 Agustus 2020', '10.15 &ndashxkommax 11.00', '45', 'BIOLOGI', 'X IPA 2', '2020-08-03 07:45:35', 'false', NULL, NULL, '2', '2020-08-03 07:59:05', 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kelas`
--

CREATE TABLE `m_kelas` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(50) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_soal`
--

CREATE TABLE `m_soal` (
  `kd` varchar(50) NOT NULL,
  `jadwal_kd` varchar(50) DEFAULT NULL,
  `no` varchar(10) DEFAULT NULL,
  `isi` longtext DEFAULT NULL,
  `kunci` varchar(1) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `m_soal`
--

INSERT INTO `m_soal` (`kd`, `jadwal_kd`, `no`, `isi`, `kunci`, `postdate`) VALUES
('3e3377729e247fb804e4d8686344f84c', '55c95c485a333e54bd44ca716dcb1b94', '1', 'xkkirixpxkkananxsoal #1xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:55:41'),
('92093906534c53d8c07754b208be7ec3', '55c95c485a333e54bd44ca716dcb1b94', '2', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'E', '2020-08-03 07:56:10'),
('23023360996716692f594f7cf275d8de', '55c95c485a333e54bd44ca716dcb1b94', '3', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'E', '2020-08-03 07:56:26'),
('de9ac70e27d61e94173d36e8fa778d6e', '1bef0fe8e6c4ef1995620af41625a812', '1', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'C', '2020-08-03 07:56:48'),
('8596e172b232bc79e5a4de3380a4d371', '1bef0fe8e6c4ef1995620af41625a812', '2', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:57:03'),
('45a140a41f3d896e065c2b75acb482ef', '869d3f414e0079c089dfc584b20a777b', '1', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:57:24'),
('7e1e69fc310d268a93879e806920a61f', '869d3f414e0079c089dfc584b20a777b', '2', 'xkkirixpxkkananxsoal..xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:57:39'),
('5f7450c1537369fa518132942d561f45', '1d431e0b88fb2563f810ea59141aa1ba', '1', 'xkkirixpxkkananxsoal..xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:58:05'),
('6700f9d76db5e803e8c82389a57b24d4', '1d431e0b88fb2563f810ea59141aa1ba', '2', 'xkkirixpxkkananxsoal..xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'C', '2020-08-03 07:58:21'),
('d059812b7bcb6d75b4247fe1b34cffa2', '83fb625a31b8f0f0020681c706c392b6', '1', 'xkkirixpxkkananxsoal..xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:58:47'),
('f985a2f582f5492d67e2c451485ee544', '83fb625a31b8f0f0020681c706c392b6', '2', 'xkkirixpxkkananxsoal..xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananx&nbspxkommaxxkkirixxgmringxpxkkananx', 'B', '2020-08-03 07:59:05'),
('1c23fbaf02ff5de88442c9428d8e527b', '1bef0fe8e6c4ef1995620af41625a812', '3', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'C', '2020-08-03 09:40:12'),
('f4138348ac58252457e4e4e2bdd62383', '55c95c485a333e54bd44ca716dcb1b94', '4', 'xkkirixpxkkananxsoal...xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxA.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxB.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxC.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxD.xkkirixxgmringxpxkkananx\r\n\r\nxkkirixpxkkananxE.xkkirixxgmringxpxkkananx', 'D', '2020-08-03 16:56:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_soal_filebox`
--

CREATE TABLE `m_soal_filebox` (
  `kd` varchar(50) NOT NULL,
  `soal_kd` varchar(50) DEFAULT NULL,
  `filex` longtext DEFAULT NULL,
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_tapel`
--

CREATE TABLE `m_tapel` (
  `kd` varchar(50) NOT NULL,
  `tahun1` varchar(4) DEFAULT NULL,
  `tahun2` varchar(4) DEFAULT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_tapel`
--

INSERT INTO `m_tapel` (`kd`, `tahun1`, `tahun2`, `status`, `postdate`) VALUES
('1521f139ca3892fb5afff72a15df510a', '2020', '2021', 'true', '2020-08-03 07:29:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `kd` varchar(50) NOT NULL,
  `tapel_kd` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL,
  `usernamex` varchar(50) DEFAULT NULL,
  `passwordx` varchar(50) DEFAULT NULL,
  `passwordx2` varchar(100) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `kelamin` varchar(1) DEFAULT NULL,
  `lahir_tmp` varchar(100) DEFAULT NULL,
  `lahir_tgl` varchar(100) DEFAULT NULL,
  `aktif_postdate` datetime DEFAULT NULL,
  `aktif` enum('true','false') DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`kd`, `tapel_kd`, `nis`, `nisn`, `nama`, `postdate`, `usernamex`, `passwordx`, `passwordx2`, `kelas`, `kelamin`, `lahir_tmp`, `lahir_tgl`, `aktif_postdate`, `aktif`) VALUES
('7d733622be034f5f8e77ae2f352148cb', '1521f139ca3892fb5afff72a15df510a', '1', '1', '1', '2020-08-03 09:42:30', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'X IPA 1', 'L', 'Kendal', '23xstrix09xstrix2004', '2020-08-03 09:44:35', 'true'),
('441df9333806bff96d609236981c2aa2', '1521f139ca3892fb5afff72a15df510a', '2', '2', '2', '2020-08-03 09:42:30', '2', 'c81e728d9d4c2f636f067f89cc14862c', '2', 'X IPA 2', 'L', 'Semarang', '11xstrix07xstrix2003', '2020-08-03 10:20:42', 'true'),
('979819b8a8f52ed66b030681dca6b3ab', '1521f139ca3892fb5afff72a15df510a', '3', '3', '3', '2020-08-03 09:42:30', NULL, NULL, NULL, 'X IPA 3', 'L', 'Kendal', '12xstrix03xstrix2002', NULL, 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_soal`
--

CREATE TABLE `siswa_soal` (
  `kd` varchar(50) NOT NULL,
  `jadwal_kd` varchar(50) DEFAULT NULL,
  `siswa_kd` varchar(50) DEFAULT NULL,
  `soal_kd` varchar(50) DEFAULT NULL,
  `jawab` varchar(1) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL,
  `kunci` varchar(1) DEFAULT NULL,
  `benar` enum('true','false') DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_soal_nilai`
--

CREATE TABLE `siswa_soal_nilai` (
  `kd` varchar(50) NOT NULL,
  `jadwal_kd` varchar(50) DEFAULT NULL,
  `siswa_kd` varchar(50) DEFAULT NULL,
  `siswa_nis` varchar(100) DEFAULT NULL,
  `siswa_nama` varchar(100) DEFAULT NULL,
  `jml_benar` varchar(3) DEFAULT NULL,
  `jml_salah` varchar(3) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_proses` datetime DEFAULT NULL,
  `waktu_akhir` datetime DEFAULT NULL,
  `skor` varchar(5) DEFAULT NULL,
  `postdate` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `jml_soal_dikerjakan` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `adminx`
--
ALTER TABLE `adminx`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `m_jadwal`
--
ALTER TABLE `m_jadwal`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `m_kelas`
--
ALTER TABLE `m_kelas`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `m_soal`
--
ALTER TABLE `m_soal`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `m_soal_filebox`
--
ALTER TABLE `m_soal_filebox`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `m_tapel`
--
ALTER TABLE `m_tapel`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `siswa_soal`
--
ALTER TABLE `siswa_soal`
  ADD PRIMARY KEY (`kd`);

--
-- Indeks untuk tabel `siswa_soal_nilai`
--
ALTER TABLE `siswa_soal_nilai`
  ADD PRIMARY KEY (`kd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
