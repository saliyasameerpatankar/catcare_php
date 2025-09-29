-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 11:52 AM
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
-- Database: `catcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `userid` int(10) UNSIGNED NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`userid`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'catlover@gmail.com', 'meow123', 'Luna', 'Whiskers'),
(2, 'user1@example.com', '1235', 'User', 'One'),
(3, 'user2@example.com', 'pass2', 'User', 'Two'),
(4, 'user1@example.com', 'pass1', 'User', 'One'),
(5, 'user2@example.com', '12345', 'User', 'Two'),
(6, 'user1@example.com', 'pass1', 'User', 'One'),
(7, 'user2@example.com', '12345', 'User', 'Two'),
(8, 'user@example.com', '$2y$10$rEPo3Ko0Z0p/i/0wMbaVBevIl3wZJR6neKR1VYu2SoErTmC35aEj.', 'John', 'Doe'),
(9, 'saleha@example.com', '$2y$10$XEjU7qmpWr9jGbvs5PhoEOimVejESV.v7IQGN9YimFXbrpUwBs/Ie', 'saleha', 'P'),
(10, 'itahirkhan07@gmail.com', '$2y$10$dovIeHrXl5ABhEHKUKGw5u8Q99KkOtc.ygKKNjvjFmevz6Awx3bNu', 'tahir', 'khan'),
(11, 'dana@gmail.com', '$2y$10$K8Erd/agAkC3fXd7ZVa0repwwNCSEhc2yhdOpk3zQ7RSbWRUs4T0O', 'dhana', 'laxmi'),
(12, 'sheep@gmail.com', '$2y$10$fLumx1ygobTohm198Nzd6.nK2vCNypEgidIvdXJ2Vr5FafsCTawy.', 'black', 'sheep'),
(13, 'salehap@gmail.com', '$2y$10$NhhXHBzlxdsCZuDsFUiOjOy9MNg1imV.PWKprkLgYFiOohhAOnQWu', 'P', 'saleha'),
(14, 'user1@example.com', 'pass1', 'User', 'One'),
(15, 'user2@example.com', '12345', 'User', 'Two'),
(16, 'saliyapatankar@gmail.com', '$2y$10$/nHcsXU0cUclha7HzMEVre0vMNQHyp6AaXx73HG/aD9BdUeJ/FCpa', 'saliya', 'patankar'),
(17, 'user1@example.com', 'pass1', 'User', 'One'),
(18, 'user2@example.com', '12345', 'User', 'Two'),
(19, 'patankarsaliya2004@gmail.com', '$2y$10$rytw6NLvz8IYqdIqvGA45.iLVd838iP3i6p5chU6xHi8NEQRjnloe', 'Saliya', 'Patankar'),
(20, 'patankarsaliyasameer@gmail.com', '$2y$10$04HV4ZgZjHlTiNLCUm6dvO.OzmNqA3/O5FygaNHWXXNkcpXadRCP.', 'Saliya', 'Patankar'),
(21, 'natureloveee12@gmail.com', '$2y$10$mDZJVymYo/0NTsolxMztmOl2YPb37VsCaVDehW/h5vd4Rf6UMbayi', 'patan', 'kar'),
(22, 'c. n', '$2y$10$ivZxg2Ayip4dWI3K8b0gNOTz2nGnkublFU4yWLBPHQ0Lh96RMJrli', 'fbb', 'cbnj'),
(23, 'saliya123', '$2y$10$yeqDqXQKqBfS9DMBNeQKSumGkf7aTQrfx6N8CRDIqIAMxFuk6pkca', 'dhanush', 'Krish'),
(24, '123@gmail.com', '$2y$10$IXdFmv6fyoloAss2E9DbUeXtMVjk1LNM29XY1YMkT.AlVu8DG.BTO', 'Saliya', 'Patankar'),
(25, '123@gmail.com', '$2y$10$m9RZdlelNtGYJHy5FYwTl.a/x9qJv0tz9YSTafzJnqL6fr/SLmjK2', 'Saliya', 'Patankar');

-- --------------------------------------------------------

--
-- Table structure for table `cat_profile`
--

CREATE TABLE `cat_profile` (
  `catid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `catname` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat_profile`
--

INSERT INTO `cat_profile` (`catid`, `userid`, `catname`, `age`, `breed`, `gender`, `photo`) VALUES
(3, 1, 'Whiskers', 2, 'Persian', 'Female', 'whiskers.jpg'),
(4, 1, 'Whiskers', 2, 'Persian', 'Female', NULL),
(11, 1, 'gr', 3, 'Persian', 'Female', NULL),
(12, 1, 'gr', 3, 'Persian', 'Female', NULL),
(13, 1, 'grgftf', 3, 'Persian', 'Female', NULL),
(15, 1, 'hdh', 5, 'nfn', 'Male', NULL),
(16, 1, 'bbb', 66, 'hdhd', 'Male', NULL),
(17, 1, 'bbb', 66, 'hdhd', 'Male', NULL),
(22, 10, 'ppp', 8, 'pppppp', 'Male', NULL),
(23, 13, 'sale', 0, 'hd', 'Female', NULL),
(24, 13, 'gh', 8, 'hh', 'Male', NULL),
(40, 10, 'lll', 2, 'Siamese', 'Male', NULL),
(45, 1, 'Shadow', 2, 'Persian', 'Male', 'shadow.jpg'),
(46, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(47, 16, 'chello', 2, 'Persian', 'Female', NULL),
(49, 16, 'jilo', 3, 'asian', 'Male', NULL),
(51, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(54, 16, 'Saliya Patankar', 2, 'Asian', 'Female', NULL),
(56, 16, 'naje', 3, 'Persian', 'Female', NULL),
(64, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(74, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(75, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(76, 1, 'Whiskers', 2, 'Persian', 'Male', NULL),
(82, 1, 'snowy', 3, 'persian', 'female', NULL),
(83, 1, 'snowy', 3, 'persian', 'female', NULL),
(84, 5, 'luna', 5, 'persian', 'male', NULL),
(85, 5, 'luna', 5, 'persian', 'male', NULL),
(86, 5, 'luna', 5, 'persian', 'male', NULL),
(92, 23, 'Saliya', 12, 'Persian', 'female', NULL),
(110, 22, 'Shiny', 2, 'Persian', 'female', NULL),
(113, 21, 'Kitty', 2, 'Persian', 'male', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feeding_schedule`
--

