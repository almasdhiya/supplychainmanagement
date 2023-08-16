-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221031.25fe766a26
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 06:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scmgandingfix2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cust` int(11) NOT NULL,
  `nama_cust` varchar(128) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `alamat_cust` varchar(128) NOT NULL,
  `kontak_cust` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cust`, `nama_cust`, `nickname`, `alamat_cust`, `kontak_cust`) VALUES
(79, 'Sakura Manufacturing Auto Parts Indonesia', 'SMAP', 'Jl. Akasia II Blok AE No. 47, Sukaresmi, Cikarang Selatan, Sukaresmi, Kabupaten Bekasi, Jawa Barat', '0219341245'),
(86, 'Cipta Nissin Industries', 'CNI', 'Jalan Raya Bekasi No. KM 23', ''),
(90, 'Sanden Indonesia', 'Sanden', 'Kawasan Industri Deltamas KITIC Kav. No. 7A & 8, Nagasari, Serang Baru, Nagasari, Kec. Serang Baru,', ''),
(91, 'Inti Ganda Perdana', 'IGP', 'Jalan Penggangsaan Dua, Kelapa Gading', '021-4602755'),
(92, 'Panasonic Manufacturing Indonesia', 'Panasonic', 'Jl. Raya Jakarta-Bogor No. KM.29 RW. 3, Pekayon, Jakarta Timur, DKI Jakarta', ''),
(93, 'Sakura Java Indonesia', 'SJI', 'Jl. Kawasan Industri Ejip No. 1, Ciantra, Kabupaten Bekasi, Jawa Barat', ''),
(94, 'Sanoh Indonesia', 'SI', 'Kawasan Industri Hyundai, Jl. Inti II No. 10, Sukaresmi, Kabupaten Bekasi, Jawa Barat', ''),
(95, 'Exedy Manufacturing Indonesia', 'Exedy', 'Jalan Permata V Lot EE-3, Kawasan Industri KIIC, Sirnabaya, Kec. Telukjambe Tim., Kabupaten Karawang', ''),
(96, 'Chandra Nugerah Cemerlang', 'CNC', 'Jl. Akasia 2 Blok AE No. 25 Delta Silikon Industrial Park, Lippo Cikarang-Bekasi', ''),
(97, 'Fukoku Tokai Rubber', 'FTR', 'Jalan Industri Selatan 6A Blok GG No. 6A-F, Jl. Kw. Industri Jl. Jababeka Raya, Pasirsari, Cikarang', ''),
(98, 'Wijaya Karya Industri & Konstruksi', 'WIKA', 'Kawasan Industri WIKA, Jl. Raya Narogong KM 26, Cileungsi - Kab. Bogor 16820', ''),
(99, 'Haeir Electrical Appliances Indonesia', 'Haeir', 'EJIP Industrial Park Plot 1A no.2, Sukaresmi, Cikarang Sel., Kabupaten Bekasi, Jawa Barat 17550', ''),
(100, 'Tiger Sash Indonesia', 'TSI', 'Jl. Teuku Umar Km. 29B Telaga Asih, Cikarang Barat, Bekasi', '(021) 88395367');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryfg`
--

CREATE TABLE `deliveryfg` (
  `id_delivfg` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `qty_delivfg` int(11) NOT NULL,
  `nosurjal` varchar(30) NOT NULL,
  `tgl_delivfg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryfg`
--

INSERT INTO `deliveryfg` (`id_delivfg`, `id_part`, `id_po`, `id_cust`, `qty_delivfg`, `nosurjal`, `tgl_delivfg`) VALUES
(100, 193, 179, 91, 200, '2019', '2023-12-31'),
(101, 193, 179, 91, 200, '2910', '2023-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `fg`
--

CREATE TABLE `fg` (
  `id_fg` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `qty_fg` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_qty_part` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fg`
--

INSERT INTO `fg` (`id_fg`, `id_po`, `id_cust`, `id_part`, `qty_fg`, `total_qty`, `total_qty_part`) VALUES
(407, 179, 91, 193, 200, 198, 0),
(408, 179, 91, 193, 198, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `nama_material` varchar(128) NOT NULL,
  `kode_material` varchar(128) NOT NULL,
  `spek_material` varchar(128) NOT NULL,
  `ketebalan` char(20) NOT NULL,
  `lebar` char(20) NOT NULL,
  `panjang` char(20) NOT NULL,
  `berat_jenis` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id_material`, `id_supp`, `nama_material`, `kode_material`, `spek_material`, `ketebalan`, `lebar`, `panjang`, `berat_jenis`) VALUES
