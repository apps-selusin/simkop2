-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2018 at 03:16 PM
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
  `Pekerjaan` varchar(25) DEFAULT NULL,
  `Alamat` text,
  `NoTelpHp` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_nasabah`
--

INSERT INTO `t01_nasabah` (`id`, `Customer`, `Pekerjaan`, `Alamat`, `NoTelpHp`) VALUES
(1, 'Andoko', NULL, NULL, NULL),
(2, 'Dodo', NULL, NULL, NULL),
(3, 'Hendra', NULL, NULL, NULL),
(4, 'Vico', NULL, NULL, NULL);

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

--
-- Dumping data for table `t02_jaminan`
--

INSERT INTO `t02_jaminan` (`id`, `nasabah_id`, `MerkType`, `NoRangka`, `NoMesin`, `Warna`, `NoPol`, `Keterangan`, `AtasNama`) VALUES
(1, 1, 'ATM', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'BPKB', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Sertifikat', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'BPKB', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Surat Nikah', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Ijasah', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 4, 'Sertifikat', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 3, 'Sertifikat', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `NoKontrakRefTo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '1', '', '1'),
(2, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '1', '', '2018-09-17'),
(3, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(4, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(5, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '1', '', '12'),
(6, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '1', '', '2.25'),
(7, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '1', '', '0.4'),
(8, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '1', '', '3'),
(9, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '1', '', '866666.6666666666'),
(10, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '1', '', '234000'),
(11, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '1', '', '1100666.6666666665'),
(12, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '1', '', NULL),
(13, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(14, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(15, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'jaminan_id', '1', '', '1'),
(16, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'pinjaman_id', '1', '', '1'),
(17, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'id', '1', '', '1'),
(18, '2018-09-17 10:45:11', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(19, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Bunga', '1', '2.25', '2.24'),
(20, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranPokok', '1', '866666.69', '867000'),
(21, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranBunga', '1', '234000.00', '233000'),
(22, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranTotal', '1', '1100666.62', '1100000'),
(23, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(24, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(25, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(26, '2018-09-17 22:33:31', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(27, '2018-09-18 00:02:47', '/simkop2/t96_employeesedit.php', '1', 'U', 't96_employees', 'Activated', '1', 'N', 'Y'),
(28, '2018-09-18 00:08:04', '/simkop2/t96_employeesedit.php', '1', 'U', 't96_employees', 'Password', '1', '********', '********'),
(29, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '1', '', '1'),
(30, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '1', '', '2018-09-20'),
(31, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(32, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(33, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '1', '', '12'),
(34, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '1', '', '2.25'),
(35, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '1', '', '0.4'),
(36, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '1', '', '3'),
(37, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '1', '', '866666.6666666666'),
(38, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '1', '', '234000'),
(39, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '1', '', '1100666.6666666665'),
(40, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '1', '', NULL),
(41, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(42, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(43, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'jaminan_id', '1', '', '1'),
(44, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'pinjaman_id', '1', '', '1'),
(45, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'id', '1', '', '1'),
(46, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(47, '2018-09-20 08:29:49', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', ''),
(48, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Bunga', '1', '2.25', '2.24'),
(49, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranPokok', '1', '866666.69', '867000'),
(50, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranBunga', '1', '234000.00', '233000'),
(51, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranTotal', '1', '1100666.62', '1100000'),
(52, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(53, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(54, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(55, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(56, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(57, '2018-09-20 08:47:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(58, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '1', '', '1'),
(59, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '1', '', '2018-09-20'),
(60, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(61, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(62, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '1', '', '12'),
(63, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '1', '', '2.25'),
(64, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '1', '', '0.4'),
(65, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '1', '', '3'),
(66, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '1', '', '866666.6666666666'),
(67, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '1', '', '234000'),
(68, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '1', '', '1100666.6666666665'),
(69, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '1', '', NULL),
(70, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(71, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(72, '2018-09-20 09:00:19', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', ''),
(73, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'Bunga', '1', '2.25', '2.24'),
(74, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranPokok', '1', '866666.69', '867000'),
(75, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranBunga', '1', '234000.00', '233000'),
(76, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't03_pinjaman', 'AngsuranTotal', '1', '1100666.62', '1100000'),
(77, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(78, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(79, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(80, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(81, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(82, '2018-09-20 09:05:01', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(83, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(84, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(85, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(86, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't05_pinjamanjaminan', 'jaminan_id', '1', '', '1'),
(87, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't05_pinjamanjaminan', 'pinjaman_id', '1', '', '1'),
(88, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't05_pinjamanjaminan', 'id', '1', '', '1'),
(89, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(90, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(91, '2018-09-20 09:18:39', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(92, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(93, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(94, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(95, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(96, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(97, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-09-20'),
(98, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', 'titip'),
(99, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '200000'),
(100, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '1', '', '0'),
(101, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '1', '', '200000'),
(102, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(103, '2018-09-20 10:14:56', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(104, '2018-09-20 10:14:57', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(105, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(106, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '37', NULL, '1'),
(107, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(108, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(109, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(110, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(111, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '2', '', '2018-09-20'),
(112, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '2', '', 'titip 2'),
(113, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '2', '', '300000'),
(114, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '2', '', '0'),
(115, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '2', '', '500000'),
(116, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '2', '', '1'),
(117, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '2', '', '2'),
(118, '2018-09-20 10:15:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(119, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(120, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '49', NULL, '1'),
(121, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(122, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(123, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(124, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(125, '2018-09-20 10:16:02', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(126, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(127, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '61', NULL, '1'),
(128, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(129, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(130, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(131, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(132, '2018-09-20 10:16:26', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(133, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(134, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '73', NULL, '1'),
(135, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(136, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(137, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(138, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(139, '2018-09-20 10:21:40', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(140, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(141, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '85', NULL, '1'),
(142, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(143, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(144, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(145, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(146, '2018-09-20 10:27:25', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(147, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(148, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '97', NULL, '1'),
(149, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(150, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(151, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(152, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(153, '2018-09-20 10:55:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(154, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(155, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '109', NULL, '1'),
(156, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(157, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(158, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(159, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(160, '2018-09-20 11:15:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(161, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(162, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TanggalBayar', '121', NULL, '2018-09-20'),
(163, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '121', NULL, '1'),
(164, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(165, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(166, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(167, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(168, '2018-09-20 11:15:35', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(169, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(170, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TanggalBayar', '133', NULL, '2018-09-20'),
(171, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(172, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(173, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(174, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(175, '2018-09-20 11:17:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(176, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(177, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TanggalBayar', '145', NULL, '2018-09-20'),
(178, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', NULL, '1'),
(179, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(180, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(181, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(182, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(183, '2018-09-20 11:33:32', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(184, '2018-09-20 11:48:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(185, '2018-09-20 11:48:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(186, '2018-09-20 11:48:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(187, '2018-09-20 11:48:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(188, '2018-09-20 11:48:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(189, '2018-09-20 11:48:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(190, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(191, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Terlambat', '145', NULL, '0'),
(192, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', '1.00', NULL),
(193, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(194, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(195, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(196, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(197, '2018-09-20 11:48:44', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(198, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(199, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', NULL, '1'),
(200, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(201, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(202, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(203, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(204, '2018-09-20 11:49:29', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(205, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '2', '', '2'),
(206, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '2', '', '2018-09-20'),
(207, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '2'),
(208, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '3120000'),
(209, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '2', '', '6'),
(210, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '2', '', '2.28'),
(211, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '2', '', '0.4'),
(212, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '2', '', '3'),
(213, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '2', '', '520000'),
(214, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '2', '', '71000'),
(215, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '2', '', '591000'),
(216, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '2', '', NULL),
(217, '2018-09-20 11:57:38', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(218, '2018-09-20 11:57:39', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(219, '2018-09-20 11:57:39', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', ''),
(220, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(221, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', '1.00', '2'),
(222, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(223, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(224, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(225, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(226, '2018-09-20 13:46:05', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(227, '2018-09-20 13:48:37', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(228, '2018-09-20 13:48:37', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', '2.00', NULL),
(229, '2018-09-20 13:48:37', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'pinjamantitipan_id', '145', NULL, '2'),
(230, '2018-09-20 13:48:38', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(231, '2018-09-20 13:48:38', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(232, '2018-09-20 13:48:38', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(233, '2018-09-20 13:48:38', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(234, '2018-09-20 13:48:38', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(235, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(236, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '145', NULL, '2'),
(237, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(238, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(239, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(240, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(241, '2018-09-20 13:49:16', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(242, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(243, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(244, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(245, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(246, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(247, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '3', '', '2018-09-20'),
(248, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '3', '', '1'),
(249, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '3', '', '300000'),
(250, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '3', '', '0'),
(251, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '3', '', '300000'),
(252, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '3', '', '2'),
(253, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '3', '', '3'),
(254, '2018-09-20 13:57:24', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(255, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '1', '', '1'),
(256, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '1', '', '2018-09-20'),
(257, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '1', '', '1'),
(258, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '1', '', '10400000'),
(259, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '1', '', '12'),
(260, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '1', '', '2.24'),
(261, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '1', '', '0.4'),
(262, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '1', '', '3'),
(263, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '1', '', '867000'),
(264, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '1', '', '233000'),
(265, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '1', '', '1100000'),
(266, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '1', '', NULL),
(267, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '1', '', '1'),
(268, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(269, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'jaminan_id', '1', '', '1'),
(270, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'pinjaman_id', '1', '', '1'),
(271, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't05_pinjamanjaminan', 'id', '1', '', '1'),
(272, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(273, '2018-09-20 14:48:24', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', ''),
(274, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(275, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(276, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(277, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(278, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(279, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '1', '', '2018-09-21'),
(280, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '1', '', '1'),
(281, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '1', '', '200000'),
(282, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '1', '', '0'),
(283, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '1', '', '200000'),
(284, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'nasabah_id', '1', '', '1'),
(285, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '1', '', '1'),
(286, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '1', '', '1'),
(287, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '2', '', '2018-09-22'),
(288, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '2', '', '2'),
(289, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '2', '', '300000'),
(290, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '2', '', '0'),
(291, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '2', '', '500000'),
(292, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'nasabah_id', '2', '', '1'),
(293, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '2', '', '1'),
(294, '2018-09-20 14:49:07', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '2', '', '2'),
(295, '2018-09-20 14:49:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(296, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrak', '2', '', '2'),
(297, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'TglKontrak', '2', '', '2018-09-20'),
(298, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'nasabah_id', '2', '', '2'),
(299, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Pinjaman', '2', '', '3120000'),
(300, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'LamaAngsuran', '2', '', '6'),
(301, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Bunga', '2', '', '2.28'),
(302, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'Denda', '2', '', '0.4'),
(303, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'DispensasiDenda', '2', '', '3'),
(304, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranPokok', '2', '', '520000'),
(305, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranBunga', '2', '', '71000'),
(306, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'AngsuranTotal', '2', '', '591000'),
(307, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'NoKontrakRefTo', '2', '', NULL),
(308, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', 'A', 't03_pinjaman', 'id', '2', '', '2'),
(309, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(310, '2018-09-20 14:49:58', '/simkop2/t03_pinjamanadd.php', '1', '*** Batch insert begin ***', 't06_pinjamantitipan', '', '', '', ''),
(311, '2018-09-20 14:50:21', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(312, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(313, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(314, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(315, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(316, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '3', '', '2018-09-21'),
(317, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '3', '', '11'),
(318, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '3', '', '400000'),
(319, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '3', '', '0'),
(320, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '3', '', '400000'),
(321, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'nasabah_id', '3', '', '2'),
(322, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '3', '', '2'),
(323, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '3', '', '3'),
(324, '2018-09-20 14:50:22', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(325, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(326, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'pinjamantitipan_id', '1', NULL, '2'),
(327, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(328, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(329, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(330, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(331, '2018-09-20 17:26:58', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(332, '2018-09-24 10:41:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(333, '2018-09-24 10:41:08', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'pinjamantitipan_id', '1', '2', NULL),
(334, '2018-09-24 10:41:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(335, '2018-09-24 10:41:08', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(336, '2018-09-24 10:41:09', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(337, '2018-09-24 10:41:09', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(338, '2018-09-24 10:41:09', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(339, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(340, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(341, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(342, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(343, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(344, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Tanggal', '4', '', '2018-09-26'),
(345, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keterangan', '4', '', '3'),
(346, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Masuk', '4', '', '100000'),
(347, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Keluar', '4', '', '0'),
(348, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'Sisa', '4', '', '600000'),
(349, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'nasabah_id', '4', '', '1'),
(350, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'pinjaman_id', '4', '', '1'),
(351, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', 'A', 't06_pinjamantitipan', 'id', '4', '', '4'),
(352, '2018-09-26 19:17:12', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(353, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(354, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TanggalBayar', '1', NULL, '2018-09-26'),
(355, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TotalDenda', '1', NULL, '10000'),
(356, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '1', NULL, '600000'),
(357, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Non_Titipan', '1', NULL, '0'),
(358, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Total', '1', NULL, '610000'),
(359, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'pinjamantitipan_id', '1', NULL, '4'),
(360, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(361, '2018-09-26 19:58:54', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(362, '2018-09-26 19:58:55', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(363, '2018-09-26 19:58:55', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(364, '2018-09-26 19:58:55', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(365, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(366, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TotalDenda', '2', NULL, '0'),
(367, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Titipan', '2', NULL, '600000'),
(368, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Non_Titipan', '2', NULL, '0'),
(369, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Bayar_Total', '2', NULL, '600000'),
(370, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'pinjamantitipan_id', '2', NULL, '4'),
(371, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(372, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(373, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(374, '2018-09-26 19:59:42', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(375, '2018-09-26 19:59:43', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', ''),
(376, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't04_angsuran', '', '', '', ''),
(377, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Terlambat', '1', NULL, '0'),
(378, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'TanggalBayar', '2', NULL, '2018-10-26'),
(379, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', 'U', 't04_angsuran', 'Terlambat', '2', NULL, '0'),
(380, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't04_angsuran', '', '', '', ''),
(381, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't05_pinjamanjaminan', '', '', '', ''),
(382, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't05_pinjamanjaminan', '', '', '', ''),
(383, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update begin ***', 't06_pinjamantitipan', '', '', '', ''),
(384, '2018-09-26 20:00:17', '/simkop2/t03_pinjamanedit.php', '1', '*** Batch update successful ***', 't06_pinjamantitipan', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t02_jaminan`
--
ALTER TABLE `t02_jaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t03_pinjaman`
--
ALTER TABLE `t03_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t04_angsuran`
--
ALTER TABLE `t04_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
