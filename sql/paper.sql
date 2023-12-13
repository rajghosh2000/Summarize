-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 07:21 PM
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
  `paper_user_summary` longtext NOT NULL,
  `paper_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `p_updated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`p_sno`, `email`, `paper_name`, `paper_author`, `paper_yr`, `paper_doi`, `paper_publisher`, `paper_published_in`, `paper_external_url`, `paper_drive_url`, `paper_sec`, `paper_user_rating`, `paper_user_summary`, `paper_timestamp`, `p_updated`) VALUES
(28, 'rajghosh2507@gmail.com', 'Resource Aware Fog Based Remote Health Monitoring System', 'Dilwar Hussain Barbhuiya, Adittya Dey, Rajdeep Ghosh, Kunal Das, Kumarjit Ray, Nabajyoti Medhi', 'May 2022', '10.1109/infocomwkshps54753.2022.9798058', 'IEEE', 'IEEE INFOCOM 2022 - IEEE Conference on Computer Communications Workshops (INFOCOM WKSHPS)', 'http://dx.doi.org/10.1109/infocomwkshps54753.2022.9798058', '', 'Cloud Computing', '3', 'ghearyrqwerftg4', '2023-10-08 13:53:29', 0),
(30, 'rajghosh2507@gmail.com', 'Resaerch snippets', 'P Desikan', 'October 2013', '10.1016/s0255-0857(21)00631-9', 'Elsevier BV', 'Indian Journal of Medical Microbiology', 'http://dx.doi.org/10.1016/s0255-0857(21)00631-9', '', 'Writing a Research Paper', '3', '<h1 class=\"ql-align-justify\"><strong class=\"ql-font-monospace\">TEST</strong></h1><p><em class=\"ql-font-monospace\">This</em> is a test <strong>Submit</strong> with some <s>font work</s>.</p>', '2023-12-13 23:03:53', 0);

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
  MODIFY `p_sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