(16, 2, 'Material', 'SJI-01928', 'SPCC-SD', '2', '115', '1219', '7,85'),
(17, 2, 'BOLT', 'N1451-D0380-SUB2', '', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `material_recipt`
--

CREATE TABLE `material_recipt` (
  `id_mtl` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `surjal` varchar(50) NOT NULL,
  `qty_dikirim` int(11) NOT NULL,
  `status1` varchar(20) NOT NULL,
  `id_po_supp` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_recipt`
--

INSERT INTO `material_recipt` (`id_mtl`, `id_material`, `surjal`, `qty_dikirim`, `status1`, `id_po_supp`, `id_supp`) VALUES
(253, 16, '1781', 200, 'Sudah Digunakan', 172, 2),
(254, 16, '2918', 200, 'Sudah Digunakan', 176, 2),
(255, 16, '817l', 20, 'Belum Digunakan', 175, 2);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id_part` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `nama_part` varchar(128) NOT NULL,
  `kode_part` varchar(128) NOT NULL,
  `berat_jenis` char(30) NOT NULL,
  `spek_material` varchar(128) NOT NULL,
  `ketebalan` int(11) NOT NULL,
  `lebar` int(11) NOT NULL,
  `panjang` int(11) NOT NULL,
  `diameter` float NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id_part`, `id_cust`, `nama_part`, `kode_part`, `berat_jenis`, `spek_material`, `ketebalan`, `lebar`, `panjang`, `diameter`, `gambar`) VALUES
(151, 90, 'B1M-CLAMP ASSY', 'N1451-D0360', '7.85', 'SPCC-SD', 1, 40, 35, 0, ''),
(157, 79, 'REINFORCEMENT ', '1FD-E476F-0000-S0305', '7.75', 'SUS409L', 1, 130, 1219, 2, ''),
(158, 79, 'Body Silincer 1 1WD', '1WD-E466A-0000-S0905', '7.75', 'SUS409L', 1, 340, 310, 0, 'Romania.jpg'),
(159, 79, 'Body Silincer 2 1WD', '1WD-E466E-D000-S0905', '7.75', 'SUS409L', 1, 356, 380, 0, 'Romania.jpg'),
(160, 79, 'Plate 3 1WD', '1WD-E469K-0000-S0305', '7.75', 'SUS409L', 1, 140, 1219, 0, 'Romania.jpg'),
(161, 79, 'Body 2-1 1WD', '1WD-E472A-0000-S0305', '7.75', 'SUS409L', 0, 190, 150, 0, 'Romania_waifu2x_art_noise3.png'),
(162, 79, 'Body 2-2 1WD', '1WD-E472E-0000-S0305', '7.75', 'SUS409L', 0, 190, 150, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(163, 79, 'Body 2-3 1WD', '1WD-E472F-0000-S0305', '7.75', 'SUS409L', 0, 150, 350, 0, 'Motivation.jpg'),
(164, 79, 'BRACKET 2-2 2MS', '2MS-E472L-0000-S0605', '7.75', 'SUS409L', 2, 150, 1219, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(165, 79, 'BODY SILINCER 2 MS', '2MS-E466E-0000-S1505', '7.75', 'SUS409L', 1, 356, 380, 0, 'Paris, France.jpg'),
(166, 79, 'BODY SILINCER 2 B02', 'B02-E466E-0000-S1505', '7.75', 'SUS409L', 1, 356, 380, 0, 'Teddy 🤍.jpg'),
(167, 79, 'BODY SILINCER 2 BS7', 'BS7-E466E-0000-S1505', '7.75', 'SUS409L', 1, 356, 380, 0, 'Romania.jpg'),
(168, 79, 'BODY SILINCER BS8', 'BS8-E466E-0000-S1505', '7.75', 'SUS409L', 1, 356, 380, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(169, 79, 'PIPE 7', '2PV-E475K-0000-S0305', '0', '', 0, 0, 0, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(170, 86, 'ARM MSA-7000 LH', '30001100', '7.85', 'SS400', 4, 40, 1219, 0, 'Teddy 🤍.jpg'),
(171, 86, 'BRACKET 1 INTAKE REAR', '121207032', '7.85', 'SPHCPO', 3, 152, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(172, 86, 'STAY 2 INTAKE REAR', '121208032', '7.85', 'SPHCPO', 3, 94, 1219, 0, 'WhatsApp Image 2022-10-15 at 8.32.53 AM.jpeg'),
(173, 86, 'STAY 3 INTAKE REAR', '121209032', '7.85', 'SPHCPO', 3, 104, 1219, 0, 'Romania.jpg'),
(174, 86, 'BRACKET 4 INTAKE REAR', '121210032', '7.85', 'SPHCPO', 3, 104, 1219, 0, 'Paris, France.jpg'),
(175, 86, 'BRACKET INTAKE FRONT', '121234032', '7.85', 'SPHCPO', 3, 77, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(176, 86, 'JOINT PIPE FR A', '99SGTSLO011400920', '7.85', 'SUS 409 THK', 2, 166, 1219, 0, 'Paris, France.jpg'),
(177, 86, 'JOINT PIPE FR B', '99SGTSLO0114101920', '7.85', 'SUS 409 THK', 2, 144, 1219, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(178, 86, 'LEVER MSA-700 SC', '35100080', '7.85', 'SS400', 8, 270, 1219, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(179, 86, 'HEAT PROTECTOR VCC 09-7020', '99SGTSLO0115850910', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(180, 90, 'B1M-BRACKET 2', 'N1451-D0390', '7.85', 'YSC270CC', 1, 145, 1219, 0, 'Paris, France.jpg'),
(181, 90, 'B1M-CLAMP', 'N1451-D0400', '7.85', 'SPCC-SD', 1, 125, 1219, 0, 'Slide template.jpg'),
(182, 90, 'B1M-CLAMP D0430', 'N1451-D0430', '7.85', 'YSC270CC', 1, 160, 1219, 0, 'Motivation.jpg'),
(183, 90, 'B1M-BRACKET 1 + 2 BOLT', 'N1451-D0380', '7.85', 'YSC270CC', 1, 131, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(184, 90, 'RUBBER (KECIL)', 'N1451-D0360-SUB1', '0', '', 0, 0, 0, 0, 'Romania.jpg'),
(185, 90, 'RUBBER (BESAR)', 'N1451-D0430-SUB1', '0', '', 0, 0, 0, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(186, 90, 'COLLAR', 'N1451-D0380-SUB1', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(187, 90, 'B1M-BRACKET 1 TANPA BOLT', 'N1451-D0460', '7.85', 'YSC270CC', 1, 131, 1219, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(188, 90, 'BOLT', 'N1451-D0380-SUB2', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(193, 91, 'Bracket Tube Clamp BZ120', '47381-BZ120#106210010', '7.85', 'SPHCPO', 2, 65, 1219, 0, 'Paris, France.jpg'),
(194, 91, 'Bracket Flexible Hose BZ140', '47351-BZ140#199730010', '7.85', 'SPHCPO', 2, 80, 1219, 0, 'Paris, France.jpg'),
(195, 91, 'NUT M6 (SAGATEK)', '47381-BZ120#106210010-SUB1', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(196, 92, 'BASEPAN', 'ACXD52-00130', '7.85', 'NSDCD2 SZQFKXK1', 0, 300, 700, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(197, 92, 'SOUND PROF BOARD', 'H151407', '7.85', 'ST SGCC-Z22', 0, 250, 505, 0, 'Paris, France.jpg'),
(198, 92, 'BASE PANE', 'D521416', '7.85', 'NSDCD2 SZQFKXK1', 0, 300, 700, 0, 'Paris, France.jpg'),
(199, 92, 'SOUND PROF BOARD', 'ACXH15-02900', '7.85', 'STEEL SGCC-Z22', 0, 395, 625, 0, 'Romania.jpg'),
(200, 92, 'BRACKET FAN MOTOR', 'D541250-P2', '7.85', 'STEEL SGCC-Z22', 0, 202, 670, 0, 'Paris, France.jpg'),
(201, 92, 'INSTALLING HOLDER (LONG)', 'ACXH36-00630', '7.85', 'SGCC ZQZ22', 0, 168, 768, 0, 'Paris, France.jpg'),
(202, 92, 'SOUND PROF BOARD', 'ACXH15-02910', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(203, 93, 'Bracket 4-1 1DY', '1DY-E474K-0000-0305', '7.85', 'SPHCPO', 1, 78, 73, 0, 'Paris, France.jpg'),
(204, 93, 'Bracket 4-2 1DY', '1DY-E474L-0000-0305', '7.85', 'SPHCPO', 1, 66, 121, 0, 'WhatsApp Image 2022-11-19 at 10.46.56 AM.jpeg'),
(205, 93, 'Stay Muff 2-1 1FD', '1FD-E4781-0000-0305', '7.85', 'SPHCPO', 2, 76, 65, 0, 'Romania.jpg'),
(206, 93, 'Pipe Silincer 2 CP 1WD', '1WD-E466J-0000-0305', '7.75', 'SUS409L', 1, 130, 970, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(207, 93, 'Pipe Silincer 5 CP 1WD', '1WD-E466M-0000-0305', '7.75', 'SUS409L', 1, 220, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(208, 93, 'Bracket 3-2 CP 1WD', '1WD-E473L-0000-0310', '7.75', 'SUS409L', 1, 270, 1219, 0, 'Romania.jpg'),
(209, 93, 'Stay Muff 2-1 2PH', '2PH-E4781-0000-0305', '7.85', 'SPHCPO', 2, 170, 45, 0, 'Paris, France.jpg'),
(210, 93, 'Stay Muff 2-1 5D9', '5D9-E4781-0100-0305', '7.85', 'SPHCPO', 2, 76, 65, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(211, 93, 'BODY PIPE 1-2 2DP LH', '2DP-E461A-0000-0605-SUB', '7.85', 'SUS409L', 1, 70, 135, 0, 'Paris, France.jpg'),
(212, 93, 'NUT M6 GRAKINDO', '1WD-E473L-0000-0310-SUB1', '0', '', 0, 0, 0, 0, 'Paris, France.jpg'),
(213, 93, 'Pipe Silincer 3 1WD', '1WD-E466J-0000-0305-SUB', '7.75', 'SUS409L', 1, 130, 970, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(214, 93, 'Pipe Silincer 6 1WD', '1WD-E466M-0000-0305-SUB', '7.75', 'SUS409L', 1, 220, 1219, 0, 'Paris, France.jpg'),
(215, 93, 'BODY PIPE 1-1 2DP RH', '2DP-E461A-0000-0605', '7.75', 'SUS409L', 1, 70, 135, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(216, 94, 'BRACKET NO. 1 51870', '51870-73R00-B1', '7.85', 'JSH270CN', 1, 84, 1219, 0, 'Paris, France.jpg'),
(217, 94, 'BRACKET NO 1 17830', '17830-73R00-01', '7.85', 'YSC270CC', 1, 70, 1219, 0, 'Romania.jpg'),
(218, 94, 'BRACKET NO.  2 17830', '17830-73R00-02', '7.85', 'YSC270CC', 1, 70, 1219, 0, 'Paris, France.jpg'),
(219, 94, 'BRACKET NO. 3 17830', '17830-73R00-03', '7.85', 'YSC270CC', 1, 85, 1219, 0, 'Romania.jpg'),
(220, 94, 'BRACKET NO. 2 51870', '51870-73R00-B2', '7.85', 'JSH270CN', 2, 80, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(221, 94, 'BRACKET', '897529250-1', '7.85', 'SPHCPO', 3, 85, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(222, 95, 'WASHER K16', '3B3101050000Q999', '7.85', 'SAPH440-P', 2, 100, 98, 0, 'Paris, France.jpg'),
(223, 95, 'WASHER G20', '3B2701050000Q999', '7.85', 'SAPH440-P', 2, 115, 112, 0, 'Paris, France.jpg'),
(224, 95, 'NUT RAW EXEDY', '390250900000Q010', '7.85', 'JSH270C-P', 4, 232, 55, 0, 'Romania.jpg'),
(225, 95, 'NUT STA EXEDY', '3B5409000000Q010', '7.85', 'JSH270C-P', 3, 273, 55, 0, 'Paris, France.jpg'),
(226, 96, 'GUARD 0918A', '55020-0918A', '7.85', 'SPHCPO', 3, 74, 1219, 0, 'Romania.jpg'),
(227, 96, 'GUARD 0919A', '55020-0919A', '7.85', 'SPHCPO', 3, 118, 1219, 0, 'Romania.jpg'),
(228, 96, 'GUARD 0920A', '55020-0920A', '7.85', 'SPHCPO', 3, 146, 1219, 0, 'Romania.jpg'),
(229, 96, 'BRKT PIPE B6G', 'B6G-F133K-00', '7.85', 'SPHCPO', 2, 162, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(230, 96, 'BRACKET 1571', '11057-1571B', '7.85', 'SPHCPO', 1, 150, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(231, 96, 'BRACKET STEP', '32054-0071A', '7.85', 'SPHCPO', 4, 85, 1219, 0, 'Romania.jpg'),
(232, 96, 'HOLDER BRAKE HOSE 1', '2SX-F5875-00-00-80', '7.85', 'SPHC-PO', 1, 69, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(233, 96, 'WIRE HOLDER BRAKE HOSE 1', '2SX-F1654-00', '0', '', 0, 0, 0, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(234, 96, 'HOLDER BRAKE HOSE 5', '2DP-F588F-00-00-80', '7.85', 'SPHC-PO', 2, 116, 1219, 0, 'Romania.jpg'),
(235, 96, 'WIRE HOLDER BRAKE HOSE 5', '2DP-F588F-00', '0', '', 0, 0, 0, 0, 'Romania_waifu2x_art_noise3.png'),
(236, 97, 'PLATE FOR INSULATOR ENGINE MTG. RR', '14-08277-A01', '7.85', 'SPCCSD', 1, 45, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(237, 97, 'PLATE FOR CAB. MOUNTING UPPER', '14-07464-A00', '7.85', 'SAPH440', 4, 86, 1219, 0, 'Paris, France.jpg'),
(238, 97, 'NEW CENTER CUSHION RAD SUPPORT UPPER', '13-07273-A00', '7.85', 'SPHCPO', 2, 100, 1219, 0, 'Paris, France.jpg'),
(239, 97, 'INSULATOR ENGINE MOUNTING FR', '13-08793-A01', '7.85', 'SAPH440', 4, 105, 1219, 0, 'Paris, France.jpg'),
(240, 97, 'UPPER PLATE FOR INSULATOR ENG. MTG. RH', '12-06836-A01', '7.85', 'SPHCPO', 4, 148, 1219, 0, 'Romania_waifu2x_art_noise3.png'),
(241, 97, 'PLATE FOR CAB. MOUNTING LOWER', '14-07465-A00', '7.85', 'SPHCPO', 3, 152, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(242, 97, 'PLATE FOR INSULATOR ENGINE MTG. RR 09070', '13-09070-A00', '7.85', 'SPHCPO', 6, 180, 1219, 0, 'Romania.jpg'),
(243, 97, 'NEW CENTER BUMPER RUBBER FRONT', '13-07271-A02', '7.85', 'SPHCPO', 3, 185, 1219, 0, 'Paris, France.jpg'),
(244, 97, 'THROWER FOR PULLEY DAMPER', 'A4-01397-Z16', '7.85', 'SPCCSD', 1, 110, 1219, 0, 'Paris, France.jpg'),
(245, 97, 'NEW CENTER CUSHION RAD SUPPORT UPPER', '13-07274-A00', '7.85', 'SPHCPO', 2, 70, 1219, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(246, 97, 'PLATE CAB. MOUNTING NO. 1', '14-08628-A00', '7.85', 'SAPH440', 3, 60, 1219, 0, 'Paris, France.jpg'),
(247, 97, 'Plate Cab Mounting No. 1', '14-08627-A00', '7.85', 'SAPH440', 5, 70, 1219, 0, 'Romania.jpg'),
(248, 99, 'FRAME BOTTOM ASSY D270/275 (SC1)', '0060124866', '7.85', '', 0, 395, 568, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(249, 99, 'FRAME BOTTOM ASSY AQR-13G(SC1)', '0060867453', '7.85', '', 0, 387, 497, 0, '@hnoc_alex on Instagram_ _Share = 1 fl_.jpg'),
(250, 99, 'FRAME BOTTOM ASSY AQR-17J/20J(SC1)', '0060867455', '7.85', '', 0, 388, 548, 0, 'Romania.jpg'),
(251, 99, 'FRAME REAR AQR-13H ASSY (SC1)', '0060869033', '7.85', '', 0, 532, 925, 0, 'Romania.jpg'),
(252, 99, 'FRAME BOTTOM ASSY MJ-R16A (SC1)', '0060867454', '7.85', '', 0, 387, 548, 0, 'Romania.jpg'),
(253, 100, 'Gusset RR Dr Hinge Upr R/L', '68622-73R00', '7.85', 'JSC270CC', 1, 250, 830, 0, 'Romania.jpg'),
(254, 100, 'REINF, FR DR WDW RR R/L', '68191-73R00', '7.85', 'JSC270CC', 0, 320, 600, 0, 'Paris, France.jpg'),
(262, 79, 'a', 'a', '2', 'a', 2, 2, 2, 2, 'mrp2.png');

-- --------------------------------------------------------

--
-- Table structure for table `pieces`
--

CREATE TABLE `pieces` (
  `id_pieces` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_po_supp` int(11) NOT NULL,
  `surjal` varchar(30) NOT NULL,
  `qty_pieces` char(20) NOT NULL,
  `id_supp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pieces`
--

INSERT INTO `pieces` (`id_pieces`, `id_material`, `id_po_supp`, `surjal`, `qty_pieces`, `id_supp`) VALUES
(7, 17, 173, '1000', '-992', 2);

-- --------------------------------------------------------

--
-- Table structure for table `po_customer`
--

CREATE TABLE `po_customer` (
  `id_po` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `no_po` varchar(100) NOT NULL,
  `tanggal_po` date NOT NULL,
  `tanggalterima_po` date NOT NULL,
  `qty_po` int(11) NOT NULL,
  `qty_forecast1` varchar(20) NOT NULL,
  `qty_forecast2` varchar(20) NOT NULL,
  `qty_forecast3` varchar(20) NOT NULL,
  `revisi` char(11) NOT NULL,
  `unit_mat` varchar(20) NOT NULL,
  `statuss` varchar(20) NOT NULL,
  `sisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_customer`
--

INSERT INTO `po_customer` (`id_po`, `id_cust`, `id_part`, `no_po`, `tanggal_po`, `tanggalterima_po`, `qty_po`, `qty_forecast1`, `qty_forecast2`, `qty_forecast3`, `revisi`, `unit_mat`, `statuss`, `sisi`) VALUES
(176, 90, 151, '1999', '2023-07-20', '2023-07-12', 2000, '200', '200', '200', '', 'Lembar', 'Selesai', 0),
(177, 79, 157, '1871', '2023-07-21', '2023-07-13', 200, '200', '200', '200', '', 'Lembar', 'Selesai', 0),
(178, 79, 158, '1981', '2023-12-31', '2023-12-31', 2000, '200', '200', '200', '', 'Lembar', 'Sedang Diproses', 0),
(179, 91, 193, '1899', '2023-07-27', '2023-07-21', 1000, '300', '300', '300', '', 'Lembar', 'Sedang Diproses', 0);

-- --------------------------------------------------------

--
-- Table structure for table `po_supplier`
--

CREATE TABLE `po_supplier` (
  `id_po_supp` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `tgl_po` date NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `no_po_supp` varchar(100) NOT NULL,
  `qty_order_supp` varchar(100) NOT NULL,
  `rencana_pertama` date NOT NULL,
  `rencana_kedua` date NOT NULL,
  `qty_rencana1` char(20) NOT NULL,
  `qty_rencana2` char(20) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `hitung` varchar(100) NOT NULL,
  `revisi` varchar(11) NOT NULL,
  `statusss` varchar(20) NOT NULL,
  `sisa_pengiriman` char(20) NOT NULL,
  `satuan1` varchar(20) NOT NULL,
  `total` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_supplier`
--

INSERT INTO `po_supplier` (`id_po_supp`, `id_supp`, `id_material`, `tgl_po`, `satuan`, `no_po_supp`, `qty_order_supp`, `rencana_pertama`, `rencana_kedua`, `qty_rencana1`, `qty_rencana2`, `harga`, `hitung`, `revisi`, `statusss`, `sisa_pengiriman`, `satuan1`, `total`) VALUES
(172, 2, 16, '2023-07-20', 'Lembar', '1899', '200', '2023-12-01', '2023-12-31', '', '', '1999', '', '', 'Selesai', '0', 'Lembar', '399800'),
(173, 2, 17, '2023-07-20', 'Pieces', '1899', '200', '2023-12-01', '2023-12-31', '', '', '200', '', '', 'Selesai', '0', 'Pieces', '40000'),
(175, 2, 16, '2023-12-31', 'Lembar', '2910', '71', '2023-07-19', '2023-07-20', '', '', '20000', '', '', 'Sedang Diproses', '51', 'Lembar', '1420000'),
(176, 2, 16, '2023-12-31', 'Lembar', '22', '200', '2023-07-22', '2023-07-23', '', '', '2000', '', '', 'Selesai', '0', 'Lembar', '400000');

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_prs` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `proses` char(7) NOT NULL,
  `spot` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_prs`, `id_material`, `id_po`, `id_part`, `id_cust`, `proses`, `spot`) VALUES
(392, 5, 169, 151, 90, '7', '2'),
(393, 5, 169, 151, 90, '7', '2'),
(394, 5, 169, 151, 90, '7', '2'),
(395, 5, 169, 151, 90, '7', '2'),
(396, 5, 169, 151, 90, '2', '1'),
(397, 16, 176, 151, 90, '7', '1'),
(398, 16, 176, 151, 90, '1', '1'),
(399, 16, 176, 151, 90, '7', '1'),
(400, 16, 176, 151, 90, '1', '1'),
(401, 16, 176, 151, 90, '7', '1'),
(402, 16, 176, 151, 90, '7', '1'),
(403, 16, 176, 151, 90, '7', '1'),
(404, 16, 176, 151, 90, '7', '1'),
(405, 16, 176, 151, 90, '1', '1'),
(406, 16, 176, 151, 90, '1', '1'),
(407, 16, 176, 151, 90, '1', 'Nonspot'),
(408, 16, 176, 151, 90, '1', '1'),
(409, 16, 176, 151, 90, '1', 'Nonspot'),
(410, 16, 176, 151, 90, '1', 'Nonspot'),
(411, 16, 176, 151, 90, '1', 'Nonspot'),
(412, 16, 176, 151, 90, '1', 'Nonspot'),
(413, 16, 176, 151, 90, '1', 'Nonspot'),
(414, 16, 176, 151, 90, '1', 'Nonspot'),
(415, 16, 179, 193, 91, '1', '1'),
(416, 16, 179, 193, 91, '1', '1'),
(417, 16, 179, 193, 91, '1', '1'),
(418, 16, 176, 151, 90, '7', '1'),
(419, 16, 179, 193, 91, '7', '1'),
(420, 16, 176, 151, 90, '7', '1'),
(421, 16, 179, 193, 91, '7', '1'),
(422, 16, 179, 193, 91, '1', 'Nonspot'),
(423, 16, 179, 193, 91, '7', '1'),
(424, 16, 179, 193, 91, '1', '1'),
(425, 16, 179, 193, 91, '3', '1'),
(426, 16, 179, 193, 91, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `proses1`
--

CREATE TABLE `proses1` (
  `id_prs1` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(100) NOT NULL,
  `qty_aktual` int(11) NOT NULL,
  `qty_ng` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl` date NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses1`
--

INSERT INTO `proses1` (`id_prs1`, `id_po`, `id_material`, `id_prs`, `id_cust`, `id_part`, `nama_proses`, `qty_aktual`, `qty_ng`, `keterangan`, `tgl`, `wip`, `kondisi`) VALUES
(466, 179, 16, 422, 91, 193, 'blanking', 0, '', '', '2023-12-31', '800', 'Sudah Digunakan'),
(468, 179, 16, 424, 91, 193, 'bending', 0, '', '', '2023-12-31', '800', 'Sudah Digunakan'),
(469, 179, 16, 425, 91, 193, 'Bending', 0, '1', 'Tidak sesuai standar', '2023-07-20', '800', 'Sudah Digunakan'),
(470, 179, 16, 426, 91, 193, 'a', 0, '', '', '0000-00-00', '800', '');

-- --------------------------------------------------------

--
-- Table structure for table `proses2`
--

CREATE TABLE `proses2` (
  `id_prs2` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outt` char(20) NOT NULL,
  `qty_ngg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses2`
--

INSERT INTO `proses2` (`id_prs2`, `id_po`, `id_prs`, `id_cust`, `id_part`, `nama_proses`, `qty_outt`, `qty_ngg`, `keterangan`, `tgl`, `wip`, `kondisi`) VALUES
(180, 179, 425, 91, 193, 'Piercing', '0', '1', 'Not Good', '2023-07-23', '1000', 'Sudah Digunakan');

-- --------------------------------------------------------

--
-- Table structure for table `proses3`
--

CREATE TABLE `proses3` (
  `id_prs3` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outtt` char(20) NOT NULL,
  `qty_nggg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_outt` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `qty_ngg` char(20) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses3`
--

INSERT INTO `proses3` (`id_prs3`, `id_po`, `id_prs`, `id_cust`, `id_part`, `nama_proses`, `qty_outtt`, `qty_nggg`, `keterangan`, `qty_outt`, `tgl`, `qty_ngg`, `wip`, `kondisi`) VALUES
(137, 179, 425, 91, 193, 'Drawing', '0', '', '', '', '2023-07-23', '', '1000', 'Sudah Digunakan');

-- --------------------------------------------------------

--
-- Table structure for table `proses4`
--

CREATE TABLE `proses4` (
  `id_prs4` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outttt` char(20) NOT NULL,
  `qty_ngggg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_outtt` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `qty_nggg` char(20) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proses5`
--

CREATE TABLE `proses5` (
  `id_prs5` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outtttt` char(20) NOT NULL,
  `qty_nggggg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_outttt` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `qty_ngggg` char(20) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proses6`
--

CREATE TABLE `proses6` (
  `id_prs6` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outttttt` char(20) NOT NULL,
  `qty_ngggggg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_outtttt` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `qty_nggggg` char(20) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proses7`
--

CREATE TABLE `proses7` (
  `id_prs7` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `nama_proses` varchar(200) NOT NULL,
  `qty_outtttttt` char(20) NOT NULL,
  `qty_nggggggg` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_outttttt` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `qty_ngggggg` char(20) NOT NULL,
  `wip` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shearing_material`
--

CREATE TABLE `shearing_material` (
  `id_mat` int(11) NOT NULL,
  `id_mtl` int(11) NOT NULL,
  `id_supp` int(11) NOT NULL,
  `id_po_supp` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `qty_sheet` int(11) NOT NULL,
  `surjal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shearing_material`
--

INSERT INTO `shearing_material` (`id_mat`, `id_mtl`, `id_supp`, `id_po_supp`, `id_material`, `qty_sheet`, `surjal`) VALUES
(122, 253, 2, 172, 16, 700, '1781');

-- --------------------------------------------------------

--
-- Table structure for table `spot1`
--

CREATE TABLE `spot1` (
  `id_spot1` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_prs` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_part` int(11) NOT NULL,
  `qty_aktual` char(20) NOT NULL,
  `qty_ng` char(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl` date NOT NULL,
  `nama_spot` varchar(128) NOT NULL,
  `qty_spot` char(20) NOT NULL,
  `qty_spott1` char(20) NOT NULL,
  `kondisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spot1`
--

INSERT INTO `spot1` (`id_spot1`, `id_cust`, `id_prs`, `id_po`, `id_material`, `id_part`, `qty_aktual`, `qty_ng`, `keterangan`, `tgl`, `nama_spot`, `qty_spot`, `qty_spott1`, `kondisi`) VALUES
(144, 90, 397, 176, 17, 151, '0', '0', 'not good', '2023-07-24', '', '0', '2', 'Sudah Digunakan'),
(145, 90, 398, 176, 0, 151, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(146, 90, 399, 176, 0, 151, '', '', '', '0000-00-00', '', '', '', ''),
(147, 90, 400, 176, 0, 151, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(148, 90, 401, 176, 0, 151, '', '', '', '0000-00-00', 'Spot welding 1', '', '2', ''),
(149, 90, 402, 176, 0, 151, '', '', '', '0000-00-00', 'Spot welding 1', '', '2', ''),
(150, 90, 403, 176, 0, 151, '', '', '', '0000-00-00', 'a2', '', '', ''),
(151, 90, 404, 176, 0, 151, '', '', '', '0000-00-00', 'a', '', '2', ''),
(152, 90, 405, 176, 0, 151, '', '', '', '0000-00-00', 'spot1', '', '2', ''),
(153, 90, 406, 176, 17, 151, '0', '', '', '2023-12-31', 'bending', '0', '2', 'Sudah Digunakan'),
(154, 90, 407, 176, 0, 151, '', '', '', '0000-00-00', '', '', '', ''),
(155, 90, 408, 176, 0, 151, '', '', '', '0000-00-00', 'b', '', '2', ''),
(156, 91, 415, 179, 0, 193, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(157, 91, 416, 179, 0, 193, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(158, 91, 417, 179, 0, 193, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(159, 90, 418, 176, 0, 151, '', '', '', '0000-00-00', 'h', '', '2', ''),
(160, 91, 419, 179, 0, 193, '', '', '', '0000-00-00', 'h', '', '2', ''),
(161, 90, 420, 176, 0, 151, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(162, 91, 421, 179, 0, 193, '', '', '', '0000-00-00', 'spot welding 1', '', '2', ''),
(163, 91, 423, 179, 0, 193, '', '', '', '0000-00-00', 'h', '', '2', ''),
(164, 91, 424, 179, 17, 193, '0', '', '', '2023-12-31', 'spot welding 1', '0', '2', 'Sudah Digunakan'),
(165, 91, 425, 179, 17, 193, '0', '', '', '2023-07-25', 'Spot Welding 1', '0', '2', 'Sudah Digunakan'),
(166, 91, 426, 179, 0, 193, '', '', '', '0000-00-00', 'a', '', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supp` int(11) NOT NULL,
  `nama_supp` varchar(128) NOT NULL,
  `alamat_supp` varchar(128) NOT NULL,
  `kontak_supp` char(20) NOT NULL,
  `email_supp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supp`, `nama_supp`, `alamat_supp`, `kontak_supp`, `email_supp`) VALUES
(2, 'PT. DIKA KARYA MANDIRI', 'Kp. Pamahan Rukem RT, 001Jl. Rawa Bangkong Ds Jatireja Cikarang Timur Kab.', 'Telp. 021-897005/ 08', 'dkr@dikaraya.com	'),
(7, 'PT. EXEDY MANUFACTURING INDONESIA', 'Kawasan Industri KIIC EE-3,5 Jl. Permata III Sinar Raya Teluk Jambe, Karawa', '021-89281901', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'majubersama', 'admin'),
(2, 'ppic', 'ppic', 'ppic'),
(3, 'purchasing', 'purchasing', 'purchasing'),
(4, 'gudang', 'gudang', 'gudang'),
(5, 'produksi', 'produksi', 'produksi'),
(6, 'pengiriman', 'pengiriman', 'pengiriman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `deliveryfg`
--
ALTER TABLE `deliveryfg`
  ADD PRIMARY KEY (`id_delivfg`);

--
-- Indexes for table `fg`
--
ALTER TABLE `fg`
  ADD PRIMARY KEY (`id_fg`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indexes for table `material_recipt`
--
ALTER TABLE `material_recipt`
  ADD PRIMARY KEY (`id_mtl`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id_part`),
  ADD KEY `id_cust` (`id_cust`);

--
-- Indexes for table `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`id_pieces`);

--
-- Indexes for table `po_customer`
--
ALTER TABLE `po_customer`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `id_cust` (`id_cust`),
  ADD KEY `id_part` (`id_part`);

--
-- Indexes for table `po_supplier`
--
ALTER TABLE `po_supplier`
  ADD PRIMARY KEY (`id_po_supp`),
  ADD KEY `id_supp` (`id_supp`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_prs`);

--
-- Indexes for table `proses1`
--
ALTER TABLE `proses1`
  ADD PRIMARY KEY (`id_prs1`),
  ADD KEY `id_cust` (`id_cust`);

--
-- Indexes for table `proses2`
--
ALTER TABLE `proses2`
  ADD PRIMARY KEY (`id_prs2`);

--
-- Indexes for table `proses3`
--
ALTER TABLE `proses3`
  ADD PRIMARY KEY (`id_prs3`);

--
-- Indexes for table `proses4`
--
ALTER TABLE `proses4`
  ADD PRIMARY KEY (`id_prs4`);

--
-- Indexes for table `proses5`
--
ALTER TABLE `proses5`
  ADD PRIMARY KEY (`id_prs5`);

--
-- Indexes for table `proses6`
--
ALTER TABLE `proses6`
  ADD PRIMARY KEY (`id_prs6`);

--
-- Indexes for table `proses7`
--
ALTER TABLE `proses7`
  ADD PRIMARY KEY (`id_prs7`);

--
-- Indexes for table `shearing_material`
--
ALTER TABLE `shearing_material`
  ADD PRIMARY KEY (`id_mat`);

--
-- Indexes for table `spot1`
--
ALTER TABLE `spot1`
  ADD PRIMARY KEY (`id_spot1`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supp`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `deliveryfg`
--
ALTER TABLE `deliveryfg`
  MODIFY `id_delivfg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `fg`
--
ALTER TABLE `fg`
  MODIFY `id_fg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `material_recipt`
--
ALTER TABLE `material_recipt`
  MODIFY `id_mtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `pieces`
--
ALTER TABLE `pieces`
  MODIFY `id_pieces` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `po_customer`
--
ALTER TABLE `po_customer`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `po_supplier`
--
ALTER TABLE `po_supplier`
  MODIFY `id_po_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_prs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;

--
-- AUTO_INCREMENT for table `proses1`
--
ALTER TABLE `proses1`
  MODIFY `id_prs1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;

--
-- AUTO_INCREMENT for table `proses2`
--
ALTER TABLE `proses2`
  MODIFY `id_prs2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `proses3`
--
ALTER TABLE `proses3`
  MODIFY `id_prs3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `proses4`
--
ALTER TABLE `proses4`
  MODIFY `id_prs4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `proses5`
--
ALTER TABLE `proses5`
  MODIFY `id_prs5` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `proses6`
--
ALTER TABLE `proses6`
  MODIFY `id_prs6` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `proses7`
--
ALTER TABLE `proses7`
  MODIFY `id_prs7` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `shearing_material`
--
ALTER TABLE `shearing_material`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `spot1`
--
ALTER TABLE `spot1`
  MODIFY `id_spot1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`id_cust`) REFERENCES `customer` (`id_cust`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po_customer`
--
ALTER TABLE `po_customer`
  ADD CONSTRAINT `po_customer_ibfk_1` FOREIGN KEY (`id_cust`) REFERENCES `customer` (`id_cust`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `po_customer_ibfk_2` FOREIGN KEY (`id_part`) REFERENCES `part` (`id_part`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po_supplier`
--
ALTER TABLE `po_supplier`
  ADD CONSTRAINT `po_supplier_ibfk_2` FOREIGN KEY (`id_supp`) REFERENCES `supplier` (`id_supp`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `myevent` ON SCHEDULE EVERY 1 SECOND STARTS '2023-07-18 17:26:47' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE po_customer SET statuss = 'Selesai' WHERE tanggal_po < NOW()$$

CREATE DEFINER=`root`@`localhost` EVENT `myevent2` ON SCHEDULE EVERY 1 SECOND STARTS '2023-07-18 17:05:28' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE po_supplier SET statusss = 'Selesai' WHERE tgl_po < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
