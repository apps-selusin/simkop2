-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 17, 2018 at 05:05 AM
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
-- Structure for view `v01_pinjamantitipan`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_pinjamantitipan`  AS  select max(`t06_pinjamantitipan`.`id`) AS `id`,`t06_pinjamantitipan`.`pinjaman_id` AS `pinjaman_id`,`t06_pinjamantitipan`.`nasabah_id` AS `nasabah_id`,(sum(`t06_pinjamantitipan`.`Masuk`) - sum(`t06_pinjamantitipan`.`Keluar`)) AS `sisa` from `t06_pinjamantitipan` group by `t06_pinjamantitipan`.`pinjaman_id` ;

--
-- VIEW  `v01_pinjamantitipan`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
