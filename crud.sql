-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2019 at 11:28 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'dwi', '7aa2602c588c05a93baf10128861aeb9');

-- --------------------------------------------------------

--
-- Table structure for table `datasantri`
--

CREATE TABLE `datasantri` (
  `id` int(11) UNSIGNED NOT NULL,
  `namaDep` varchar(100) DEFAULT NULL,
  `namaBel` varchar(100) DEFAULT NULL,
  `jk` enum('laki laki','perempuan') DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datasantri`
--

INSERT INTO `datasantri` (`id`, `namaDep`, `namaBel`, `jk`, `alamat`, `ttl`, `image`) VALUES
(1, 'dwi', 'sugi', 'laki laki', 'sedayu', '2019-09-01', 'default.jpg'),
(2, 'suraj', 'ji', 'laki laki', 'bantul', '2019-09-02', 'default.jpg'),
(3, 'abum', 'sari', 'perempuan', 'sleman', '2019-08-30', 'default.jpg'),
(6, 'sa', 'sa', 'laki laki', 'Sedayu', '2019-09-01', 'default.jpg'),
(7, 'dw', 'we', 'laki laki', 'Sedayu', '2019-09-03', 'default.jpg'),
(12, 'satu', 'satu', 'laki laki', 'Sedayu', '2019-09-03', 'file_1569464522.png'),
(13, 'qwe', 'ewq', 'perempuan', 'Sedayu', '2019-08-30', 'file_1569464565.jpg'),
(14, 'df', 'fds', 'laki laki', 'Sedayu', '2019-08-06', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datasantri`
--
ALTER TABLE `datasantri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `datasantri`
--
ALTER TABLE `datasantri`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
