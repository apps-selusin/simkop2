-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2018 at 09:12 PM
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

--
-- Dumping data for table `t03_pinjaman`
--

INSERT INTO `t03_pinjaman` (`id`, `NoKontrak`, `TglKontrak`, `nasabah_id`, `Pinjaman`, `LamaAngsuran`, `Bunga`, `Denda`, `DispensasiDenda`, `AngsuranPokok`, `AngsuranBunga`, `AngsuranTotal`, `NoKontrakRefTo`) VALUES
(1, '1', '2018-09-17', 1, 10400000.00, 12, '2.24', '0.40', 3, 867000.00, 233000.00, 1100000.00, NULL);

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
  `TotalDenda` float(14,2) DEFAULT NULL,
  `Terlambat` smallint(6) DEFAULT NULL,
  `Keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_angsuran`
--

INSERT INTO `t04_angsuran` (`id`, `pinjaman_id`, `AngsuranKe`, `AngsuranTanggal`, `AngsuranPokok`, `AngsuranBunga`, `AngsuranTotal`, `SisaHutang`, `TanggalBayar`, `TotalDenda`, `Terlambat`, `Keterangan`) VALUES
(13, 1, 1, '2018-10-17', 867000.00, 233000.00, 1100000.00, 9533000.00, NULL, NULL, NULL, NULL),
(14, 1, 2, '2018-11-17', 867000.00, 233000.00, 1100000.00, 8666000.00, NULL, NULL, NULL, NULL),
(15, 1, 3, '2018-12-17', 867000.00, 233000.00, 1100000.00, 7799000.00, NULL, NULL, NULL, NULL),
(16, 1, 4, '2019-01-17', 867000.00, 233000.00, 1100000.00, 6932000.00, NULL, NULL, NULL, NULL),
(17, 1, 5, '2019-02-17', 867000.00, 233000.00, 1100000.00, 6065000.00, NULL, NULL, NULL, NULL),
(18, 1, 6, '2019-03-17', 867000.00, 233000.00, 1100000.00, 5198000.00, NULL, NULL, NULL, NULL),
(19, 1, 7, '2019-04-17', 867000.00, 233000.00, 1100000.00, 4331000.00, NULL, NULL, NULL, NULL),
(20, 1, 8, '2019-05-17', 867000.00, 233000.00, 1100000.00, 3464000.00, NULL, NULL, NULL, NULL),
(21, 1, 9, '2019-06-17', 867000.00, 233000.00, 1100000.00, 2597000.00, NULL, NULL, NULL, NULL),
(22, 1, 10, '2019-07-17', 867000.00, 233000.00, 1100000.00, 1730000.00, NULL, NULL, NULL, NULL),
(23, 1, 11, '2019-08-17', 867000.00, 233000.00, 1100000.00, 863000.00, NULL, NULL, NULL, NULL),
(24, 1, 12, '2019-09-17', 863000.00, 237000.00, 1100000.00, 0.00, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t05_pinjamanjaminan`
--

CREATE TABLE `t05_pinjamanjaminan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jaminan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t05_pinjamanjaminan`
--

INSERT INTO `t05_pinjamanjaminan` (`id`, `pinjaman_id`, `jaminan_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t06_pinjamantitipan`
--

CREATE TABLE `t06_pinjamantitipan` (
  `id` int(11) NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
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
(28, '2018-09-18 00:08:04', '/simkop2/t96_employeesedit.php', '1', 'U', 't96_employees', 'Password', '1', '********', '********');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_angsuran`
--
ALTER TABLE `t04_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t05_pinjamanjaminan`
--
ALTER TABLE `t05_pinjamanjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
