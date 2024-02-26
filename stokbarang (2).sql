-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 02:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stokbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `masterbarang`
--

CREATE TABLE `masterbarang` (
  `Id` int(11) NOT NULL,
  `kodeBarang` varchar(12) NOT NULL,
  `namaBarang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterbarang`
--

INSERT INTO `masterbarang` (`Id`, `kodeBarang`, `namaBarang`) VALUES
(1, 'PS-PLD24T500', 'CINEMAX LED'),
(2, 'PS-PLD24T654', 'CINEMAX LED');

-- --------------------------------------------------------

--
-- Table structure for table `masterlokasi`
--

CREATE TABLE `masterlokasi` (
  `Id` int(11) NOT NULL,
  `lokasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterlokasi`
--

INSERT INTO `masterlokasi` (`Id`, `lokasi`) VALUES
(1, 'GBJ01');

-- --------------------------------------------------------

--
-- Table structure for table `masterprogram`
--

CREATE TABLE `masterprogram` (
  `Id` int(11) NOT NULL,
  `program` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterprogram`
--

INSERT INTO `masterprogram` (`Id`, `program`) VALUES
(1, 'Masuk'),
(2, 'Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `masteruser`
--

CREATE TABLE `masteruser` (
  `Id` int(11) NOT NULL,
  `User` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masteruser`
--

INSERT INTO `masteruser` (`Id`, `User`) VALUES
(1, 'User1'),
(2, 'User2');

-- --------------------------------------------------------

--
-- Table structure for table `tabelstokbarang`
--

CREATE TABLE `tabelstokbarang` (
  `Id` int(11) NOT NULL,
  `Id_lokasi` int(11) NOT NULL,
  `Id_Barang` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `tglMasuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelstokbarang`
--

INSERT INTO `tabelstokbarang` (`Id`, `Id_lokasi`, `Id_Barang`, `saldo`, `tglMasuk`) VALUES
(63, 1, 1, 0, '2024-02-26'),
(64, 1, 2, 100, '2024-02-26'),
(65, 1, 1, 60, '2024-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `transaksihistory`
--

CREATE TABLE `transaksihistory` (
  `Id` int(11) NOT NULL,
  `bukti` varchar(25) NOT NULL,
  `tgl_Input` date NOT NULL,
  `jam_Input` time NOT NULL,
  `Id_Stok` int(11) NOT NULL,
  `saldo_transaksi` int(11) NOT NULL,
  `Id_Program` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksihistory`
--

INSERT INTO `transaksihistory` (`Id`, `bukti`, `tgl_Input`, `jam_Input`, `Id_Stok`, `saldo_transaksi`, `Id_Program`, `Id_User`) VALUES
(69, 'TAMBAH01', '2024-02-26', '07:58:49', 63, 100, 1, 1),
(70, 'TAMBAH02', '2024-02-26', '07:59:00', 64, 100, 1, 1),
(71, 'TAMBAH03', '2024-02-28', '07:59:19', 65, 80, 1, 1),
(72, 'KURANG01', '2024-02-29', '08:00:07', 63, -100, 2, 1),
(73, 'KURANG01', '2024-02-29', '08:00:07', 65, -20, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masterbarang`
--
ALTER TABLE `masterbarang`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `masterlokasi`
--
ALTER TABLE `masterlokasi`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `masterprogram`
--
ALTER TABLE `masterprogram`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `masteruser`
--
ALTER TABLE `masteruser`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tabelstokbarang`
--
ALTER TABLE `tabelstokbarang`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_lokasi` (`Id_lokasi`),
  ADD KEY `Id_Barang` (`Id_Barang`);

--
-- Indexes for table `transaksihistory`
--
ALTER TABLE `transaksihistory`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Stok` (`Id_Stok`),
  ADD KEY `Id_Program` (`Id_Program`),
  ADD KEY `Id_User` (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masterbarang`
--
ALTER TABLE `masterbarang`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masterlokasi`
--
ALTER TABLE `masterlokasi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masterprogram`
--
ALTER TABLE `masterprogram`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masteruser`
--
ALTER TABLE `masteruser`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabelstokbarang`
--
ALTER TABLE `tabelstokbarang`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `transaksihistory`
--
ALTER TABLE `transaksihistory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabelstokbarang`
--
ALTER TABLE `tabelstokbarang`
  ADD CONSTRAINT `tabelstokbarang_ibfk_1` FOREIGN KEY (`Id_Barang`) REFERENCES `masterbarang` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabelstokbarang_ibfk_2` FOREIGN KEY (`Id_lokasi`) REFERENCES `masterlokasi` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksihistory`
--
ALTER TABLE `transaksihistory`
  ADD CONSTRAINT `transaksihistory_ibfk_1` FOREIGN KEY (`Id_Stok`) REFERENCES `tabelstokbarang` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksihistory_ibfk_2` FOREIGN KEY (`Id_Program`) REFERENCES `masterprogram` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksihistory_ibfk_3` FOREIGN KEY (`Id_User`) REFERENCES `masteruser` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
