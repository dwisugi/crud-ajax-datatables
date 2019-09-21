-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2019 at 02:38 PM
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
-- Table structure for table `datasantri`
--

CREATE TABLE `datasantri` (
  `id` int(11) UNSIGNED NOT NULL,
  `namaDep` varchar(100) DEFAULT NULL,
  `namaBel` varchar(100) DEFAULT NULL,
  `jk` enum('laki laki','perempuan') DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `ttl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datasantri`
--

INSERT INTO `datasantri` (`id`, `namaDep`, `namaBel`, `jk`, `alamat`, `ttl`) VALUES
(22, 'dsds', 'dada', 'laki laki', 'dad', '2019-09-04'),
(23, 'feewt', 'gwrhgr', 'perempuan', 'gsrhr', '2019-09-17'),
(24, 'csdgsrg', 'bfdnhte', 'perempuan', ' bdntjt', '2019-09-17'),
(25, 'ngdjyi', 'mfgh', 'laki laki', 'bdrhy', '2019-09-09'),
(26, 'ffffd', 'ddd', 'perempuan', 'fwefw', '2019-09-20'),
(27, 'fwefdf', 'sdg4gwd', 'laki laki', 'faryjpiul', '2019-09-24'),
(28, 'pyikrtk', 'rymk6', 'laki laki', 'jrntgn', '2019-09-25'),
(30, 'htrh', 'trjypp', 'laki laki', 'cqwdseg', '2019-09-18'),
(32, 'htrsjj', 'rgmjyl', 'perempuan', 'sjr5wu5ju', '2019-09-04'),
(33, 'ngdjnyjn', 'gnfhjsr', 'laki laki', 'jtrgnrtsj', '2019-09-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datasantri`
--
ALTER TABLE `datasantri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datasantri`
--
ALTER TABLE `datasantri`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
