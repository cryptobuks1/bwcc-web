-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Jul 2019 pada 21.42
-- Versi server: 10.2.25-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u7120973_rsud_antrian_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id` int(3) NOT NULL,
  `token` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id`, `token`, `status`) VALUES
(1, '7TmgitdDpPsh8YC8MXkkuzqZ1YOGDwJA', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bangsal`
--

CREATE TABLE `bangsal` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kuota` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bangsal`
--

INSERT INTO `bangsal` (`id`, `nama`, `kuota`) VALUES
('-', '-', '1'),
('A01', 'ANGGREK (Anak)', '1'),
('A02', 'ANGGREK (Balita)', '1'),
('A03', 'MAWAR(Dewasa Laki-Laki)', '0'),
('A04', 'MAWAR (Dewasa Perempuan)', '0'),
('A05', 'EDELWEIS (Ruang Bersalin)', '1'),
('A06', 'ANGGREK (ISOLASI)', '1'),
('A07', 'MAWAR (ISOLASI)', '1'),
('A08', 'HCU', '1'),
('A09', 'EDELWEIS (Bayi Baru Lahir)', '1'),
('A10', 'ANGGREK (Observasi Bayi)', '1'),
('A11', 'EDELWEIS (Ruang Tindakan)', '1'),
('A12', 'MAWAR', '1'),
('A13', 'IGD (OBSERVASI)', '1'),
('AP', 'APOTEK FARMASI', '1'),
('B0013', 'PERINA ANGGREK', '0'),
('B0016', 'APOTEK', '0'),
('GD', 'GUDANG', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(36) NOT NULL,
  `user_id` int(36) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `max_time` varchar(10) DEFAULT NULL,
  `last_password` longtext DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `forget_password`
--

INSERT INTO `forget_password` (`id`, `user_id`, `token`, `max_time`, `last_password`, `status`) VALUES
(1, 81, '05699aad75448a104ce5d371621be4d6', '1561643450', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(2, 81, 'e529a03461ae53aef80c64bb9d668175', '1561645399', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(3, 81, '5b0c3950f431cf642c3ac7b56aff4dee', '1561645400', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(4, 81, '81202f3dd1d603b6874142e15a997ee3', '1561645401', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(5, 81, 'fc9a3e0247d59148032479d375c415ad', '1561646477', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(6, 81, '2e83aa2ea524df8e8b29fb8feda5baf0', '1561646539', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(7, 81, 'b1dd782c97284f4411898d15225bd3da', '1561714822', 'c027152694f63a99a52a2852376e52071ccf5b44', 0),
(8, 81, '78f6332e703fc89d60b21f90e122224a', '1561715323', 'c027152694f63a99a52a2852376e52071ccf5b44', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id` varchar(10) NOT NULL,
  `kode` varchar(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `status` varchar(6) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `posisi` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id`, `kode`, `harga`, `status`, `kelas`, `posisi`) VALUES
('1', 'A07', 150000, 'ISI', 'Kelas 3', '0'),
('402-001', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('402-002', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('402-003', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('402-004', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('402-005', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('403-001', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('403-002', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('403-003', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('403-004', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('404-ISO1', 'A07', 200000, 'ISI', 'Kelas 3', '1'),
('404-ISO2', 'A07', 200000, 'ISI', 'Kelas 3', '1'),
('404-ISO3', 'A07', 200000, 'KOSONG', 'Kelas 3', '1'),
('405-001', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('405-002', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('405-003', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('405-004', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('405-005', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('406-001', 'A12', 100000, 'ISI', 'Kelas 3', '1'),
('406-002', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('406-003', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('406-004', 'A12', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.301.B1', 'A02', 100000, 'ISI', 'Kelas 3', '1'),
('A.301.B2', 'A02', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.301.B3', 'A02', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.301.B4', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.301.B5', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.302.B1', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.302.B2', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.302.B3', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.302.B4', 'A02', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.302.B5', 'A02', 100000, 'ISI', 'Kelas 3', '1'),
('A.303.01', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.303.B1', 'A02', 50000, 'KOSONG', 'Kelas 3', '0'),
('A.303.B2', 'A02', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.303.B3', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.304.ISO1', 'A06', 200000, 'KOSONG', 'Kelas 3', '1'),
('A.304.ISO2', 'A06', 200000, 'KOSONG', 'Kelas 3', '1'),
('A.305.B1', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.305.B2', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.305.B3', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.305.B4', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('A.305.B5', 'A01', 100000, 'KOSONG', 'Kelas 3', '1'),
('BBL001', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('BBL002', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('BBL003', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('BBL004', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('BBL005', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('BBL006', 'A09', 150000, 'KOSONG', 'Kelas 3', '1'),
('HCU-001', 'A08', 200000, 'KOSONG', 'Kelas 3', '1'),
('HCU-002', 'A08', 200000, 'KOSONG', 'Kelas 3', '1'),
('K0000008', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000009', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000010', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000021', 'A01', 50000, 'KOSONG', 'Kelas 1', '0'),
('K0000026', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000027', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000028', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000029', 'A07', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000030', 'A07', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000031', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000032', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000033', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000034', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000037', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000038', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000039', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000040', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000041', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000042', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000043', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000044', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000045', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000046', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000047', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000048', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000049', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000060', 'A07', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000061', 'A07', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000062', 'A07', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000063', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000064', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000065', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000066', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000067', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000068', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000069', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000070', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000071', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000072', 'A03', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000073', 'A01', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000074', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000075', 'B00', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000081', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000082', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000083', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000084', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000085', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000086', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000087', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000088', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000089', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000090', 'A12', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000095', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000096', 'A05', 50000, 'KOSONG', 'Kelas 3', '0'),
('K0000104', 'A09', 150000, 'KOSONG', 'Kelas 1', '0'),
('K0000115', 'A10', 200000, 'KOSONG', 'Kelas 3', '1'),
('K0000116', 'A10', 200000, 'KOSONG', 'Kelas 3', '1'),
('K0000124', 'A02', 50000, 'KOSONG', 'Kelas 3', '0'),
('OBS.B01', 'A13', 45000, 'KOSONG', 'Kelas 3', '1'),
('OBS.B02', 'A13', 45000, 'KOSONG', 'Kelas 3', '1'),
('RB-T001', 'A11', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB-T002', 'A11', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB-T003', 'A11', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB001', 'A05', 100000, 'ISI', 'Kelas 3', '1'),
('RB002', 'A05', 100000, 'ISI', 'Kelas 3', '1'),
('RB003', 'A05', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB004', 'A05', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB005', 'A05', 100000, 'KOSONG', 'Kelas 3', '1'),
('RB006', 'A05', 100000, 'KOSONG', 'Kelas 3', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `no_rkm_medis` varchar(15) NOT NULL,
  `nm_pasien` varchar(40) DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `tmp_lahir` varchar(15) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nm_ibu` varchar(40) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `gol_darah` enum('A','B','O','AB','-') DEFAULT NULL,
  `pekerjaan` varchar(35) DEFAULT NULL,
  `stts_nikah` enum('BELUM MENIKAH','MENIKAH','JANDA','DUDHA','JOMBLO') DEFAULT NULL,
  `agama` varchar(12) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `no_tlp` varchar(40) DEFAULT NULL,
  `umur` varchar(20) NOT NULL,
  `pnd` enum('TS','TK','SD','SMP','SMA','SLTA/SEDERAJAT','D1','D2','D3','D4','S1','S2','S3','-') NOT NULL,
  `keluarga` enum('AYAH','IBU','ISTRI','SUAMI','SAUDARA','ANAK') DEFAULT NULL,
  `namakeluarga` varchar(50) NOT NULL,
  `kd_pj` char(3) NOT NULL,
  `no_peserta` varchar(25) DEFAULT NULL,
  `kd_kel` int(11) NOT NULL,
  `kd_kec` int(11) NOT NULL,
  `kd_kab` int(11) NOT NULL,
  `pekerjaanpj` varchar(35) NOT NULL,
  `alamatpj` varchar(100) NOT NULL,
  `kelurahanpj` varchar(60) NOT NULL,
  `kecamatanpj` varchar(60) NOT NULL,
  `kabupatenpj` varchar(60) NOT NULL,
  `perusahaan_pasien` varchar(8) NOT NULL,
  `suku_bangsa` int(11) NOT NULL,
  `bahasa_pasien` int(11) NOT NULL,
  `cacat_fisik` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `kd_prop` int(11) NOT NULL,
  `propinsipj` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rkm_medis`, `nm_pasien`, `no_ktp`, `jk`, `tmp_lahir`, `tgl_lahir`, `nm_ibu`, `alamat`, `gol_darah`, `pekerjaan`, `stts_nikah`, `agama`, `tgl_daftar`, `no_tlp`, `umur`, `pnd`, `keluarga`, `namakeluarga`, `kd_pj`, `no_peserta`, `kd_kel`, `kd_kec`, `kd_kab`, `pekerjaanpj`, `alamatpj`, `kelurahanpj`, `kecamatanpj`, `kabupatenpj`, `perusahaan_pasien`, `suku_bangsa`, `bahasa_pasien`, `cacat_fisik`, `email`, `nip`, `kd_prop`, `propinsipj`) VALUES
(' 001234', 'PIPIT, NY', '-', 'P', 'JAKARTA', '1970-08-17', '-', 'JL. MANGGA BESAR 13 RT.001/003', '-', '-', 'MENIKAH', 'ISLAM', '2017-10-24', '021', '47Th5Bl27Hr', 'SMA', 'SAUDARA', '-', '1', '-', 10562, 1909, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 001778', 'AHMAD FAUZI, TN', '3321030702930002', 'L', 'DEMAK', '1993-02-07', '-', 'JL. KAPUK MUARA NO.53 RT.005/004', '-', 'GURU', 'BELUM MENIKAH', 'ISLAM', '2017-11-10', '089637954460', '26 Th 2 Bl 19 Hr', 'S1', 'SAUDARA', '-', '1', '-', 25075, 1919, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 002140', 'PURWATI, NY', '-', 'P', 'JAKARTA', '1960-05-23', '*', 'JL KB JERUK RT 006/003', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-11-21', '-', '57Th8Bl21Hr', 'SMP', 'SAUDARA', '-', '1', '-', 25057, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 002551', 'WIWID, NY', '-', 'P', 'JAKARTA', '1983-03-31', '-', 'JL. LABU DALAM ', '-', 'SWASTA', 'MENIKAH', 'ISLAM', '2017-12-02', '085776217820', '34Th10Bl13Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 003173', 'DWI CAHYO AFRIANTO, TN', '-', 'L', 'PURBALINGGA', '1984-08-24', '-', 'JL. TAMAN PASIR RT.004/007 NO.10B', '-', 'GURU', 'MENIKAH', 'ISLAM', '2017-12-12', '081288654805', '33Th5Bl20Hr', '-', 'SAUDARA', '-', '1', '-', 25077, 1919, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 003232', 'NURUL FAHMI HALIM, TN', '-', 'L', 'JAKARTA', '1997-12-26', '-', 'JL. LABU RT.003/005 NO.56A', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-12-13', '021', '20Th1Bl18Hr', 'SMP', 'SAUDARA', '-', '1', '-', 19866, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 004179', 'KASIROH, NY', '3329085706830007', 'P', 'BREBES', '1982-06-17', '-', 'JL. PEKAPURAN II SONGSI DALAM RT.006/004 NO.27', '-', 'IRT', 'MENIKAH', 'ISLAM', '2018-01-11', '081586447887', '35Th7Bl27Hr', 'SD', 'SAUDARA', '-', '1', '-', 25046, 1916, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 004617', 'DIAN ANGGREINI, NY', '-', 'P', 'BREBES', '1995-04-01', '-', 'JL. KB JERUK V', '-', 'IRT', 'MENIKAH', 'ISLAM', '2018-01-27', '081808866111', '22Th10Bl12Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25057, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 004675', 'HARRIS ,TN', '3173032209900002', 'L', 'JAKARTA', '1990-09-22', '-', 'JL BADILA II/77 RT 2 RW 5', '-', 'Karyawan Swasta', 'BELUM MENIKAH', 'BUDHA', '2018-01-30', '083899515455', '28 Th 1 Bl 9 Hr', 'SD', 'SAUDARA', '-', '1', '-', 25060, 1934, 555, '-', 'JL BADILA II/77 RT 2 RW 5', 'TANGKI', 'TAMAN SARI', 'JAKARTA BARAT', '-', 5, 2, 1, '', '-', 31, 'DKI JAKARTA'),
(' 005007', 'IYUS BT. AIMAN. NY', '-', 'P', 'JAKARTA', '1951-11-27', '-', 'JL. BADILA I', '-', '-', 'MENIKAH', 'ISLAM', '2018-02-10', '085697467511', '66Th2Bl17Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25060, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 005011', 'GUNWAN HUTAGALUNG, TN', '-', 'L', 'SINDULA', '1998-06-12', '-', 'KMP BAHARI RT 04/06', '-', '-', 'BELUM MENIKAH', 'KRISTEN', '2018-02-10', '081286886725', '19Th8Bl1Hr', 'SMA', 'SAUDARA', '-', '1', '-', 84019, 1921, 1026, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 008613', 'MUHAMMAD ALVIANSYAH, AN', '-', 'L', 'JAKARTA', '2015-12-25', 'REDI, TN', 'JL. MANGGA BESAR 13 RT.005/004 NO.99', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2018-06-16', '085720221377', '2 Th 5 Bl 22 Hr', '-', 'AYAH', '-', '1', '-', 10562, 1909, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 010191', 'DEVI BURHAN, NY', '-', 'P', 'JAKARTA', '1986-12-21', '-', 'JL. TANGKI GG. LANGGAR RT.006/007 NO.26A', '-', '-', 'JANDA', 'ISLAM', '2018-08-02', '081210670727', '31 Th 7 Bl 20 Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25060, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
(' 017488', 'IIS ROSITA, NY', '3173065410810016', 'P', 'JAKARTA', '1981-10-14', '-', 'JL SAWAH LIO GG 20 N0 11 RT 12 RW 7', 'O', 'Mengurus Rumah Tangga', 'MENIKAH', 'ISLAM', '2018-12-13', '085890872153', '37 Th 1 Bl 29 Hr', '-', 'SAUDARA', '-', '2', '-', 25051, 1916, 18887, '-', 'JL SAWAH LIO GG 20 N0 11 RT 12 RW 7', 'JEMBATAN LIMA', 'TAMBORA', 'JAKARTA BARAT', 'S0002', 1, 2, 3, '-', '-', 1, 'PROPINSI'),
('000001', 'ALFREDI, TN', '-', 'L', '-', '1978-04-13', '-', 'JL. RANTE ', '-', 'PNS', 'MENIKAH', 'KRISTEN', '2017-09-14', '081342545304', '39Th10Bl0Hr', 'SMA', 'SAUDARA', '-', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000002', 'HALWA QONITA RANIAH, AN', '-', 'P', 'JAKARTA ', '2017-04-16', '-', 'JL. TANGKI GG. LANGGAR RT.010/007 NO.26', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-14', '083893384593', '1 Th 10 Bl 21 Hr', '-', 'SAUDARA', '-', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000003', 'JOHARI, TN', '-', 'L', 'SIANTAR', '1969-08-17', '-', 'JL. PINANGSIA RAYA', '-', 'PEGAWAI SWASTA', 'MENIKAH', 'KRISTEN', '2017-09-14', '081280401996', '48Th5Bl27Hr', 'S1', 'SAUDARA', '-', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000004', 'CHANDRA KUSUMA IWAN, TN', '-', 'L', 'SURABAYA', '1955-04-29', '-', 'JL. KEBON JERUK III RT.002/004', '-', '-', 'MENIKAH', 'KRISTEN', '2017-09-14', '08557829455', '62Th9Bl15Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25057, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000005', 'MOH RIFAT TADJOEDIN SH, TN', '3173081609520002', 'L', 'JAKARTA', '1952-09-16', '-', 'JL KARYA UTAMA NO.50 RT 1 RW 3', 'O', 'Notaris', 'MENIKAH', 'ISLAM', '2017-09-14', '087771651655', '66 Th 6 Bl 23 Hr', '-', 'SAUDARA', '-', '1', '-', 25019, 1911, 18887, '-', 'JL KARYA UTAMA NO.50 RT 1 RW 3', 'SRENGSENG', 'KEMBANGAN', 'JAKARTA BARAT', '-', 5, 2, 1, '', '', 31, 'DKI JAKARTA'),
('000006', 'NUR FADILAH, NY', '3172054904921002', 'P', 'BANGKALAN', '1992-04-09', '-', 'JL. LODAN RAYA RT.004/002 NO.22', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-14', '087882402009', '25Th10Bl4Hr', 'SD', 'SAUDARA', '-', '1', '-', 25081, 1920, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000007', 'BLENDA ZHEVANYA, AN', '-', 'P', 'JAKARTA', '2017-10-10', '-', 'JL. MANGGA BESAR 7', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-14', '087883875945', '0Th4Bl3Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000008', 'ARVINO FAEZA, AN', '-', 'L', 'JAKARTA', '2017-09-14', 'RENNY, NY', 'JL. KEBON JERUK XII RT.002/007', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-14', '082113571166', '0Th4Bl30Hr', '-', 'IBU', '-', '1', '-', 25057, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000009', 'MUHAMMAD ADHYA HAMDIKA, AN', '-', 'L', 'JAKRTA', '2008-08-26', '-', 'KETAPANG UTARA , KRUKUT', '-', 'PELAJAR', 'MENIKAH', 'ISLAM', '2017-09-14', '081381266617', '9 Th 6 Bl 15 Hr', '-', 'SAUDARA', '-', '1', '-', 25055, 1934, 555, '--', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000010', 'ABDUL WAKHID, TN', '-', 'L', 'BLORA', '1996-05-19', '-', 'JL KP MUKA RT 009/004', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-14', '085740912542', '21Th8Bl25Hr', '-', 'SAUDARA', '-', '1', '-', 25081, 1920, 1026, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000011', 'ADE ADIKSI, NN', '3576014809920001', 'P', 'NGANJUK', '1992-09-08', '-', 'JL. MANGGA BESAR 11', '-', 'PEGAWAI SWASTA', 'MENIKAH', 'ISLAM', '2017-09-14', '-', '25Th5Bl5Hr', 'SMA', 'SAUDARA', '-', '1', '-', 80993, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000012', 'RISZKY DIAN LESTARI, NY', '3171075701910004', 'P', 'JAKARTA', '1991-01-17', '-', 'JLN.TAMANSARI IV NO.69 RT 2 RW 3', 'O', 'Mengurus Rumah Tangga', 'MENIKAH', 'ISLAM', '2017-09-14', '081317926300', '28 Th 2 Bl 22 Hr', 'SMA', 'SAUDARA', '-', '2', '-', 25057, 27865, 18887, '-', 'JLN.TAMANSARI IV NO.69 RT 2 RW 3', 'MAPHAR', 'TAMAN SARI', 'JAKARTA BARAT', '-', 5, 2, 1, '', '', 31, 'DKI JAKARTA'),
('000013', 'SITI KHORIYATUN, NY', '3328116811800002', 'P', 'TEGAL', '1980-11-28', '-', 'JL. MANGGA BESAR IX GG I RT.10/01', '-', 'IRT', 'BELUM MENIKAH', 'ISLAM', '2017-09-14', '081285618018', '37Th2Bl16Hr', 'SD', 'SUAMI', 'SUDIRNO, TN', '1', '-', 25060, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000014', 'SUMINI, NY', '-', 'P', 'CILACAP', '1985-09-15', '-', 'JL MADU NO 38', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-14', '085779752045', '32Th4Bl29Hr', 'SMP', 'SAUDARA', '-', '1', '-', 19866, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000015', 'KIKI  FITRI RAHMATILLAH, NY', '3173035408910007', 'P', 'BIMA', '1991-08-14', '-', 'JL. TANGKI WOOD II/2 RT.10/03', 'O', 'PEGAWAI SWASTA', 'MENIKAH', 'ISLAM', '2017-09-14', '081310195346', '26Th5Bl30Hr', 'S1', 'SUAMI', 'WIDIARSO, TN', '1', '-', 25060, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000016', 'VIRGIAWAN MAHESA, AN', '-', 'L', 'JAKARTA', '2014-07-03', 'FITRI WULANDARI, NY', 'JL TANGKI WOOD III RT 12/02', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-14', '081319836177', '3Th7Bl10Hr', '-', 'SAUDARA', '-', '1', '-', 25060, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000017', 'JULIA SARTIKA OLIVIA HUTAGALUNG, NN', '3173035508948004', 'P', 'PEMATANGSIANTAR', '1993-09-14', '-', 'JL MANGGIS GG KUDU NO 4B RT 03/01', '-', 'KARYAWAN', 'BELUM MENIKAH', 'KRISTEN', '2017-09-14', '082167342621', '24Th4Bl30Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000018', 'AR RAYYAN NUR FIRDAN, AN ', '-', 'L', 'JAKARTA ', '2016-10-19', '-', 'JL. KEDESRHANAAN DALAM RT 07/05 ', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-14', '081295559065', '1Th3Bl25Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 1492, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000019', 'DARYONO, TN ', '-', 'L', 'JAKARTA ', '1991-08-05', '-', 'JL. GAJAH MADA RT09/05 ', '-', 'KARYAWAN ', 'MENIKAH', 'ISLAM', '2017-09-14', '08158157398', '26Th6Bl8Hr', 'SD', 'SAUDARA', '-', '2', '-', 79985, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000020', 'RINI, NN ', '-', 'P', 'JAKARTA ', '1993-06-05', '-', 'JL. MANGGA BESAR ', '-', 'KARYAWAN ', 'MENIKAH', 'ISLAM', '2017-09-14', '087882906266', '24Th8Bl8Hr', 'SMA', 'SAUDARA', '-', '2', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000021', 'ASRI TRISANTI, NY ', '-', 'P', 'MEDAN ', '1995-10-25', '-', 'JL. MANGGA BESAR NO 58', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-15', '08119185003', '22 Th 5 Bl 13 Hr', '-', 'SAUDARA', '-', '2', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000022', 'ROLITA', '-', 'P', 'JAKARTA', '1989-10-19', 'ROISAH', 'JL MANGGA BESAR', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '0895391641882', '28Th3Bl25Hr', 'SMP', 'IBU', '-', '1', '-', 10562, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000023', 'SATYADJAJA TN', '-', 'L', 'JAKARTA', '1966-08-23', '-', 'JL MANGGA BESAR IX', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '081932190311', '51Th5Bl21Hr', 'SMP', 'ISTRI', 'KURNIATI GUNAWAN', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000024', 'ETY RUSMINI', '-', 'L', 'JAKARTA', '1977-06-11', '-', 'JL TANGKI', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '082171480744', '40Th8Bl2Hr', 'SMP', 'SUAMI', 'PAIMIN', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000025', 'EKA SRI WULANDARI', '-', 'P', 'PEMALANG', '1995-06-27', 'EKA', 'JL LADA DALAM', '-', 'KARYAWAN SWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '083872324268', '23 Th 8 Bl 24 Hr', 'SMP', 'ISTRI', '-', '1', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000026', 'YO WOEN SHIT', '-', 'L', 'JAKARTA', '1956-11-27', '-', 'JL KEJAYA', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '0', '61 Th 4 Bl 21 Hr', 'SMA', 'ISTRI', 'JAP JE LIE', '1', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000027', 'BUNDIYAH, NY', '-', 'P', 'BATANG', '1978-08-18', '-', 'JL PS PECAH KULIT', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '0216267573', '40 Th 9 Bl 9 Hr', 'SD', 'SUAMI', 'SANTOSO', '1', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000028', 'JUWITA SARI', '3173024506810006', 'P', 'JAKARTA', '1981-06-05', ' -', 'JLN MANGGA BESAR', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '081932578922', '36Th8Bl8Hr', 'SMA', 'SAUDARA', '-', '1', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000029', 'CHAERUDIN TN', '3173031509580001', 'L', 'JAKARTA', '1958-09-05', ' -', 'JL KRUKUT', '-', 'WIRASWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '085719209138', '59Th5Bl8Hr', 'SD', 'ISTRI', '-', '1', '-', 25055, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000030', 'SITI ASMAH', '3173036712730006', 'P', 'JAKARTA', '1973-12-27', '-', 'JLN MANGGA BESAR IV', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '085210228338', '44Th1Bl17Hr', 'SD', 'SUAMI', 'A. RAHMAT', '1', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000031', 'SITI HOLILAH', '-', 'P', 'JAKARTA', '1990-08-10', '-', 'JL KRENDANG', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '087881472710', '28 Th 6 Bl 1 Hr', 'SD', 'SUAMI', 'AGUS SUTRISNO', '1', '-', 25048, 1916, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000032', 'LINA TJUN YIAN', '3173034205710005', 'P', 'JAKARTA', '1971-05-02', '-', 'JL BADILA', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '087885222071', '46Th9Bl11Hr', '-', 'SAUDARA', '-', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000033', 'ABDURAHMAN TN', '-', 'L', 'BOGOR', '1977-08-06', '-', 'JLN MANGGA BESAR', 'AB', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '085887821280', '40Th6Bl7Hr', '-', 'SAUDARA', '-', '1', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000034', 'SURIYADI TN', '-', 'L', 'BOGOR', '1989-03-23', '-', 'JL BUNI', '-', 'BURUH', 'MENIKAH', 'ISLAM', '2017-09-15', '62202374', '28Th10Bl21Hr', '-', 'SAUDARA', 'MUSTAJAB', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000035', 'SIPAH BINTI M PON. NY', '-', 'P', 'JAKARTA', '1958-09-21', '-', 'JL KEBON  JERUK', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '083890936787', '60 Th 5 Bl 18 Hr', '-', 'SAUDARA', '-', '1', '-', 25057, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000036', 'RUDI ASEP. TN', '-', 'L', 'JAKARTA', '1964-01-12', '-', 'JLN THALIB III', '-', 'WIRASWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '085110420626', '54 Th 6 Bl 11 Hr', '-', 'SAUDARA', '-', '1', '-', 25055, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000037', 'HADINOTO', '3173040305800015', 'L', 'JAKARTA', '1980-05-03', '-', 'JL ANGKE JAYA', '-', 'KARYAWAN SWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '083806233466', '37Th9Bl10Hr', '-', 'ISTRI', 'NOVI', '1', '-', 25050, 1916, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000038', 'RUSLAN ABDUL GANI', '-', 'L', 'JAKARTA', '1987-12-31', '-', 'JL MANGGA BESAR 4', '-', 'WIRASWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '089689882413', '30Th1Bl13Hr', '-', 'ISTRI', 'NOVITA', '1', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000039', 'OLVIN NY', '-', 'P', 'JAKARTA', '1995-08-14', '-', 'JL MANGGA BESAR RAYA', '-', 'KARYAWAN SWASTA', 'MENIKAH', 'ISLAM', '2017-09-15', '087887142462', '22Th5Bl30Hr', '-', 'SUAMI', 'ADE ROHMAN', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000040', 'SHO MARJOKO SUHANDA TN', '-', 'L', 'BANDUNG', '1951-08-03', '-', 'JL KEBAHAGIAAN', '-', 'PENSIUNAN', 'MENIKAH', 'ISLAM', '2017-09-15', '0816896629', '66Th6Bl10Hr', '-', 'ISTRI', 'TRESIA NY', '1', '-', 25055, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000041', 'ACIH NY', '-', 'L', 'TANGGERANG', '1993-06-24', '-', 'JL THALIB 2', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '0', '25 Th 3 Bl 28 Hr', '-', 'SUAMI', 'M. DAMHURI', '1', '-', 25055, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000042', 'SISKA, NY', '-', 'P', 'JAKARTA', '1992-11-11', '-', 'GANG SIAGA RT 013/004', '-', 'karyawan', 'MENIKAH', 'ISLAM', '2017-09-15', '089513238645', '25Th3Bl2Hr', '-', 'SUAMI', 'ardi, tn', '1', '-', 25050, 1916, 555, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000043', 'ATIKA AMIN, NY', '-', 'P', 'JAKARTA ', '1958-05-04', '-', 'JL KERAJINAN II /5 RT 04/09', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '-', '59Th9Bl9Hr', '-', 'SAUDARA', '-', '1', '-', 21527, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000044', 'FEBY ARDITA, NY', '-', 'P', 'JAKARTA', '1999-02-21', '-', 'JL TANGKI WOOD 1 RT 008/003', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '083890705847', '19 Th 9 Bl 20 Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25060, 1934, 555, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '-', 31, ''),
('000045', 'CICIH RIYANI. NY', '-', 'P', 'CIREBON', '1997-07-29', '-', 'JL TAMAN SARI 4', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-15', '085774333553', '20Th6Bl15Hr', '-', 'SUAMI', 'CHANDRA TN', '1', '-', 25057, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000046', 'GIBRAN PRAYUDA . AN', '-', 'L', 'INDRAMAYU', '2015-09-18', '-', '', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-15', '082312177602', '2Th4Bl26Hr', '-', 'AYAH', 'SUMADI TN', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000047', 'ADHYA ANINDITA, AN', '-', 'P', 'JAKARTA', '2015-03-08', 'CHAIRUNNISA, NY', 'JL KESELAMATAN RT 013/007', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-15', '081298861568', '2Th11Bl5Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 555, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000048', 'RENI RAMADAYANTI, NY', '-', 'P', 'JAKARTA', '1998-01-23', '-', 'JL. KP BANDAN RT.13/02', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-15', '081296598086', '20Th0Bl21Hr', 'SMP', 'SUAMI', 'MUHAMMAD DEDE RACHMAN, TN', '1', '-', 25081, 1920, 1026, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000049', 'RENDRA TAUFIK, TN', '3521092404840001', 'L', 'JAKARTA', '1984-04-24', '-', 'JL. MANGGA BESAR IVG/34', 'O', 'PEGAWAI SWASTA', 'BELUM MENIKAH', 'ISLAM', '2017-09-15', '085224049394', '33Th9Bl20Hr', 'S1', 'SAUDARA', '-', '1', '-', 80993, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000050', 'SANGAPTA SEMBIRING , TN', '861112220855', 'L', 'MARDINDING', '1986-11-04', '-', 'JL SEMPOR I NO 6 RT 003/001', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-15', '-', '31Th3Bl9Hr', 'S1', 'SAUDARA', '-', '1', '-', 49349, 3936, 267, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000051', 'NATALIA, NY', '3173045412880002', 'P', 'JAKARTA', '1988-12-14', '-', 'JL. KRENDANG TIMUR GG 2 NO.4D RT.10/01', 'A', 'PEGAWAI SWASTA', 'MENIKAH', 'KRISTEN', '2017-09-15', '087877636063', '29Th1Bl30Hr', 'S1', 'SAUDARA', 'EDWIN ERGI', '1', '-', 25048, 1916, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000052', 'IRFAN FIKRI, TN', '-', 'P', 'JAKARTA', '1981-02-26', '-', 'JL. CILEDUG RAYA GG M.JANI NO.25 RT.01/03', '-', 'JURNALIS', 'MENIKAH', 'ISLAM', '2017-09-15', '083813899700', '37 Th 5 Bl 4 Hr', 'S1', 'SAUDARA', '-', '1', '-', 38474, 1886, 6808, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000053', 'LIEDWINA AZHARENKA NOVOTHZA, AN', '-', 'P', 'JAKARTA', '2013-11-08', 'NURJATI, NY', 'JL MANGGA BESAR IV UTARA RT 09/08', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-15', '081287501780', '5 Th 4 Bl 4 Hr', '-', 'IBU', '-', '2', '-', 80993, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000054', 'KIE ANITA CAROLINE, NY', '3173036811480002', 'P', 'JAKARTA', '1948-11-28', '-', 'JL KEMENANGAN V GG 1 RT 02/03', 'O', 'IRT', 'MENIKAH', 'BUDHA', '2017-09-15', '081311228910', '69Th2Bl16Hr', 'SMA', 'SAUDARA', '-', '2', '-', 25061, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000055', 'BY NY RENI RAMADAYANTI, AN', '-', 'P', 'JAKARTA', '2017-09-16', 'RENI DAMAYANTI, NY', 'JL KP BANDAN RT 13/02 ', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '081296598086', '0Th4Bl28Hr', '-', 'IBU', '-', '1', '-', 25081, 1920, 1026, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000056', 'KWE LAN HOA, NY', '3173035709600002', 'P', 'JAKARTA', '1960-09-17', '-', 'JL. TANGKI GG. LANGGAR RT.004/007', '-', 'IRT', 'MENIKAH', 'KRISTEN', '2017-09-16', '08128058417', '58 Th 6 Bl 10 Hr', 'SD', 'SAUDARA', '-', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000057', 'M LUTHFI WASISTHA, TN', '-', 'L', 'MAJALENGKA', '1994-11-24', '-', 'JL. CEMPAKA PUTIH TENGAH RT.011/004', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '085770088413', '24 Th 5 Bl 24 Hr', '-', 'SAUDARA', '-', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000058', 'HENI LUSIANAH, NY', '-', 'P', 'JAKARTA', '1982-10-02', '-', 'JL. TANGKI WOOD III RT.012/002 NO. 4', '-', 'IRT', 'MENIKAH', 'KRISTEN', '2017-09-16', '081311133670', '35 Th 5 Bl 8 Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000059', 'RINA, NY', '1801074107910002', 'P', 'LAMPUNG', '2017-09-16', '-', 'JL. RT.005/006', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-16', '085783581454', '0Th4Bl28Hr', 'SD', 'SAUDARA', '-', '2', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000060', 'IWAN HERMAWAN, TN', '3175012504630006', 'L', 'SUKABUMI', '1963-04-25', '-', 'JL. KB. KELAPA TINGGI RT.009/008 NO.11', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-16', '087776654540', '55 Th 10 Bl 9 Hr', 'SMA', 'SAUDARA', '-', '2', '-', 24972, 1903, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000061', 'NAILA AINAYA FATHIATURAHMA, AN', '-', 'P', 'PURWOREJO', '2017-02-08', '-', 'JL. MABES IV RT.003/005', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '087877008567', '2 Th 0 Bl 27 Hr', '-', 'SAUDARA', '-', '2', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, 'PROPINSI'),
('000062', 'APRILIA ANATASYA, NY', '3172026904971001', 'P', 'JAKARTA', '1997-04-29', '-', 'JL. NELAYAN TIMUR RT.008/007 NO.33', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-16', '081284458121', '20 Th 10 Bl 22 Hr', 'SMA', 'SAUDARA', '-', '2', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000063', 'HAIKAL FARISBALFAS, AN', '-', 'L', 'JAKARTA', '2015-06-06', '-', 'JL. TAMANSARI RT.007/003 NO.10', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '085779133895', '2Th8Bl7Hr', '-', 'SAUDARA', '-', '2', '-', 25057, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000064', 'SITI KARIJAH, NY', '3173064808931002', 'P', 'BREBES', '1993-08-08', '-', 'JL. MENCENG KOMPLEK KEBERSIHAN RT.002/004', '-', 'WIRASWASTA', 'MENIKAH', 'ISLAM', '2017-09-16', '08138156940', '24Th6Bl5Hr', 'SD', 'SAUDARA', '-', '2', '-', 25073, 7335, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000065', 'HUBERT TJIU CHAI KHIANG, AN', '-', 'L', 'JAKARTA', '2011-05-07', '-', 'JL. APART RUSUN TAHAP 3', '-', '-', 'BELUM MENIKAH', 'KRISTEN', '2017-09-16', '081289813267', '6Th9Bl6Hr', 'SD', 'SAUDARA', '-', '1', '-', 81438, 1908, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000066', 'FINA SUSANTI, NY', '-', 'P', 'JAKARTA', '1984-03-13', '-', 'JL. KARTINI RT.001/002', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-16', '085848127493', '33Th11Bl0Hr', 'SMA', 'SAUDARA', '-', '2', '-', 8030, 1909, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000067', 'TATA WIGUNA, TN', '3601310207870003', 'L', 'PANDEGLANG', '1987-07-02', '-', 'JL. KP. CIMALAJANG RT.008-02', '-', 'WIRASWSTA', 'MENIKAH', 'ISLAM', '2017-09-16', '-', '30Th7Bl11Hr', 'SMA', 'SAUDARA', '-', '2', '-', 25699, 3876, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000068', 'ALVIAN WIRA ATHAYA. AN', '-', 'L', 'JAKARTA', '2016-03-09', '-', 'JL KEUTAMAAN DALAM', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-16', '085694965520', '2 Th 1 Bl 4 Hr', 'SMA', 'AYAH', 'BAMBANG MURYANTO TN', '2', '-', 25055, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000069', 'KRISTIN', '-', 'P', 'TANGGERANG', '1994-12-27', 'CHATERINA', 'JL PANGEN JAYAKARTA NO 12  RT 001/002', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-16', '081311238120', '23Th1Bl17Hr', '-', 'IBU', '-', '1', '-', 80993, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000070', 'JIBRIL KHADAFI PRATAMA AN', '-', 'L', 'BANDUNG', '2014-11-13', 'NURAENI ELI WAHYUNI', 'JL MANGGA DUA', '-', 'KARYAWAN', 'MENIKAH', 'ISLAM', '2017-09-16', '0878800207800', '3Th3Bl0Hr', '-', 'IBU', '-', '1', '-', 25062, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000071', 'ZAYN KAL KAUTSAR, AN', '-', 'L', 'JAKARTA', '2016-09-30', '-', 'JL PETOJO BINATU II NO.21B RT.08/08', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '083804331721', '1 Th 7 Bl 20 Hr', '-', 'SAUDARA', 'FANDHY RAMADHAN, TN', '1', '-', 25016, 1910, 18901, 'PEGAWAI SWASTA', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000072', 'FERNANDO HO, TN', '3173030508980003', 'L', 'JAKARTA', '1998-08-05', 'BUN LINAH, NY', 'JLN MANGGA BESAR IX NO 32 BB RT 7 RW 1', '-', 'Pelajar/Mahasiswa', 'BELUM MENIKAH', 'KRISTEN', '2017-09-16', '0216497565', '20 Th 2 Bl 26 Hr', 'SMP', 'SAUDARA', 'HO SEM LIONG, TN', '1', '-', 25062, 1934, 555, 'PEGAWAI SWASTA', 'JLN MANGGA BESAR IX NO 32 BB RT 7 RW 1', 'PINANGSIA', 'TAMAN SARI', 'JAKARTA BARAT', '-', 5, 2, 1, '-', '', 31, 'DKI JAKARTA'),
('000073', 'SUWONO MARTOMI, TN', '-', 'L', 'BANJAR NEGARA', '2000-07-27', 'TARSUMI, NY', 'JL. MANGGA BESAAR XIII/19 RT.06/03', '-', 'BURUH', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '08788492350', '17Th6Bl17Hr', 'SD', 'SAUDARA', 'HERMAWAN, TN', '1', '-', 25011, 1909, 18901, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000074', 'MARTIN WIJAYA,TN', '0', 'L', 'TANGERANG', '1993-05-21', '-', 'JL MANGGA BESAR 9 RT 001/04', '-', 'SWASTA', 'BELUM MENIKAH', 'KRISTEN', '2017-09-16', '082210004982', '24Th8Bl23Hr', 'SMP', 'SAUDARA', '-', '1', '-', 19866, 1934, 985, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000075', 'DINDA TRESNA ADHITAMA ,NY', '3175016304930004', 'P', 'SUKABUMI', '1993-04-23', '-', 'JL.KEBON KELAPA TINGGI NO.11 RT 9 RW 8', 'O', 'Mengurus Rumah Tangga', 'MENIKAH', 'ISLAM', '2017-09-16', '085718189754', '25 Th 6 Bl 8 Hr', 'S1', 'SAUDARA', '-', '1', '-', 24972, 1903, 1611, '-', 'JL.KEBON KELAPA TINGGI NO.11 RT 9 RW 8', 'UTAN KAYU SELATAN', 'MATRAMAN', 'JAKARTA TIMUR', '-', 5, 2, 1, '', '', 31, 'DKI JAKARTA'),
('000076', 'HELMY SAID, TN', '3173032604820004', 'L', 'JAKARTA', '1982-04-26', 'SITI SJAIFUNNISAH, NY', 'JL. KEBO JERUK XI/59 RT.05/05', 'AB', 'PEGAWAI SWASTA', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '081299408200', '35Th9Bl18Hr', 'S1', 'SAUDARA', 'JACKY, TN', '2', '-', 25057, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000077', 'ROSADAH, NY', '3173037007660004', 'P', 'JAKARTA', '1966-07-30', '-', 'JL KEBON JERUK XIX RT 06/09', '-', 'IRT', 'MENIKAH', 'ISLAM', '2017-09-16', '081315384560', '51Th6Bl14Hr', '-', 'SAUDARA', '-', '1', '-', 25057, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000078', 'NADIA NURSYAMSIAH, NN', '-', 'P', 'JAKARTA', '1995-02-06', '-', 'JL MANGGA BESAR II', '-', 'KARYAWAN', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '082213404277', '23Th0Bl7Hr', '-', 'SAUDARA', '-', '1', '-', 80993, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000079', 'DENI, TN', '3173030412790003', 'L', 'TASIK MALAYA', '1979-12-04', '-', 'JL KEBON JERUK XIII NO 40 RT 04/07', 'O', 'KARYAWAN SWASTA', 'MENIKAH', 'ISLAM', '2017-09-16', '081310106916', '38Th2Bl9Hr', 'SMP', 'ISTRI', 'YULIA, NY', '1', '-', 25057, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000080', 'ALMIRA ZASKIA, AN', '-', 'P', 'JAKARTA', '2008-08-18', 'FATHIA YUSRA MULYANI, NY', 'JL BLIMBING II NO 8 RT 04/04', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-16', '0895332513763', '9Th5Bl26Hr', '-', 'IBU', '-', '1', '-', 19866, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000081', 'SYAKIF ARRASYID, AN', '-', 'L', 'JAKARTA', '2013-02-26', '-', 'JLMANGGA BESAR IV S NO 07 RT 01', '-', '-', 'BELUM MENIKAH', 'ISLAM', '2017-09-17', '087884381585', '4Th11Bl18Hr', '-', 'AYAH', 'ABDUL HANIF GOZALI, TN', '1', '-', 80993, 1934, 18887, '-', '-', '-', '-', '-', '-', 5, 2, 1, '', '', 31, ''),
('000082', 'NURIMAN, TN ', '-', 'L', 'PADANG', '1986-03-26', '-', 'JL. BUNGA RAMPAI VI RT 01/08 ', '-', 'KARYAWAN ', 'MENIKAH', 'ISLAM', '2017-09-17', '081281814547', '31Th10Bl18Hr', 'SMA', 'SAUDARA', '-', '1', '-', 24951, 1899, 1611, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000083', 'IWAN WIDJAJA, TN', '-', 'L', 'JAKARTA', '1948-10-29', '-', 'JL. TANGKI GG LANGGAR RT.002/007', '-', '-', 'MENIKAH', 'KRISTEN', '2017-09-17', '0', '69Th3Bl15Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25060, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000084', 'YAYAN SUPIANI, NY', '3216196004880002', 'P', 'KARAWANG', '1988-04-20', '-', 'JL. MANGGA BESAR 9 ', '-', 'PNS', 'MENIKAH', 'ISLAM', '2017-09-17', '087881577810', '29Th9Bl24Hr', 'SMA', 'SAUDARA', '-', '1', '-', 19866, 1934, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000085', 'BASRIANDI SIREGAR, TN', '-', 'L', 'JAMBI', '1979-08-18', '-', 'JL. J RT.003/010', '-', 'WIRASWASTA', 'MENIKAH', 'ISLAM', '2017-09-17', '089622636638', '38Th5Bl26Hr', 'SMA', 'SAUDARA', '-', '1', '-', 4092, 1891, 1, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, ''),
('000086', 'DEVITA URMILA, AN ', '-', 'P', 'JAKARTA ', '2009-04-21', '-', 'JL. KEBON JERUK RT 06/09 ', '-', '-', 'MENIKAH', 'ISLAM', '2017-09-17', '085811690469', '8Th9Bl23Hr', 'SMA', 'SAUDARA', '-', '1', '-', 25057, 1934, 18887, '-', 'ALAMAT', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', '-', 5, 2, 1, '', '', 31, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `quota` int(11) NOT NULL DEFAULT 1,
  `email` varchar(100) NOT NULL,
  `token_notification` longtext DEFAULT NULL,
  `device_notification` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `token`, `quota`, `email`, `token_notification`, `device_notification`) VALUES
(1, 'pol', 'eb9d0aad0dcae1a784c00f35a8779a38', 1, 'djyaul@gmail.com', 'eKgMSB5kXeU:APA91bH0gBMQ5fh0-oySAY3tCFMCCp_rTILiT5OhjGluVyBCwo7AqnqXTLzMirMBlCHWagdaRC4tPYtTyT89exOpbUNAjYm1d5Jsuz8j5u5Ck0klVbrvnVQwfeZfXr3fhRpLhFhQJCFm', NULL),
(3, 'ziaul haq', '9b2a60510473735f7899e1770da94cc8', 1, 'ziaulhaq@mhs.dinus.ac.id', 'gerherherh', 'erherherhre'),
(4, 'sodara', '075ae589d72a757a4ef976a53720b809', 1, 'sodarawin@gmail.com', 'c13asPTxCWQ:APA91bESrSu6nC4Oj7e3mCKuaf3V8mc7X96FOZ0p87iclata0oyQxuGeHZ6ub5LzcOBsIcHluETl654Lb-Bahc6SBhEeY26TmXvY70ADOy-ARe-3PagLaCRipkYF2kuxpPmQdhpX88LE', NULL),
(5, 'Wanda Riswanda', '1bbf9b85d812b6e974a4f179615854e4', 1, 'wandariswanda1026@gmail.com', NULL, NULL),
(6, 'Rega Febriana', 'e02887c47979bfca76a7fe60b34c905f', 1, 'rega.pebriana@gmail.com', 'eSWfYUoN9sA:APA91bHwaKst0DgHnzIaNA5Wj0UQ6aRSQbwkOYx3NBGUf3OQDCn78FEfXi1CQDqh3vsouwNfg5pCnruE0L3OD4xosLA5yVC2LKKFS-iq-w84jDrpVKXyt5QTRiPklvFPVP19JOJm3pmr', NULL),
(7, 'salsa aprilia imani', '0dbe88ca1085dd9d2ce0a08924f8b707', 1, 'salsaaprilia8@gmail.com', NULL, NULL),
(8, 'Muchamad Iqbal', '5e8a8d63606caa703dbf7f1c24691058', 1, 'iqbbaly@gmail.com', 'fGl4vn7olfM:APA91bHXUaBoM_uWkEBwn9zfY8gv1GD8VsJHVRnGlDHnZcdcFy1Yl04gzW3p_H9b4Mgk6M-2lXCeHBeO20nnIvA_dMwb5i1H3KAjB_2A7I1gWKhCnsNC-SJ1eEbrBZ6wZdIthg9s3Cma', NULL),
(9, 'Stefanus agung', '7edf79a2c0e8464d5bac37ab6cd6887b', 1, 'chris.kompor@gmail.com', 'dpoOHqLUZ-I:APA91bGuJV_4XXKNVDsk2o2Ca1iHEEff5uEK9eBKrB1haBsMUhfED2QoXuWhpjtzcSl4QkAknVdDxhpniJ8UV_yGkdFz7XdSyKEsJXHAJzSaEHSeuvQRa_eOKo4PzUc-oU4fQHzrTWMY', NULL),
(11, 'anggi mardiyanto', '0f6b916fb1bfe154f73decb4cc7abe65', 1, 'mardiyanto.anggi94@gmail.com', 'ceKGbRsu-TI:APA91bE91AJBlVaC9_EZjcU-u8FFTKXhd1j4OCFmKjIvmriTYDnpTWAMTIQGfVY8HVt6JMps4mkiUiOJC4j9sC9sMSV-E2jq59alI6Zb9piaAPHvGdzBKNiK6BSiehL81VOewWYsyMHN', NULL),
(12, 'Fitri Andriasari', 'c15eb77dfda28953d1174d58d108121f', 1, 'andria1303@gamil.com', NULL, NULL),
(13, 'maedah', '4a2cc9de68e75ba2c38273b3105316b4', 1, 'maedah.medyana@gmail.com', NULL, NULL),
(14, 'irwan irmawandi', 'a5a96175a9c11ea00cf5b3703906ee5c', 1, 'irwanirmawandi1994@gmail.com', NULL, NULL),
(15, 'Aep Saepulloh', '7722c30514d4a0cb261fe457705dd812', 1, 'leuweung.oko@gmail.com', 'c7jDTnxK6eQ:APA91bF8tobcs8ZUc3s3V0hS0Ociy-zy2q410DlpVpHmFoSvINwGNneivJp_a2gDnH6xAef_V82utebj9TdeVJ5cHhYS7UU9kEsjFo1OdXAf-GT_4ZQoDKXFJ11QFjkvQpBvXKXGrY70', NULL),
(16, 'ricca amelia', '1f06f23bdfc113751826ef2fb0d547d8', 1, 'ricca.tkbu@gmail.com', NULL, NULL),
(17, 'bang amoz', '1d2d39cfe44d53971be6522da155d1ef', 1, 'agungmozin@gmail.com', NULL, NULL),
(18, 'agus', '2160c924dc2d6402adcbd3f2502b9bd0', 1, 'wealthyas999@gmail.com', NULL, NULL),
(19, 'TATANG SOPYAN', '356b846cad7cf7e56881978b52e6ef21', 1, 'tatangsofian7@gmail.com', 'eM1s0jcEPOc:APA91bEvsSEA-ARtRuql5-pIt1bBBbzoimAjyBxcvu6yA6ISxtWbImtYyFKJayVbnURzA_FFXDNI47AvM2iDLzx-H313OPbVincujWqTgB9VTe7c2ClSWV62mi8bAieyRi0BCr0ar0jS', NULL),
(20, 'rosy kusuma', '455eb15b37a1b6db4f3ac1eadbe03e03', 1, 'rosy.kusuma@gmail.com', NULL, NULL),
(21, 'UMMI Dina', '20bba9c1b37082270936fe60c70e78cd', 1, 'dinaummi91@gmail.com', 'fxVEIyQuo8I:APA91bGyfsV3KR9wkOlyk4ZAAoLwDD7rh7IA3KmqUeyHv0VZcJeKswch9WhUnHyVSuNZyM5wm6AKq9e00HXhsDfSEkkf0JfMey1OEsfNiQKG7ut_lN1CUpv6gdGhXVb4SE0uTth4Wa0S', NULL),
(22, 'Ismail', 'c80acd45c24d2a950b4af6f05f4fbb63', 1, 'bangismailwae@gmail.com', NULL, NULL),
(28, 'Satria Wibowk', 'a5cb2bc245ca5899ecdc6d8abf39e3b9', 1, 'satria.nux@gmail.com', 'cnT-kKvnKhM:APA91bF5SjUv75OR4gON8hwog1l86TtJ_PrSAddBHhRvf-CdwECkCC6rasvV7lPUsJBePo7UxfElf-Ef_6WavZxMNVbT6SPclPk5g5-bTrtAnrsVeNJx7IaC644TeulbKHlla4e66-i8', NULL),
(29, 'Khorianis Malina', 'a54119a4d96ae9e17d8c3720966d8fe1', 1, 'kaori.ozora@gmail.com', 'eKHZFzmH_vI:APA91bHeBzedNT05XcInXaiWXB1AX-PMZr6v5Hz86OX-5-H8kzsUorMWtQLsIU5AlpEkAeA-ExjCm7F7vAc4qtKmtIDJ8lRwPVw9jV0jGkMHONjLTEYySvVIeRcEr5QO7FF4QCP2qFlE', NULL),
(30, 'Rosya Ruwaidah', '52261e4a5b211ec06c416bc9df4514f2', 1, 'bang.ismail.wae@gmail.com', 'eC2rLWUEO80:APA91bHGn72U8we4U4n715Sa1V2SawWXF3erYd2iIGTnflw3REXFfASnKKkeHfvotiYjiv6GgvXdfMM5G00inof1pPbA84PXCBV-1KkbSSlnaG1p1jbN6FVcXXYdsqsL_goiytyvAIXC', NULL),
(31, 'sugeng priwanto', '78dbfb5097a99ff4496a516e8b42337a', 1, 'sugengpriwanto72@gmail.com', 'dN10t88O8Fo:APA91bFqMH7VKeUbxtdhD1ygMYiDIbfyuFqS-X_ObRNQbC9kKTqGvLiXoKHOVRxTSXgZHmwUtwxbq7ZyWQbQvcbQPIH_wnqwixjG4p0G9wFdhrvAr7g6kdia5thYxya1tSReQYxhkr78', NULL),
(32, 'Desy Arisandi', 'fc3ac8fcad216db32d637d4c34e71db3', 1, 'arisandi.desy.da@gmail.com', 'fPH0HnaUQVU:APA91bEAN_LNyChB6oXuq9f30yTT3MhyIeZbHruXdCVIB05Fih6LEffYZXYylFDqeRtjX8NGwZPZHMeOg41Qb6HNmKJr4EFFv3aL8C3Hvp_J3pfLk00uKlW1VxELTr1Fl96BobcA4kQv', NULL),
(33, 'redika', '3e4f91b00b9b97742d748f70f3bd7b3f', 1, 'redikatokkotak@gmail.com', 'cGHB1EK8gco:APA91bGwr0HC29CzlDBKF1B7AnE1LJe1-AvwYrz5B_I3ZC55i1JC3BltOhpxGvqe69Y8z1dyPNpS2EAeL1KDEINtzNPXPYOfGE8YCg_uFR2wbcf5skAeSj72uAIBG_F2B0bo4wJvkd3l', NULL),
(34, 'Sugiono', '22405c901c7b248b3217a534d1e4dbeb', 1, 'Sugickalchantara1989@gmail.com', 'euZCCUDSF48:APA91bEo5bOk9Do7zTggeqTvAG6vhxEuolxBKTXpItzcP4OD4LOz_pCh7gmak5EtE4PUh-4HAdNIGGGrSjo0ewgk9sdTAoXBUA8Dd2dY-xxzuxC6cEOmuvuCXx9LGL__9dgwPerOrNUo', NULL),
(35, 'meyhoa dermawan', 'c5061ae6a6fe67abebfe4140cddbacc9', 1, 'meyhoa18@gmail.com', 'eIYeNq_Bmk8:APA91bG6NZ-JwwNCZ8dNZqgWXPPn-0_fqAmAdqWuFRaiDlYIU9XGRsVd5Hw9d99Y_L8ex06HGdBMcpXMqnKf0VsQukrkH7iitLPcoVV9qR7A334RLrZxaKlxzALbj2baiIPf7DY09ULV', NULL),
(36, 'Putramas Jokopratomo', 'e5d8b2759944ce1399c7ce46d6fcf12e', 1, 'Putramas.Jp@gmail.com', 'er4GzkxjTcc:APA91bFOpypKkM1-J5UbWj-CQigY5qc9XAcMLs-rTaJpIZoLJwLmmE8MHcgpkXwjoFxw_OyjKyirnLf8Ih3v51YF3B--MxmrdUWgcnoyoXPg6g32Ava6PJbpVZ3CvdaqqXmZURyo-sqh', NULL),
(37, 'Nova Yuliana ', '7630666a94366754602e0e244cd665ba', 1, 'novay248@gmail.com', 'eFbsJxpb7bQ:APA91bGNnGLjPPUBdsfJ6HiHm-XzfV5WO7mCBXRushieb94RHokV-DMxyEPtyV2m6Dtg-6nemnqp08MVJPN693Z0M3CXQlKMwY3himM8BH319rPvmqwbZMaeSuARRGRc1YB6W7Hv6tzI', NULL),
(38, 'Winda Hairani Purba', '3f340430dea5520ea85fa9172b9b3d30', 1, 'winda_hairanipurba@yahoo.com', 'cbe8_jwDWgY:APA91bH292Nry-5G0eBjZp2t_Dgad_lTkT3MGxHvONYWw7aR8cwS2u9jpvLUXO20EI-ZiDQOPvtReKXBE5LMwuV8NXtnWvV4_hhrgIUwlq7R_fEzn2uW6Yp2SVUsopM_yj8hOJFNc6GD', NULL),
(39, 'Sisilia Nike ', '886bd7ca79b18ee70492d45cc096fb64', 1, 'nike.sisilia@yahoo.co.id', 'chsWj28cP7M:APA91bECFYBjr4s22ZE4QFNBT9krR1z-kFN-GrZ7uT_odhKDFhnF7R9v3IH_5JkbzEHxOjVFbdnYPMv-Is2TlbuNxh-aU13sfinRGlSBScVp5bLJz6Iv-HxOFAph6ubHJYUD_Ch8gMgI', NULL),
(40, 'tan mudji ngestuwati', '4b213b036c569242524f141afb6a17c5', 1, 'susy.mudji@gmail.com', 'fzhGep-CHwM:APA91bGoZDX6DHwARDV1keCpHlofLn9gJXq78fRNRyfJpgNgWd-G3HiZ-RN4x6q2zG4Lbc1S4Z4GULtwQtnLWtfQiRcZemWHM0Xx0P8I-yV5zZpxZp_3CQd0j-CVAKXsBaXr7-HvhsYY', NULL),
(41, 'Dwi Aribowo', 'd987ca3a467093686bfea6ba63f45d43', 1, 'it.pkmcengkareng@gmail.com', 'do1R-axhIhA:APA91bGSX90JbyF-Kw-CFtgSddULX6QV1yy8bo9oFCxjbhdcsGgNJUFsYheI1wRzA1OHR9qh7hjc4-XtWMtCN2g8MP2bl9W5X36sjnbJOfJIwY-ACSwpCyaHC426ulGsYo473NrWN5fY', NULL),
(42, 'ridhafika', 'b4eb3abb2a399c9777ad1d02178f227e', 1, 'ridhafikaulfa@yahoo.com', 'cjtSI25gG6I:APA91bEzUFf9Gh2YRtW6F9vGqfkTNuyFIGGkoN3N46V-SHHFV17WYfpnQSiYmuUoObI4SleayJSuWCAWxTJycE4JEqx9OLGl5G0V4l0meYD9VhJVdmxta6sTWNLNSLI4oCGDRtkBc6g2', NULL),
(43, 'Daniel Roy', '2e73a2b47b72f1831061132196509273', 1, 'daniel31roy@gmail.com', 'cnUCjWn5h7M:APA91bGvZb_MIRh1tFxGZKMoraBAOpwwedtweHDGpH8ZJzgOqokUvU_GivkCuXavT7m0UxdBpxw7iGyaVDcfj60QGaiHkBEzbjHfLiaBm3ZunadJSoi3xWPJfjEa6g6bgtmQxo4Ywt-W', NULL),
(44, 'nana', '0ce6fb061637cb7e86f64796ef736835', 1, 'nana_sukarna25@yahoo.com', 'crhoeMuoFtE:APA91bHE2upLv28_OZwWv2oRbpt5X18G0irf7TOkAhS8VvznNQ-lq_KiDk3yoKuM2NQAwsXMuYeRFF-ytXdh9HljGuwNW_2eregP_eqgSC7n9sooUPyEoWZt17CC94UtyPOfVMyStFdw', NULL),
(45, 'mohamad ikbal', '9e04b2a18aae0342a9da62205409904b', 1, 'ikbal160682@gmail.com', 'fX2BVbWmNvE:APA91bH_Iifv6mlutI5KAu5W5HMP3smM0oITqE2FPXkAoPX-JNhGkHlr74PIxUVraBOVM7Jne4pBtyGrVc9hn_GI2REA4EZQmRTWuubhpOML4u6EVhvyk6sjpaNXyl2kYiRJISu71Z45', NULL),
(46, 'Fadillah Amin', '4777f9c37307be29b693971163980816', 1, 'fadillah.amin@gmail.com', 'dpCjI_ULVeQ:APA91bENTcSWyIF8SNk8pSaSWqMbl5BUvZ2361ccWOyIXXISkvajfvPMLA_GlO6QVYz4Yw90WCoK73KTf2YKXTeWRxChCzonxYYP0foIPvUxf8XbhJ9A0JS4Un92k_pL0DfXBRMbBc5D', NULL),
(47, 'saksi', 'b774ed5a382a9d9058dc90f27889a4f3', 1, 'saksiwira1606@gmail.com', 'ds21S7w6gi0:APA91bESMKlgIeubwmniO9j_V4pAbXpgXKQOC7ce6iexe2D3bh3gjOt8XXxKYoaokdfU_6XGPltQCvNUjWhkJypo--8DcJKewsSaWU01dOX5kenUkOjfuqtZ9dnr887ikaFP8naxvuaW', NULL),
(48, 'iya surya', '9043ebcfa9929b20595257229fcb20e2', 1, 'iyasuryaofficial@gmail.com', 'fMhI6ALDULE:APA91bETpTOV0VB7WpxrFRze1rN6wFXv831-AGYEryNz9K6BhiI0g4r0DBQ9lOpRfVdPVB2VRwfhuqeefubNe-oj3PloxRfPQW60uc6Lqoc_W1OwwMis6lQBf9yTQiguMuxu6ZiOk8mG', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bangsal`
--
ALTER TABLE `bangsal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rkm_medis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
