-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2018 at 11:27 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simkop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_nasabah`
--

CREATE TABLE `t01_nasabah` (
  `id` int(11) NOT NULL,
  `Customer` varchar(25) NOT NULL,
  `Pekerjaan` varchar(25) NOT NULL,
  `Alamat` text NOT NULL,
  `AlamatPekerjaan` text NOT NULL,
  `NoTelpHp` varchar(25) NOT NULL,
  `NoTelpPekerjaan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Customer`, `Pekerjaan`, `Alamat`, `AlamatPekerjaan`, `NoTelpHp`, `NoTelpPekerjaan`) VALUES
(1, 'Andoko', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `t02_jaminan`
--

CREATE TABLE `t02_jaminan` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `MerkType` varchar(25) NOT NULL,
  `NoRangka` varchar(50) DEFAULT NULL,
  `NoMesin` varchar(50) DEFAULT NULL,
  `Warna` varchar(15) DEFAULT NULL,
  `NoPol` varchar(15) DEFAULT NULL,
  `Keterangan` text,
  `AtasNama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t03_pinjaman`
--

CREATE TABLE `t03_pinjaman` (
  `id` int(11) NOT NULL,
  `NoKontrak` varchar(25) NOT NULL,
  `TglKontrak` date NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Pinjaman` float(14,2) NOT NULL,
  `LamaAngsuran` tinyint(4) NOT NULL,
  `Bunga` decimal(5,2) NOT NULL DEFAULT '2.25',
  `Denda` decimal(5,2) NOT NULL DEFAULT '0.40',
  `DispensasiDenda` tinyint(4) NOT NULL DEFAULT '3',
  `AngsuranPokok` float(14,2) NOT NULL,
  `AngsuranBunga` float(14,2) NOT NULL,
  `AngsuranTotal` float(14,2) NOT NULL,
  `NoKontrakRefTo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_pinjaman`
--