CREATE TABLE `feeding_schedule` (
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `feeding_time` time NOT NULL,
  `food_type` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feeding_schedule`
--

INSERT INTO `feeding_schedule` (`schedule_id`, `catid`, `feeding_time`, `food_type`, `notes`) VALUES
(2, 3, '08:00:00', 'Dry Food', 'Give fresh water'),
(3, 3, '08:00:00', 'Dry Food', 'Give fresh water');

-- --------------------------------------------------------

--
-- Table structure for table `grooming_tasks`
--

CREATE TABLE `grooming_tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  `last_done` date DEFAULT NULL,
  `next_due` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grooming_tasks`
--

INSERT INTO `grooming_tasks` (`id`, `task_name`, `frequency`, `last_done`, `next_due`) VALUES
(1, 'Brush Teeth', 'Weekly', '2025-08-25', '2025-09-01'),
(2, 'Trim Nails', 'Monthly', '2025-09-01', '2025-09-30'),
(3, 'Trim Nails', 'Monthly', '2025-09-01', '2025-09-30'),
(47, 'Brush', 'Daily', '2025-09-08', '2025-09-09'),
(47, 'Bathing', 'Bath twice a week', '2025-09-03', '2025-09-09'),
(47, 'cut nails', 'weekly', '2025-09-01', '2025-09-08'),
(47, 'combing', 'Daily', '2025-09-08', '2025-09-19'),
(47, 'dhb', 'Weekly', '2025-09-11', '2025-09-12'),
(48, 'chh', 'Daily', '2025-09-18', '2025-09-11'),
(48, 'vsnn', 'Daily', '2025-09-16', '2025-09-03'),
(48, 'gyj', 'Daily', '2025-09-18', '2025-09-19'),
(49, 'shampoo', 'Daily', '2025-09-09', '2025-09-11'),
(47, 'shampoo', 'Daily', '2025-09-11', '2025-09-20'),
(47, 'shampoo', 'Daily', '2025-09-11', '2025-09-20'),
(47, 'ch ajn', 'Daily', '2025-09-09', '2025-09-12'),
(47, 'fbn', 'Daily', '2025-09-12', '2025-09-19'),
(47, 'hdjdn', 'Daily', '2025-09-06', '2025-09-25'),
(47, 'washing', 'Monthly', '2025-09-20', '2025-09-19'),
(47, 'washing', 'Daily', '2025-09-20', '2025-09-26'),
(47, 'dannnnn', 'Weekly', '2025-09-12', '2025-09-21'),
(47, 'saliya', 'Daily', '2025-09-26', '2025-09-27'),
(0, 'cut nails', 'weekly', '2025-09-01', '2025-09-08'),
(47, 'cut nails', 'weekly', '2025-09-01', '2025-09-08'),
(54, 'daddyyyyyy', 'Daily', '2025-09-10', '2025-09-04'),
(47, 'tub', 'Daily', '2025-09-11', '2025-09-19'),
(47, 'eating', 'Daily', '2025-09-11', '2025-09-20'),
(92, 'bathing', 'Monthly', '2025-09-20', '2025-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `health_records`
--

CREATE TABLE `health_records` (
  `record_id` int(10) UNSIGNED NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `checkup_date` date NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `health_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_entries`
--

CREATE TABLE `photo_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vetappointments`
--

CREATE TABLE `vetappointments` (
  `appointmentid` int(11) NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `next_appointment_date` date DEFAULT NULL,
  `next_appointment_time` time DEFAULT NULL,
  `reason_or_visit_type` varchar(255) DEFAULT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `vet_name` varchar(255) DEFAULT NULL,
  `vet_phone_number` varchar(50) DEFAULT NULL,
  `last_visit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vetappointments`
--

INSERT INTO `vetappointments` (`appointmentid`, `catid`, `next_appointment_date`, `next_appointment_time`, `reason_or_visit_type`, `clinic_name`, `vet_name`, `vet_phone_number`, `last_visit_date`) VALUES
(1, 47, '2025-11-08', '12:02:30', 'vaccination ', 'Happy Paws Vet Clinic', 'srihhari', '8099089123', '2025-08-21'),
(2, 47, '2025-11-08', '12:02:30', 'vaccination ', 'Happy Paws Vet Clinic', 'srihhari', '8099089123', '2025-08-21'),
(3, 47, '2025-11-08', '12:02:30', 'vaccination ', 'Happy Paws Vet Clinic', 'srihhari', '8099089123', '2025-08-21'),
(4, 47, '2025-11-08', '12:02:30', 'vaccination ', 'Happy Paws Vet Clinic', 'srihhari', '8099089123', '2025-08-21'),
(5, 49, '2025-09-10', '01:06:00', 'Dental', 'Saliya Patankar', 'bchvnbkb', '2328698059', '2025-09-12'),
(6, 47, '2025-09-12', '17:32:00', 'Emergency', 'Saliya Patankar', 'Saliya Patankar', '222222', '2025-09-19'),
(7, 54, '2025-09-12', '04:00:00', 'Vaccination', 'saluzavv', 'pretah', '258509696', '2025-09-10'),
(8, 56, '2025-09-27', '19:31:00', 'Check-up', 'Saliya Patankar', 'Saliya Patankar', '3215469780', '2025-09-08'),
(9, 47, '2025-09-11', '21:07:00', 'Vaccination', 'bajeeeeeeee', 'svh', '9649', '2025-09-27'),
(10, 92, '2025-09-23', '23:24:00', 'Vaccination', 'Saliya Patankar', 'Saliya Patankar', '8056470320', '2025-09-27'),
(11, 92, '2025-09-26', '03:39:00', 'Vaccination', 'petcare', 'Srihari', '8056440320', '2025-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `weight_entries`
--

CREATE TABLE `weight_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight_entries`
--

INSERT INTO `weight_entries` (`id`, `catid`, `date`, `weight`, `notes`) VALUES
(1, 3, '2025-09-11', 28.00, 'healthy'),
(2, 47, '2025-09-12', 12.00, 'health'),
(3, 47, '2025-09-12', 12.00, 'fhshb'),
(4, 3, '2025-09-11', 28.00, 'healthy'),
(5, 47, '2025-09-12', 12.00, 'healthy '),
(6, 47, '2025-09-12', 25.00, 'thes'),
(7, 47, '2025-09-12', 28.00, 'fbn'),
(8, 3, '2025-09-11', 28.00, 'healthy'),
(23, 6, '2009-08-10', 3.40, 'health'),
(24, 47, '2025-09-12', 12.00, 'health '),
(25, 47, '2025-09-12', 12.00, 'health '),
(26, 47, '2025-09-12', 12.00, 'health '),
(27, 6, '2009-08-10', 3.40, 'health'),
(28, 47, '2025-09-12', 28.00, 'wf'),
(29, 53, '2025-09-12', 999.99, 'super'),
(30, 47, '2025-09-12', 15.00, 'asiffff'),
(31, 47, '2025-09-12', 15.00, 'asiffff'),
(32, 47, '2025-09-12', 15.00, 'asiffff'),
(33, 47, '2025-09-12', 15.00, 'asiffff'),
(34, 47, '2025-09-12', 2.00, 'nitttttt'),
(35, 47, '2025-09-12', 12.00, 'saliya'),
(36, 47, '2025-09-12', 25.00, 'sameer '),
(37, 54, '2025-09-12', 59.00, 'gokd'),
(38, 56, '2025-09-12', 12.00, 'healthy '),
(39, 56, '2025-09-12', 15.00, 'good'),
(40, 49, '2025-09-12', 999.99, 'cbh'),
(41, 70, '2025-09-12', 12.00, 'yesterday '),
(42, 49, '2025-09-13', 12.00, 'healthy '),
(43, 49, '2025-09-13', 12.00, 'healthy '),
(44, 49, '2025-09-13', 12.00, 'healthy '),
(45, 54, '2025-09-13', 12.00, 'grag'),
(46, 47, '2025-09-13', 12.00, 'gr'),
(47, 71, '2025-09-15', 4.00, 'yesterday '),
(48, 71, '2025-09-15', 12.00, 'today '),
(49, 71, '2025-09-15', 25.00, NULL),
(50, 71, '2025-09-15', 1.00, 'tjff'),
(51, 92, '2025-09-23', 12.00, 'on 13 th June '),
(52, 92, '2025-09-23', 15.00, 'on 21 st september '),
(53, 92, '2025-09-23', 15.00, 'on 21 st september '),
(54, 92, '2025-09-25', 25.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `cat_profile`
--
ALTER TABLE `cat_profile`
  ADD PRIMARY KEY (`catid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `photo_entries`
--
ALTER TABLE `photo_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `vetappointments`
--
ALTER TABLE `vetappointments`
  ADD PRIMARY KEY (`appointmentid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `weight_entries`
--
ALTER TABLE `weight_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cat_profile`
--
ALTER TABLE `cat_profile`
  MODIFY `catid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  MODIFY `schedule_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `health_records`
--
ALTER TABLE `health_records`
  MODIFY `record_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_entries`
--
ALTER TABLE `photo_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vetappointments`
--
ALTER TABLE `vetappointments`
  MODIFY `appointmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `weight_entries`
--
ALTER TABLE `weight_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cat_profile`
--
ALTER TABLE `cat_profile`
  ADD CONSTRAINT `cat_profile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `auth_user` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `feeding_schedule`
--
ALTER TABLE `feeding_schedule`
  ADD CONSTRAINT `feeding_schedule_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cat_profile` (`catid`) ON DELETE CASCADE;

--
-- Constraints for table `health_records`
--
ALTER TABLE `health_records`
  ADD CONSTRAINT `health_records_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cat_profile` (`catid`) ON DELETE CASCADE;

--
-- Constraints for table `photo_entries`
--
ALTER TABLE `photo_entries`
  ADD CONSTRAINT `photo_entries_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cat_profile` (`catid`) ON DELETE CASCADE;

--
-- Constraints for table `vetappointments`
--
ALTER TABLE `vetappointments`
  ADD CONSTRAINT `vetappointments_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cat_profile` (`catid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
