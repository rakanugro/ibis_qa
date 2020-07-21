-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2012 at 01:28 AM
-- Server version: 5.1.56
-- PHP Version: 5.3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nusoap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tref_agama`
--

CREATE TABLE IF NOT EXISTS `tref_agama` (
  `agama_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'table referensi agama',
  `agama_nama` varchar(20) NOT NULL COMMENT 'nama agama',
  `create_date` datetime DEFAULT NULL COMMENT 'tanggal create data',
  `update_date` datetime DEFAULT NULL COMMENT 'tanggal terakhir update data',
  `create_by` varchar(50) DEFAULT NULL COMMENT 'user created data',
  `update_by` varchar(50) DEFAULT NULL COMMENT 'user udpate data',
  PRIMARY KEY (`agama_id`),
  KEY `FK_pub_ref_agama_user` (`create_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabel Referensi Agama' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tref_agama`
--

INSERT INTO `tref_agama` (`agama_id`, `agama_nama`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
(1, 'Islam', '2012-10-16 00:37:53', '2012-10-19 00:37:55', 'admin', NULL),
(2, 'Kristen', '2012-10-16 00:38:12', '2012-10-16 00:38:13', 'admin', NULL),
(3, 'Hindu', '2012-10-16 00:38:38', '2012-10-16 00:38:39', 'admin', NULL),
(4, 'Budha', '2012-10-16 00:38:48', '2012-10-16 00:38:49', 'admin', NULL),
(5, 'Katholik', '2012-10-16 00:39:02', '2012-10-16 00:39:02', 'admin', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
