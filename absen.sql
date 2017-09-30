-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2017 at 03:14 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `data_excel`
--

CREATE TABLE `data_excel` (
  `NAMA` varchar(50) NOT NULL,
  `NIP` varchar(50) NOT NULL,
  `TANGGAL` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hari_libur`
--

CREATE TABLE `hari_libur` (
  `ID_HARI_LIBUR` int(11) NOT NULL,
  `TANGGAL` date NOT NULL,
  `KETERANGAN` text,
  `ID_USER_INPUT` int(11) NOT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `non_pegawai`
--

CREATE TABLE `non_pegawai` (
  `ID` bigint(20) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `INSTITUSI` varchar(100) NOT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_pegawai`
--

INSERT INTO `non_pegawai` (`ID`, `NAMA`, `INSTITUSI`, `DATE_MODIFIED`) VALUES
(3, 'Pak Satrio', 'FILKOM', '2017-09-30 01:09:26'),
(4, 'Pak Nanang', 'FILKOM', '2017-09-30 01:09:46'),
(5, 'Pak Himawat', 'FILKOM', '2017-09-30 01:12:25'),
(6, 'Pak Isya', 'FILKOM', '2017-09-30 01:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` int(11) NOT NULL,
  `NIP` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `ID_SATKER` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NIP`, `NAMA`, `ID_SATKER`, `STATUS`, `DATE_MODIFIED`) VALUES
(415, '12345', 'admin', 1, 1, '2017-09-30 01:03:43');

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `update username` AFTER UPDATE ON `pegawai` FOR EACH ROW UPDATE user
SET  USERNAME = NEW.NIP
WHERE ID_PEGAWAI = NEW.ID_PEGAWAI
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peserta_rapat`
--

CREATE TABLE `peserta_rapat` (
  `ID_PESERTA_RAPAT` int(11) NOT NULL,
  `ID_RAPAT` int(11) NOT NULL,
  `ID_REF` int(20) NOT NULL,
  `PEGAWAI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta_rapat`
--

INSERT INTO `peserta_rapat` (`ID_PESERTA_RAPAT`, `ID_RAPAT`, `ID_REF`, `PEGAWAI`) VALUES
(319, 38, 3, 0),
(320, 38, 4, 0),
(321, 39, 3, 0),
(322, 39, 5, 0),
(323, 39, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `ID_PRESENSI` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `TANGGAL` date NOT NULL,
  `TERAKHIR_PRESENSI` time NOT NULL,
  `LEMBUR` int(11) NOT NULL,
  `HITUNG` int(11) NOT NULL DEFAULT '1',
  `ID_USER_INPUT` int(11) NOT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rapat`
--

CREATE TABLE `rapat` (
  `ID_RAPAT` int(11) NOT NULL,
  `JUDUL_RAPAT` varchar(200) NOT NULL,
  `WAKTU_RAPAT` datetime NOT NULL,
  `ID_RUANG` int(11) NOT NULL,
  `ID_USER_INPUT` bigint(20) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `STATUS_AKTIVASI` int(11) NOT NULL DEFAULT '0',
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rapat`
--

INSERT INTO `rapat` (`ID_RAPAT`, `JUDUL_RAPAT`, `WAKTU_RAPAT`, `ID_RUANG`, `ID_USER_INPUT`, `STATUS`, `STATUS_AKTIVASI`, `DATE_MODIFIED`) VALUES
(38, 'Contoh Rapat', '2017-10-12 09:30:00', 3, 35, 1, 0, '2017-09-30 01:10:49'),
(39, 'Contoh rapat lagi', '2017-10-03 14:00:00', 4, 35, 1, 1, '2017-09-30 01:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE `rekap` (
  `ID_REKAP` int(11) NOT NULL,
  `BULAN` int(11) NOT NULL,
  `TAHUN` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `PRESENSI` int(11) NOT NULL,
  `LEMBUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_rapat`
--

CREATE TABLE `ruang_rapat` (
  `ID_RUANG` int(11) NOT NULL,
  `NAMA_RUANG` varchar(50) NOT NULL,
  `STATUS_RUANG` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang_rapat`
--

INSERT INTO `ruang_rapat` (`ID_RUANG`, `NAMA_RUANG`, `STATUS_RUANG`) VALUES
(3, 'R1.13', 1),
(4, 'R2.22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_kerja`
--

CREATE TABLE `satuan_kerja` (
  `ID_SATKER` int(11) NOT NULL,
  `NAMA_SATKER` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_kerja`
--

INSERT INTO `satuan_kerja` (`ID_SATKER`, `NAMA_SATKER`, `STATUS`) VALUES
(1, 'ITIKOM', 1),
(2, 'Tata Usaha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `ID_PEGAWAI` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `OTORITAS` int(11) NOT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `ID_PEGAWAI`, `USERNAME`, `PASSWORD`, `STATUS`, `OTORITAS`, `DATE_MODIFIED`) VALUES
(35, 415, '12345', '12345', 1, 1, '2017-09-30 01:05:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD PRIMARY KEY (`ID_HARI_LIBUR`),
  ADD KEY `ID_USER_LAST_EDITOR` (`ID_USER_INPUT`);

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
  ADD PRIMARY KEY (`ID_PESERTA_RAPAT`),
  ADD KEY `ID_RAPAT` (`ID_RAPAT`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`ID_PRESENSI`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`),
  ADD KEY `ID_USER_INPUT` (`ID_USER_INPUT`);

--
-- Indexes for table `rapat`
--
ALTER TABLE `rapat`
  ADD PRIMARY KEY (`ID_RAPAT`),
  ADD KEY `ID_RUANG` (`ID_RUANG`),
  ADD KEY `ID_USER_INPUT` (`ID_USER_INPUT`);

--
-- Indexes for table `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`ID_REKAP`),
  ADD KEY `ID_PEGAWAI` (`ID_PEGAWAI`);

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
-- AUTO_INCREMENT for table `hari_libur`
--
ALTER TABLE `hari_libur`
  MODIFY `ID_HARI_LIBUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `non_pegawai`
--
ALTER TABLE `non_pegawai`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `ID_PEGAWAI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;
--
-- AUTO_INCREMENT for table `peserta_rapat`
--
ALTER TABLE `peserta_rapat`
  MODIFY `ID_PESERTA_RAPAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `ID_PRESENSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3905;
--
-- AUTO_INCREMENT for table `rapat`
--
ALTER TABLE `rapat`
  MODIFY `ID_RAPAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `rekap`
--
ALTER TABLE `rekap`
  MODIFY `ID_REKAP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `ruang_rapat`
--
ALTER TABLE `ruang_rapat`
  MODIFY `ID_RUANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `satuan_kerja`
--
ALTER TABLE `satuan_kerja`
  MODIFY `ID_SATKER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD CONSTRAINT `hari_libur_ibfk_1` FOREIGN KEY (`ID_USER_INPUT`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`ID_SATKER`) REFERENCES `satuan_kerja` (`ID_SATKER`);

--
-- Constraints for table `peserta_rapat`
--
ALTER TABLE `peserta_rapat`
  ADD CONSTRAINT `peserta_rapat_ibfk_1` FOREIGN KEY (`ID_RAPAT`) REFERENCES `rapat` (`ID_RAPAT`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`),
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`ID_USER_INPUT`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `rekap`
--
ALTER TABLE `rekap`
  ADD CONSTRAINT `rekap_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
