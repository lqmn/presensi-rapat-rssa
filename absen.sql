-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2017 at 08:02 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--
CREATE DATABASE IF NOT EXISTS `absen` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `absen`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CHANGE_STATUS` (IN `IN_NIP` BIGINT, IN `IN_STATUS` INT)  NO SQL
UPDATE pegawai
SET STATUS=IF(IN_STATUS=1,0,1)
WHERE IN_NIP=NIP$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CHANGE_USER_STATUS` (IN `IN_NIP` BIGINT, IN `IN_STATUS` INT)  NO SQL
UPDATE user
SET STATUS=IF(IN_STATUS=1,0,1)
WHERE NIP_PEGAWAI=IN_NIP$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_NON_PEGAWAI` (IN `IN_ID` INT)  NO SQL
DELETE FROM non_pegawai 
WHERE ID=IN_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PEGAWAI` (IN `IN_ID_PEGAWAI` INT)  NO SQL
DELETE FROM pegawai where ID_PEGAWAI = IN_ID_PEGAWAI$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_USER` (IN `IN_ID` INT)  NO SQL
DELETE FROM user WHERE ID_USER=IN_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EDIT_NON_PEGAWAI` (IN `IN_ID` INT, IN `IN_NAMA` VARCHAR(50), IN `IN_INSTITUSI` VARCHAR(100))  NO SQL
UPDATE non_pegawai 
SET NAMA=IN_NAMA , INSTITUSI=IN_INSTITUSI
WHERE ID=IN_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EDIT_PEGAWAI` (IN `IN_NAMA_PEGAWAI` VARCHAR(50), IN `IN_NIP_PEGAWAI` BIGINT, IN `IN_SATKER_PEGAWAI` INT, IN `IN_ID_PEGAWAI` INT)  NO SQL
UPDATE pegawai 
SET NAMA=IN_NAMA_PEGAWAI, NIP=IN_NIP_PEGAWAI, ID_SATKER=IN_SATKER_PEGAWAI
WHERE ID_PEGAWAI=IN_ID_PEGAWAI$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EDIT_USER` (IN `IN_ID` INT, IN `IN_NIP` BIGINT, IN `IN_PASSWORD` VARCHAR(100), IN `IN_OTORITAS` INT)  NO SQL
UPDATE user 
SET PASSWORD=IN_PASSWORD,OTORITAS=IN_OTORITAS,NIP_PEGAWAI=IN_NIP
WHERE ID_USER=IN_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ONE_NON_PEGAWAI` (IN `IN_NAMA` VARCHAR(50))  NO SQL
SELECT * FROM non_pegawai WHERE NAMA = IN_NAMA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ONE_NON_PEGAWAI_ID` (IN `IN_ID` INT)  NO SQL
SELECT * FROM non_pegawai 
WHERE ID=IN_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ONE_PEGAWAI` (IN `IN_NIP_PEGAWAI` BIGINT)  NO SQL
SELECT * FROM pegawai where NIP = IN_NIP_PEGAWAI$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ONE_USER` (IN `IN_NIP_PEGAWAI` BIGINT)  NO SQL
SELECT * FROM user WHERE NIP_PEGAWAI=IN_NIP_PEGAWAI$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INPUT_ABSEN` (IN `IN_ID_PEGAWAI` INT, IN `IN_WAKTU` DATETIME)  NO SQL
INSERT INTO absensi ( ID_USER, TANGGAL) 
SELECT * FROM (SELECT IN_ID_PEGAWAI, IN_WAKTU) AS tmp
WHERE NOT EXISTS (
    SELECT ID_USER , TANGGAL FROM absensi WHERE ID_USER = IN_ID_PEGAWAI
    AND DATE(TANGGAL) = DATE(IN_WAKTU)
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NEW_USER` (IN `IN_NIP` BIGINT, IN `IN_NAMA` VARCHAR(50), IN `IN_ID_SATKER` INT)  NO SQL
INSERT INTO pegawai (NAMA,NIP,SATKER,STATUS) VALUES (IN_NAMA,IN_NIP,IN_ID_SATKER,1)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `ID_ABSENSI` int(11) NOT NULL,
  `ID_USER` bigint(20) NOT NULL,
  `TANGGAL` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `ID_BULAN` int(11) NOT NULL,
  `NAMA_BULAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`ID_BULAN`, `NAMA_BULAN`) VALUES
(1, 'JANUARI'),
(2, 'FEBRUARI'),
(3, 'MARET'),
(4, 'APRIL'),
(5, 'MEI'),
(6, 'JUNI'),
(7, 'JULI'),
(8, 'AGUSTUS'),
(9, 'SEPTEMBER'),
(10, 'OKTOBER'),
(11, 'NOVEMBER'),
(12, 'DESEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `hari_libur`
--

CREATE TABLE `hari_libur` (
  `ID_HARI_LIBUR` int(11) NOT NULL,
  `TANGGAL` date NOT NULL,
  `ID_USER_LAST_EDITOR` bigint(20) NOT NULL,
  `DATE_LAST_EDITED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jam_lembur`
--

CREATE TABLE `jam_lembur` (
  `ID_USER` bigint(20) NOT NULL,
  `TOTAL_LEMBUR` int(11) NOT NULL,
  `ID_BULAN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `non_pegawai`
