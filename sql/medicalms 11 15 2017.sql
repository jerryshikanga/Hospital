-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 08:41 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicalms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE `tbl_appointments` (
  `appointment_id` bigint(255) NOT NULL,
  `patient_id` bigint(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`appointment_id`, `patient_id`, `date`, `time`, `date_created`) VALUES
(3, 1, '2016-04-26', '17:30:00', '2016-04-09 10:28:46'),
(4, 2, '2016-04-10', '17:00:00', '2016-04-09 10:32:57'),
(5, 4, '2016-08-31', '18:00:00', '2016-04-09 10:33:42'),
(6, 3, '2016-09-07', '00:00:00', '2016-04-09 10:34:47'),
(7, 3, '2016-06-30', '00:00:00', '2016-04-26 02:57:04'),
(8, 6, '2016-05-06', '00:00:00', '2016-05-03 07:53:43'),
(9, 5, '2016-05-01', '00:00:00', '2016-05-03 07:54:13'),
(10, 3, '2016-05-04', '00:00:00', '2016-05-04 12:19:17'),
(11, 6, '2016-05-26', '00:00:00', '2016-05-04 12:32:37'),
(12, 7, '2016-05-13', '00:00:00', '2016-05-04 12:37:58'),
(13, 7, '2016-05-20', '00:00:00', '2016-05-04 12:38:46'),
(14, 6, '2016-05-01', '00:00:00', '2016-05-04 12:40:38'),
(15, 5, '2016-05-03', '00:00:00', '2016-05-04 12:44:06'),
(16, 6, '2016-05-02', '00:00:00', '2016-05-04 12:46:58'),
(17, 2, '2016-05-02', '00:00:00', '2016-05-04 12:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints_general_examinations`
--

CREATE TABLE `tbl_complaints_general_examinations` (
  `id` bigint(255) NOT NULL,
  `description` varchar(65000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `treatment_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_complaints_general_examinations`
--

INSERT INTO `tbl_complaints_general_examinations` (`id`, `description`, `status`, `treatment_id`) VALUES
(1, 'hvhvhvhvgvg', 0, 1),
(2, 'mkmkqmkcmwkm', 0, 2),
(3, 'Pale eyes', 0, 3),
(4, 'Yellow eyes', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints_history`
--

CREATE TABLE `tbl_complaints_history` (
  `id` bigint(255) NOT NULL,
  `description` varchar(65000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `treatment_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_complaints_history`
--

INSERT INTO `tbl_complaints_history` (`id`, `description`, `status`, `treatment_id`) VALUES
(1, 'cgcgcgcf', 0, 1),
(2, 'kmkmkmkqmk', 0, 2),
(3, 'Severe Headache mostly on the forehead', 0, 3),
(4, 'Been having for 5 days', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints_impressions_examinations`
--

CREATE TABLE `tbl_complaints_impressions_examinations` (
  `id` bigint(255) NOT NULL,
  `description` varchar(65000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `treatment_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints_presenting`
--

CREATE TABLE `tbl_complaints_presenting` (
  `id` bigint(255) NOT NULL,
  `description` varchar(65000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `treatment_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_complaints_presenting`
--

INSERT INTO `tbl_complaints_presenting` (`id`, `description`, `status`, `treatment_id`) VALUES
(1, 'pavvgvggcfcfx', 0, 1),
(2, 'kmkcmqkemvk', 0, 2),
(3, 'Headcahe', 0, 3),
(4, 'Flu', 0, 4),
(5, 'new diag', 0, 5),
(6, 'wheezing sound', 0, 6),
(7, 'Headache', 0, 7),
(8, 'sawas', 0, 8),
(9, 'headache', 0, 9),
(10, 'Stomach Ache', 0, 10),
(11, 'Me', 0, 11),
(12, 'Headache\nDiahorrea', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints_systemic_examinations`
--

CREATE TABLE `tbl_complaints_systemic_examinations` (
  `id` bigint(255) NOT NULL,
  `description` varchar(65000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `treatment_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_complaints_systemic_examinations`
--

INSERT INTO `tbl_complaints_systemic_examinations` (`id`, `description`, `status`, `treatment_id`) VALUES
(1, 'chvhbjjjnk', 0, 1),
(2, 'kmkcmkvmskmmksdm', 0, 2),
(3, 'No fever', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE `tbl_doctors` (
  `doctor_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_doctors`
--

INSERT INTO `tbl_doctors` (`doctor_id`, `user_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guardians`
--

CREATE TABLE `tbl_guardians` (
  `guardian_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_id` bigint(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital_details`
--

CREATE TABLE `tbl_hospital_details` (
  `id` bigint(255) NOT NULL,
  `name` varchar(6400) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `active_status` tinyint(1) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `c` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_requests`
--

CREATE TABLE `tbl_lab_requests` (
  `request_id` bigint(255) NOT NULL,
  `patient_treatment_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab_requests`
--

INSERT INTO `tbl_lab_requests` (`request_id`, `patient_treatment_id`, `user_id`, `status`, `date_created`) VALUES
(42, 5, 1, 1, '2016-05-09 12:43:29'),
(43, 5, 1, 1, '2016-05-09 12:50:53'),
(44, 1, 1, 1, '2016-05-09 18:11:19'),
(45, 7, 1, 1, '2016-05-10 19:30:13'),
(46, 2, 1, 1, '2016-05-11 19:11:02'),
(47, 8, 1, 1, '2016-05-19 06:55:28'),
(48, 9, 1, 1, '2016-06-01 10:44:56'),
(49, 10, 1, 1, '2016-06-01 12:32:24'),
(50, 11, 1, 1, '2016-06-23 07:33:41'),
(51, 11, 1, 1, '2016-06-23 07:35:25'),
(52, 12, 1, 1, '2017-11-11 16:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_requests_details`
--

CREATE TABLE `tbl_lab_requests_details` (
  `id` bigint(255) NOT NULL,
  `request_id` bigint(255) NOT NULL,
  `lab_results` varchar(60000) DEFAULT NULL,
  `notes` varchar(5000) DEFAULT NULL,
  `service_id` bigint(255) NOT NULL,
  `lab_tech_id` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_results` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab_requests_details`
--

INSERT INTO `tbl_lab_requests_details` (`id`, `request_id`, `lab_results`, `notes`, `service_id`, `lab_tech_id`, `status`, `date_results`) VALUES
(22, 27, 'njnjnjcnajsncjasncjsan', 'hahehee', 2, NULL, 0, '2016-05-04 16:28:31'),
(23, 27, 'njcjncjnjvnejvnjenvjew', 'Amo', 3, NULL, 0, '2016-05-04 16:28:31'),
(24, 28, NULL, '', 3, NULL, 0, '2016-05-04 16:29:36'),
(25, 28, NULL, '', 5, NULL, 0, '2016-05-04 16:29:36'),
(26, 29, NULL, 'Scan', 5, NULL, 0, '2016-05-04 16:31:03'),
(27, 29, 'Its fine', 'Stool', 4, NULL, 0, '2016-05-04 16:31:03'),
(28, 0, NULL, '{\"notes\":\"[\\\"\\\",\\\"\\\"]\",\"service_id\":\"[\\\"2\\\",\\\"2\\\"]\"}', 0, NULL, 0, '2016-05-04 16:46:19'),
(31, 32, 'N/A', 'Amo', 2, 1, 1, '2016-05-04 19:29:31'),
(32, 32, 'N/A', 'cs', 5, 1, 1, '2016-05-04 19:29:31'),
(33, 33, 'no bacteria found', 'Stomach Test', 4, 1, 0, '2016-05-05 13:36:09'),
(34, 34, 'mememame', 'Test via Blood', 2, 1, 1, '2016-05-05 18:27:43'),
(35, 36, 'vsgvsadvav vadomain', '', 3, 1, 0, '2016-05-08 18:40:43'),
(36, 37, 'cssacsacascascascascas', '', 2, 1, 0, '2016-05-09 07:26:25'),
(37, 38, NULL, '', 3, NULL, 0, '2016-05-09 09:02:15'),
(38, 39, 'relususs', 'sdsadas', 4, 1, 1, '2016-05-09 09:02:55'),
(39, 40, 'Ningare', 'sdsadasd', 3, 1, 1, '2016-05-09 09:05:53'),
(40, 41, 'ajnksakaskcnaskc', 'Stomach Test', 4, 1, 1, '2016-05-09 09:25:35'),
(41, 42, 'N/A', 'Test', 2, 1, 1, '2016-05-09 12:43:29'),
(42, 43, 'Iko Fiti', 'New Test', 3, 1, 1, '2016-05-09 12:50:53'),
(43, 44, 'n/a', '', 2, 1, 1, '2016-05-09 18:11:19'),
(44, 45, 'BP Negative', '', 2, 1, 1, '2016-05-10 19:30:13'),
(45, 46, 'none', 'Pnnsd', 2, 1, 1, '2016-05-11 19:11:02'),
(46, 46, 'yes kiasi', 'sjnjsanjsan', 4, 1, 1, '2016-05-11 19:11:02'),
(47, 46, 'none', 'jsnjsnjnxsaj', 5, 1, 1, '2016-05-11 19:11:02'),
(48, 47, 'NO', '', 2, 1, 1, '2016-05-19 06:55:28'),
(49, 47, 'NO', '', 4, 1, 1, '2016-05-19 06:55:28'),
(50, 47, 'YES', '', 3, 1, 1, '2016-05-19 06:55:28'),
(51, 48, 'bs4 mps', '', 2, 1, 1, '2016-06-01 10:44:56'),
(52, 49, 'Present', '', 4, 1, 1, '2016-06-01 12:32:24'),
(53, 50, '', '', 2, 1, 1, '2016-06-23 07:33:41'),
(54, 50, '', '', 3, 1, 1, '2016-06-23 07:33:41'),
(55, 50, '', '', 5, 1, 1, '2016-06-23 07:33:41'),
(56, 51, 'N/A', '', 4, 1, 1, '2016-06-23 07:35:25'),
(57, 51, '', '', 3, 1, 1, '2016-06-23 07:35:25'),
(58, 52, 'Red blood cells low malaria present', '', 2, 1, 1, '2017-11-11 16:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_services`
--

CREATE TABLE `tbl_lab_services` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `description` varchar(1000) NOT NULL,
  `deleted_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab_services`
--

INSERT INTO `tbl_lab_services` (`id`, `name`, `price`, `description`, `deleted_status`) VALUES
(1, 'lab', 50, 'Lab Test', 1),
(2, 'Malaria Test', 100, 'Tablets', 0),
(3, 'Haemoglobin Test', 2000, 'Test', 0),
(4, 'Amoeba Test', 200, 'Test for Amoeba', 0),
(5, 'CT Scan', 2000, 'CT Scan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_techs`
--

CREATE TABLE `tbl_lab_techs` (
  `lab_tech_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicines`
--

CREATE TABLE `tbl_medicines` (
  `medicine_id` bigint(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `category` bigint(255) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_medicines`
--

INSERT INTO `tbl_medicines` (`medicine_id`, `name`, `category`, `price`, `description`, `manufacturer`) VALUES
(1, 'Panadol Extra', 2, 20, 'Tablets', 'sasasa'),
(2, 'Actal Tums', 2, 10, 'Tablets', 'Glyko Smith'),
(3, 'Calamine Lotion B.P', 2, 100, 'Lotion', 'Diarim'),
(4, 'Amoxyl', 2, 2000, 'capsules', 'Glyko Smith'),
(5, 'Flu Gone', 1, 150, 'Syrup', 'Glyko Smith');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine_category`
--

CREATE TABLE `tbl_medicine_category` (
  `category_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_medicine_category`
--

INSERT INTO `tbl_medicine_category` (`category_id`, `name`) VALUES
(1, 'Painkiller'),
(2, 'Injectables');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notification_id` bigint(255) NOT NULL,
  `sender_role` bigint(255) NOT NULL,
  `reciever_role` bigint(255) NOT NULL,
  `treatment_id` bigint(255) NOT NULL,
  `notification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `notification_type` tinyint(4) NOT NULL DEFAULT '0',
  `request_id` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notification_id`, `sender_role`, `reciever_role`, `treatment_id`, `notification_date`, `status`, `notification_type`, `request_id`) VALUES
(14, 2, 2, 3, '2016-05-09 09:05:31', 1, 2, 34),
(15, 2, 4, 1, '2016-05-09 09:05:53', 0, 1, 40),
(16, 2, 4, 3, '2016-05-09 09:25:35', 0, 1, 41),
(17, 2, 2, 3, '2016-05-09 09:25:51', 1, 2, 41),
(18, 2, 2, 1, '2016-05-09 10:56:07', 1, 2, 40),
(19, 2, 4, 5, '2016-05-09 12:43:29', 0, 1, 42),
(20, 2, 2, 5, '2016-05-09 12:44:44', 1, 2, 42),
(21, 2, 4, 5, '2016-05-09 12:50:53', 0, 1, 43),
(22, 2, 2, 5, '2016-05-09 13:27:40', 1, 2, 43),
(23, 2, 4, 1, '2016-05-09 18:11:19', 0, 1, 44),
(24, 2, 2, 1, '2016-05-09 18:11:52', 1, 2, 44),
(25, 2, 5, 1, '2016-05-10 10:22:08', 0, 3, 0),
(26, 2, 5, 1, '2016-05-10 10:26:24', 0, 3, 0),
(27, 2, 5, 4, '2016-05-10 10:27:18', 0, 3, 0),
(28, 2, 5, 5, '2016-05-10 17:17:37', 0, 3, 0),
(29, 2, 5, 3, '2016-05-10 17:18:54', 0, 3, 0),
(30, 2, 5, 6, '2016-05-10 19:24:22', 0, 3, 0),
(31, 2, 4, 7, '2016-05-10 19:30:13', 0, 1, 45),
(32, 2, 2, 7, '2016-05-10 19:31:12', 1, 2, 45),
(33, 2, 5, 7, '2016-05-10 19:33:02', 0, 3, 0),
(34, 2, 4, 2, '2016-05-11 19:11:02', 0, 1, 46),
(35, 2, 2, 2, '2016-05-11 19:11:34', 1, 2, 46),
(36, 2, 5, 2, '2016-05-11 19:12:25', 0, 3, 0),
(37, 1, 4, 8, '2016-05-19 06:55:28', 0, 1, 47),
(38, 2, 4, 9, '2016-06-01 10:44:56', 0, 1, 48),
(39, 2, 2, 9, '2016-06-01 10:46:13', 1, 2, 48),
(40, 2, 5, 9, '2016-06-01 10:47:26', 0, 3, 0),
(41, 2, 4, 10, '2016-06-01 12:32:24', 0, 1, 49),
(42, 2, 2, 10, '2016-06-01 12:32:51', 1, 2, 49),
(43, 2, 5, 10, '2016-06-01 12:33:45', 0, 3, 0),
(44, 2, 2, 8, '2016-06-01 12:40:54', 1, 2, 47),
(45, 2, 5, 8, '2016-06-01 12:42:54', 0, 3, 0),
(46, 2, 4, 11, '2016-06-23 07:33:41', 0, 1, 50),
(47, 2, 2, 11, '2016-06-23 07:34:53', 1, 2, 50),
(48, 2, 4, 11, '2016-06-23 07:35:25', 0, 1, 51),
(49, 2, 4, 12, '2017-11-11 16:15:27', 0, 1, 52),
(50, 2, 2, 12, '2017-11-11 16:16:14', 1, 2, 52),
(51, 2, 2, 11, '2017-11-12 19:50:54', 1, 2, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nurses`
--

CREATE TABLE `tbl_nurses` (
  `nurse_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `last_visit` datetime DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone_number` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `location` varchar(255) DEFAULT NULL,
  `relationship_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `name`, `dob`, `gender`, `last_visit`, `date_created`, `phone_number`, `status`, `location`, `relationship_id`) VALUES
(1, 'Samuel Masinde', '1988-09-07', 1, '2016-05-10 21:19:22', '2016-05-10 19:19:22', '0720114007', 0, 'Nairobi', 0),
(2, 'Samuel Masinde', '1970-09-07', 1, '2016-02-09 06:40:10', '2016-03-31 09:51:07', '0720114007', 0, 'Nairobi', 1),
(3, 'Sandra Burns Sandra Burns', '2000-04-15', 0, '2016-01-10 11:45:17', '2016-03-31 15:07:36', '0738114007', 0, 'Kitengela, Nairobi', 0),
(4, 'Sandra Burns Sandra Burns', '2000-04-15', 0, '2016-04-27 12:45:35', '2016-04-27 10:45:35', '0738114007', 0, 'Kitengela, Nairobi', 1),
(5, 'Busolo Me', '2015-06-09', 1, '2016-05-04 07:35:19', '2016-05-18 10:41:56', '0722', 0, 'Nakuru', 0),
(6, 'Marley', '2016-04-26', 0, '2016-05-05 20:27:14', '2016-05-05 18:27:14', '0789767574', 0, 'Embu', 0),
(7, 'Lucy Lucy', '2000-05-31', 0, '2016-05-04 13:44:20', '2016-05-04 11:44:20', '0720006789', 0, 'Nairobi', 0),
(8, 'Lucy Ngina', '1993-01-31', 0, '2016-05-08 20:39:53', '2016-05-08 18:39:53', '0714553723', 0, 'Roysambu, Kenya', 0),
(9, 'Cycy', '1993-01-31', 0, '2016-05-09 14:43:06', '2016-05-09 12:43:06', '0720114007', 0, 'Roysambu, Kenya', 0),
(10, 'Don Javan', '1996-08-05', 1, '2016-05-10 21:29:07', '2016-05-10 19:29:07', '0720114007', 0, 'SUNNYVALLE, NAIROBI', 0),
(11, 'Isaac', '2016-05-01', 1, '2016-06-01 14:31:11', '2016-06-01 12:31:11', '0720114007', 0, 'Nairobi, Umoja', 0),
(12, 'Gloria Muthama', '1998-03-13', 0, '2017-11-10 17:07:52', '2017-11-10 16:07:52', '0723238868', 0, 'Makueni', 0),
(13, 'Steve Kimani', '2017-11-06', 1, '2017-11-11 17:12:46', '2017-11-11 16:12:46', '0712345678', 0, 'Nakuru', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_treatments`
--

CREATE TABLE `tbl_patient_treatments` (
  `id` bigint(255) NOT NULL,
  `patient_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `symptoms` varchar(65000) DEFAULT NULL,
  `treatment_heading` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `treatment_type` bigint(255) DEFAULT NULL,
  `lab_request_id` bigint(255) DEFAULT '0',
  `treatment_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient_treatments`
--

INSERT INTO `tbl_patient_treatments` (`id`, `patient_id`, `user_id`, `symptoms`, `treatment_heading`, `datetime`, `status`, `treatment_type`, `lab_request_id`, `treatment_status`) VALUES
(1, 5, 1, NULL, NULL, '2016-05-04 05:35:19', 2, NULL, 44, 1),
(2, 7, 1, NULL, NULL, '2016-05-04 11:44:20', 2, NULL, 46, 1),
(3, 6, 1, NULL, NULL, '2016-05-05 18:27:14', 2, NULL, 41, 1),
(4, 8, 1, NULL, NULL, '2016-05-08 18:39:53', 2, NULL, 36, 1),
(5, 9, 1, NULL, NULL, '2016-05-09 12:43:06', 2, NULL, 43, 1),
(6, 1, 1, NULL, NULL, '2016-05-10 19:19:22', 2, NULL, 0, 1),
(7, 1, 1, NULL, NULL, '2016-05-10 19:29:07', 2, NULL, 45, 1),
(8, 7, 1, NULL, NULL, '2016-05-11 19:46:29', 2, NULL, 47, 1),
(9, 5, 1, NULL, NULL, '2016-06-01 10:44:24', 2, NULL, 48, 1),
(10, 11, 1, NULL, NULL, '2016-06-01 12:32:03', 2, NULL, 49, 1),
(11, 5, 1, NULL, NULL, '2016-06-23 07:33:07', 0, NULL, 51, 0),
(12, 13, 1, NULL, NULL, '2017-11-11 16:14:41', 0, NULL, 52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacists`
--

CREATE TABLE `tbl_pharmacists` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

CREATE TABLE `tbl_prescriptions` (
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prescription_id` bigint(255) NOT NULL,
  `treatment_id` bigint(255) NOT NULL,
  `notes` varchar(40000) DEFAULT NULL,
  `treatment` varchar(25000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prescriptions`
--

INSERT INTO `tbl_prescriptions` (`datetime`, `prescription_id`, `treatment_id`, `notes`, `treatment`) VALUES
('0000-00-00 00:00:00', 12, 4, NULL, 'Flu'),
('0000-00-00 00:00:00', 13, 5, NULL, 'Malaria'),
('0000-00-00 00:00:00', 14, 3, NULL, 'Swine Flu'),
('0000-00-00 00:00:00', 15, 6, NULL, 'flu virus'),
('0000-00-00 00:00:00', 16, 7, NULL, 'Flu'),
('2016-05-11 19:12:25', 17, 2, NULL, 'None'),
('2016-06-01 10:47:26', 18, 9, NULL, 'Malaria'),
('2016-06-01 12:33:45', 19, 10, NULL, 'Typhoid'),
('2016-06-01 12:42:54', 20, 8, NULL, 'Typhoid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription_medicines`
--

CREATE TABLE `tbl_prescription_medicines` (
  `id` bigint(255) NOT NULL,
  `prescription_id` bigint(255) NOT NULL,
  `medicine` varchar(50000) DEFAULT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prescription_medicines`
--

INSERT INTO `tbl_prescription_medicines` (`id`, `prescription_id`, `medicine`, `dosage`, `status`) VALUES
(1, 5, '[', '[', 1),
(2, 6, '[', '[', 1),
(3, 7, '[', '[', 1),
(4, 7, '\"', '\"', 1),
(5, 8, 'Painkillers', '[', 1),
(6, 8, 'Antibiotics', '\"', 1),
(7, 9, 'Painkillers', '2x1', 1),
(8, 9, 'Flugone', '2x2', 1),
(9, 10, 'Painkillers', '2x1', 1),
(10, 10, 'Tumbocid', '3x1', 1),
(11, 11, 'Flugone', '3x1', 1),
(12, 11, 'Painkillers', '2x2', 1),
(13, 12, 'Painkillers', '2x1', 1),
(14, 12, 'Celestamine', '1x3', 1),
(15, 13, 'Antimalaria', '1x3', 1),
(16, 13, 'Painkillers', '1x3', 1),
(17, 14, 'None', 'None', 1),
(18, 15, 'piriton', '1x3', 1),
(19, 17, 'Vitamins Supp', '', 1),
(20, 17, 'ako poa', 'none', 1),
(21, 18, 'coatem', 'bp5 days', 1),
(22, 19, 'Painkillers', '2x1', 1),
(23, 19, 'Antibiotics', '2x2', 1),
(24, 20, 'Injection Antiobiotics', '5 Days', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_relationships`
--

CREATE TABLE `tbl_relationships` (
  `relationship_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `name`, `description`) VALUES
(1, 'admin', 'System admin'),
(2, 'doctor', 'doctor'),
(3, 'nurse', 'nurse'),
(4, 'laboratory', 'Laboratory Technician '),
(5, 'pharmacy', 'pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sale_id` bigint(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_items`
--

CREATE TABLE `tbl_sales_items` (
  `sale_item_id` bigint(255) NOT NULL,
  `sale_id` bigint(255) NOT NULL,
  `item_id` bigint(255) NOT NULL,
  `quantity` double NOT NULL,
  `price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_symptoms`
--

CREATE TABLE `tbl_symptoms` (
  `symptom_id` bigint(255) NOT NULL,
  `treatment_id` bigint(255) NOT NULL,
  `symptoms` varchar(65000) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `a` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `n` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `role_id`, `active`, `date_created`, `last_login`, `name`, `a`, `d`, `n`) VALUES
(1, 'Jerry', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '2016-04-07 07:21:27', '2017-11-15 22:25:04', 'Dr. Jerry Shikanga', 'c4ca4238a0b923820dcc509a6f75849b', NULL, NULL),
(2, 'Sam', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '2016-04-07 08:41:57', '2016-04-07 04:08:09', 'Sam One', NULL, NULL, NULL),
(3, 'Doe', '2829fc16ad8ca5a79da932f910afad1c', 4, 1, '2016-04-07 08:42:45', '2016-04-07 03:22:06', 'Doe Doe', NULL, NULL, NULL),
(4, 'test', 'password', 2, 1, '2017-11-15 19:39:28', '0000-00-00 00:00:00', 'Dr. Jerry Test', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `tbl_complaints_general_examinations`
--
ALTER TABLE `tbl_complaints_general_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaints_history`
--
ALTER TABLE `tbl_complaints_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaints_impressions_examinations`
--
ALTER TABLE `tbl_complaints_impressions_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaints_presenting`
--
ALTER TABLE `tbl_complaints_presenting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaints_systemic_examinations`
--
ALTER TABLE `tbl_complaints_systemic_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `tbl_guardians`
--
ALTER TABLE `tbl_guardians`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `tbl_lab_requests`
--
ALTER TABLE `tbl_lab_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_lab_requests_details`
--
ALTER TABLE `tbl_lab_requests_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lab_services`
--
ALTER TABLE `tbl_lab_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lab_techs`
--
ALTER TABLE `tbl_lab_techs`
  ADD PRIMARY KEY (`lab_tech_id`);

--
-- Indexes for table `tbl_medicines`
--
ALTER TABLE `tbl_medicines`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `tbl_medicine_category`
--
ALTER TABLE `tbl_medicine_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tbl_nurses`
--
ALTER TABLE `tbl_nurses`
  ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_patient_treatments`
--
ALTER TABLE `tbl_patient_treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pharmacists`
--
ALTER TABLE `tbl_pharmacists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `tbl_prescription_medicines`
--
ALTER TABLE `tbl_prescription_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_relationships`
--
ALTER TABLE `tbl_relationships`
  ADD PRIMARY KEY (`relationship_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tbl_sales_items`
--
ALTER TABLE `tbl_sales_items`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  ADD PRIMARY KEY (`symptom_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  MODIFY `appointment_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_complaints_general_examinations`
--
ALTER TABLE `tbl_complaints_general_examinations`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_complaints_history`
--
ALTER TABLE `tbl_complaints_history`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_complaints_impressions_examinations`
--
ALTER TABLE `tbl_complaints_impressions_examinations`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaints_presenting`
--
ALTER TABLE `tbl_complaints_presenting`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_complaints_systemic_examinations`
--
ALTER TABLE `tbl_complaints_systemic_examinations`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  MODIFY `doctor_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_guardians`
--
ALTER TABLE `tbl_guardians`
  MODIFY `guardian_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lab_requests`
--
ALTER TABLE `tbl_lab_requests`
  MODIFY `request_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_lab_requests_details`
--
ALTER TABLE `tbl_lab_requests_details`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_lab_services`
--
ALTER TABLE `tbl_lab_services`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_lab_techs`
--
ALTER TABLE `tbl_lab_techs`
  MODIFY `lab_tech_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_medicines`
--
ALTER TABLE `tbl_medicines`
  MODIFY `medicine_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_medicine_category`
--
ALTER TABLE `tbl_medicine_category`
  MODIFY `category_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_nurses`
--
ALTER TABLE `tbl_nurses`
  MODIFY `nurse_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_patient_treatments`
--
ALTER TABLE `tbl_patient_treatments`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pharmacists`
--
ALTER TABLE `tbl_pharmacists`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  MODIFY `prescription_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_prescription_medicines`
--
ALTER TABLE `tbl_prescription_medicines`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_relationships`
--
ALTER TABLE `tbl_relationships`
  MODIFY `relationship_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sale_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_items`
--
ALTER TABLE `tbl_sales_items`
  MODIFY `sale_item_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  MODIFY `symptom_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
