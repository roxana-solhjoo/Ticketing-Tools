-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2021 at 06:46 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aaaa-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL COMMENT '0 - not delete 1 - Deleted',
  `company_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `flag` int(2) NOT NULL COMMENT '1= admin update,\r\n4= management update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments_settings`
--

CREATE TABLE `departments_settings` (
  `id` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `department` varchar(255) NOT NULL,
  `total_staff` int(255) NOT NULL,
  `flag` int(2) NOT NULL COMMENT '1= admin\r\n4=management'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emails_settings`
--

CREATE TABLE `emails_settings` (
  `id` int(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `email_protocol` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smpt_user` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `email_encription` varchar(255) NOT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `incidents_id` varchar(6) NOT NULL,
  `incident_name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_version` varchar(9) NOT NULL,
  `report_form` varchar(20) NOT NULL,
  `internal` varchar(40) NOT NULL,
  `assign_to` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `initial_status` int(11) NOT NULL DEFAULT 0,
  `flag` int(2) NOT NULL COMMENT 'admin update = 1,\r\nusers update =2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incident_status`
--

CREATE TABLE `incident_status` (
  `id` int(255) NOT NULL,
  `incident_id` int(20) NOT NULL,
  `incident_status` varchar(40) NOT NULL,
  `incident_description` varchar(255) NOT NULL,
  `create_at` datetime(6) NOT NULL,
  `update_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL COMMENT '1 - Deleted, 0 - Not Deleted',
  `project_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `project_manager` varchar(255) NOT NULL,
  `support_staff` text NOT NULL,
  `flag` int(3) NOT NULL COMMENT '1= Admin,\r\n3=Manager,\r\n4= management'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles_settings`
--

CREATE TABLE `roles_settings` (
  `id` int(11) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `flag` int(2) NOT NULL COMMENT '1= admin update,\r\n4 = management update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_settings`
--

INSERT INTO `roles_settings` (`id`, `delete_flag`, `role_name`, `role_slug`, `description`, `flag`) VALUES
(15, 1, 'Manager', 'y', 'manager of the IT department', 1),
(16, 1, 'Manager Office', 'b', 'Manager Office of IT', 1),
(17, 0, 'PROGRAMMER', 'HH', 'PROGRAMMER OF IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `tasks_id` varchar(10) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_version` decimal(65,0) NOT NULL,
  `report_form` varchar(20) NOT NULL,
  `internal` varchar(25) NOT NULL,
  `assign_to` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file` varchar(50) NOT NULL,
  `initial_status` int(11) NOT NULL DEFAULT 0,
  `flag` int(2) NOT NULL COMMENT 'admin update =1 , users update=2\r\nManager_update =3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int(255) NOT NULL,
  `task_id` int(10) NOT NULL,
  `task_status` varchar(25) NOT NULL,
  `task_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teams_settings`
--

CREATE TABLE `teams_settings` (
  `id` int(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `member` varchar(255) NOT NULL,
  `leader` varchar(255) NOT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `status` int(15) NOT NULL COMMENT 'Active=1, Deactive = 0',
  `mobile_no` int(10) NOT NULL,
  `role` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `manager` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `flag` int(2) NOT NULL COMMENT '1= Admin,\r\n2=User,\r\n3=Manger'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `delete_flag`, `first_name`, `last_name`, `email`, `employee_id`, `status`, `mobile_no`, `role`, `company_name`, `manager`, `username`, `password`, `photo`, `flag`) VALUES
(48, 0, 0, 'roxana ', 'solhjoo', 'admin@gmail.com', '4444', 1, 189819062, 'Admin', 'AIM Solutions Sdb Bhd', NULL, 'admin', '$2y$10$gCO2HhRKRrBe0p1DtoUkdOeAj.0Q8t.DpqJe77saAVFa9Mqb6eF2O', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments_settings`
--
ALTER TABLE `departments_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails_settings`
--
ALTER TABLE `emails_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incident_status`
--
ALTER TABLE `incident_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_settings`
--
ALTER TABLE `roles_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams_settings`
--
ALTER TABLE `teams_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments_settings`
--
ALTER TABLE `departments_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emails_settings`
--
ALTER TABLE `emails_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `incident_status`
--
ALTER TABLE `incident_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles_settings`
--
ALTER TABLE `roles_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `teams_settings`
--
ALTER TABLE `teams_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