INSERT INTO `t03_pinjaman` (`id`, `NoKontrak`, `TglKontrak`, `nasabah_id`, `Pinjaman`, `LamaAngsuran`, `Bunga`, `Denda`, `DispensasiDenda`, `AngsuranPokok`, `AngsuranBunga`, `AngsuranTotal`, `NoKontrakRefTo`) VALUES
(1, '1', '2018-10-19', 1, 10400000.00, 12, '2.25', '0.40', 3, 866666.69, 234000.00, 1100666.62, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t04_angsuran`
--

CREATE TABLE `t04_angsuran` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `AngsuranKe` tinyint(4) NOT NULL,
  `AngsuranTanggal` date NOT NULL,
  `AngsuranPokok` float(14,2) NOT NULL,
  `AngsuranBunga` float(14,2) NOT NULL,
  `AngsuranTotal` float(14,2) NOT NULL,
  `SisaHutang` float(14,2) NOT NULL,
  `TanggalBayar` date DEFAULT NULL,
  `Terlambat` smallint(6) DEFAULT NULL,
  `TotalDenda` float(14,2) DEFAULT NULL,
  `Bayar_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Non_Titipan` float(14,2) DEFAULT NULL,
  `Bayar_Total` float(14,2) DEFAULT NULL,
  `Keterangan` text,
  `pinjamantitipan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_angsuran`
--

INSERT INTO `t04_angsuran` (`id`, `pinjaman_id`, `AngsuranKe`, `AngsuranTanggal`, `AngsuranPokok`, `AngsuranBunga`, `AngsuranTotal`, `SisaHutang`, `TanggalBayar`, `Terlambat`, `TotalDenda`, `Bayar_Titipan`, `Bayar_Non_Titipan`, `Bayar_Total`, `Keterangan`, `pinjamantitipan_id`) VALUES
(1, 1, 1, '2018-11-19', 866666.69, 234000.00, 1100666.62, 9533333.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, '2018-12-19', 866666.69, 234000.00, 1100666.62, 8666667.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, '2019-01-19', 866666.69, 234000.00, 1100666.62, 7800000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, '2019-02-19', 866666.69, 234000.00, 1100666.62, 6933333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, '2019-03-19', 866666.69, 234000.00, 1100666.62, 6066666.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, '2019-04-19', 866666.69, 234000.00, 1100666.62, 5200000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, '2019-05-19', 866666.69, 234000.00, 1100666.62, 4333333.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, '2019-06-19', 866666.69, 234000.00, 1100666.62, 3466666.75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, '2019-07-19', 866666.69, 234000.00, 1100666.62, 2600000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, '2019-08-19', 866666.69, 234000.00, 1100666.62, 1733333.38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, '2019-09-19', 866666.69, 234000.00, 1100666.62, 866666.69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, '2019-10-19', 866666.69, 234000.00, 1100666.62, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t05_pinjamanjaminan`
--

CREATE TABLE `t05_pinjamanjaminan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jaminan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t06_pinjamantitipan`
--

CREATE TABLE `t06_pinjamantitipan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` text,
  `Masuk` float(14,2) NOT NULL DEFAULT '0.00',
  `Keluar` float(14,2) NOT NULL DEFAULT '0.00',
  `Sisa` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t94_log`
--

CREATE TABLE `t94_log` (
  `id` int(11) NOT NULL,
  `index_` tinyint(4) NOT NULL,
  `subj_` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t94_log`
--

INSERT INTO `t94_log` (`id`, `index_`, `subj_`) VALUES
(1, 2, 'pinjaman - master'),
(2, 3, 'pinjaman - nasabah'),
(3, 4, 'pinjaman - angsuran'),
(4, 1, 'aplikasi'),
(5, 5, 'pinjaman - jaminan'),
(6, 6, 'pinjaman - titipan');

-- --------------------------------------------------------

--
-- Table structure for table `t95_logdesc`
--

CREATE TABLE `t95_logdesc` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `desc_` text NOT NULL,
  `date_solved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t95_logdesc`
--

INSERT INTO `t95_logdesc` (`id`, `log_id`, `date_issued`, `desc_`, `date_solved`) VALUES
(1, 1, '2018-10-04', 'tipe data NOMOR REFERENSI diubah dari integer menjadi varchar', '2018-10-17'),
(2, 1, '2018-10-04', 'ada tambahan kolom POTONGAN, mengurangi SISA PINJAMAN', NULL),
(3, 1, '2018-10-04', 'setiap ada pembayaran yang menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN', NULL),
(4, 2, '2018-10-04', 'alamat nasabah harus diisi', NULL),
(5, 2, '2018-10-04', 'melengkapi tampilan add nasabah di menu pinjaman', NULL),
(6, 3, '2018-10-18', 'otomatis tampil JUMLAH di semua kolom, JUMLAH :\r\nTERLAMBAT, DENDA, BAYAR TITIPAN, dan seterusnya', NULL),
(7, 3, '2018-10-18', 'jumlah TITIPAN langsung tampil bila nasabah memiliki SALDO TITIPAN', NULL),
(8, 3, '2018-10-18', 'nilai TERLAMBAT dan DENDA otomatis rumus', NULL),
(9, 3, '2018-10-18', 'read only baris record ANGSURAN, hanya dibuka 1 record saja, yg mana yg akan diproses datanya', NULL),
(10, 4, '2018-10-17', 'SETUP - NASABAH dimunculkan lagi', NULL),
(11, 4, '2018-10-17', 'sinkronisasi data antar-cabang, agar tiap cabang dapat cross-check data calon nasabah dari cabang lain', NULL),
(12, 4, '2018-10-17', 'tambah modul SIMPANAN WAJIB', NULL),
(13, 4, '2018-10-17', 'tambah modul SIMPANAN POKOK', NULL),
(14, 4, '2018-10-17', 'tambah modul DEPOSITO', NULL),
(15, 1, '2018-10-17', 'input BIAYA ADMINISTRASI', NULL),
(16, 1, '2018-10-17', 'input BIAYA MATERAI', NULL),
(17, 3, '2018-10-04', 'check :: jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN', '2018-10-04'),
(18, 2, '2018-10-04', 'melengkapi tampilan add NASABAH di menu PINJAMAN', '2018-10-17'),
(19, 5, '2018-10-04', 'menghilangkan nasabah_id di add JAMINAN pada proses input PINJAMAN', '2018-10-17'),
(20, 6, '2018-10-04', 'setelah input setoran TITIPAN :: harus save dulu agar jumlah saldo TITIPAN terupdate', '2018-10-17'),
(21, 4, '2018-10-04', 'hilangkan menu SETUP - NASABAH', '2018-10-04'),
(22, 4, '2018-10-04', 'buat modul CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm', '2018-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}cf01_home.php', 111),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t01_nasabah', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t02_jaminan', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t03_pinjaman', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t04_angsuran', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t05_pinjamanjaminan', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t06_pinjamantitipan', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t96_employees', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t97_userlevels', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t98_userlevelpermissions', 0),
(-2, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t99_audittrail', 0),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}cf01_home.php', 111),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t01_nasabah', 0),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t96_employees', 0),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t97_userlevels', 0),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t98_userlevelpermissions', 0),
(-2, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t99_audittrail', 0),
(-2, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t96_employees', 0),
(-2, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t97_userlevels', 0),
(-2, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t98_userlevelpermissions', 0),
(-2, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t99_audittrail', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t01_nasabah', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t02_jaminan', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t03_pinjaman', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t04_angsuran', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t05_pinjamanjaminan', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t06_pinjamantitipan', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t96_employees', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t97_userlevels', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t98_userlevelpermissions', 0),
(-2, '{e6473db1-2054-4b08-821e-13a44f78897d}t99_audittrail', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}cf01_home.php', 111),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t01_nasabah', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t02_jaminan', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t03_pinjaman', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t04_angsuran', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t05_pinjamanjaminan', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t06_pinjamantitipan', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t96_employees', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t97_userlevels', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t98_userlevelpermissions', 0),
(0, '{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t99_audittrail', 0),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}cf01_home.php', 111),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t01_nasabah', 0),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t96_employees', 0),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t97_userlevels', 0),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t98_userlevelpermissions', 0),
(0, '{B3698D9B-8D4B-412E-A2E5-AFAD2FEE5A23}t99_audittrail', 0),
(0, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t96_employees', 0),
(0, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t97_userlevels', 0),
(0, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t98_userlevelpermissions', 0),
(0, '{D3A66325-B686-405A-A7D0-90D6B7E2446A}t99_audittrail', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t01_nasabah', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t02_jaminan', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t03_pinjaman', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t04_angsuran', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t05_pinjamanjaminan', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t06_pinjamantitipan', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t96_employees', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t97_userlevels', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t98_userlevelpermissions', 0),
(0, '{e6473db1-2054-4b08-821e-13a44f78897d}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'Customer', '1', '', 'Andoko'),
(2, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'Alamat', '1', '', '-'),
(3, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'Pekerjaan', '1', '', '-'),
(4, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'NoTelpHp', '1', '', '-'),
(5, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'AlamatPekerjaan', '1', '', '-'),
(6, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'NoTelpPekerjaan', '1', '', '-'),
(7, '2018-10-17 01:05:12', '/simkop2/t01_nasabahaddopt.php', '1', 'A', 't01_nasabah', 'id', '1', '', '1'),
(8, '2018-10-18 10:13:33', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'index_', '1', '', '1'),
(9, '2018-10-18 10:13:33', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'subj_', '1', '', 'done'),
(10, '2018-10-18 10:13:33', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'id', '1', '', '1'),
(11, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', '*** Batch insert begin ***', 't94_logsub', '', '', '', ''),
(12, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'logmain_id', '1', '', '1'),
(13, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'index_', '1', '', '1'),
(14, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'subj_', '1', '', 'pinjaman - master'),
(15, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'id', '1', '', '1'),
(16, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'logmain_id', '2', '', '1'),
(17, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'index_', '2', '', '2'),
(18, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'subj_', '2', '', 'pinjaman - master - nasabah'),
(19, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'id', '2', '', '2'),
(20, '2018-10-18 10:13:34', '/simkop2/t93_logmainadd.php', '1', '*** Batch insert successful ***', 't94_logsub', '', '', '', ''),
(21, '2018-10-18 10:14:26', '/simkop2/t93_logmainedit.php', '1', 'U', 't93_logmain', 'subj_', '1', 'done', 'to do'),
(22, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'index_', '2', '', '2'),
(23, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'subj_', '2', '', 'done'),
(24, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't93_logmain', 'id', '2', '', '2'),
(25, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', '*** Batch insert begin ***', 't94_logsub', '', '', '', ''),
(26, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'logmain_id', '3', '', '2'),
(27, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'index_', '3', '', '1'),
(28, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'subj_', '3', '', 'pinjaman - master'),
(29, '2018-10-18 10:15:24', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'id', '3', '', '3'),
(30, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'logmain_id', '4', '', '2'),
(31, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'index_', '4', '', '2'),
(32, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'subj_', '4', '', 'pinjaman - master - nasabah'),
(33, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'id', '4', '', '4'),
(34, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'logmain_id', '5', '', '2'),
(35, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'index_', '5', '', '3'),
(36, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'subj_', '5', '', 'pinjaman - angsuran'),
(37, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', 'A', 't94_logsub', 'id', '5', '', '5'),
(38, '2018-10-18 10:15:25', '/simkop2/t93_logmainadd.php', '1', '*** Batch insert successful ***', 't94_logsub', '', '', '', ''),
(39, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'logmain_id', '1', '', '1'),
(40, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'logsub_id', '1', '', '1'),
(41, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '1', '', '2018-10-18'),
(42, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '1', '', 'check jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN;'),
(43, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '1', '', NULL),
(44, '2018-10-18 10:17:01', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '1', '', '1'),
(45, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'logmain_id', '2', '', '2'),
(46, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'logsub_id', '2', '', '3'),
(47, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '2', '', '2018-10-18'),
(48, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '2', '', 'tipe data nomor referensi diubah dari integer menjadi varchar;'),
(49, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '2', '', NULL),
(50, '2018-10-18 10:35:07', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '2', '', '2'),
(51, '2018-10-18 10:35:48', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'date_issued', '2', '2018-10-18', '2018-10-15'),
(52, '2018-10-18 10:35:48', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'date_solved', '2', NULL, '2018-10-18'),
(53, '2018-10-18 11:17:02', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '1', '', '1'),
(54, '2018-10-18 11:17:02', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '1', '', 'pinjaman - master'),
(55, '2018-10-18 11:17:02', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '1', '', '1'),
(56, '2018-10-18 11:17:02', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(57, '2018-10-18 11:27:29', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '1', '', '1'),
(58, '2018-10-18 11:27:29', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '1', '', 'pinjaman - master'),
(59, '2018-10-18 11:27:29', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '1', '', '1'),
(60, '2018-10-18 11:27:29', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(61, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(62, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '1', '', '1'),
(63, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '1', '', '2018-10-18'),
(64, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '1', '', 'tipe data nomor referensi diubah dari integer menjadi varchar;'),
(65, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '1', '', NULL),
(66, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '1', '', '1'),
(67, '2018-10-18 11:29:36', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(68, '2018-10-18 11:45:49', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'log_id', '2', '', '1'),
(69, '2018-10-18 11:45:49', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '2', '', '2018-10-18'),
(70, '2018-10-18 11:45:49', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '2', '', 'tipe data nomor referensi diubah dari integer menjadi varchar;'),
(71, '2018-10-18 11:45:49', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '2', '', NULL),
(72, '2018-10-18 11:45:49', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '2', '', '2'),
(73, '2018-10-18 13:44:23', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(74, '2018-10-18 13:44:23', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'date_issued', '1', '2018-10-18', '2018-10-04'),
(75, '2018-10-18 13:44:23', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'date_solved', '1', NULL, '2018-10-17'),
(76, '2018-10-18 13:44:23', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(77, '2018-10-18 13:45:58', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'log_id', '2', '', '1'),
(78, '2018-10-18 13:45:58', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '2', '', '2018-10-04'),
(79, '2018-10-18 13:45:58', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '2', '', 'ada tambahan kolom POTONGAN, mengurangi SISA HUTANG;'),
(80, '2018-10-18 13:45:58', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '2', '', NULL),
(81, '2018-10-18 13:45:58', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '2', '', '2'),
(82, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(83, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '3', '', '1'),
(84, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '3', '', '2018-10-04'),
(85, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '3', '', 'setiap ada pembayaran menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;'),
(86, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '3', '', NULL),
(87, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '3', '', '3'),
(88, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(89, '2018-10-19 08:38:56', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(90, '2018-10-19 08:38:56', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'desc_', '3', 'setiap ada pembayaran menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;', 'setiap ada pembayaran yang menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;'),
(91, '2018-10-19 08:38:56', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(92, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '2', '', '2'),
(93, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '2', '', 'pinjaman - nasabah'),
(94, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '2', '', '2'),
(95, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(96, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '4', '', '2'),
(97, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '4', '', 'alamat nasabah harus diisi;'),
(98, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '4', '', '2018-10-04'),
(99, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '4', '', NULL),
(100, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '4', '', '4'),
(101, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '5', '', '2'),
(102, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '5', '', 'melengkapi tampilan add nasabah di menu pinjaman;'),
(103, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '5', '', '2018-10-04'),
(104, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '5', '', NULL),
(105, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '5', '', '5'),
(106, '2018-10-19 08:40:41', '/simkop2/t94_logadd.php', '1', '*** Batch insert successful ***', 't95_logdesc', '', '', '', ''),
(107, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '3', '', '3'),
(108, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '3', '', 'pinjaman - angsuran'),
(109, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '3', '', '3'),
(110, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(111, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '6', '', '3'),
(112, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '6', '', 'otomatis tampil nilai semua kolom'),
(113, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '6', '', '2018-10-18'),
(114, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '6', '', NULL),
(115, '2018-10-19 08:49:27', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '6', '', '6'),
(116, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '7', '', '3'),
(117, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '7', '', 'nilai titipan lgsg tampil bila ada titipan'),
(118, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '7', '', '2018-10-18'),
(119, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '7', '', NULL),
(120, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '7', '', '7'),
(121, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '8', '', '3'),
(122, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '8', '', 'nilai TERLAMBAT dan DENDA otomatis rumus'),
(123, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '8', '', '2018-10-18'),
(124, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '8', '', NULL),
(125, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '8', '', '8'),
(126, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '9', '', '3'),
(127, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '9', '', 'read only baris record ANGSURAN, hanya dibuka 1 record saja, yg mana yg akan diproses datanya'),
(128, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '9', '', '2018-10-18'),
(129, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '9', '', NULL),
(130, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '9', '', '9'),
(131, '2018-10-19 08:49:28', '/simkop2/t94_logadd.php', '1', '*** Batch insert successful ***', 't95_logdesc', '', '', '', ''),
(132, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '4', '', '1'),
(133, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '4', '', 'aplikasi'),
(134, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '4', '', '4'),
(135, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(136, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '10', '', '4'),
(137, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '10', '', 'SETUP - NASABAH diaktifkan lagi'),
(138, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '10', '', '2018-10-17'),
(139, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '10', '', NULL),
(140, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '10', '', '10'),
(141, '2018-10-19 08:53:57', '/simkop2/t94_logadd.php', '1', '*** Batch insert successful ***', 't95_logdesc', '', '', '', ''),
(142, '2018-10-19 08:54:13', '/simkop2/t94_logedit.php', '1', 'U', 't94_log', 'index_', '1', '1', '2'),
(143, '2018-10-19 08:54:21', '/simkop2/t94_logedit.php', '1', 'U', 't94_log', 'index_', '2', '2', '3'),
(144, '2018-10-19 08:54:27', '/simkop2/t94_logedit.php', '1', 'U', 't94_log', 'index_', '3', '3', '4'),
(145, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(146, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '11', '', '4'),
(147, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '11', '', 'sinkronisasi data antar-cabang, agar tiap cabang dapat cross-check data calon nasabah di cabang lain'),
(148, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '11', '', '2018-10-17'),
(149, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '11', '', NULL),
(150, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '11', '', '11'),
(151, '2018-10-19 08:59:49', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(152, '2018-10-19 09:00:47', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'log_id', '12', '', '4'),
(153, '2018-10-19 09:00:47', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '12', '', 'tambah menu SIMPANAN WAJIB'),
(154, '2018-10-19 09:00:47', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '12', '', '2018-10-17'),
(155, '2018-10-19 09:00:47', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '12', '', NULL),
(156, '2018-10-19 09:00:47', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '12', '', '12'),
(157, '2018-10-19 09:01:18', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'log_id', '13', '', '4'),
(158, '2018-10-19 09:01:18', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '13', '', 'tambah modul SIMPANAN POKOK'),
(159, '2018-10-19 09:01:18', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '13', '', '2018-10-17'),
(160, '2018-10-19 09:01:18', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '13', '', NULL),
(161, '2018-10-19 09:01:18', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '13', '', '13'),
(162, '2018-10-19 09:01:26', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '12', 'tambah menu SIMPANAN WAJIB', 'tambah modul SIMPANAN WAJIB'),
(163, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(164, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '14', '', '4'),
(165, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '14', '', 'tambah modul DEPOSITO'),
(166, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '14', '', '2018-10-17'),
(167, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '14', '', NULL),
(168, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '14', '', '14'),
(169, '2018-10-19 09:22:34', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(170, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(171, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '15', '', '1'),
(172, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '15', '', 'input BIAYA ADMINISTRASI'),
(173, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '15', '', '2018-10-17'),
(174, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '15', '', NULL),
(175, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '15', '', '15'),
(176, '2018-10-19 09:23:14', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(177, '2018-10-19 09:23:33', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '1', 'tipe data nomor referensi diubah dari integer menjadi varchar;', 'tipe data NOMOR REFERENSI diubah dari integer menjadi varchar;'),
(178, '2018-10-19 09:23:53', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '2', 'ada tambahan kolom POTONGAN, mengurangi SISA HUTANG;', 'ada tambahan kolom POTONGAN, mengurangi SISA PINJAMAN;'),
(179, '2018-10-19 09:24:07', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '1', 'tipe data NOMOR REFERENSI diubah dari integer menjadi varchar;', 'tipe data NOMOR REFERENSI diubah dari integer menjadi varchar'),
(180, '2018-10-19 09:24:35', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '2', 'ada tambahan kolom POTONGAN, mengurangi SISA PINJAMAN;', 'ada tambahan kolom POTONGAN, mengurangi SISA PINJAMAN'),
(181, '2018-10-19 09:24:40', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '3', 'setiap ada pembayaran yang menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;', 'setiap ada pembayaran yang menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN'),
(182, '2018-10-19 09:25:06', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(183, '2018-10-19 09:25:06', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'desc_', '4', 'alamat nasabah harus diisi;', 'alamat nasabah harus diisi'),
(184, '2018-10-19 09:25:06', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'desc_', '5', 'melengkapi tampilan add nasabah di menu pinjaman;', 'melengkapi tampilan add nasabah di menu pinjaman'),
(185, '2018-10-19 09:25:06', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(186, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(187, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '16', '', '1'),
(188, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '16', '', 'input BIAYA MATERAI'),
(189, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '16', '', '2018-10-17'),
(190, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '16', '', NULL),
(191, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '16', '', '16'),
(192, '2018-10-19 09:26:09', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(193, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(194, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '17', '', '3'),
(195, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '17', '', 'check :: jumlah TOTAL PEMBAYARAN harus sama dengan jumlah TOTAL ANGSURAN'),
(196, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '17', '', '2018-10-04'),
(197, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '17', '', NULL),
(198, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '17', '', '17'),
(199, '2018-10-19 09:56:14', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(200, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(201, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '18', '', '2'),
(202, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '18', '', 'melengkapi tampilan add NASABAH di menu PINJAMAN'),
(203, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '18', '', '2018-10-04'),
(204, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '18', '', '2018-10-17'),
(205, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '18', '', '18'),
(206, '2018-10-19 10:00:31', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(207, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '5', '', '5'),
(208, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '5', '', 'pinjaman - jaminan'),
(209, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '5', '', '5'),
(210, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(211, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '19', '', '5'),
(212, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '19', '', 'menghilangkan nasabah_id di add JAMINAN pada proses input PINJAMAN'),
(213, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '19', '', '2018-10-04'),
(214, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '19', '', '2018-10-17'),
(215, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '19', '', '19'),
(216, '2018-10-19 10:03:01', '/simkop2/t94_logadd.php', '1', '*** Batch insert successful ***', 't95_logdesc', '', '', '', ''),
(217, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'index_', '6', '', '6'),
(218, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'subj_', '6', '', 'pinjaman - titipan'),
(219, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't94_log', 'id', '6', '', '6'),
(220, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', '*** Batch insert begin ***', 't95_logdesc', '', '', '', ''),
(221, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'log_id', '20', '', '6'),
(222, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'desc_', '20', '', 'setelah input setoran titipan :: harus save dulu agar nilai saldo terupdate'),
(223, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_issued', '20', '', '2018-10-04'),
(224, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'date_solved', '20', '', '2018-10-17'),
(225, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', 'A', 't95_logdesc', 'id', '20', '', '20'),
(226, '2018-10-19 10:04:03', '/simkop2/t94_logadd.php', '1', '*** Batch insert successful ***', 't95_logdesc', '', '', '', ''),
(227, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(228, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'log_id', '21', '', '4'),
(229, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'desc_', '21', '', 'menghilangkan menu SETUP NASABAH'),
(230, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_issued', '21', '', '2018-10-04'),
(231, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'date_solved', '21', '', '2018-10-04'),
(232, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', 'A', 't95_logdesc', 'id', '21', '', '21'),
(233, '2018-10-19 10:06:07', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(234, '2018-10-19 10:06:44', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'log_id', '22', '', '4'),
(235, '2018-10-19 10:06:44', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'desc_', '22', '', 'buat CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm'),
(236, '2018-10-19 10:06:44', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_issued', '22', '', '2018-10-04'),
(237, '2018-10-19 10:06:44', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'date_solved', '22', '', '2018-10-04'),
(238, '2018-10-19 10:06:44', '/simkop2/t95_logdescadd.php', '1', 'A', 't95_logdesc', 'id', '22', '', '22'),
(239, '2018-10-19 10:11:33', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(240, '2018-10-19 10:11:33', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'desc_', '21', 'menghilangkan menu SETUP NASABAH', 'mengnonaktifkan menu SETUP - NASABAH'),
(241, '2018-10-19 10:11:33', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(242, '2018-10-19 10:12:16', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '21', 'mengnonaktifkan menu SETUP - NASABAH', 'hilangkan menu SETUP - NASABAH'),
(243, '2018-10-19 10:12:39', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '10', 'SETUP - NASABAH diaktifkan lagi', 'SETUP - NASABAH dimunculkan lagi'),
(244, '2018-10-19 10:13:02', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '11', 'sinkronisasi data antar-cabang, agar tiap cabang dapat cross-check data calon nasabah di cabang lain', 'sinkronisasi data antar-cabang, agar tiap cabang dapat cross-check data calon nasabah dari cabang lain'),
(245, '2018-10-19 10:14:36', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '22', 'buat CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm', 'buat modul CHECK FOR UPDATE; aplikasi yang harus ada :: github desktop & gitscm'),
(246, '2018-10-19 10:16:06', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(247, '2018-10-19 10:16:06', '/simkop2/t94_logedit.php', '1', 'U', 't95_logdesc', 'desc_', '20', 'setelah input setoran titipan :: harus save dulu agar nilai saldo terupdate', 'setelah input setoran titipan :: harus save dulu agar jumlah saldo titipan terupdate'),
(248, '2018-10-19 10:16:07', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(249, '2018-10-19 10:16:43', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '20', 'setelah input setoran titipan :: harus save dulu agar jumlah saldo titipan terupdate', 'setelah input setoran TITIPAN :: harus save dulu agar jumlah saldo TITIPAN terupdate'),
(250, '2018-10-19 10:22:53', '/simkop2/t94_logedit.php', '1', '*** Batch update begin ***', 't95_logdesc', '', '', '', ''),
(251, '2018-10-19 10:22:53', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', ''),
(252, '2018-10-19 10:23:33', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '7', 'nilai titipan lgsg tampil bila ada titipan', 'jumlah TITIPAN lgsg tampil bila nasabah memiliki SALDO TITIPAN'),
(253, '2018-10-19 10:24:38', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '6', 'otomatis tampil nilai semua kolom', 'otomatis tampil JUMLAH di semua kolom, JUMLAH :\r\nTERLAMBAT, DENDA, BAYAR TITIPAN, dan seterusnya'),
(254, '2018-10-19 11:11:44', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'date_solved', '17', NULL, '2018-10-04'),
(255, '2018-10-19 11:12:19', '/simkop2/t95_logdescedit.php', '1', 'U', 't95_logdesc', 'desc_', '7', 'jumlah TITIPAN lgsg tampil bila nasabah memiliki SALDO TITIPAN', 'jumlah TITIPAN langsung tampil bila nasabah memiliki SALDO TITIPAN'),
(256, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '1', '', '1'),
(257, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '1', '', '2018-10-19'),
(258, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(259, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(260, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '1', '', '12'),
(261, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '1', '', '2.25'),
(262, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '1', '', '0.4'),
(263, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '1', '', '3'),
(264, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '1', '', '866666.6666666666'),
(265, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '1', '', '234000'),
(266, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '1', '', '1100666.6666666665'),
(267, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '1', '', NULL),
(268, '2018-10-19 11:20:01', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(269, '2018-10-19 11:20:02', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(270, '2018-10-19 11:20:02', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_pinjamantitipan`
-- (See below for the actual view)
--
CREATE TABLE `v01_pinjamantitipan` (
`id` int(11)
,`pinjaman_id` int(11)
,`nasabah_id` int(11)
,`sisa` double(19,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v01_pinjamantitipan`
--
DROP TABLE IF EXISTS `v01_pinjamantitipan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_pinjamantitipan`  AS  select max(`t06_pinjamantitipan`.`id`) AS `id`,`t06_pinjamantitipan`.`pinjaman_id` AS `pinjaman_id`,`t06_pinjamantitipan`.`nasabah_id` AS `nasabah_id`,(sum(`t06_pinjamantitipan`.`Masuk`) - sum(`t06_pinjamantitipan`.`Keluar`)) AS `sisa` from `t06_pinjamantitipan` group by `t06_pinjamantitipan`.`pinjaman_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_angsuran`
--
ALTER TABLE `t04_angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t94_log`
--
ALTER TABLE `t94_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_nasabah`
--
ALTER TABLE `t01_nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_angsuran`
--
ALTER TABLE `t04_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t06_pinjamantitipan`
--
ALTER TABLE `t06_pinjamantitipan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t94_log`
--
ALTER TABLE `t94_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
