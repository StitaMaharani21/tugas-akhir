-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 03:23 PM
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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Id_Stok` bigint(20) UNSIGNED NOT NULL,
  `Id_Program` bigint(20) UNSIGNED NOT NULL,
  `Id_User` bigint(20) UNSIGNED NOT NULL,
  `tgl_Input` date NOT NULL,
  `jam_Input` time NOT NULL,
  `bukti` varchar(25) NOT NULL,
  `saldo_transaksi` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`Id`, `Id_Stok`, `Id_Program`, `Id_User`, `tgl_Input`, `jam_Input`, `bukti`, `saldo_transaksi`, `created_at`) VALUES
(26, 17, 1, 1, '2024-02-29', '15:46:19', 'TAMBAH01', 100, '2024-02-29 15:46:19'),
(27, 17, 2, 1, '2024-03-01', '15:46:46', 'KURANG01', -10, '2024-02-29 15:46:46'),
(28, 18, 1, 1, '2024-03-12', '21:22:04', 'TAMBAH02', 100, '2024-02-29 21:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `masterbarang`
--

CREATE TABLE `masterbarang` (
  `Id` bigint(11) UNSIGNED NOT NULL,
  `kodeBarang` varchar(12) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterbarang`
--

INSERT INTO `masterbarang` (`Id`, `kodeBarang`, `namaBarang`, `created_at`) VALUES
(1, 'PS-PLD24T500', 'CINEMAX LED', '2024-02-28 23:15:09'),
(2, 'PS-PLD24T654', 'CINEMAX LED', '2024-02-28 23:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `masterlokasi`
--

CREATE TABLE `masterlokasi` (
  `Id` bigint(11) UNSIGNED NOT NULL,
  `lokasi` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterlokasi`
--

INSERT INTO `masterlokasi` (`Id`, `lokasi`, `created_at`) VALUES
(1, 'GBJ01', '2024-02-28 23:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `masterprogram`
--

CREATE TABLE `masterprogram` (
  `Id` bigint(11) UNSIGNED NOT NULL,
  `program` varchar(12) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masterprogram`
--

INSERT INTO `masterprogram` (`Id`, `program`, `created_at`) VALUES
(1, 'Masuk', '2024-02-28 23:14:00'),
(2, 'Keluar', '2024-02-28 23:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `masteruser`
--

CREATE TABLE `masteruser` (
  `Id` bigint(11) UNSIGNED NOT NULL,
  `User` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masteruser`
--

INSERT INTO `masteruser` (`Id`, `User`, `created_at`) VALUES
(1, 'User1', '2024-02-28 23:13:22'),
(2, 'User2', '2024-02-28 23:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `tabelstokbarang`
--

CREATE TABLE `tabelstokbarang` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Id_lokasi` bigint(20) UNSIGNED NOT NULL,
  `Id_Barang` bigint(20) UNSIGNED NOT NULL,
  `tglMasuk` date NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelstokbarang`
--

INSERT INTO `tabelstokbarang` (`Id`, `Id_lokasi`, `Id_Barang`, `tglMasuk`, `saldo`, `created_at`) VALUES
(17, 1, 1, '2024-02-29', 90, '2024-02-29 15:46:46'),
(18, 1, 1, '2024-03-12', 100, '2024-02-29 21:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Id_Stok` bigint(20) UNSIGNED NOT NULL,
  `Id_Program` bigint(20) UNSIGNED NOT NULL,
  `Id_User` bigint(20) UNSIGNED NOT NULL,
  `tgl_Input` date NOT NULL,
  `jam_Input` time NOT NULL,
  `bukti` varchar(25) NOT NULL,
  `saldo_transaksi` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id`, `Id_Stok`, `Id_Program`, `Id_User`, `tgl_Input`, `jam_Input`, `bukti`, `saldo_transaksi`, `created_at`) VALUES
(106, 17, 1, 1, '2024-02-29', '15:46:19', 'TAMBAH01', 100, '2024-02-29 21:21:34'),
(107, 17, 2, 1, '2024-03-01', '15:46:46', 'KURANG01', -10, '2024-02-29 21:21:34'),
(109, 18, 1, 1, '2024-03-12', '21:22:04', 'TAMBAH02', 100, '2024-02-29 21:22:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Stok` (`Id_Stok`),
  ADD KEY `Id_Program` (`Id_Program`),
  ADD KEY `Id_User` (`Id_User`);

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
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Stok` (`Id_Stok`),
  ADD KEY `Id_Program` (`Id_Program`),
  ADD KEY `Id_User` (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `masterbarang`
--
ALTER TABLE `masterbarang`
  MODIFY `Id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masterlokasi`
--
ALTER TABLE `masterlokasi`
  MODIFY `Id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masterprogram`
--
ALTER TABLE `masterprogram`
  MODIFY `Id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masteruser`
--
ALTER TABLE `masteruser`
  MODIFY `Id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabelstokbarang`
--
ALTER TABLE `tabelstokbarang`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `masteruser` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`Id_Stok`) REFERENCES `tabelstokbarang` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`Id_Program`) REFERENCES `masterprogram` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabelstokbarang`
--
ALTER TABLE `tabelstokbarang`
  ADD CONSTRAINT `tabelstokbarang_ibfk_1` FOREIGN KEY (`Id_lokasi`) REFERENCES `masterlokasi` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabelstokbarang_ibfk_2` FOREIGN KEY (`Id_Barang`) REFERENCES `masterbarang` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `masteruser` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`Id_Stok`) REFERENCES `tabelstokbarang` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`Id_Program`) REFERENCES `masterprogram` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
