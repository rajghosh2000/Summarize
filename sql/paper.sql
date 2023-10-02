-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 06:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `summarize`
--

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE `paper` (
  `p_sno` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `paper_name` varchar(500) NOT NULL,
  `paper_author` varchar(500) NOT NULL,
  `paper_yr` varchar(20) NOT NULL,
  `paper_doi` varchar(100) NOT NULL,
  `paper_publisher` varchar(100) NOT NULL,
  `paper_published_in` varchar(1000) NOT NULL,
  `paper_external_url` varchar(1000) NOT NULL,
  `paper_drive_url` varchar(1000) NOT NULL,
  `paper_sec` varchar(100) NOT NULL,
  `paper_user_rating` text NOT NULL,
  `paper_user_summary` mediumtext NOT NULL,
  `paper_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `p_updated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`p_sno`),
  ADD KEY `email` (`email`),
  ADD KEY `paper_sec` (`paper_sec`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paper`
--
ALTER TABLE `paper`
  MODIFY `p_sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paper`
--
ALTER TABLE `paper`
  ADD CONSTRAINT `paper_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `paper_ibfk_2` FOREIGN KEY (`paper_sec`) REFERENCES `section` (`sec_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
