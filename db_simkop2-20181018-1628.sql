-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2018 at 11:27 AM
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
(1, 1, 'pinjaman - master');

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
(1, 1, '2018-10-04', 'tipe data nomor referensi diubah dari integer menjadi varchar;', '2018-10-17'),
(2, 1, '2018-10-04', 'ada tambahan kolom POTONGAN, mengurangi SISA HUTANG;', NULL),
(3, 1, '2018-10-04', 'setiap ada pembayaran menggunakan SALDO TITIPAN maka akan mengurangi jumlah SALDO TITIPAN;', NULL);

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
(88, '2018-10-18 15:01:09', '/simkop2/t94_logedit.php', '1', '*** Batch update successful ***', 't95_logdesc', '', '', '', '');

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
-- AUTO_INCREMENT for table `t94_log`
--
ALTER TABLE `t94_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t95_logdesc`
--
ALTER TABLE `t95_logdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
