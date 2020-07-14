-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Jul 2019 pada 15.58
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
-- Database: `u7120973_rsud_antrian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` varchar(36) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `device_user` varchar(150) DEFAULT NULL,
  `ip_address` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT 1 COMMENT '0 = "Tidak aktif", 1 = "Aktif"',
  `access_group_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `hash`, `no_telp`, `images`, `last_login`, `device_user`, `ip_address`, `is_active`, `access_group_id`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`, `status`) VALUES
('368D6EB5-9993-8BC5-5D5E-F135063A3A2B', 'Loket 6', 'loket6@gmail.com', '$2y$10$MwmG7PIVOVV6EM9qorOtl./BhK2M40pF7wRGzW4DGWtQq3x6/.c2.', 'YKE3uMSkqFT4Jz8ZEqovjROxHaSTEKqaC4dW2A0NAT4DFbTOQkAeJdZTvJKc9K9YS0K7mHBAV4943bZm0aEKNigMrfoyBvtPBhGkakFe3pXzkAl2vMymBtUdFqtzs9bT', NULL, NULL, '2019-06-28 15:02:43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:56:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL, 1),
('39EE8D05-3039-E1CD-C27E-FA525488D305', 'Loket 5', 'loket5@gmail.com', '$2y$10$h/euzF8hZVE6myppWG2dUeGtndZX0x9VvHifTwiMwfRodcYSwiWQa', '9PeW0xS4dJ8weFUuNoWvgeMoR2TR0INEaSrU6CjW8LPz8qCqujyj0WQcHyslCKAK37udfMvJOontQOpwNrhUkYEnAhzkV67k3fbAGUgUdyMPuds9xNKMgOKHZTbzGIkG', NULL, NULL, '2019-06-30 20:49:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:55:56', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL, 1),
('5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'Loket 2', 'loket2@gmail.com', '$2y$10$pg157olQRof6tlEF2C7Kbe5p3Giurs.UUw0yBBj04g5mDqyLp42Zi', 'OykCP9th1ti2TH8WXVoTDZVtMr1F88LZqzC5RhtubWgtRmg8LuaHHZYyJGJldY461Pa4vvttWhMlzUNU97fbITEqOV5hDJImEpwpa9FOmZbpbbZ2JvrhcxjW0M0uYxZ5', NULL, NULL, '2019-07-23 12:17:54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 0, 1, 3, 0, '2019-05-22 22:49:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 12:34:13', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 0),
('5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'Loket 1', 'loket1@gmail.com', '$2y$10$pg157olQRof6tlEF2C7Kbe5p3Giurs.UUw0yBBj04g5mDqyLp42Zi', 'OykCP9th1ti2TH8WXVoTDZVtMr1F88LZqzC5RhtubWgtRmg8LuaHHZYyJGJldY461Pa4vvttWhMlzUNU97fbITEqOV5hDJImEpwpa9FOmZbpbbZ2JvrhcxjW0M0uYxZ5', NULL, NULL, '2019-07-23 08:02:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 0, 1, 3, 0, '2019-05-22 22:49:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 08:03:21', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 0),
('5CFF15F6-82AB-0676-3522-44169B0CA6D3', 'Loket 4', 'loket4@gmail.com', '$2y$10$aY7VZ5noGIhpEyRonKfL0uSX1Ex6Fny2eJznaq0Q12/tmNaaK2E2a', 'WCpnasxKPRzIRywL8zdHZxLAVSZ4BOIX6y9BShRcL8NBYG2wkoV6f020zvXHDpGTVqaKRjes3v7fLFEP7Gdb1cW1ZRNrNJK7kG9HB0O0XDf0ddgBUY3HnqDNntktItZH', NULL, NULL, '2019-07-02 11:03:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:55:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-02 11:09:56', '5CFF15F6-82AB-0676-3522-44169B0CA6D3', 1),
('B5D6AF2A-149D-5C4F-8721-528A47004F88', 'Admin', 'admin@gmail.com', '$2y$10$XPt34RLI2U8p6//3rZudp.Vy7S1J3qlFzWXp8I4c7p0jlNUybzVcq', 'rUerwi48HIeMYLKF6ocZwTjZVvAKL5GgozkxOVdrCrYlmNBZmbfgJOxT379UakxG3qKgfS1Dxbv3cNzEcUA108c831Wh0X70YlJt97IYj26GGvzLlDWXJXWsAFAsetwo', '089516500999', NULL, '2019-07-28 08:32:36', NULL, NULL, 1, 1, 0, NULL, NULL, '2019-05-22 23:14:20', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 0),
('C787C629-DA2F-65C3-DF72-CEC84501550C', 'Loket 3', 'loket3@gmail.com', '$2y$10$W.CnpDEk3Q0znW8ky/9/5uErY93831a/pAdHQPHobHp2r7U2biuiO', 'DJN8C6DwKCTS8EW9IENorGrcNaokCEX1MrMJIpNjuAujqtdLEUZNlQ3I1TuwMwnANOI2RxGkL3BEDLRNWpSksGNdKRZMJwe0kqLi6kWVdl142Efm7fpmlT7UGR9cTQxE', NULL, NULL, '2019-07-23 08:03:51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:54:56', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 08:03:58', 'C787C629-DA2F-65C3-DF72-CEC84501550C', 0),
('E5A59450-151D-6FB8-F5EB-F1A8D06EA398', 'Loket 8', 'loket8@gmail.com', '$2y$10$lS1hlntbW5F4Msj58B0F7uVmpBBh5Cdjfj9DQdXytxrvcx6ttLZIm', '2vPimcdnEVRczgqVl3Ne3bUg6k1rwGfpT98CpNMZekY5gjxvdM35VoG1y5eWmW5CxIHb2ykXI46bztL0jFNqUEuSuOlYcCEO1NRtY7tEYYdsvpge2FDbRePGjnl3Npqg', NULL, NULL, '2019-06-29 11:02:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:57:06', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL, 1),
('FD390007-D45C-8C84-45F1-EDD97301A729', 'Loket 9', 'loket9@gmail.com', '$2y$10$.iu8sgjH9eSuijINN.iE.ObkzgcK16a5Dl9RA1KNaNGRkyTYvnZ/.', 'MwiXQ75uIVsxAFfkjSAwmJHNttEabtOSVA2IRJopITU3I0KlYbIUhMMplJ6ixBGHVNZRZfuSoLpANdZ767PE2TkjUdE4EdIGrORnVIFB9DLjjtTsyOqm2GDR7rhJRgbl', NULL, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 125165, 1, 3, 1, '2019-07-18 17:53:18', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL, 0),
('FEE7A6B5-4936-3003-5FF4-3F70BB17019C', 'Loket 7', 'loket7@gmail.com', '$2y$10$aColRKrH/ulzjRyJzZ/jMe/PDB.9v3cOh872zOoGG7kCSpemEAj/2', 'eHODIPKlk8tJy139CcnjHBrpgmb7XTewtwwmN6GQb1fSXEArz0aLPbthwhIdcEii0i2C3OYdky5tCBevnGNlWx7NDSdNZOrtPeRFX2oTsU0Bn8YczGuLrdt0jvdFa0XR', NULL, NULL, '2019-06-30 19:20:39', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 125166, 1, 3, 0, '2019-06-28 08:56:48', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` varchar(36) NOT NULL,
  `id_loket` varchar(36) DEFAULT NULL,
  `kode_antrian` varchar(36) DEFAULT NULL,
  `req_queue_id` varchar(36) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0 = "menunggu", 1 = "dapat_loket", 2 ="selesai_dipanggil(orang datang)", 3="sudah_dipanggil", 4="terlewati"',
  `created_date` varchar(10) DEFAULT NULL,
  `calling_datetime` varchar(10) DEFAULT NULL,
  `audio_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `id_loket`, `kode_antrian`, `req_queue_id`, `status`, `created_date`, `calling_datetime`, `audio_url`) VALUES
('00692A8A-1D26-D876-52EE-0221589D560D', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'KLK.1', 'e9ac196f179e121327a198b78946c487', 2, '2019-07-19', '1563843973', '/uploads/audio/KLK.1.mp3'),
('0D31E4A4-6A5A-B174-0884-C0E3B916AE48', '', 'PSPD.1', '1473422F-BDBB-8E23-7BC5-A1244D1A5B0B', 0, '2019-07-19', '1563509003', NULL),
('0DF51B09-A972-0BBB-A762-3BD798EF5E22', '', 'AN.1', 'C44A4D37-388B-B3FA-1ACC-89EA4BE00CA8', 0, '2019-07-23', '1563870407', NULL),
('16B552A9-7C56-8839-D028-5B6925D704C2', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'PSPD.1', 'A1C7EC80-ABFD-E283-3A9C-13C36EFE77EA', 2, '2019-07-23', '1563854200', '/uploads/audio/PSPD.1.mp3'),
('178D3682-04AA-7902-6B83-08C654C736AC', '', 'AN.2', '94FF9D39-5443-2BD1-B883-40537F6F6BDD', 0, '2019-07-23', '1563870407', NULL),
('186F4820-0679-D1F2-77E5-887184F7220F', '', 'AN.5', '6949214D-EB11-AF11-0BE9-B0AA9EDFDF90', 0, '2019-07-23', '1563870644', NULL),
('1F1A3A0D-7C9D-D14C-5DA7-CD53B2431BF2', '', 'PSPD.2', 'D765AA65-86F4-3E57-74FD-B5A09F2CAECB', 0, '2019-07-23', '1563870310', NULL),
('223A796F-79D7-E9F1-9261-68895ECC0CAB', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.3', '41895D4F-C6FC-46CA-DB38-602866A9F634', 2, '2019-07-17', '1563349334', '/uploads/audio/AN.3.mp3'),
('2628990C-96B0-125E-84FE-5F237E320BA1', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'AN.1', '97848FA2-197E-267E-E0A8-E6FF51AE7D16', 2, '2019-07-18', '1563844412', '/uploads/audio/AN.1.mp3'),
('3933E4C3-EFE6-6412-77A9-23BE03352E27', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'KLK.2', '37CB940D-B414-3AF8-EE41-D7E4B18EAB6A', 3, '2019-07-19', '1563855890', '/uploads/audio/KLK.2.mp3'),
('3BDF5D3F-403E-2A59-A3EF-17C4CF8FB922', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'AN.1', '297B299A-B2C0-1286-1C28-81D2D9F33838', 2, '2019-07-18', '1563844446', '/uploads/audio/AN.1.mp3'),
('432F94FE-2F01-1C47-E079-D44CB1AC3E70', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'PSM.1', '5d0e6a5492ba18814256d53574d14b27', 0, '2019-07-23', '1563843928', '/uploads/audio/PSM.1.mp3'),
('4999FD4B-A1F9-F2B3-9BE2-B7792BF285E6', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'PSM.3', '6EA91427-C969-1B6F-4A69-FDD41CBF81B4', 2, '2019-07-17', '1563350813', '/uploads/audio/PSM.3.mp3'),
('4F104E3A-4A6C-4574-6C62-BF549872F9D6', '', 'AN.4', '3B40E6E5-C93D-0EDF-5588-AB9961E5D3D5', 0, '2019-07-23', '1563870601', NULL),
('5EF319A5-8A86-3B0C-519F-566661726FFC', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.2', '628D3B09-E617-39E6-F83A-1634FD2CD737', 2, '2019-07-17', '1563349275', '/uploads/audio/AN.2.mp3'),
('6C42B057-6020-DC19-D4E9-B79CCE2BF071', '', 'AN.3', 'A2278C06-4F5F-A092-3331-D68AE23E3863', 0, '2019-07-23', '1563870601', NULL),
('73BC356B-CDCE-E6F7-A11B-B570FBB5E0F3', '', 'AN.3', '32C4A750-25C4-20A8-9142-0AD3CED51735', 0, '2019-07-23', '1563870446', NULL),
('7DE4EF03-24C3-D9DE-C98B-D50B33FCF1DA', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'PSM.1', 'b5be6516f58da0e7fe2cefc1b8d5169f', 4, '2019-07-19', '1563851886', '/uploads/audio/PSM.1.mp3'),
('7F311830-DDAC-9525-07B7-B561D63C9366', '', 'AN.1', '66A0F507-BCC2-161C-4DE6-5C577DC788E6', 0, '2019-07-23', '1563870417', NULL),
('829EDFA1-DAAD-7494-692D-5E60089E9E24', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'PSPD.1', '71F7C009-8BC9-2125-94D4-417EC4D1B016', 2, '2019-07-18', '1563506383', '/uploads/audio/PSPD.1.mp3'),
('86A4130F-32AC-C65C-BC34-B16CE46EE2C8', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.1', '8CB9ED28-59DE-8530-B8E1-896A9FA9BC0F', 2, '2019-07-17', '1563349184', '/uploads/audio/AN.1.mp3'),
('9E0053A4-1900-43BC-997E-9AB8990A8C8B', '', 'PSPD.5', 'EF1087C1-E713-8346-0ABB-E4CDB9BCE9D0', 0, '2019-07-23', '1563870325', NULL),
('9E8ADBE8-3060-B1C3-6E86-F2A3AB9CE8B7', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'PSM.1', '2472AF9C-9580-3564-5838-3886A8E92226', 2, '2019-07-17', '1563344258', '/uploads/audio/PSM.1.mp3'),
('A0FADFDE-5E76-1DD5-6EF6-A5F6E7160734', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'PSM.2', '978BD16A-F000-16B0-F739-6166977535B0', 2, '2019-07-17', '1563344346', '/uploads/audio/PSM.2.mp3'),
('A1245D83-2136-D1A4-EE16-779AEEE7D42F', '', 'PSPD.1', '244363FA-AEF3-F7DF-7DBA-561C26EF4CDC', 0, '2019-07-17', '1563355281', NULL),
('A3C47A10-CA9E-E3D0-8151-20F6A9A7D66D', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.3', '31f86f6fa1a5a5b0bccd9a7ab07a01a3', 2, '2019-07-17', '1563354941', '/uploads/audio/AN.3.mp3'),
('A4EE0945-1DF5-9DE8-4C4A-D273A83A503E', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.2', 'd9b8486cf2aa9c62330d0a9eee1fbc23', 2, '2019-07-17', '1563348265', '/uploads/audio/AN.2.mp3'),
('BDE509AA-64E2-1E91-10ED-0BB5AB6B8D4F', '', 'PSPD.1', '5E7AF965-9AED-95D7-D380-3E9BC10447A8', 0, '2019-07-23', '1563859115', NULL),
('CEECADA7-1984-03DD-F331-54009796B6C1', '', 'KLK.1', '6F687FE1-B01B-1E10-79EE-C0AE303C349D', 0, '2019-07-17', '1563355034', NULL),
('D8FAEC3B-8149-479D-EC12-306459F54F29', '', 'AN.2', '0DF8661F-A997-7778-7994-990C154BCCB3', 0, '2019-07-23', '1563870417', NULL),
('D9392A20-AF86-9D29-A9AE-5F9B8B9FC4B0', '', 'TBDOTS.1', 'BAFEAACA-46CC-FF21-0D79-0DB97954519D', 0, '2019-07-18', '1563446135', NULL),
('D9A2CA9A-9F30-0E9E-2F6F-306103689919', '', 'AN.2', '5231A420-0B86-18BE-A2F5-3EDA02018BA1', 0, '2019-07-19', '1563510408', NULL),
('DFEBEFB7-968C-642F-D9BB-461404B2BD8D', '', 'PSPD.6', '2EC6B27A-0167-AB26-AC6C-387705F20A5E', 0, '2019-07-23', '1563870335', NULL),
('E0BAAC7E-125E-083F-CADC-19EE61CF909F', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'PSPD.2', '7E8D7D39-DC3D-22FF-BCEF-0C23D4DD083A', 2, '2019-07-19', '1563854203', '/uploads/audio/PSPD.2.mp3'),
('EAC1D979-5A5F-88CC-0360-EE5DA10C7991', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'AN.1', '28004D8E-9DF7-2388-141A-79E06A22EE29', 2, '2019-07-19', '1563851677', '/uploads/audio/AN.1.mp3'),
('EB07EAE3-4D56-1E2F-8D63-9EF6B3B4AE28', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'AN.1', '1042c57a7547d925004918c36008acf7', 2, '2019-07-17', '1563334478', '/uploads/audio/AN.1.mp3'),
('F17C3488-578C-B809-DC00-2EC17D72DF0E', '', 'AN.4', '63B43EC5-E477-6AF2-42F3-3FC2694CC5D3', 0, '2019-07-23', '1563870446', NULL),
('F22BEAD6-8920-E933-527F-105A13BB7B4E', '', 'PSPD.4', 'FA096729-BDF3-95A0-DBC3-DE7AFED9D5A3', 0, '2019-07-23', '1563870325', NULL),
('F979C687-7026-B9CC-F1F4-27AC2B4C705A', '', 'PSPD.3', '5B54B465-32DA-57BC-297C-02690AE76F38', 0, '2019-07-23', '1563870310', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_access_group`
--

CREATE TABLE `app_access_group` (
  `access_group_id` int(11) NOT NULL,
  `access_group_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `access_group_status` tinyint(1) DEFAULT NULL COMMENT '1 = "Active", 0 = "Non Active"'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `app_access_group`
--

INSERT INTO `app_access_group` (`access_group_id`, `access_group_name`, `created_by`, `created_date`, `updated_by`, `updated_date`, `access_group_status`) VALUES
(1, 'Administrator', 0, '2018-09-24 20:07:43', 0, '2019-07-09 15:13:40', 1),
(3, 'Loket', 0, '2019-05-22 21:18:52', 0, '2019-06-28 07:05:44', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_access_group_moduldetail`
--

CREATE TABLE `app_access_group_moduldetail` (
  `access_group_id` int(11) NOT NULL,
  `access_module_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Dumping data untuk tabel `app_access_group_moduldetail`
--

INSERT INTO `app_access_group_moduldetail` (`access_group_id`, `access_module_id`) VALUES
(1, 6),
(1, 5),
(1, 4),
(1, 3),
(1, 2),
(1, 1),
(3, 7),
(1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_access_group_submodule`
--

CREATE TABLE `app_access_group_submodule` (
  `access_group_id` int(11) NOT NULL,
  `access_submodule_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Dumping data untuk tabel `app_access_group_submodule`
--

INSERT INTO `app_access_group_submodule` (`access_group_id`, `access_submodule_id`) VALUES
(1, 8),
(1, 7),
(1, 5),
(1, 4),
(1, 6),
(1, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_module`
--

CREATE TABLE `app_module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_order` int(10) DEFAULT NULL COMMENT 'Order Menu',
  `module_icon` varchar(255) DEFAULT NULL,
  `module_url` varchar(255) DEFAULT NULL COMMENT 'URL when click, if parent give it "#"',
  `isParent` int(1) DEFAULT NULL COMMENT '1 = "Is Parent" (If 1 it means add sub module), 0 = "No Sub Module"',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `module_status` tinyint(1) DEFAULT 1 COMMENT '1 = "Active", 0 = "Non Active"',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = "Deletede", 0 = "Active" (Remove from UI table if its 1)'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `app_module`
--

INSERT INTO `app_module` (`module_id`, `module_name`, `module_order`, `module_icon`, `module_url`, `isParent`, `created_by`, `created_date`, `updated_by`, `updated_date`, `module_status`, `isDeleted`) VALUES
(1, 'Dashboard', 1, 'fas fa-home', 'dashboard', 0, 0, '2019-05-22 21:13:51', NULL, NULL, 1, 0),
(2, 'Settings', 99, 'fas fa-cogs', '#', 1, 0, '2019-05-22 21:15:25', 0, '2019-05-22 23:15:29', 1, 0),
(3, 'Users', 98, 'fa fa-users', 'user', 0, 0, '2019-05-22 23:15:58', 0, '2019-05-22 23:28:21', 1, 0),
(4, 'Parameter Maintenance', 2, 'fa fa-list', '#', 1, 0, '2019-05-23 09:02:41', NULL, NULL, 1, 0),
(5, 'Berita', 3, 'far fa-newspaper', 'berita', 0, 0, '2019-05-28 09:27:35', NULL, NULL, 1, 0),
(6, 'Request Antrian', 4, 'fa fa-users', 'reqantrian', 0, 0, '2019-06-25 09:18:05', NULL, NULL, 1, 0),
(7, 'Antrian', 5, 'fa fa-users', 'antrian', 0, 0, '2019-06-28 07:00:22', NULL, NULL, 1, 0),
(8, 'Chats', 6, 'fas fa-comments', 'chats', 0, 0, '2019-07-09 15:13:26', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_submodule`
--

CREATE TABLE `app_submodule` (
  `submodule_id` int(11) NOT NULL,
  `submodule_name` varchar(255) DEFAULT NULL,
  `submodule_order` int(10) DEFAULT NULL COMMENT 'Order Menu',
  `submodule_url` varchar(255) DEFAULT NULL COMMENT 'URL when click',
  `module_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `submodule_status` tinyint(1) DEFAULT 1 COMMENT '1 = "Active", 0 = "Non Active"',
  `isDeleted` tinyint(1) NOT NULL COMMENT '1 = "Deletede", 0 = "Active" (Remove from UI table if its 1)'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `app_submodule`
--

INSERT INTO `app_submodule` (`submodule_id`, `submodule_name`, `submodule_order`, `submodule_url`, `module_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `submodule_status`, `isDeleted`) VALUES
(1, 'Module & Submodule', 1, 'module', 2, 0, '2019-05-22 21:16:48', NULL, NULL, 1, 0),
(2, 'Group Module', 2, 'groupmodule', 2, 0, '2019-05-22 21:17:17', NULL, NULL, 1, 0),
(3, 'Loket', 1, 'loket', 4, 0, '2019-05-23 09:18:59', 0, '2019-05-23 09:19:16', 1, 0),
(4, 'Spesialis', 3, 'spesialis', 4, 0, '2019-05-23 11:28:14', 0, '2019-05-28 11:02:44', 1, 0),
(5, 'Dokter', 4, 'dokter', 4, 0, '2019-05-23 13:57:45', 0, '2019-05-24 14:18:22', 1, 0),
(6, 'Metode Pembayaran', 2, 'pembayaran', 4, 0, '2019-05-24 14:18:56', 0, '2019-05-28 11:02:43', 1, 0),
(7, 'Poli', 5, 'poli', 4, 0, '2019-05-24 15:53:44', NULL, NULL, 1, 0),
(8, 'Kategori Berita', 6, 'kategoriberita', 4, 0, '2019-05-27 16:03:13', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_user`
--

CREATE TABLE `app_user` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL COMMENT 'Password min 6 character',
  `access_group_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT '1 = "Active", 2 = "Non Active"',
  `isDeleted` varchar(255) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `app_user`
--

INSERT INTO `app_user` (`user_id`, `user_full_name`, `user_username`, `user_email`, `user_password`, `access_group_id`, `status`, `isDeleted`, `last_login_time`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 1, '1', '0', '2019-02-18 11:22:59'),
(2, 'Wanda Riswanda', 'wawan19', 'wandariswanda1026@gmail.com', '4297f44b13955235245b2497399d7a93', 6, '1', '0', '2019-05-22 12:45:17'),
(4, 'Okta Firdaus', NULL, 'oktafirdaus@gmail.com', '4297f44b13955235245b2497399d7a93', 6, '1', '0', '2019-02-18 11:39:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id` int(10) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `timestamp` varchar(10) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `type_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `timestamp`, `text`, `type_user`) VALUES
(11, '1', '1563179545', 'p', 2),
(12, '6', '1563355413', 'ya apakabar', 1),
(13, '29', '1563356458', 'test', 2),
(14, '4', '1563420926', 'terimakasih', 2),
(15, '30', '1563447145', 'silahkan datang sesuai jadwal yang telah ditentukan', 1),
(16, '33', '1563855262', 'hai', 1),
(17, '37', '1563856168', 'test ', 2),
(18, '19', '1563855244', 'males deh....', 2),
(19, '36', '1563856248', 'halo', 2),
(20, '11', '1563929821', 'hdjdjsjsjs', 2),
(21, '28', '1564463594', 'tes', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat_row`
--

CREATE TABLE `chat_row` (
  `id` int(10) NOT NULL,
  `chat_id` int(10) DEFAULT NULL,
  `type_user` int(1) DEFAULT NULL COMMENT '1 = "admin", 2 = "user"',
  `text` text DEFAULT NULL,
  `timestamp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `chat_row`
--

INSERT INTO `chat_row` (`id`, `chat_id`, `type_user`, `text`, `timestamp`) VALUES
(50, 11, 2, 'p', '1563179545'),
(51, 12, 2, 'haloo', '1563348639'),
(52, 12, 1, 'ok', '1563348654'),
(53, 12, 2, 'halo', '1563355364'),
(54, 12, 1, 'ya apakabar', '1563355413'),
(55, 13, 2, 'ðŸ‘‹', '1563356447'),
(56, 13, 2, 'test', '1563356458'),
(57, 15, 1, 'silahkan datang sesuai jadwal yang telah ditentukan', '1563447145'),
(58, 16, 2, 'tes', '1563779492'),
(59, 16, 1, 'halo', '1563779509'),
(60, 16, 2, 'hei', '1563798339'),
(61, 16, 2, 'tes1', '1563844158'),
(62, 16, 1, 'halo', '1563844177'),
(63, 17, 2, 'posisi dmn ?', '1563854964'),
(64, 17, 2, 'bisa ', '1563854975'),
(65, 17, 2, 'rhhhjhh', '1563854992'),
(66, 17, 2, 'yuhuuu', '1563855020'),
(67, 16, 2, 'halo', '1563855209'),
(68, 18, 2, 'besok dokter nya ada gak ?', '1563855221'),
(69, 18, 2, 'admin...', '1563855225'),
(70, 18, 2, 'ih.. kok gak bales', '1563855237'),
(71, 18, 2, 'males deh....', '1563855244'),
(72, 16, 1, 'hai', '1563855262'),
(73, 17, 2, 'test ', '1563856168'),
(74, 19, 2, 'halo', '1563856248'),
(75, 20, 1, 'ada yang bis\r\n', '1563929798'),
(76, 20, 1, 'dasdjalksdjal', '1563929808'),
(77, 20, 2, 'hdjdjsjsjs', '1563929821');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_category_news`
--

CREATE TABLE `master_category_news` (
  `id` varchar(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_category_news`
--

INSERT INTO `master_category_news` (`id`, `name`, `is_active`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('3D039DAB-B5D1-C36D-7B10-BC2BB93431A9', 'Jadwal Periksa', 0, '2019-07-18 11:59:40', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-18 12:00:14', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('66F6608E-DC15-13E9-0FD5-6FA29BF1EEA6', 'Berita Kesehatan', 1, '2019-07-15 10:16:27', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('80288E3F-F7FF-1D00-2F98-884C9B393C36', 'Cuaca', 1, '2019-06-15 18:46:22', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8A8A548C-8043-5037-9DCB-2A1AA84FB3D7', 'Prestasi', 1, '2019-06-28 09:53:40', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('93212F09-819C-83DE-BFCB-B246D12C7AFC', 'Kegiatan Rumah Sakit', 1, '2019-06-28 09:53:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_counter`
--

CREATE TABLE `master_counter` (
  `id` varchar(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT NULL COMMENT '0 = Non Active", 1 = "Active"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_counter`
--

INSERT INTO `master_counter` (`id`, `name`, `is_active`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('A21033A1-8CDC-F2A7-71E9-3754246898D2', 'loket 1', '1', '2019-06-26 12:07:18', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_doctor`
--

CREATE TABLE `master_doctor` (
  `id` varchar(36) NOT NULL,
  `id_specialist` varchar(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `no_str` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL COMMENT 'P/L',
  `image` varchar(250) DEFAULT NULL,
  `experience` int(2) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL COMMENT '0 = "Non Active", 1 = "Active"',
  `is_deleted` varchar(255) DEFAULT NULL COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_doctor`
--

INSERT INTO `master_doctor` (`id`, `id_specialist`, `name`, `no_str`, `gender`, `image`, `experience`, `is_active`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('0340C009-FE85-2074-5BE1-B0E6A582D9AD', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Mochammad Adam Eldi', '-', 'L', 'images/dokter/DK-19270604444220.png', 0, 1, '1', '2019-06-27 16:44:42', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:55:52', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('079DE0C6-2122-A89E-3438-26259C52F1EF', '72DA0504-D36F-0B13-1423-B9601DE9BEB4', 'Sefiani Nur Handayani, Amd.Gz', '-', 'P', 'images/dokter/DK-19270604364685.png', 0, 1, '1', '2019-06-27 16:36:46', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:52:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('09120EE9-B282-021E-B02E-C023EE27AA7A', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr.Nungky Widiastuti', '-', 'P', 'images/dokter/DK-19270604124065.png', 0, 1, '1', '2019-06-27 16:12:40', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:55:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '9B3601E0-11A3-BC9A-9943-5F8024D1F361', 'dr. Brama Ihsan Sazli, Sp.PD', '12.1.1.401.3.15.111037', 'L', 'images/dokter/DK-19140602472654.jpg', 0, 1, '0', '2019-06-14 14:47:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-16 13:40:39', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('176D6BA5-B2E0-D93F-6B95-1980D19BFA61', 'ED9B34F0-6B91-7092-1A3A-3F0556519B09', 'dr. Rubby Aditya, Sp.KK', '31.1.1.602.3.18.114470', 'L', 'images/dokter/DK-19160702143975.jpg', 0, 0, '0', '2019-07-16 14:14:39', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:36:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', 'A2426EC2-799E-4F16-E2E2-A82898575CE3', 'dr. Faraby Martha, Sp.M', '31.1.1.603.3.17.119081', 'L', 'images/dokter/DK-19160702082966.jpg', 0, 1, '0', '2019-07-16 14:08:29', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('1E7267F3-378D-81A7-C1E9-22A7002C3884', '92065FCB-3931-F532-3D4D-9B6EF82D7353', 'dr.Better Versi Parinoi, Sp.OG tes nama', '-', 'L', 'images/dokter/DK-19160712571935.jpg', 4, 1, '0', '2019-07-04 09:00:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:34:22', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('1ED2A125-A13F-CA6A-CCF5-68C227238ADA', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Ajeng Pramesti', '31.2.1.100.2.17.122836', 'P', 'images/dokter/DK-19170610303728.png', 0, 1, '1', '2019-06-16 20:30:00', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', 'ED9B34F0-6B91-7092-1A3A-3F0556519B09', 'dr. Rubby Aditya, Sp.KK', '3111602318114470', 'L', 'images/dokter/DK-19160701332156.jpg', 0, 1, '0', '2019-07-16 13:33:21', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:49:12', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('24BF672B-873F-A486-A42F-209BD17A018D', '8E8D9605-595E-EEC7-760E-844183EE4445', 'dr. Debby A. Suhito', '-', 'P', 'images/dokter/DK-19180711550974.png', 3, 1, '1', '2019-07-18 11:55:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:50:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('260979DA-CDAA-B964-10C8-3861BF503D62', 'A54C9DE7-7AA9-93AE-0018-7E62F604B1D7', 'dr.Lie Affendi Kartikahadi, Sp.A', '-', 'L', 'images/dokter/DK-19160704481210.jpg', 4, 1, '0', '2019-07-16 16:48:12', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-17 16:19:57', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('2F041740-B15A-A87B-8D18-4A35F112D950', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Ni Putu Pramithasari Kusuma', '-', 'P', 'images/dokter/DK-19270604425989.png', 0, 1, '1', '2019-06-27 16:42:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:14:40', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('33535DC4-FF07-24C5-1E91-D782A6F0F750', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Arevia Mega Diduta Utami', '-', 'P', 'images/dokter/DK-19270604460184.png', 0, 1, '1', '2019-06-27 16:46:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:51:22', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('3A3D814E-C8DA-6131-5A66-B915BBC48374', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'Eva Simajuntak', '-', 'P', 'images/dokter/DK-19270604422329.png', 0, 1, '1', '2019-06-27 16:42:23', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('411601EF-52D4-7901-16D2-97686C8C4A97', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Khaoirun Mukhsinin Putra', '-', 'L', 'images/dokter/DK-19270604215844.png', 0, 1, '1', '2019-06-27 16:21:58', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:53:51', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('4C81150D-7C5C-7256-5E5F-900D92DAF188', '8B9C337E-05FA-F313-9F3A-60CC19B7B51B', 'dr. Ronny, Sp.Rad', '-', 'L', 'images/dokter/DK-19270604402643.png', 0, 1, '1', '2019-06-27 16:40:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:14:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('57527786-2955-59D2-5993-48CD0A5B4CA1', '72DA0504-D36F-0B13-1423-B9601DE9BEB4', 'Hendi Gunawan, Amd.Gizi., S.Gz', '-', 'L', 'images/dokter/DK-19270604372160.png', 0, 1, '1', '2019-06-27 16:37:21', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:52:35', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('5AF57A71-98A8-5E60-304D-AFC9EA320D97', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Franciscus Tri Susanto', '-', 'L', 'images/dokter/DK-19270604451191.png', 0, 1, '1', '2019-06-27 16:45:11', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:20', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('5D657E6F-AE72-B316-7C46-9AF7641F08D2', 'AD628C5D-F727-E861-2582-8BF955F6D067', 'dr. Shiera Septrisya, Sp.B', '31.2.1.101.3.15.098890', 'P', 'images/dokter/DK-19090703080565.png', 0, 1, '0', '2019-06-14 14:57:50', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-09 15:08:05', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('5E9CBC98-D532-E86D-5DB0-5755C0ACE156', 'A2426EC2-799E-4F16-E2E2-A82898575CE3', 'dr. Nur Isnaeni Risna, Sp.M', '34.2.1.603.3.15.055741', 'P', 'images/dokter/DK-19160702031347.jpg', 0, 1, '0', '2019-07-16 14:03:13', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', 'AD628C5D-F727-E861-2582-8BF955F6D067', 'dr. Andy Lesmana, Sp.B', '5 B.15b 31.73.03 -1.779.3 e 2019', 'L', 'images/dokter/DK-19160703495927.jpg', 0, 1, '0', '2019-07-16 15:49:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6E57E6C9-1680-D022-8051-9E08AA37FFAC', '92065FCB-3931-F532-3D4D-9B6EF82D7353', 'dr. C. Gunawan Wibisono, Sp.OG', '-', 'L', 'images/dokter/DK-19160701555142.jpg', 0, 1, '0', '2019-06-16 20:23:13', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-16 13:55:51', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('7B311E0E-2D5A-D85F-DDBB-6CF7F3A03B1F', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Puspita Komalasari Candra', '11 2.102 31.73.02.1005 -1.779.3 2016', 'P', 'images/dokter/DK-19270604070433.png', 0, 1, '1', '2019-06-27 16:07:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:55:08', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('83A57858-6908-4A3E-A8D3-EB394401AAE8', '78A11BB7-E897-7E90-6554-9CEB090B065D', 'Titin Kurnia, Amd.RO', '-', 'P', 'images/dokter/DK-19160704300994.jpg', 0, 1, '1', '2019-07-16 16:30:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:50:17', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('9703C1C9-8A17-018F-5D16-E28050B5EF25', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Andreas Peter Patar Baresman', '2 B.15a 31.73.03.1005 -1.779.3 e 2018', 'L', 'images/dokter/DK-19270604263212.png', 0, 1, '1', '2019-06-27 16:26:32', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:53:42', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('B0B53DF3-46D7-D4DD-0870-42C3BEC399A1', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Julia Lestari', '-', 'L', 'images/dokter/DK-19270604453775.png', 0, 1, '1', '2019-06-27 16:45:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:51:31', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('B94030FA-7FE6-1072-D9F9-A12368FDEA65', '8B9C337E-05FA-F313-9F3A-60CC19B7B51B', 'Ditto Pratama, Amd. Rad', '-', 'L', 'images/dokter/DK-19270604393665.png', 0, 1, '1', '2019-06-27 16:39:36', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:14:31', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('BA252EA6-C4BF-7142-E3CD-C5D655345BE8', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Hafizah Wijaya', '-', 'P', 'images/dokter/DK-19270604420313.png', 0, 1, '1', '2019-06-27 16:42:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:14:47', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('BAB4694B-8831-DCCC-31A1-B7A84A6410A2', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'Lutfi Febriyanto', '-', 'L', 'images/dokter/DK-19270604150128.png', 0, 1, '1', '2019-06-27 16:15:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:14:18', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('BF9186E9-55B0-4CAE-8E04-D125F9350367', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Aditya Novita', '09 2.102 31.73.03.1005 -1.779.3 2016', 'P', 'images/dokter/DK-19270604095565.png', 0, 1, '1', '2019-06-27 16:09:55', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:55:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('C1A6E0C0-8067-F5C3-D8DE-AFE8A81DFE9A', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Henry Estrada', '07 2.102 31.73.03.1005 -1.779.3 2016', 'L', 'images/dokter/DK-19270604081751.png', 0, 1, '1', '2019-06-27 16:08:17', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('CB888A31-A576-6A0B-8859-EA165E57222D', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Niken Septianita', '-', 'P', 'images/dokter/DK-19270604061092.png', 0, 1, '1', '2019-06-27 16:06:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:52:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('CFB56F63-6ACA-3F3D-0A86-D16938622C50', '9B3601E0-11A3-BC9A-9943-5F8024D1F361', 'dr. Faisal Parlindungan, Sp.PD', '12.1.1.401.3.15.095455', 'L', 'images/dokter/DK-19160701522950.jpg', 0, 1, '0', '2019-07-16 13:52:29', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D409F5D0-856B-AF48-00AF-9B8AAE37B478', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Raymond Edwin Lubis', '-', 'L', 'images/dokter/DK-19270604413488.png', 0, 1, '1', '2019-06-27 16:41:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:15:06', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('D7DFB11B-ABED-E7CA-31B1-04831665C435', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Namira Azzahra', '-', 'P', 'images/dokter/DK-19270604085038.png', 0, 1, '1', '2019-06-27 16:08:50', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('DAEE6C86-255F-68F1-D69B-ED8211447356', '8B9C337E-05FA-F313-9F3A-60CC19B7B51B', 'Ali Hasyim Rafsanjani, Amd.Rad', '-', 'L', 'images/dokter/DK-19270604375226.png', 0, 1, '1', '2019-06-27 16:37:52', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:54:29', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('DB5E51DF-5B46-FF20-6344-6623FB0C7142', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Zuriel Jeffrey Jonathan', '-', 'L', 'images/dokter/DK-19270604461986.png', 0, 1, '1', '2019-06-27 16:46:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:51:14', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('E095EC37-4656-8501-F823-16156BB4F81E', '9B3601E0-11A3-BC9A-9943-5F8024D1F361', 'dr. Myrna Martinus, Sp.PD', '31.2.1.401.3.16.040620', 'P', 'images/dokter/DK-19160701373959.jpg', 0, 1, '1', '2019-06-14 14:46:07', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:50:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('E28C5F52-918A-BA48-F926-DC1F9BE9441D', 'A54C9DE7-7AA9-93AE-0018-7E62F604B1D7', 'dr. Nova Yulia Rita, Sp.A', '-', 'P', 'images/dokter/DK-19160701270948.jpg', 0, 1, '0', '2019-07-16 13:27:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E2C3416B-D509-553F-9844-DFA4613A0BE5', 'A54C9DE7-7AA9-93AE-0018-7E62F604B1D7', 'dr. Mega Oktariena Syafendra, Sp.A', '12.2.1.201.2.16.105721', 'P', 'images/dokter/DK-19160701181961.jpg', 0, 1, '0', '2019-07-16 13:18:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('EF2164F6-4221-B965-7126-3A560B5BDC3A', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'dr. Niken Septianita', '11 2.102 31.73.02.1005 -1.779.3 2016', 'P', 'images/dokter/DK-19270604034685.png', 0, 1, '1', '2019-06-27 16:03:46', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-06-27 16:05:00', 'B5D6AF2A-149D-5C4F-8721-528A47004F88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_payment`
--

CREATE TABLE `master_payment` (
  `id` varchar(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `detail` text DEFAULT NULL COMMENT 'Detail Pembayaran',
  `is_active` int(1) DEFAULT NULL COMMENT '0 = "Non Active", 1 = "Active"',
  `is_deleted` varchar(255) DEFAULT NULL COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_payment`
--

INSERT INTO `master_payment` (`id`, `name`, `detail`, `is_active`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 'Tunai', '', 1, '0', '2019-06-14 15:12:57', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('4BF0E3F3-87C9-63B5-F756-94EB7462816E', 'BPJS', '', 1, '0', '2019-06-14 15:12:46', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-06-28 09:43:54', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('F4D09D60-C547-821B-7A1C-7FFD29132B46', 'Asuransi', 'Pembayaran Asuransi', 1, '1', '2019-07-18 11:47:24', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-18 12:02:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_poly`
--

CREATE TABLE `master_poly` (
  `id` varchar(36) NOT NULL,
  `poly_code` varchar(36) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_specialist` varchar(36) DEFAULT NULL,
  `id_payment` text DEFAULT NULL COMMENT '// Bentuk Json',
  `is_deleted` int(11) DEFAULT NULL COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_poly`
--

INSERT INTO `master_poly` (`id`, `poly_code`, `name`, `id_specialist`, `id_payment`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('197F4539-529C-A728-F8BB-5B5779FD2054', 'KLK', 'Klinik Spesialis Kulit & Kelamin', 'ED9B34F0-6B91-7092-1A3A-3F0556519B09', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:20:55', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:00', '0000-00-00 00:00:00'),
('264C8733-768E-EDD5-5900-0D6C4C1843D4', 'PBU', 'Klinik Spesialis Bedah', 'AD628C5D-F727-E861-2582-8BF955F6D067', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:19:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:23', '0000-00-00 00:00:00'),
('2DC63F10-C924-8875-0E3A-95110071B9BD', 'RM', 'Klinik Spesialis Fisik & Rehabilitas Medik', 'B16CA09A-7A03-2799-4825-4DA6B4E33C17', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-07-23 15:18:28', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:50:48', '0000-00-00 00:00:00'),
('589D5650-1FE8-6776-C92A-DC5F04ADA947', 'PUM', 'Poli Kesehatan Umum', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-07-18 11:57:54', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-18 12:00:24', '0000-00-00 00:00:00'),
('763E90B4-F961-158A-D431-09EB40C5AA0A', 'PSPD', 'Klinik Spesialis Penyakit Dalam', '9B3601E0-11A3-BC9A-9943-5F8024D1F361', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:18:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:58', '0000-00-00 00:00:00'),
('91248483-9248-F0CE-CF91-61557164F17E', 'KGZ', 'Klinik Gizi', '72DA0504-D36F-0B13-1423-B9601DE9BEB4', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\"]', 1, '2019-06-27 16:32:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:16', '0000-00-00 00:00:00'),
('A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', 'RF', 'Refraksi Mata', '78A11BB7-E897-7E90-6554-9CEB090B065D', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\"]', 1, '2019-06-27 16:36:25', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:22', '0000-00-00 00:00:00'),
('B5584290-7440-BA41-5F1B-6B82D87A5886', 'AN', 'Klinik Spesialis Anak', 'A54C9DE7-7AA9-93AE-0018-7E62F604B1D7', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:19:29', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:33', '0000-00-00 00:00:00'),
('BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', 'PSKB', 'Klinik Spesialis Kebidanan dan Kandungan', '92065FCB-3931-F532-3D4D-9B6EF82D7353', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:14:31', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:43:09', '0000-00-00 00:00:00'),
('BBC16941-D777-EF36-1454-ADA6A71BA953', 'PSM', 'Klinik Spesialis Mata', 'A2426EC2-799E-4F16-E2E2-A82898575CE3', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:18:58', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:43', '0000-00-00 00:00:00'),
('D3C5A136-39F1-E6DB-A485-993AEA842BF3', 'PGG', 'Klinik Gigi', 'D6B4AC7D-CE8A-1573-2926-9535F292E7C2', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 0, '2019-06-14 14:25:50', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:42:12', '0000-00-00 00:00:00'),
('D5CB9D75-463B-F7F5-1500-08A44AF0CEA8', 'PFT', 'Fisioterapi', 'EC385375-6A82-2925-A36C-4CEE2E3C3F49', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-06-14 14:39:56', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:40', '0000-00-00 00:00:00'),
('E6559349-68AA-02D5-0874-F03FF86A6D65', 'PIMS', 'Poliklinik IMS', '65E98A6E-3D02-6B2B-F6F5-4DD71FB75321', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-06-14 14:27:17', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:07', '0000-00-00 00:00:00'),
('E67B0B4C-3E7A-9A54-E5D5-0BEF729DC53B', 'UM', 'Poliklinik Umum dan MCU', '976FEAD7-C3D9-D2A9-8349-E846739D88EF', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-06-14 14:27:32', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:32', '0000-00-00 00:00:00'),
('EF2CB26E-4A14-B714-7EB0-DDF73ADA8A88', 'KMD', 'Klinik Madu', 'CE4C6859-46C3-7729-7615-EE6416CE7571', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\"]', 1, '2019-06-27 16:34:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:11', '0000-00-00 00:00:00'),
('F8B6D57B-D950-857E-1EB0-767290DB28EE', 'TBDOTS', 'TB-DOTS', '9B3601E0-11A3-BC9A-9943-5F8024D1F361', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-06-16 20:00:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:40:49', '0000-00-00 00:00:00'),
('FF7F1439-EF07-BF7E-AE21-223CA30165D3', 'PDP', 'Poliklinik PDP', '60A737D8-4659-1438-DC7E-984DB7F4A7F3', '[\"19F65BA2-92B2-C5C0-F660-BF7D5BA4C328\",\"4BF0E3F3-87C9-63B5-F756-94EB7462816E\"]', 1, '2019-06-14 14:36:06', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-24 09:41:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_poly_doctor`
--

CREATE TABLE `master_poly_doctor` (
  `id` varchar(36) NOT NULL,
  `id_poly` varchar(36) DEFAULT NULL,
  `id_doctor` varchar(36) DEFAULT NULL,
  `start_practice` time NOT NULL,
  `end_practice` time NOT NULL,
  `is_active` int(1) DEFAULT NULL COMMENT '0 = "Non Active", 1 = "Active"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_practice_schedule`
--

CREATE TABLE `master_practice_schedule` (
  `id` varchar(36) NOT NULL,
  `id_poly` varchar(36) DEFAULT NULL,
  `id_doctor` varchar(36) DEFAULT NULL,
  `start_time_service` time DEFAULT NULL,
  `finish_time_service` time DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `start_onsite` time DEFAULT NULL,
  `end_onsite` time DEFAULT NULL,
  `quota_online` int(11) DEFAULT NULL,
  `days` int(1) DEFAULT NULL COMMENT 'value = 1 - 7 (Ket : Senin - Minggu)',
  `weeks` varchar(1) DEFAULT NULL COMMENT 'value = 1 - 5 ',
  `type` varchar(255) DEFAULT NULL COMMENT '1 = "Weekly", 2 = "Monthly"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_practice_schedule`
--

INSERT INTO `master_practice_schedule` (`id`, `id_poly`, `id_doctor`, `start_time_service`, `finish_time_service`, `quota`, `start_onsite`, `end_onsite`, `quota_online`, `days`, `weeks`, `type`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('016C4807-8A97-F0FA-CD06-490288B031E4', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '14:00:00', '18:00:00', 5, '14:00:00', '18:00:00', 5, 6, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('032254EF-63EA-44A8-3B46-8D7F37D349B0', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('05E9422A-A827-0190-2348-611729AD5A3B', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 5, 1, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('07EEF3DB-885F-543F-26BA-B1EFF0DBFDDC', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '14:00:00', '18:00:00', 5, '14:00:00', '18:00:00', 5, 3, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('08774703-86DB-1CA0-08B7-E621453A469B', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('09158B43-86B8-35D8-01D5-5FD7C291C19B', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 2, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('0B4AEEE3-5D5E-956F-2711-456A53921E89', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('0DC9C3BA-6654-9043-6CAD-63A65B3AF40C', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('0DE669F1-558D-F6E8-FAAB-6E0A97530F6E', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '13:00:00', 50, '07:00:00', '11:00:00', 10, 3, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('112C0EDD-1015-22CD-3BE6-59D1A5C38A63', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('1332E880-180E-0CCA-5007-F4B808A5F2A7', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('13DB47C3-4CBD-BB1D-E2EE-D6C14222BAD4', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('1A2A688E-2434-2B40-D962-36A641259C75', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('1AF985BF-0910-FABD-280E-5D4A48FB84E5', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '12:00:00', '16:00:00', 10, '12:00:00', '16:00:00', 5, 1, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('1B29E813-4AB7-607C-46B2-651E2795085B', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('2066CBD2-2EAE-0A47-3D0E-1F37996A28F3', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '08:00:00', '12:00:00', 10, '08:00:00', '12:00:00', 5, 2, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('2561ED6A-2437-7247-D4D2-6FACCA777C45', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '15:30:00', '19:30:00', 5, '15:30:00', '19:30:00', 4, 5, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('26DCC2EA-8E66-8A53-FB5D-E2330DBA46D0', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('2E4ADBFC-CF6A-1101-9179-8D5DAE6E2423', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 5, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('31ACCC93-1434-7193-057D-E8CD3ACD6613', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('31F46BB5-3685-5A17-8DDB-0CB36240819C', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 4, 5, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3205B56D-6025-F393-E446-1A6133789647', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('32061F89-5C79-3DBD-2F38-81308522A4D9', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '12:00:00', 30, '07:00:00', '11:00:00', 10, 6, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('32577495-9345-809D-DCC9-6B8FB6A52B16', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '15:30:00', '19:30:00', 5, '15:30:00', '19:30:00', 5, 3, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('33C86C65-3FB3-58D4-B047-7F51E746CCD5', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('34A76994-835E-EB55-048A-DDCB578DA90E', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 4, 4, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('34DD0E49-BBC2-6703-BFDD-E0FEF2A1CF24', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '14:30:00', '18:30:00', 5, '00:00:00', '00:00:00', 5, 1, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3553EBF7-2294-B9C5-C15A-E074AAFFB414', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('35B832D6-C15B-ED9B-6386-47294FD83F62', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 4, 5, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3628D02D-FC5A-D8FC-D2C3-73EC823EBD08', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('36CB3C45-9D09-9D4D-0526-47105B08E4C4', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('392C7DBD-4B11-2E26-EE8A-DDF0A5427471', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3A291883-E965-47F2-4D73-50BD28B66ECA', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3C46E581-F5A9-F8DD-ECF4-9BDB8756D21E', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('407135FF-3638-2292-9FBC-E35927541CFC', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('44CF8191-F205-2CD2-51B1-49E19EE85EE6', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '12:00:00', '16:00:00', 10, '12:00:00', '16:00:00', 4, 3, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('4A12CDE5-DF21-4200-EA4E-B63AAAD0225B', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('4DE7C33F-D231-9D33-ABF8-2502A47DF046', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '08:00:00', '12:00:00', 10, '08:00:00', '12:00:00', 4, 5, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('4E13D8D1-203A-5F15-7EB5-94B0DFF6CAD3', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '14:00:00', '18:00:00', 5, '14:00:00', '18:00:00', 5, 1, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('59C53066-70A2-659E-1A50-6E855EA77086', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 5, 1, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6020AA7C-7445-59DB-9B4D-C5F85E4AF398', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('61F6CB5A-9811-C849-14C0-3678726C6C8D', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('62DAE7B0-03FD-1250-673C-14D6D6148B07', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('63A8CEBE-C494-1F4C-036D-F24D8E7F4465', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 0, 4, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('65F26ABB-0223-0114-0508-9A2EC98A4EAA', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('673D5A34-A2CB-A140-C7BF-424517976244', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('695F994D-0643-2795-5378-FA9EA270EB65', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6A165BD2-C563-99AA-3485-44642C899B46', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6A70986A-216D-AA22-4DC7-A2728A5A2C0D', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '13:00:00', 50, '07:00:00', '11:00:00', 10, 4, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6BE0BC92-8180-4E5F-4A96-D6A1AC7237DF', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '12:00:00', '16:00:00', 10, '12:00:00', '16:00:00', 3, 5, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('6CE248F7-48A9-5A80-A2B5-23E40D3EE90B', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('7277D7F0-6542-51E4-4592-C513F79585B8', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('750EE3DD-6961-9BB8-79CA-95A84345C9A4', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '14:00:00', '18:00:00', 5, '14:00:00', '18:00:00', 5, 5, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('79A4012B-C069-870F-D96D-58BB834B4C6F', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 3, 3, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('7AD0C616-21AB-5010-46B7-4F2DE35E61E6', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('7D462D77-26D5-187F-F334-2883596ADAAD', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '11:00:00', '15:00:00', 10, '11:00:00', '15:00:00', 4, 1, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('7D8303A3-9452-8969-1528-48D7CBC1CCB0', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('818BA47D-B810-69DF-55CD-90688D8BC62C', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('830D467E-AB44-3496-4C71-B70E23E8A479', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('83B6F34E-F536-7F73-9BE2-6DBE723EC426', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '11:00:00', '15:00:00', 10, '11:00:00', '15:00:00', 4, 3, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('84575FA2-3328-907A-2495-42BAC0C62AED', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '13:00:00', 50, '07:00:00', '11:00:00', 10, 2, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('849A6A40-9EE9-1BBE-8D07-8F3DBB2C540B', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('85F3CD51-D348-F5E6-2BC8-32CCBF815E85', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 4, 5, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('864D8C5F-6BAB-DAC2-577D-407F694CD5B8', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('87562A35-93C3-0791-0EAB-EDF2FB5BD9B8', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('879F85FA-4330-5E3D-2886-406BFD6BFDE5', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '13:00:00', 50, '07:00:00', '11:00:00', 10, 5, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8A67A174-7AD8-3A0A-4B6F-B0854176A32B', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8F30C32E-9ABF-39D8-044F-B407FB4545A4', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8F6206E5-81A7-DE16-F122-086C2ED1C358', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8FAF3B6B-7CE3-0873-C07B-6D545564882E', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('917E1DA8-6632-4E27-A72B-371D01BF588D', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 5, 4, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('932DFC9D-F0D4-3F71-0EFC-0B7E437EB39B', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('9A476169-57AD-AEC6-9DCD-2F1DFBA4D5A5', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('9C09B33A-C559-6F87-0471-A00387A61A6B', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 4, 5, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('A070322A-83DC-6BC1-7C10-10A58A855D97', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('A193B522-024B-31AB-C905-96400DD6B6E9', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '83A57858-6908-4A3E-A8D3-EB394401AAE8', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-17 09:00:04', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('A5995D19-F0EF-72D7-7F58-4F138611AE97', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('A906D3DC-9AE2-DCB4-722E-988FC7405EEF', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('AA074798-5611-7469-2E03-1A93E90CF8E6', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '10:00:00', '13:00:00', 0, '10:00:00', '13:00:00', 3, 3, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('AC2D76B8-69CA-736A-5A20-6ED860547E7A', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('AC328268-27E8-0014-3DD7-596A4EEFF5D8', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('ACC90AF0-D853-DC71-303B-DF0796EF4139', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '08:00:00', '12:00:00', 10, '08:00:00', '12:00:00', 4, 4, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('ADC9ADF5-1C16-4BC5-D855-D12FE2DEB26A', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '08:00:00', '11:00:00', 5, '08:00:00', '11:00:00', 4, 6, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('AF40C22E-58EA-FC61-3C0D-DCE7E8DC4D64', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '14:30:00', '18:30:00', 5, '00:00:00', '00:00:00', 5, 3, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('B2668F2B-465F-AD16-9191-8AC40DFE8906', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 3, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('B5003911-19A1-3019-54B9-41A1E2A59FCD', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('B5D63548-36DA-1A14-4D8D-153DB27D5364', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-16 16:03:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('BAA834F6-C331-1DB7-D42B-701E9D7B1B77', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 5, 4, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('BE57E26A-D52B-0D9E-B262-DE23063E482E', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '7CE1C75E-5369-85B4-4E61-B6654106CBB6', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 6, '', '1', '2019-07-16 13:07:36', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C04917A7-7148-AD1A-2BED-86C3A74DC9CF', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C1678E25-5A7D-66F6-DCEA-01BAC96FAB02', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C1B3EB53-7003-753C-0FB6-0525FEB78AF4', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 1, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C1C4BF22-3A70-4C9B-B7A3-73C55FDAAF9F', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C3F3C2DA-D15C-E527-2008-E20E9F579695', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 3, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C8933421-E243-0D56-0D5C-87F1887EBC4B', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C973E55F-4E3D-7998-FA72-8885948C0E40', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C97B201F-D363-616E-EB37-A2BD3EDE95C2', '763E90B4-F961-158A-D431-09EB40C5AA0A', 'E095EC37-4656-8501-F823-16156BB4F81E', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 6, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('C9E5388D-760F-F5C2-6DF8-DD1496F644B3', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('CA012594-A6F6-F9A6-FCE8-9E11596BFEF1', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '08:00:00', '11:00:00', 5, '08:00:00', '11:00:00', 4, 6, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D0592B63-14F6-3E65-7669-DE5CEF29CB4D', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D4100618-C1D3-2408-5D17-8128DDBB2D1B', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 2, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D55C63F2-1BEE-4836-68D7-68E97858C559', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '14:30:00', '18:30:00', 5, '00:00:00', '00:00:00', 5, 5, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D60BFF1C-B2A9-1214-D941-F6B5AF04CB1D', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D87EEC4B-D80E-BAF3-D724-E83EB5FA6AED', 'F8B6D57B-D950-857E-1EB0-767290DB28EE', '24BF672B-873F-A486-A42F-209BD17A018D', '07:30:00', '13:00:00', 50, '07:00:00', '12:30:00', 10, 1, '', '1', '2019-07-18 12:02:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('D98B990A-9468-061C-57B6-54EAE2A750A2', '', '0E825875-590F-9D21-0527-D12F26DC4A71', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-16 11:35:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('DC7A5313-FF43-D509-F258-A2C101FED14B', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '7CE1C75E-5369-85B4-4E61-B6654106CBB6', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-16 13:07:36', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E325D283-555E-E06E-4FEE-395DCB971E67', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '08:00:00', '11:00:00', 10, '08:00:00', '11:00:00', 5, 6, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E407C598-C65A-BC2B-01D0-D3D09248FF3A', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '08:00:00', '12:00:00', 10, '08:00:00', '12:00:00', 5, 3, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E4F137AB-845C-5706-B916-8ECE8782D301', '264C8733-768E-EDD5-5900-0D6C4C1843D4', '5D657E6F-AE72-B316-7C46-9AF7641F08D2', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-17 09:04:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E516A383-5B6E-AC67-A2B8-8969C957E884', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E68246CE-BDED-B497-7AFC-F77114C3DCFD', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 5, 2, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('E8AFC7B8-C903-16F5-74FF-ABF23F0A66F7', '', '5235C39F-9B27-DBAA-176F-55AE39D722BD', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '', '1', '2019-07-16 16:07:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('EA750234-A9BC-0407-6FB4-7DE084DA81A8', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('EDC4F23B-5F01-1B92-80EE-1CA959DA3A8F', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 4, 4, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('EEF55432-DA39-CE18-9314-AFCD8C522469', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 4, 2, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('EEF6BCCD-8487-3FD9-986F-2AC8E75790E0', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 6, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F086559C-6AD4-2768-0D06-75CA955A9C2C', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '08:00:00', '12:00:00', 10, '08:00:00', '12:00:00', 5, 1, '', '1', '2019-07-17 10:38:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F17041AB-B855-5FFC-AA17-B0D7DB2028B4', 'BBC16941-D777-EF36-1454-ADA6A71BA953', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 5, '', '1', '2019-07-17 09:03:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F1F7E5E9-CA61-8C5D-9B90-C8D8E2D4E95F', 'BA42D429-3BB3-0AC5-31D8-782FC2CECB6B', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 7, '', '1', '2019-07-17 09:03:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F3E14C6B-2544-EB52-C47C-09C5ECF37D49', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 5, 2, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F40B9B19-1F4C-A789-D1B3-719DAEAAA5B9', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 4, 1, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F476E2CC-B235-161B-7EA6-A3CFB947B033', '', '673C4057-B4E0-E9DC-4C7E-5B4DCC2CD60F', '08:00:00', '12:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-24 09:36:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('F9C80392-F0FD-1562-5F6E-B25B741F3BA0', 'A149FB3A-CDDA-BDB8-5F51-1CB635C6D6E6', '260979DA-CDAA-B964-10C8-3861BF503D62', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 6, '', '1', '2019-07-23 08:11:19', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('FABFF9D6-5D39-72FA-5112-D92BA9E2F919', '', '1F9AE642-BAC8-0D6C-CB0B-2F64C0B9659D', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 4, '', '1', '2019-07-24 09:49:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('FC73F5E6-41AE-D263-49C7-B659B79835E2', '197F4539-529C-A728-F8BB-5B5779FD2054', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '08:00:00', '12:00:00', 5, '08:00:00', '12:00:00', 5, 3, '', '1', '2019-07-17 09:04:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('FCA2562F-C5DA-5EFC-9C73-64C0CCF1F810', '763E90B4-F961-158A-D431-09EB40C5AA0A', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 5, 3, '', '1', '2019-07-17 09:18:03', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('FF69EFCB-FFC8-09C6-2ABD-2AFF100D9AD4', 'B5584290-7440-BA41-5F1B-6B82D87A5886', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '15:00:00', '19:00:00', 10, '15:00:00', '19:00:00', 5, 2, '', '1', '2019-07-17 09:01:37', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_req_queue`
--

CREATE TABLE `master_req_queue` (
  `id` varchar(36) NOT NULL,
  `id_booking` varchar(13) NOT NULL,
  `id_schedule_practice` varchar(36) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT NULL COMMENT 'BPJS/Asuransi/Umum',
  `type_patient` varchar(255) DEFAULT NULL,
  `bpjs_id` varchar(100) DEFAULT NULL,
  `id_poly_doctor` varchar(36) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_doctor` varchar(36) DEFAULT NULL,
  `tanggal` varchar(10) DEFAULT NULL,
  `queue_number` int(3) DEFAULT NULL,
  `booking_code` varchar(20) NOT NULL,
  `queue_code` varchar(20) NOT NULL,
  `id_payment` varchar(36) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = booking 1 = cancel oleh user  -- admin -- 2 = approve admin 3 = cancel by admin  -- Konfirm -- 4 = konfirmasi kehadiran user 5 = Batal Hadir  -- Onsite --  6 = Mendapatkan no antrian (Menunggu Antrian) 7 = Selesai 8 = Terlewati',
  `unix_timestamp` varchar(10) NOT NULL DEFAULT '0000000000',
  `nik` varchar(16) DEFAULT NULL,
  `no_rm` varchar(20) DEFAULT NULL,
  `id_loket` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_req_queue`
--

INSERT INTO `master_req_queue` (`id`, `id_booking`, `id_schedule_practice`, `user_status`, `type_patient`, `bpjs_id`, `id_poly_doctor`, `created_date`, `created_by`, `updated_date`, `updated_by`, `name`, `id_doctor`, `tanggal`, `queue_number`, `booking_code`, `queue_code`, `id_payment`, `status`, `unix_timestamp`, `nik`, `no_rm`, `id_loket`) VALUES
('0bd21f10026a8a3bbbc2e02b258f72fe', '20190728180', 'ADC9ADF5-1C16-4BC5-D855-D12FE2DEB26A', 'Lama', 'Lama', '', 'ADC9ADF5-1C16-4BC5-D855-D12FE2DEB26A', NULL, 'a5cb2bc245ca5899ecdc6d8abf39e3b9', '2019-07-28 09:38:51', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'SATRIA WIBOWO TN', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '27-07-2019', 1, '20190728180', '', '', 4, '1564044591', NULL, '863700', ''),
('0DF8661F-A997-7778-7994-990C154BCCB3', '', 'FF69EFCB-FFC8-09C6-2ABD-2AFF100D9AD4', NULL, NULL, NULL, NULL, '2019-07-23 15:26:57', NULL, NULL, NULL, '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '23-07-2019', NULL, '', 'AN.2', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870417', NULL, NULL, ''),
('1042c57a7547d925004918c36008acf7', '20190717596', 'E407C598-C65A-BC2B-01D0-D3D09248FF3A', 'Baru', 'Baru', '', 'ACC90AF0-D853-DC71-303B-DF0796EF4139', NULL, 'e02887c47979bfca76a7fe60b34c905f', '2019-07-17 13:16:23', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'andi', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '17-07-2019', 1, '20190717596', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563334469', '2164321684321684', NULL, ''),
('1473422F-BDBB-8E23-7BC5-A1244D1A5B0B', '', '2561ED6A-2437-7247-D4D2-6FACCA777C45', NULL, NULL, NULL, NULL, '2019-07-19 11:03:23', NULL, NULL, NULL, '', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '19-07-2019', NULL, '', 'PSPD.1', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563509003', NULL, NULL, ''),
('1af54fda4e3b1068decbad355deb2c3e', '20190717430', 'ACC90AF0-D853-DC71-303B-DF0796EF4139', 'Lama', 'Lama', '', 'ACC90AF0-D853-DC71-303B-DF0796EF4139', NULL, 'e02887c47979bfca76a7fe60b34c905f', '2019-07-17 16:12:23', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'NURUL FAHMI HALIM, TN', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '18-07-2019', 1, '20190717430', '', '', 4, '1563354702', NULL, ' 003232', ''),
('244363FA-AEF3-F7DF-7DBA-561C26EF4CDC', '', 'FCA2562F-C5DA-5EFC-9C73-64C0CCF1F810', NULL, NULL, NULL, NULL, '2019-07-17 16:21:21', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '17-07-2019', NULL, '', 'PSPD.1', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563355281', NULL, NULL, ''),
('2472AF9C-9580-3564-5838-3886A8E92226', '', '79A4012B-C069-870F-D96D-58BB834B4C6F', NULL, NULL, NULL, NULL, '2019-07-17 13:17:00', NULL, '2019-07-17 13:18:17', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '17-07-2019', NULL, '', 'PSM.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563344220', NULL, NULL, ''),
('28004D8E-9DF7-2388-141A-79E06A22EE29', '', '35B832D6-C15B-ED9B-6386-47294FD83F62', NULL, NULL, NULL, NULL, '2019-07-19 10:57:18', NULL, '2019-07-23 10:15:56', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '19-07-2019', NULL, '', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563508638', NULL, NULL, ''),
('297B299A-B2C0-1286-1C28-81D2D9F33838', '', '34A76994-835E-EB55-048A-DDCB578DA90E', NULL, NULL, NULL, NULL, '2019-07-18 17:35:44', NULL, '2019-07-23 10:15:52', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '18-07-2019', NULL, '', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563446144', NULL, NULL, ''),
('2EC6B27A-0167-AB26-AC6C-387705F20A5E', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 15:25:35', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.6', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870335', NULL, NULL, ''),
('31f86f6fa1a5a5b0bccd9a7ab07a01a3', '20190717368', 'E407C598-C65A-BC2B-01D0-D3D09248FF3A', 'Baru', 'Baru', '', 'ACC90AF0-D853-DC71-303B-DF0796EF4139', NULL, 'e02887c47979bfca76a7fe60b34c905f', '2019-07-17 16:16:34', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', 'tedi', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '17-07-2019', 1, '20190717368', 'AN.3', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563354848', '8732168432168321', NULL, ''),
('32C4A750-25C4-20A8-9142-0AD3CED51735', '', '25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', NULL, NULL, NULL, NULL, '2019-07-23 15:27:26', NULL, NULL, NULL, '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '23-07-2019', NULL, '', 'AN.3', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870446', NULL, NULL, ''),
('3436a92dd1e802cc0f2e12ad1938e988', '', '6BE0BC92-8180-4E5F-4A96-D6A1AC7237DF', 'Baru', 'Baru', '', '6BE0BC92-8180-4E5F-4A96-D6A1AC7237DF', NULL, '356b846cad7cf7e56881978b52e6ef21', '2019-07-23 15:24:42', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'sopyand', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '26-07-2019', 1, '', '', '', 3, '1563854104', '1234567891234567', NULL, ''),
('37CB940D-B414-3AF8-EE41-D7E4B18EAB6A', '', '31F46BB5-3685-5A17-8DDB-0CB36240819C', NULL, NULL, NULL, NULL, '2019-07-19 11:27:04', NULL, NULL, NULL, '', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '19-07-2019', NULL, '', 'KLK.2', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563510424', NULL, NULL, ''),
('3b363f2ea2cf6be0a8cdc97283d27028', '', 'F40B9B19-1F4C-A789-D1B3-719DAEAAA5B9', 'Lama', 'Lama', '', 'F40B9B19-1F4C-A789-D1B3-719DAEAAA5B9', NULL, 'a5cb2bc245ca5899ecdc6d8abf39e3b9', NULL, NULL, 'SATRIA WIBOWO TN', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '29-07-2019', 1, '', '', '', 0, '1564277497', NULL, '863700', ''),
('3B40E6E5-C93D-0EDF-5588-AB9961E5D3D5', '', 'FF69EFCB-FFC8-09C6-2ABD-2AFF100D9AD4', NULL, NULL, NULL, NULL, '2019-07-23 15:30:01', NULL, NULL, NULL, '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '23-07-2019', NULL, '', 'AN.4', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870601', NULL, NULL, ''),
('41895D4F-C6FC-46CA-DB38-602866A9F634', '', 'B2668F2B-465F-AD16-9191-8AC40DFE8906', NULL, NULL, NULL, NULL, '2019-07-17 14:42:05', NULL, '2019-07-17 14:42:38', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '17-07-2019', NULL, '', 'AN.3', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563349325', NULL, NULL, ''),
('5231A420-0B86-18BE-A2F5-3EDA02018BA1', '', '35B832D6-C15B-ED9B-6386-47294FD83F62', NULL, NULL, NULL, NULL, '2019-07-19 11:26:48', NULL, NULL, NULL, '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '19-07-2019', NULL, '', 'AN.2', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563510408', NULL, NULL, ''),
('5B54B465-32DA-57BC-297C-02690AE76F38', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 15:25:10', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.3', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870310', NULL, NULL, ''),
('5d0e6a5492ba18814256d53574d14b27', '20190722133', 'EEF55432-DA39-CE18-9314-AFCD8C522469', 'Baru', 'Baru', '', 'EEF55432-DA39-CE18-9314-AFCD8C522469', NULL, '3e4f91b00b9b97742d748f70f3bd7b3f', '2019-07-23 08:06:10', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'redika', '17A3FFDE-5E22-5406-5AD9-2FE200CEF9D7', '23-07-2019', 1, '20190722133', 'PSM.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563843704', '3573020712970001', NULL, ''),
('5E7AF965-9AED-95D7-D380-3E9BC10447A8', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 12:18:35', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563859115', NULL, NULL, ''),
('628D3B09-E617-39E6-F83A-1634FD2CD737', '', 'B2668F2B-465F-AD16-9191-8AC40DFE8906', NULL, NULL, NULL, NULL, '2019-07-17 14:41:06', NULL, '2019-07-17 14:41:55', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '17-07-2019', NULL, '', 'AN.2', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563349266', NULL, NULL, ''),
('63B43EC5-E477-6AF2-42F3-3FC2694CC5D3', '', '25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', NULL, NULL, NULL, NULL, '2019-07-23 15:27:26', NULL, NULL, NULL, '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '23-07-2019', NULL, '', 'AN.4', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870446', NULL, NULL, ''),
('66A0F507-BCC2-161C-4DE6-5C577DC788E6', '', 'FF69EFCB-FFC8-09C6-2ABD-2AFF100D9AD4', NULL, NULL, NULL, NULL, '2019-07-23 15:26:57', NULL, NULL, NULL, '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '23-07-2019', NULL, '', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870417', NULL, NULL, ''),
('6949214D-EB11-AF11-0BE9-B0AA9EDFDF90', '', '25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', NULL, NULL, NULL, NULL, '2019-07-23 15:30:44', NULL, NULL, NULL, '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '23-07-2019', NULL, '', 'AN.5', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870644', NULL, NULL, ''),
('6e3436a6563a314817dcf50b130fddcd', '20190718428', '35B832D6-C15B-ED9B-6386-47294FD83F62', 'Baru', 'Baru', '', '35B832D6-C15B-ED9B-6386-47294FD83F62', NULL, '075ae589d72a757a4ef976a53720b809', '2019-07-18 10:39:57', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'sodara', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '19-07-2019', 1, '20190718428', '', '', 4, '1563421130', '3663961583468597', NULL, ''),
('6EA91427-C969-1B6F-4A69-FDD41CBF81B4', '', '79A4012B-C069-870F-D96D-58BB834B4C6F', NULL, NULL, NULL, NULL, '2019-07-17 15:03:35', NULL, '2019-07-17 15:22:26', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '17-07-2019', NULL, '', 'PSM.3', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563350615', NULL, NULL, ''),
('6F687FE1-B01B-1E10-79EE-C0AE303C349D', '', 'FC73F5E6-41AE-D263-49C7-B659B79835E2', NULL, NULL, NULL, NULL, '2019-07-17 16:17:14', NULL, NULL, NULL, '', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '17-07-2019', NULL, '', 'KLK.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563355034', NULL, NULL, ''),
('71F7C009-8BC9-2125-94D4-417EC4D1B016', '', '917E1DA8-6632-4E27-A72B-371D01BF588D', NULL, NULL, NULL, NULL, '2019-07-18 17:35:52', NULL, '2019-07-23 08:05:35', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'E095EC37-4656-8501-F823-16156BB4F81E', '18-07-2019', NULL, '', 'PSPD.1', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 7, '1563446152', NULL, NULL, ''),
('73f1f20f2bcfadf31207f2e497ec3025', '', '7D462D77-26D5-187F-F334-2883596ADAAD', 'Lama', 'Lama', '2121515464894', '7D462D77-26D5-187F-F334-2883596ADAAD', NULL, 'a5cb2bc245ca5899ecdc6d8abf39e3b9', NULL, NULL, 'SATRIA WIBOWO TN', 'E095EC37-4656-8501-F823-16156BB4F81E', '22-07-2019', 1, '', '', '', 0, '1563501190', NULL, '863700', ''),
('7b70cec561b7b1b1a66c0abb3cad1f50', '20190723543', '79A4012B-C069-870F-D96D-58BB834B4C6F', 'Baru', 'Baru', '', '79A4012B-C069-870F-D96D-58BB834B4C6F', NULL, '3e4f91b00b9b97742d748f70f3bd7b3f', '2019-07-23 10:54:21', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'tes', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '24-07-2019', 1, '20190723543', '', '', 4, '1563854020', '3573020712970001', NULL, ''),
('7d5a3662711ca2597ce88acdafd9ca23', '20190717571', '2561ED6A-2437-7247-D4D2-6FACCA777C45', 'Lama', 'Lama', '', '2561ED6A-2437-7247-D4D2-6FACCA777C45', NULL, 'e02887c47979bfca76a7fe60b34c905f', '2019-07-17 14:21:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'NURUL FAHMI HALIM, TN', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '19-07-2019', 1, '20190717571', '', '', 4, '1563348067', NULL, ' 003232', ''),
('7d5afe365c984beffbcaf27967258e15', '', '6BE0BC92-8180-4E5F-4A96-D6A1AC7237DF', 'Baru', 'Baru', '', '6BE0BC92-8180-4E5F-4A96-D6A1AC7237DF', NULL, '52261e4a5b211ec06c416bc9df4514f2', NULL, NULL, 'windi', '1E7267F3-378D-81A7-C1E9-22A7002C3884', '19-07-2019', 1, '', '', '', 0, '1563451372', '3690852147085236', NULL, ''),
('7E8D7D39-DC3D-22FF-BCEF-0C23D4DD083A', '', '2561ED6A-2437-7247-D4D2-6FACCA777C45', NULL, NULL, NULL, NULL, '2019-07-19 11:28:06', NULL, '2019-07-23 11:26:24', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'CFB56F63-6ACA-3F3D-0A86-D16938622C50', '19-07-2019', NULL, '', 'PSPD.2', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 7, '1563510486', NULL, NULL, ''),
('7fb8d46c09641c7330417935c8c3be30', '', '79A4012B-C069-870F-D96D-58BB834B4C6F', 'Lama', 'Lama', '0002227362265', '79A4012B-C069-870F-D96D-58BB834B4C6F', NULL, 'e5d8b2759944ce1399c7ce46d6fcf12e', NULL, NULL, 'PUTRAMAS JOKOPRATOMO, TN', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '24-07-2019', 2, '', '', '', 0, '1563854330', NULL, '321300', ''),
('8CB9ED28-59DE-8530-B8E1-896A9FA9BC0F', '', 'B2668F2B-465F-AD16-9191-8AC40DFE8906', NULL, NULL, NULL, NULL, '2019-07-17 14:39:16', NULL, '2019-07-17 14:40:51', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '17-07-2019', NULL, '', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563349156', NULL, NULL, ''),
('94FF9D39-5443-2BD1-B883-40537F6F6BDD', '', '25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', NULL, NULL, NULL, NULL, '2019-07-23 15:26:47', NULL, NULL, NULL, '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '23-07-2019', NULL, '', 'AN.2', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870407', NULL, NULL, ''),
('97848FA2-197E-267E-E0A8-E6FF51AE7D16', '', 'ACC90AF0-D853-DC71-303B-DF0796EF4139', NULL, NULL, NULL, NULL, '2019-07-18 17:35:08', NULL, '2019-07-23 10:15:53', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '18-07-2019', NULL, '', 'AN.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563446108', NULL, NULL, ''),
('978BD16A-F000-16B0-F739-6166977535B0', '', '79A4012B-C069-870F-D96D-58BB834B4C6F', NULL, NULL, NULL, NULL, '2019-07-17 13:18:40', NULL, '2019-07-17 13:19:23', '5CD44B28-9D4A-1D97-599A-94042E61EBE9', '', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '17-07-2019', NULL, '', 'PSM.2', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563344320', NULL, NULL, ''),
('A1C7EC80-ABFD-E283-3A9C-13C36EFE77EA', '', '09158B43-86B8-35D8-01D5-5FD7C291C19B', NULL, NULL, NULL, NULL, '2019-07-23 08:10:05', NULL, '2019-07-23 12:22:04', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', '', 'E095EC37-4656-8501-F823-16156BB4F81E', '23-07-2019', NULL, '', 'PSPD.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 7, '1563844205', NULL, NULL, ''),
('A2278C06-4F5F-A092-3331-D68AE23E3863', '', 'FF69EFCB-FFC8-09C6-2ABD-2AFF100D9AD4', NULL, NULL, NULL, NULL, '2019-07-23 15:30:01', NULL, NULL, NULL, '', 'E2C3416B-D509-553F-9844-DFA4613A0BE5', '23-07-2019', NULL, '', 'AN.3', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870601', NULL, NULL, ''),
('a57991aff21aefb73506464bd2246fc7', '20190718289', 'CA012594-A6F6-F9A6-FCE8-9E11596BFEF1', 'Lama', 'Lama', '', 'CA012594-A6F6-F9A6-FCE8-9E11596BFEF1', NULL, '0f6b916fb1bfe154f73decb4cc7abe65', '2019-07-18 15:49:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', 'SATRIA WIBOWO TN', '6E57E6C9-1680-D022-8051-9E08AA37FFAC', '20-07-2019', 1, '20190718289', '', '', 4, '1563439588', NULL, '863700', ''),
('b5be6516f58da0e7fe2cefc1b8d5169f', '20190718203', '9C09B33A-C559-6F87-0471-A00387A61A6B', 'Baru', 'Baru', '', '9C09B33A-C559-6F87-0471-A00387A61A6B', NULL, '52261e4a5b211ec06c416bc9df4514f2', '2019-07-23 10:56:22', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'abang', '5E9CBC98-D532-E86D-5DB0-5755C0ACE156', '19-07-2019', 1, '20190718203', 'PSM.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 8, '1563509058', '1234567890123456', NULL, ''),
('BAFEAACA-46CC-FF21-0D79-0DB97954519D', '', '6A70986A-216D-AA22-4DC7-A2728A5A2C0D', NULL, NULL, NULL, NULL, '2019-07-18 17:35:35', NULL, NULL, NULL, '', '24BF672B-873F-A486-A42F-209BD17A018D', '18-07-2019', NULL, '', 'TBDOTS.1', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563446135', NULL, NULL, ''),
('C44A4D37-388B-B3FA-1ACC-89EA4BE00CA8', '', '25091DF0-5C1A-19BB-53B8-FF5DAD7B637D', NULL, NULL, NULL, NULL, '2019-07-23 15:26:47', NULL, NULL, NULL, '', 'E28C5F52-918A-BA48-F926-DC1F9BE9441D', '23-07-2019', NULL, '', 'AN.1', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870407', NULL, NULL, ''),
('cf4dbba2d390d249237a64632561a57c', '', '83B6F34E-F536-7F73-9BE2-6DBE723EC426', 'Baru', 'Baru', '0002101696064', '83B6F34E-F536-7F73-9BE2-6DBE723EC426', NULL, '0dbe88ca1085dd9d2ce0a08924f8b707', NULL, NULL, 'Eni suhaeni', 'E095EC37-4656-8501-F823-16156BB4F81E', '31-07-2019', 1, '', '', '', 0, '1564505242', '3173046006840014', NULL, ''),
('D765AA65-86F4-3E57-74FD-B5A09F2CAECB', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 15:25:10', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.2', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 6, '1563870310', NULL, NULL, ''),
('e9ac196f179e121327a198b78946c487', '20190718274', '31F46BB5-3685-5A17-8DDB-0CB36240819C', 'Lama', 'Lama', '', '31F46BB5-3685-5A17-8DDB-0CB36240819C', NULL, 'a54119a4d96ae9e17d8c3720966d8fe1', '2019-07-23 08:06:35', '5CD44B28-9D4A-1D97-599A-94042E61EBE8', 'SATRIA WIBOWO TN', '176D6BA5-B2E0-D93F-6B95-1980D19BFA61', '19-07-2019', 1, '20190718274', 'KLK.1', '4BF0E3F3-87C9-63B5-F756-94EB7462816E', 7, '1563510362', NULL, '863700', ''),
('EF1087C1-E713-8346-0ABB-E4CDB9BCE9D0', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 15:25:25', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.5', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870325', NULL, NULL, ''),
('FA096729-BDF3-95A0-DBC3-DE7AFED9D5A3', '', 'F3E14C6B-2544-EB52-C47C-09C5ECF37D49', NULL, NULL, NULL, NULL, '2019-07-23 15:25:25', NULL, NULL, NULL, '', '0F2B7AC4-5D2C-4F44-519B-727331EBD55B', '23-07-2019', NULL, '', 'PSPD.4', '19F65BA2-92B2-C5C0-F660-BF7D5BA4C328', 6, '1563870325', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_specialist`
--

CREATE TABLE `master_specialist` (
  `id` varchar(36) NOT NULL,
  `specialist_code` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT NULL COMMENT '0 = "No", 1 = "Yes"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `master_specialist`
--

INSERT INTO `master_specialist` (`id`, `specialist_code`, `name`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('60A737D8-4659-1438-DC7E-984DB7F4A7F3', 'PDP', 'Pelatihan Perawatan, Dukungan & Perawatan', 1, '2019-06-14 14:28:48', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('65E98A6E-3D02-6B2B-F6F5-4DD71FB75321', 'IMS', 'Spesialis Infeksi Menular Seksual', 1, '2019-06-14 14:26:09', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('72DA0504-D36F-0B13-1423-B9601DE9BEB4', 'GZ', 'Gizi', 1, '2019-06-27 16:31:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:20', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('78A11BB7-E897-7E90-6554-9CEB090B065D', 'RFM', 'Refraksi Mata', 1, '2019-06-27 16:35:16', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:45', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('79F61381-442F-1FD0-9B3A-7F5B0D2C39A8', 'BS', 'Klinik Spesialis Bedah (Sore)', 0, '2019-07-23 15:05:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('8049BB3E-FE40-D97E-5F28-7F206BB55478', 'SPD', 'Spesialis Penyakit Dalam', 1, '2019-06-14 14:17:38', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-06-14 14:18:20', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('8B9C337E-05FA-F313-9F3A-60CC19B7B51B', 'SPRAD', 'Radiologi', 1, '2019-06-14 14:39:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:57:16', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('8E8D9605-595E-EEC7-760E-844183EE4445', 'SpPD', 'Spesialis Penyakit Dalam', 1, '2019-07-18 11:49:32', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-18 12:02:53', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('92065FCB-3931-F532-3D4D-9B6EF82D7353', 'O', 'Klinik Spesialis Kebidanan & Kandungan', 0, '2019-06-14 14:12:14', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:19:07', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('976FEAD7-C3D9-D2A9-8349-E846739D88EF', 'UM', 'Umum', 1, '2019-06-14 14:26:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:49', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('9B3601E0-11A3-BC9A-9943-5F8024D1F361', 'PDA', 'Klinik Spesialis Penyakit Dalam (Pagi)', 0, '2019-06-14 14:16:47', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:19:24', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('A2426EC2-799E-4F16-E2E2-A82898575CE3', 'M', 'Klinik Spesialis Mata', 0, '2019-06-14 14:17:55', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:19:36', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('A54C9DE7-7AA9-93AE-0018-7E62F604B1D7', 'AP', 'Klinik Spesialis Anak (Pagi)', 0, '2019-06-14 14:18:30', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:19:44', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('AD628C5D-F727-E861-2582-8BF955F6D067', 'BP', 'Klinik Spesialis Bedah (Pagi)', 0, '2019-06-14 14:19:10', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:05:26', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('B16CA09A-7A03-2799-4825-4DA6B4E33C17', 'SF', 'Klinik Spesialis Fisik & Rehabilitas Medik', 0, '2019-07-24 09:50:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('CE4C6859-46C3-7729-7615-EE6416CE7571', 'MD', 'Madu', 1, '2019-06-27 16:33:41', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:56:43', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('D6B4AC7D-CE8A-1573-2926-9535F292E7C2', 'G', 'Klinik Gigi', 0, '2019-06-14 14:22:02', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:05:01', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('EC385375-6A82-2925-A36C-4CEE2E3C3F49', 'FT', 'Fisioterapi', 1, '2019-06-14 14:38:20', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 14:58:24', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('ED9B34F0-6B91-7092-1A3A-3F0556519B09', 'K', 'Klinik Spesialis Kulit & Kelamin', 0, '2019-06-14 14:19:32', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-23 15:05:14', 'B5D6AF2A-149D-5C4F-8721-528A47004F88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` varchar(36) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `id_category` varchar(36) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type` int(1) NOT NULL COMMENT '1= "video", 2= "text"',
  `image` text DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL COMMENT '0 = "Non Active", 1 = "Active"',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `title`, `id_category`, `content`, `type`, `image`, `is_active`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
('343A3CE8-491F-0F3E-5548-A2F1FC70482C', 'Demam Berdarah', '66F6608E-DC15-13E9-0FD5-6FA29BF1EEA6', 'Memasuki musim hujan, bukan hanya flu atau pilek yang umum terjadi. Penyakit lain yang cukup serius, seperti demam berdarah juga mulai mewabah. Anda mungkin melihat banyak beritanya di siaran televisi, tentang banyaknya pasien DBD yang memenuhi rumah sakit. Selain itu, pemerintah juga gencar mengimbau masyarakat untuk mencegah penularannya dan mengamati gejala demam berdarah lebih dini. Sebenarnya, seperti apa gejala demam dengue ini? Yuk, simak ulasannya berikut ini. \r\nDemam berdarah atau dikenal dengan DBD adalah penyakit menular akibat gigitan nyamuk yang membawa virus dengue. Ada dua jenis nyamuk yang menjadi kurir penyebaran virus dengue, yaitu Aedes aegypty dan Aedes albocpictus. Namun, jenis nyamuk yang paling sering menyebarkan penyakit ini di Indonesia adalah nyamuk betina jenis Aedes aegypty. \r\nMeski disebut penyakit menular, penyakit DBD tidak ditularkan dari orang ke orang, seperti flu atau pilek. Virus dengue membutuhkan perantara, yaitu nyamuk untuk mematangkan virus. Kemudian, ketika nyamuk pembawa virus ini menggigit kulit manusia, virus akan berpindah dari lewat gigitan tersebut.\r\n\r\nOrang yang sudah terinfeksi virus dengue dapat menularkan infeksi selama 4 hingga 5 hari setelah gejala DBD pertama muncul. Bahkan, bisa terus menyebarkan infeksi virus hingga 12 hari.\r\n\r\nCara penyebaran virusnya, yakni orang yang terinfeksi digigit nyamuk. Kemudian, virus berpindah ke tubuh nyamuk dan berinkubasi selama 4 hingga 10 hari. Selanjutnya, jika nyamuk tersebut menggigit orang yang sehat, maka virus akan berpindah dan menyebabkan infeksi. \r\n', 2, 'images/berita/NW-19180705504612.jpg', 1, '2019-07-18 17:50:46', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', NULL, NULL),
('3E8EF0CB-9A85-78D0-65BB-EFA404C28181', 'menangani diabetes', '93212F09-819C-83DE-BFCB-B246D12C7AFC', 'Jakarta - Selain gaya hidup, penyakit diabetes juga dipengaruhi faktor genetik dalam keluarga. Jika memiliki anggota keluarga dengan diabetes maka peluang mengalami penyakit serupa lebih besar.\r\n\r\n\"Jika punya bapak atau ibu yang diabetes maka peluang anaknya punya penyakit sama adalah 25 persen. Bila keduanya diabetes, peluang menjadi 50 persen. Kalau keduanya kena sebelum usia 30 tahun, risikonya mencapai 70 persen,\" kata dokter ahli endokrinologi dari Fakultas Kedokteran Universitas Indonesia-Rumah Sakit Cipto Mangunkusumo dr Dante Saksono, SpPD-KEMD, PhD.\r\n\r\nMenurut dr Dante, penurunan diabetes tidak menjadi tanggung jawab satu gen. Kondisi ini diturunkan melalui gabungan beberapa dari jutaan gen dalam tubuh manusia (poligenetik). Dengan kondisi ini, maka sebetulnya semua orang Indonesia membawa risiko diabetes dalam gennya.\r\n\r\nHal ini juga bisa dilihat dari prevelansi orang dengan diabetes dalam satu keluarga besar. Saat ini dalam keluarga biasanya ada 1 atau beberapa orang yang mengalami diabetes. Artinya, keturunan berikutnya punya risiko mengalami penyakit degeneratif tersebut.\r\n\r\nKendati berisiko, diabetes bisa dicegah dengan menerapkan pola hidup sehat. Dokter Dante mengingatkan pentingnya memilih asupan kalori, rutin olahraga, mengonsumsi buah dan sayur setiap hari. Masyarakat tentunya harus menghindari rokok yang menjadi faktor risiko banyak penyakit.\r\n', 2, 'images/berita/NW-19150709182173.jpg', 1, '2019-07-15 09:18:21', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-15 12:46:42', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('5EABD910-A214-79EB-E244-4FE5EA698D2F', '10 Penyakit pada Ibu Hamil yang Harus Diwaspadai', '93212F09-819C-83DE-BFCB-B246D12C7AFC', 'DokterSehat.Com\r\n- Selain perubahan bentuk tubuh, perubahan hormon yang dialami oleh ibu hamil membuatnya lebih rentan untuk terkena penyakit. Selain itu, sistem imunitas ibu hamil juga perlu bekerja lebih keras karena harus melindungi tubuhnya dan janin di dalam kandungan. Berikut ini adalah beberapa penyakit pada ibu hamil yang harus Anda kenali.\r\n\r\nMengenali Penyakit Ibu Hamil\r\nSebelum menjelaskan mengenai berbagai macam penyakit pada ibu hamil, perlu diketahui bahwa menjaga kondisi kesehatan adalah sesuatu yang mutlak bagi ibu hamil. Beberapa penyakit bisa berakibat fatal bagi ibu maupun janin. Kadang kala gejala penyakit terlihat sederhana namun hal ini adalah indikasi munculnya penyakit berbahaya.\r\n\r\nOleh karena itulah, mengetahui penyakit berbahaya pada ibu hamil adalah hal penting agar Anda bisa melakukan tindakan pencegahan sedini mungkin, atau bisa melakukan tindakan secepatnya jika gejala penyakit ibu hamil tersebut muncul.\r\n\r\nBerikut ini adalah beberapa penyakit pada ibu hamil yang harus Anda waspadai keberadaannya, di antaranya:\r\n\r\n1. TORCH\r\nPenyakit pada ibu hamil yang pertama dan harus diwaspadai adalah TORCH. Pemeriksaan TORCH diperlukan untuk mendeteksi adanya toksoplasmosis, infeksi lain/Other infection, Rubella, Cytomegalovirus, dan Herpes simplex.\r\n\r\nJika penyakit TORCH terjadi pada ibu hamil, maka janinnya berisiko mengalami berbagai gangguan seperti sistem saraf pusat janin rusak, hilangannya pendengaran, gangguan penglihatan, kelainan mental, gangguan tiroid, dan kelainan sistem imun.\r\n\r\n2. Hepatitis B\r\nHepatitis B adalah penyakit pada ibu hamil lainnya yang harus Anda waspadai. Meski begitu, janin di dalam kandungan umumnya tidak terpengaruh oleh virus hepatitis yang dibawa ibunya selama kehamilan.\r\n\r\nNamun, terdapat beberapa kemungkinan peningkatan risiko tertentu saat persalinan, seperti bayi lahir prematur, bayi lahir dengan berat rendah, atau kelainan anatomi dan fungsi tubuh bayi.\r\n\r\n3. Anemia\r\nPenyakit pada ibu hamil selanjutnya adalah anemia. Apabila penyakit ibu hamil ini tidak mendapatkan penanganan dengan segera, maka bisa menyebabkan kelahiran prematur, berat bayi rendah, hingga cacat lahir. Kondisi ibu hamil yang sering mengalami anemia adalah mereka yang hamil kembar, pola makan tidak sehat, dan sering mengalami morning sickness.\r\n\r\nSaat hamil, kebutuhan darah akan meningkat untuk mendukung pertumbuhan janin. Namun apabila tubuh ibu hamil tidak mampu memproduksi lebih banyak hemoglobin, hal inilah yang menyebabkan terjadinya anemia. Letih, sulit konsentrasi, pusing, sesak bernapas dan kulit pucat adalah tanda dari anemia.\r\n\r\n4. Keputihan\r\nPenyakit ibu hamil yang paling sering terjadi adalah keputihan. Keputihan meningkat saat memasuki masa kehamilan karena berguna untuk melindungi rahim dan vagina dari infeksi. Kondisi ini membuat leher rahim (serviks) dan dinding vagina menjadi lebih lembut.\r\n\r\nJelang masa akhir kehamilan, jumlah keputihan bisa mengalami peningkatan dan mungkin terdapat bercak darah. Hal ini merupakan tanda bahwa tubuh mulai mempersiapkan kelahiran.\r\n\r\nJika terjadi perubahan yang tidak biasa seperti perubahan warna, aroma dan muncul nyeri di sekitar vagina, sebaiknya segera konsultasi dengan dokter.\r\n\r\n5. Perdarahan\r\nMemasuki trimester pertama, penyakit pada ibu hamil yang bisa muncul adalah terjadi perdarahan. Meski begitu, tidak semua perdarahan saat hamil adalah sesuatu yang membahayakan. Perdarahan terjadi karena proses menempelnya sel telur yang telah dibuahi di dinding rahim atau setelah melakukan penetrasi yang keras.\r\n\r\nPerdarahan bisa menjadi bahaya apabila diikuti dengan kram dan nyeri perut yang hebat. Selain itu, kehamilan ektopik atau pertumbuhan janin abnormal juga bisa menyebabkan perdarahan. Jika Anda ragu apakah perdarahan yang dialami sesuatu yang normal atau tidak, konsultasi dengan dokter kandungan untuk mendapatkan penanganan yang tepat.\r\n\r\n6. Plasenta previa\r\nPlasenta previa adalah kondisi ketika ari-ari berada di bagian bawah rahim, sehingga menutupi sebagian atau seluruh jalan lahir. Plasenta previa dapat mengakibatkan perdarahan yang berlebihan atau perdarahan di bagian bawah rahim. Apabila perdarahan tidak berhenti maka janin harus segera dilahirkan melalui operasi caesar.\r\n\r\n7. Diabetes gestasional\r\nPenyakit pada ibu hamil berikutnya yang sering dialami adalah diabetes gestasional. Bahkan penyakit ibu hamil ini dapat dialami oleh wanita yang belum didiagnosis diabetes sebelumnya.\r\n\r\nPenyebab pasti diabetes gestasional pada ibu hamil belum diketahui secara pasti, namun faktor perubahan hormon sering dianggap sebagai pemicunya. Biasanya gejala diabetes gestasional menghilang setelah melahirkan.\r\n\r\n8. Candidiasis\r\nCandidiasis adalah penyakit pada ibu hamil yang terjadi karena perubahan hormon. Candidiasis adalah infeksi yang disebabkan oleh jamur Candida. Perlu diketahui, pada dasarnya, kulit manusia terdapat jamur (fungi) dan bakteri yang tidak berbahaya.\r\n\r\nNamun, jika fungi dan bakteri tersebut berkembang biak tak terkontrol, hal itu bisa menyebabkan infeksi. Adalah candidiasis vulvovaginal, infeksi candidiasis yang terjadi pada organ genital wanita.\r\n\r\n9. Sakit punggung\r\nMeningkatnya usia kehamilan akan diiringi dengan meningkatnya pertumbuhan janin, di mana kondisi ini otomatis akan memberatkan punggung dan panggul. Dampaknya, hal ini bisa menyebabkan sakit punggung.\r\n\r\nMeski begitu, penyakit ibu hamil ini adalah sesuatu yang normal karena ligamen yang menghubungkan antar tulang menjadi lebih lunak dan meregang untuk mempersiapkan persalinan.\r\n\r\n10. Sembelit\r\nPenyakit pada ibu hamil yang terakhir dan umumnya terjadi di trimester pertama kehamilan adalah munculnya sembelit. Penyakit ibu hamil ini disebabkan oleh perubahan hormon, meski begitu sembelit juga bisa dipengaruhi oleh pola makan yang kurang mendapatkan asupan serat.\r\n\r\nApabila sembelit tidak segera ditangani, hal itu bisa menyebabkan berkembangnya ambeien, yaitu bengkaknya pembuluh darah di sekitar anus.\r\n\r\nNah, itulah beberapa penyakit pada ibu hamil yang harus diwaspadai. Pada akhirnya, agar penyakit ibu hamil seperti di atas tidak terjadi, Anda harus rutin melakukan pemeriksaan kehamilan secara rutin. Jika ditemukan masalah, dokter bisa segera melakukan penanganan sesuai dengan gangguan yang terjadi.', 2, 'images/berita/NW-19150710155522.jpg', 1, '2019-07-15 10:15:55', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-15 15:48:59', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('iulgfrbbjkjlg', 'Video Percobaan', '93212F09-819C-83DE-BFCB-B246D12C7AFC', 'ini  tentang video percobaan ya', 1, 'https://www.youtube.com/watch?v=cd4Y_2onFVc', 1, '2019-07-02 00:00:00', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-31 00:00:00', 'B5D6AF2A-149D-5C4F-8721-528A47004F88'),
('iulgfrbbjkjlgusadiu', 'Anak Anak Dan Odol', '93212F09-819C-83DE-BFCB-B246D12C7AFC', 'ini berita pecobaan juga', 2, 'images/berita/NW-19010704264626.jpg', 1, '2019-07-02 00:00:00', 'B5D6AF2A-149D-5C4F-8721-528A47004F88', '2019-07-15 10:24:34', 'B5D6AF2A-149D-5C4F-8721-528A47004F88');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_quota`
--

CREATE TABLE `status_quota` (
  `id` int(11) NOT NULL,
  `id_schedule_practice` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL COMMENT 'Tanggal yang tersedia',
  `total_quota` int(11) DEFAULT NULL COMMENT 'Total Kuota',
  `pengantri` int(11) DEFAULT NULL COMMENT 'Orang yang sudah mendaftar',
  `available_quota` int(11) DEFAULT NULL COMMENT 'Kuota Tersedia',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(36) NOT NULL,
  `unique_code_type` int(1) DEFAULT NULL COMMENT '1 = "BPJS", 2 = "KTP", 3 = "NIK", 4 = "Lainnya"',
  `unique_code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `loc_provinces_id` varchar(36) DEFAULT NULL,
  `loc_regencies_id` varchar(36) DEFAULT NULL,
  `loc_districts_id` varchar(36) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL COMMENT 'P/L',
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `password` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `unique_code_type`, `unique_code`, `name`, `birth_place`, `birth_date`, `loc_provinces_id`, `loc_regencies_id`, `loc_districts_id`, `address`, `gender`, `telp`, `email`, `created_date`, `created_by`, `updated_date`, `updated_by`, `password`) VALUES
(1, NULL, NULL, 'pol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085641323687', 'djyaul@gmail.com', NULL, NULL, NULL, NULL, 'fb6eb2ef3bce7f75938dc0637d8088b72a310ac6'),
(3, NULL, NULL, 'ziaul haq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085641323688', 'ziaulhaq@mhs.dinus.ac.id', NULL, NULL, NULL, NULL, '04324ec01d4203b3a4aadd068225138b2c5c7197'),
(4, NULL, NULL, 'sodara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085741953670', 'sodarawin@gmail.com', NULL, NULL, NULL, NULL, 'b533349886c53d3c768fb78fba62c4e8e2083462'),
(5, NULL, NULL, 'Wanda Riswanda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '089516500899', 'wandariswanda1026@gmail.com', NULL, NULL, NULL, NULL, '97a53123596032f0f3b28521ece37365ab0ab2b3'),
(6, NULL, NULL, 'Rega Febriana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081294406044', 'rega.pebriana@gmail.com', NULL, NULL, NULL, NULL, '009c58ae5cef7c1411f988f23530f44c2abc2849'),
(7, NULL, NULL, 'salsa aprilia imani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '088211463134', 'salsaaprilia8@gmail.com', NULL, NULL, NULL, NULL, 'bb0dce17cb5e1971943af5f58b9926d89516c746'),
(8, NULL, NULL, 'Muchamad Iqbal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '082110160232', 'iqbbaly@gmail.com', NULL, NULL, NULL, NULL, 'b278939914e609ad28c67a13f691c32c8345f150'),
(9, NULL, NULL, 'Stefanus agung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08563417591', 'chris.kompor@gmail.com', NULL, NULL, NULL, NULL, '2f25159d80a1f38ef05600fd7c2215084f7b8344'),
(11, NULL, NULL, 'anggi mardiyanto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '087770002067', 'mardiyanto.anggi94@gmail.com', NULL, NULL, NULL, NULL, '5da09071d96af164dfd5921f2bb2b9728b17be1a'),
(12, NULL, NULL, 'Fitri Andriasari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '082123636400', 'andria1303@gamil.com', NULL, NULL, NULL, NULL, 'ef0f83259c7f91297ccd18437aa92652cca8a7cb'),
(13, NULL, NULL, 'maedah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081298644596', 'maedah.medyana@gmail.com', NULL, NULL, NULL, NULL, '32b7af865dc334c425c316a282c286ac1006440f'),
(14, NULL, NULL, 'irwan irmawandi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085723232014', 'irwanirmawandi1994@gmail.com', NULL, NULL, NULL, NULL, 'd5e94652371c9b7c591f029b33fc9d459a818d1f'),
(15, NULL, NULL, 'Aep Saepulloh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08118452288', 'leuweung.oko@gmail.com', NULL, NULL, NULL, NULL, '4d505719ce02f45d7f47ccffd967a79495305156'),
(16, NULL, NULL, 'ricca amelia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081294000425', 'ricca.tkbu@gmail.com', NULL, NULL, NULL, NULL, '33deb8628ff1bd3b2487c27f4697593955436a21'),
(17, NULL, NULL, 'bang amoz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081210282860', 'agungmozin@gmail.com', NULL, NULL, NULL, NULL, '8f11933f82833dbcb95d7a2c2d7a3074110300c0'),
(18, NULL, NULL, 'agus', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085101631877', 'wealthyas999@gmail.com', NULL, NULL, NULL, NULL, 'ec4668eb04ce69e9feba57a83d0d440336ed6cff'),
(19, NULL, NULL, 'TATANG SOPYAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081908126064', 'tatangsofian7@gmail.com', NULL, NULL, NULL, NULL, '3efed72367f7368de631eddf3188a02db0e31cc3'),
(20, NULL, NULL, 'rosy kusuma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08122802938', 'rosy.kusuma@gmail.com', NULL, NULL, NULL, NULL, 'a01190e288b347ef9f21367041e9e3040385385f'),
(21, NULL, NULL, 'UMMI Dina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08127679484', 'dinaummi91@gmail.com', NULL, NULL, NULL, NULL, '7dde487e266f3bba318d25cfd05a3e7144bd0896'),
(22, NULL, NULL, 'Ismail', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0857123456789', 'bangismailwae@gmail.com', NULL, NULL, NULL, NULL, 'd42a588c01683fb6091621e9edeae78742f40d3e'),
(25, NULL, NULL, 'Senco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081222333444', 'barbarian060@gmail.com', NULL, NULL, NULL, NULL, '218adbf4c6ef28c58bab958dd70cc7f0e90787dd'),
(26, NULL, NULL, 'Raja Warteg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085321654987', 'makanwarteglagi@gmail.com', NULL, NULL, NULL, NULL, '42a27e16852d964f10db01d53758ef02a00ad977'),
(27, NULL, NULL, 'Angel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '087899566233', 'thelastscreamsquad@gmail.com', NULL, NULL, NULL, NULL, 'e1571ea792669d20f219a7e0182ab1d3eaba3457'),
(28, NULL, NULL, 'Satria Wibowk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085776844736', 'satria.nux@gmail.com', NULL, NULL, NULL, NULL, '126a0490c90f1233b6a86b396bac919468591dfc'),
(29, NULL, NULL, 'Khorianis Malina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085716009941', 'kaori.ozora@gmail.com', NULL, NULL, NULL, NULL, 'b771d71ec199abe8070b60303182fc69932676b8'),
(30, NULL, NULL, 'Rosya Ruwaidah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0812345678900', 'bang.ismail.wae@gmail.com', NULL, NULL, NULL, NULL, 'c9e47301065d28776378e4e8fd0d6b81e77f2164'),
(31, NULL, NULL, 'sugeng priwanto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08158749574', 'sugengpriwanto72@gmail.com', NULL, NULL, NULL, NULL, 'b29d908e13a6cfe325c8d9772e1e223c8425f96a'),
(32, NULL, NULL, 'Desy Arisandi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08998778335', 'arisandi.desy.da@gmail.com', NULL, NULL, NULL, NULL, '2cb69e71b20d3e051469458198b944ec19b548a6'),
(33, NULL, NULL, 'redika', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08977962839', 'redikatokkotak@gmail.com', NULL, NULL, NULL, NULL, '184350bdd77d9c89f3a3b9af1f615447b5f7785d'),
(34, NULL, NULL, 'Sugiono', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081311990706', 'Sugickalchantara1989@gmail.com', NULL, NULL, NULL, NULL, '91142724ad3cb24384b9ae17f0be38ec7c11bddc'),
(35, NULL, NULL, 'meyhoa dermawan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '087886463018', 'meyhoa18@gmail.com', NULL, NULL, NULL, NULL, '655ea105f2edd936834c1e84b26eac42e4cb5e73'),
(36, NULL, NULL, 'Putramas Jokopratomo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085710338569', 'Putramas.Jp@gmail.com', NULL, NULL, NULL, NULL, 'a20edea7012b5eca5eb2f1be8f12ea357afccc74'),
(37, NULL, NULL, 'Nova Yuliana ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081386311486', 'novay248@gmail.com', NULL, NULL, NULL, NULL, 'f47daf0dffce3706db5a683692c5cff95e0e0331'),
(38, NULL, NULL, 'Winda Hairani Purba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081317219260', 'winda_hairanipurba@yahoo.com', NULL, NULL, NULL, NULL, '9287985c7f53ddc6aa5ad4c075f3be0d3b5ac3f7'),
(39, NULL, NULL, 'Sisilia Nike ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085252055626', 'nike.sisilia@yahoo.co.id', NULL, NULL, NULL, NULL, '58f8c6fbf3106a496fe367193c2277a2f0b97b4f'),
(40, NULL, NULL, 'tan mudji ngestuwati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '083807539623', 'susy.mudji@gmail.com', NULL, NULL, NULL, NULL, '4bd74dcb72b67d7980d3c80f44194ea59b400336'),
(41, NULL, NULL, 'Dwi Aribowo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08567632323', 'it.pkmcengkareng@gmail.com', NULL, NULL, NULL, NULL, '5efddb535d863da906f23280e4e82e35ad1a953a'),
(42, NULL, NULL, 'ridhafika', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08111049242', 'ridhafikaulfa@yahoo.com', NULL, NULL, NULL, NULL, 'a114010d2c5dec8c23f31bc551d88944c55b7a03'),
(43, NULL, NULL, 'Daniel Roy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085277762424', 'daniel31roy@gmail.com', NULL, NULL, NULL, NULL, 'b81285e3986b576c7285d12c08caf9d97952ee91'),
(44, NULL, NULL, 'nana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08569964593', 'nana_sukarna25@yahoo.com', NULL, NULL, NULL, NULL, '965ce8fb363ca7503905e54521a2ed7345ababe6'),
(45, NULL, NULL, 'mohamad ikbal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '081932800090', 'ikbal160682@gmail.com', NULL, NULL, NULL, NULL, '034ab389ecb43c71776e70828d202354212a6e38'),
(46, NULL, NULL, 'Fadillah Amin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08567030991', 'fadillah.amin@gmail.com', NULL, NULL, NULL, NULL, '881462ce99d345a3b363a4b39a77dfb2d151b086'),
(47, NULL, NULL, 'saksi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '087848141374', 'saksiwira1606@gmail.com', NULL, NULL, NULL, NULL, 'e1a2e137814dbd400cf9d80accafd5f6b9f71cbb'),
(48, NULL, NULL, 'iya surya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '088213288976', 'iyasuryaofficial@gmail.com', NULL, NULL, NULL, NULL, '753c66ee0d363989de82cdade2ba5bc9b54b5116');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `app_access_group`
--
ALTER TABLE `app_access_group`
  ADD PRIMARY KEY (`access_group_id`) USING BTREE;

--
-- Indeks untuk tabel `app_module`
--
ALTER TABLE `app_module`
  ADD PRIMARY KEY (`module_id`) USING BTREE;

--
-- Indeks untuk tabel `app_submodule`
--
ALTER TABLE `app_submodule`
  ADD PRIMARY KEY (`submodule_id`) USING BTREE;

--
-- Indeks untuk tabel `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `chat_row`
--
ALTER TABLE `chat_row`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_category_news`
--
ALTER TABLE `master_category_news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_counter`
--
ALTER TABLE `master_counter`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_doctor`
--
ALTER TABLE `master_doctor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_payment`
--
ALTER TABLE `master_payment`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_poly`
--
ALTER TABLE `master_poly`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_poly_doctor`
--
ALTER TABLE `master_poly_doctor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_practice_schedule`
--
ALTER TABLE `master_practice_schedule`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_req_queue`
--
ALTER TABLE `master_req_queue`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `master_specialist`
--
ALTER TABLE `master_specialist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `status_quota`
--
ALTER TABLE `status_quota`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_access_group`
--
ALTER TABLE `app_access_group`
  MODIFY `access_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `app_module`
--
ALTER TABLE `app_module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `app_submodule`
--
ALTER TABLE `app_submodule`
  MODIFY `submodule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `app_user`
--
ALTER TABLE `app_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `chat_row`
--
ALTER TABLE `chat_row`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
