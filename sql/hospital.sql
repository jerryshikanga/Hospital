-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2018 at 01:15 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE `tbl_doctors` (
  `doctor_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'jerry', '30035607ee5bb378c71ab434a6d05410', 2, 1, '2018-10-07 06:21:27', '2018-10-07 07:21:27', 'Dr. Jerry Shikanga', 'c4ca4238a0b923820dcc509a6f75849b', NULL, NULL);

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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;