--

CREATE TABLE `non_pegawai` (
  `ID` bigint(20) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `INSTITUSI` varchar(100) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_pegawai`
--

INSERT INTO `non_pegawai` (`ID`, `NAMA`, `INSTITUSI`, `date_modified`) VALUES
(27, 'Pak Aryo', 'FILKOM', '2017-08-09 05:29:07'),
(29, 'Pak nanang', 'FILKOM', '2017-08-12 05:46:05'),
(30, 'Bu niken', 'FILKOM', '2017-08-12 05:48:19'),
(32, '211111212121', 'wwwwww', '2017-08-12 05:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` bigint(20) NOT NULL,
  `NIP` bigint(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `ID_SATKER` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NIP`, `NAMA`, `ID_SATKER`, `STATUS`, `date_modified`) VALUES
(1, 145150401111036, 'Eki Yusandhi Iskandar', 2, 1, '2017-08-09 05:11:04'),
(2, 145150407111034, 'Ahmad Luthfi Teguh', 2, 0, '2017-08-09 05:11:04'),
(3, 15149841, 'Jabbar Satrio Wicaksono', 1, 0, '2017-08-09 05:11:04'),
(5, 98929, 'Dedi Setiadi', 2, 0, '2017-08-09 07:10:13'),
(189, 1685071368499, 'Tamara', 1, 1, '2017-08-09 05:11:04'),
(190, 1691102662499, 'Logan', 2, 1, '2017-08-09 05:11:04'),
(191, 1669040824899, 'Sonia', 2, 0, '2017-08-09 05:11:04'),
(192, 1614112862399, 'Robert', 2, 1, '2017-08-09 05:11:04'),
(193, 1656042765099, 'Cassidy', 1, 0, '2017-08-09 05:11:04'),
(194, 1660023053599, 'Wade', 1, 0, '2017-08-09 05:11:04'),
(195, 1637012482999, 'Sigourney', 1, 1, '2017-08-09 05:11:04'),
(196, 1613021884699, 'Julie', 1, 1, '2017-08-09 05:11:04'),
(197, 1645101661099, 'Conan', 2, 1, '2017-08-09 05:11:04'),
(198, 1696071568999, 'Silas', 2, 1, '2017-08-09 05:11:04'),
(199, 1691122337699, 'Joy', 1, 0, '2017-08-09 05:11:04'),
(200, 1632062101199, 'Zorita', 2, 0, '2017-08-09 05:11:04'),
(201, 1696010970499, 'Isaiah', 2, 1, '2017-08-09 05:11:04'),
(202, 1651052534899, 'Kerry', 1, 1, '2017-08-09 05:11:04'),
(203, 1605081787899, 'Cedric', 1, 0, '2017-08-09 05:23:52'),
(204, 1631030297099, 'Uriel', 2, 1, '2017-08-09 05:11:04'),
(205, 1659020355599, 'Aline', 2, 0, '2017-08-09 05:11:04'),
(206, 1663052784399, 'Didi', 2, 0, '2017-08-11 16:02:51'),
(207, 1628120998099, 'Whilemina', 2, 0, '2017-08-09 05:11:04'),
(208, 1693110908199, 'Hamilton', 1, 0, '2017-08-09 07:03:55'),
(209, 1676082406999, 'Lance', 1, 0, '2017-08-09 05:11:04'),
(210, 1666032779399, 'Tate', 2, 0, '2017-08-09 07:02:52'),
(211, 1682062015099, 'Linus', 2, 1, '2017-08-09 05:11:04'),
(212, 1688021440899, 'Pandora', 2, 1, '2017-08-09 05:11:04'),
(213, 1659061573499, 'Eaton', 1, 0, '2017-08-09 05:11:04'),
(214, 1659040284799, 'Akeem', 1, 0, '2017-08-09 05:11:04'),
(215, 1684101419799, 'Darius', 2, 1, '2017-08-09 05:11:04'),
(216, 1646010490099, 'Paloma', 2, 0, '2017-08-09 05:11:04'),
(217, 1602020806999, 'Rengginang', 2, 0, '2017-08-11 03:00:49'),
(218, 1676052178499, 'Uta', 2, 1, '2017-08-09 05:11:04'),
(219, 1667082154799, 'Harper', 1, 1, '2017-08-09 05:11:04'),
(221, 1694042222799, 'Xenos', 1, 0, '2017-08-09 05:11:04'),
(222, 1629060745599, 'Driscoll', 2, 1, '2017-08-09 05:11:04'),
(223, 1698071585399, 'Miriam', 2, 0, '2017-08-09 05:11:04'),
(225, 1605041498099, 'Dean', 2, 0, '2017-08-11 16:04:10'),
(226, 1605070758499, 'Rhoda', 2, 1, '2017-08-09 05:11:04'),
(227, 1606021823399, 'Carla', 2, 0, '2017-08-09 05:11:04'),
(228, 1613083005399, 'Kerry', 2, 1, '2017-08-09 05:11:04'),
(229, 1653081602699, 'Pascale', 1, 1, '2017-08-09 05:11:04'),
(230, 1667092896699, 'Yenna', 1, 1, '2017-08-11 16:28:53'),
(231, 1690022321399, 'Whitney', 2, 0, '2017-08-09 05:11:04'),
(232, 1665082415399, 'Eagan', 2, 1, '2017-08-09 05:11:04'),
(233, 1666082944299, 'Vera', 2, 0, '2017-08-09 05:11:04'),
(234, 1661020666699, 'Cameron', 1, 0, '2017-08-09 05:11:04'),
(235, 1674081712999, 'Chio', 1, 0, '2017-08-11 16:03:27'),
(236, 1686041430299, 'Sage', 1, 0, '2017-08-11 16:04:10'),
(237, 1663011309199, 'Bernard', 2, 0, '2017-08-09 05:11:04'),
(238, 1614062230599, 'Cruz', 2, 1, '2017-08-09 05:11:04'),
(239, 1679041683399, 'Kennedy', 1, 0, '2017-08-09 05:11:04'),
(240, 1658040158499, 'Berk', 2, 0, '2017-08-09 05:11:04'),
(241, 1614082381599, 'Jordan', 2, 1, '2017-08-09 05:11:04'),
(242, 1616072580399, 'Alexander', 1, 0, '2017-08-09 05:11:04'),
(243, 1600033015399, 'Nero', 2, 0, '2017-08-09 05:11:04'),
(244, 1690072080799, 'Jarrod', 2, 0, '2017-08-09 05:11:04'),
(245, 1664061940999, 'Andrew', 2, 0, '2017-08-09 05:11:04'),
(246, 1642111740199, 'Spring', 1, 0, '2017-08-09 05:13:53'),
(247, 1614011428199, 'Mari', 2, 0, '2017-08-09 07:06:25'),
(248, 1646010127299, 'Yun', 1, 0, '2017-08-11 03:00:32'),
(249, 1609052955999, 'Ina', 1, 1, '2017-08-09 05:11:04'),
(250, 1646063070999, 'Rhiannon', 1, 0, '2017-08-09 05:11:04'),
(251, 1646020598299, 'Phelan', 1, 0, '2017-08-09 05:11:04'),
(252, 1627052785799, 'Pamela', 2, 0, '2017-08-09 05:11:04'),
(253, 1657102555699, 'Rebecca', 2, 0, '2017-08-09 05:11:04'),
(254, 1687091813699, 'Kaden', 2, 1, '2017-08-09 05:11:04'),
(255, 1658032304699, 'Lavinia', 2, 1, '2017-08-09 05:11:04'),
(256, 1671112597299, 'Barclay', 1, 0, '2017-08-09 05:19:00'),
(257, 1660092649299, 'Yvette', 2, 0, '2017-08-09 05:11:04'),
(258, 1626012208499, 'Felicia', 1, 0, '2017-08-09 05:11:04'),
(259, 1617061729099, 'Hop', 1, 1, '2017-08-09 05:11:04'),
(260, 1630072963299, 'Byron', 1, 0, '2017-08-09 05:11:04'),
(261, 1685052153599, 'Shelby', 1, 0, '2017-08-09 05:11:04'),
(262, 1671061596699, 'Holmes', 2, 0, '2017-08-09 05:11:04'),
(263, 1683072403199, 'Raja', 2, 0, '2017-08-09 05:11:04'),
(264, 1637061665599, 'Jamin', 1, 0, '2017-08-11 16:02:00'),
(265, 1653061073399, 'Cheryl', 1, 1, '2017-08-09 05:11:04'),
(266, 1622100129699, 'Haley', 2, 1, '2017-08-09 05:11:04'),
(267, 1690051237999, 'Brian', 2, 1, '2017-08-09 05:11:04'),
(268, 1688092587099, 'Marsden', 1, 1, '2017-08-09 05:11:04'),
(269, 1677050686099, 'Sylvia', 1, 0, '2017-08-09 07:02:26'),
(270, 1602111210299, 'Aphrodite', 1, 1, '2017-08-09 05:11:04'),
(271, 1677072003299, 'Shana', 2, 0, '2017-08-09 05:11:04'),
(272, 1610051370999, 'Ora', 1, 1, '2017-08-09 05:11:04'),
(273, 1604081258199, 'Virginia', 1, 0, '2017-08-09 05:11:04'),
(274, 1676030925799, 'Jescie', 1, 0, '2017-08-09 05:11:04'),
(275, 1618081164799, 'Anika', 2, 0, '2017-08-09 05:11:04'),
(276, 1693051124799, 'Lamar', 2, 1, '2017-08-09 05:11:04'),
(277, 1637112158299, 'Erich', 2, 0, '2017-08-09 05:11:04'),
(278, 1678121569199, 'Bo', 2, 0, '2017-08-09 05:11:04'),
(279, 1649031396099, 'Beau', 1, 0, '2017-08-09 07:01:45'),
(280, 1623071359099, 'Dale', 2, 1, '2017-08-09 05:11:04'),
(281, 1628023065799, 'Bertha', 2, 1, '2017-08-09 05:11:04'),
(282, 1605062140199, 'Zoe', 2, 0, '2017-08-09 05:11:04'),
(283, 1653111901999, 'Xena', 2, 0, '2017-08-09 05:11:04'),
(284, 1646101378099, 'Ulysses', 2, 0, '2017-08-09 07:33:28'),
(285, 1646040238399, 'Christine', 1, 1, '2017-08-09 05:11:04'),
(286, 1665121275599, 'Reese', 1, 0, '2017-08-09 05:11:04'),
(287, 1656051683899, 'Jada', 1, 0, '2017-08-09 05:11:04'),
(288, 1634110141199, 'Camden', 1, 1, '2017-08-09 05:11:04'),
(289, 16889411, 'Zyva', 1, 1, '2017-08-09 05:11:04'),
(324, 145150407111051, 'Luqman Ariffandi', 1, 1, '2017-08-12 05:25:12'),
(325, 100, 'budi', 1, 0, '2017-08-11 16:29:14'),
(327, 121, 'nyoba2', 1, 1, '2017-08-09 05:11:04'),
(330, 27348, 'wow', 1, 0, '2017-08-09 06:58:53'),
(331, 0, '', 1, 0, '2017-08-10 01:05:30'),
(332, 4125, 'awewadaaw', 1, 0, '2017-08-11 05:41:48'),
(333, 54645, 'bgetest lagi', 1, 0, '2017-08-11 05:41:48'),
(334, 0, '', 1, 0, '2017-08-11 07:59:00'),
(335, 0, '', 1, 0, '2017-08-11 08:35:38'),
(336, 0, '', 1, 0, '2017-08-11 08:35:38'),
(337, 0, '', 1, 0, '2017-08-11 08:35:38'),
(338, 0, '', 1, 0, '2017-08-11 08:35:38'),
(339, 0, '', 1, 0, '2017-08-11 08:35:38'),
(340, 412, '21312', 1, 0, '2017-08-11 15:42:31'),
(341, 215421521, 'awdaw', 2, 0, '2017-08-11 16:02:25'),
(342, 0, '', 1, 0, '2017-08-11 17:35:54'),
(343, 0, '', 1, 0, '2017-08-11 17:35:54'),
(344, 0, '', 1, 0, '2017-08-11 17:35:54'),
(345, 0, '', 1, 0, '2017-08-11 17:35:54'),
(346, 0, '', 1, 0, '2017-08-11 17:40:52'),
(347, 0, '', 1, 0, '2017-08-11 18:45:24'),
(348, 0, '', 1, 0, '2017-08-11 18:45:24'),
(349, 0, '', 1, 0, '2017-08-12 01:06:42'),
(350, 0, '', 1, 0, '2017-08-12 01:06:42'),
(351, 1, '2', 1, 0, '2017-08-12 01:06:42'),
(352, 121421421, '12321421', 1, 0, '2017-08-12 02:00:50'),
(353, 352532, 'yay', 1, 0, '2017-08-12 02:03:02'),
(354, 12421, 'jadi lama', 1, 0, '2017-08-12 02:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_rapat`
--

CREATE TABLE `peserta_rapat` (
  `ID_USER` bigint(20) NOT NULL,
  `NAMA_PESERTA` varchar(50) NOT NULL,
  `ID_RAPAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rapat`
--

CREATE TABLE `rapat` (
  `ID_RAPAT` int(11) NOT NULL,
  `WAKTU_RAPAT` datetime NOT NULL,
  `ID_RUANG` int(11) NOT NULL,
  `ID_USER_INPUT` bigint(20) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_rapat`
--

CREATE TABLE `ruang_rapat` (
  `ID_RUANG` int(11) NOT NULL,
  `NAMA_RUANG` varchar(50) NOT NULL,
  `STATUS_RUANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan_kerja`
--

CREATE TABLE `satuan_kerja` (
  `ID_SATKER` int(11) NOT NULL,
  `NAMA_SATKER` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_kerja`
--

INSERT INTO `satuan_kerja` (`ID_SATKER`, `NAMA_SATKER`, `STATUS`) VALUES
(1, 'ITIKOM', 0),
(2, 'Tata Usaha', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `ID_PEGAWAI` bigint(20) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `OTORITAS` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `ID_PEGAWAI`, `USERNAME`, `PASSWORD`, `STATUS`, `OTORITAS`, `date_modified`) VALUES
(1, 1, '11155', '12345', 1, 1, '2017-08-12 05:45:30'),
(2, 194, '123', '1234', 0, 2, '2017-08-12 05:26:38'),
(3, 324, '12412', '1234', 0, 1, '2017-08-12 02:54:53'),
(4, 325, '100', '12312312412', 0, 2, '2017-08-10 01:49:40'),
(6, 327, '124214124', '12321', 0, 2, '2017-08-12 02:54:29'),
(7, 327, '121', '1234', 0, 1, '2017-08-12 05:25:31'),
(8, 324, '145150407111051', '125215215215215215215', 0, 1, '2017-08-12 05:31:43'),
(9, 324, '145150407111051', '12345', 1, 1, '2017-08-12 05:44:45'),
(10, 230, '1667092896699', '12345', 1, 2, '2017-08-12 05:45:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID_ABSENSI`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`ID_BULAN`);

--
-- Indexes for table `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD PRIMARY KEY (`ID_HARI_LIBUR`),
  ADD KEY `ID_USER_LAST_EDITOR` (`ID_USER_LAST_EDITOR`);

--
-- Indexes for table `jam_lembur`
--
ALTER TABLE `jam_lembur`
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_BULAN` (`ID_BULAN`);

--
-- Indexes for table `non_pegawai`
--
ALTER TABLE `non_pegawai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`),
  ADD KEY `ID_SATKER` (`ID_SATKER`);

--
-- Indexes for table `peserta_rapat`
--
ALTER TABLE `peserta_rapat`
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_RAPAT` (`ID_RAPAT`);

--
-- Indexes for table `rapat`
--
ALTER TABLE `rapat`
  ADD PRIMARY KEY (`ID_RAPAT`),
  ADD KEY `ID_RUANG` (`ID_RUANG`),
  ADD KEY `ID_USER_INPUT` (`ID_USER_INPUT`);

--
-- Indexes for table `ruang_rapat`
--
ALTER TABLE `ruang_rapat`
  ADD PRIMARY KEY (`ID_RUANG`);

--
-- Indexes for table `satuan_kerja`
--
ALTER TABLE `satuan_kerja`
  ADD PRIMARY KEY (`ID_SATKER`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `ID_USER` (`ID_PEGAWAI`),
  ADD KEY `ID_USER_2` (`ID_PEGAWAI`),
  ADD KEY `ID_USER_3` (`ID_PEGAWAI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID_ABSENSI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hari_libur`
--
ALTER TABLE `hari_libur`
  MODIFY `ID_HARI_LIBUR` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `non_pegawai`
--
ALTER TABLE `non_pegawai`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `ID_PEGAWAI` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD CONSTRAINT `hari_libur_ibfk_1` FOREIGN KEY (`ID_USER_LAST_EDITOR`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `jam_lembur`
--
ALTER TABLE `jam_lembur`
  ADD CONSTRAINT `jam_lembur_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `pegawai` (`ID_PEGAWAI`),
  ADD CONSTRAINT `jam_lembur_ibfk_2` FOREIGN KEY (`ID_BULAN`) REFERENCES `bulan` (`ID_BULAN`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`ID_SATKER`) REFERENCES `satuan_kerja` (`ID_SATKER`);

--
-- Constraints for table `peserta_rapat`
--
ALTER TABLE `peserta_rapat`
  ADD CONSTRAINT `peserta_rapat_ibfk_2` FOREIGN KEY (`ID_RAPAT`) REFERENCES `rapat` (`ID_RAPAT`),
  ADD CONSTRAINT `peserta_rapat_ibfk_3` FOREIGN KEY (`ID_USER`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `ruang_rapat`
--
ALTER TABLE `ruang_rapat`
  ADD CONSTRAINT `ruang_rapat_ibfk_1` FOREIGN KEY (`ID_RUANG`) REFERENCES `rapat` (`ID_RUANG`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
