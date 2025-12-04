-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 10:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joball_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `date_applied` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `salary` decimal(12,2) DEFAULT NULL,
  `salary_type` varchar(20) DEFAULT NULL,
  `employment_type` varchar(30) DEFAULT NULL,
  `urgent` tinyint(1) DEFAULT 0,
  `date_type` varchar(20) DEFAULT 'single',
  `single_date` date DEFAULT NULL,
  `range_start` date DEFAULT NULL,
  `range_end` date DEFAULT NULL,
  `multiple_dates` text DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp(),
  `employer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `job_title`, `job_description`, `city`, `barangay`, `province`, `postal_code`, `salary`, `salary_type`, `employment_type`, `urgent`, `date_type`, `single_date`, `range_start`, `range_end`, `multiple_dates`, `start_time`, `end_time`, `date_posted`, `employer_id`) VALUES
(8, 'Farmer', 'fafdas', 'Maramag', 'Musuan', 'Bukidnon', '8714', 24.00, '0', 'Full Time', 0, 'single', '2025-12-11', NULL, NULL, NULL, '17:26:00', '17:27:00', '2025-12-04 10:25:23', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `from_user_id`, `message`, `is_read`, `created_at`) VALUES
(15, 8, NULL, 'You have received an employment request from Employer ID: 8.', 0, '2025-12-04 08:23:59'),
(16, 8, 8, 'You have received an employment request from Stephen Rubin.', 0, '2025-12-04 09:02:06'),
(17, 8, 8, 'You have received an employment request from Stephen Rubin for the job: \"Carpenter\". Please check your profile messages.', 0, '2025-12-04 09:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `has_experience` tinyint(1) DEFAULT NULL,
  `job_title` varchar(150) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `start_month` varchar(20) DEFAULT NULL,
  `start_year` varchar(10) DEFAULT NULL,
  `end_month` varchar(20) DEFAULT NULL,
  `end_year` varchar(10) DEFAULT NULL,
  `still_in_role` tinyint(1) DEFAULT NULL,
  `classification` varchar(150) DEFAULT NULL,
  `subclassification` varchar(150) DEFAULT NULL,
  `visibility` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `fname`, `lname`, `email`, `password`, `home_address`, `has_experience`, `job_title`, `company_name`, `start_month`, `start_year`, `end_month`, `end_year`, `still_in_role`, `classification`, `subclassification`, `visibility`, `created_at`) VALUES
(7, 'SJ', 'Rubin', 'codex@gmail.com', '$2y$10$sZOn7RoKdgsocp5n5qz96OhiFb/zkHns70lIwLyZ3os1yeuf9tzQy', 'Maramag, Bukidnon', 1, 'Carpenter', 'Mind Mechanics', 'Month', 'Year', 'Month', 'Year', 0, '0', 'Carpenter', 'public', '2025-12-04 02:50:25'),
(8, 'Stephen', 'Rubin', 'akoni@gmail.com', '$2y$10$vfXgf20vds.sBJZS7yhbheXzyPkGQkY1VqsYL.gwq5o2cRaDOgsWi', 'Maramag, Bukidnon', 1, 'Carpenter', 'Mind Mechanics', 'September', '2011', 'July', '2011', 0, '0', 'Carpenter', 'public', '2025-12-04 07:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `worker_applications`
--

CREATE TABLE `worker_applications` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `work_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL,
  `sub_classification` varchar(255) DEFAULT NULL,
  `date_submitted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_applications`
--

INSERT INTO `worker_applications` (`id`, `worker_id`, `work_name`, `description`, `classification`, `sub_classification`, `date_submitted`) VALUES
(5, 8, 'Carpenter', 'fadfd', 'Construction & Skilled Trades', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_applications`
--
ALTER TABLE `worker_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `worker_applications`
--
ALTER TABLE `worker_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `worker_applications`
--
ALTER TABLE `worker_applications`
  ADD CONSTRAINT `worker_applications_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
