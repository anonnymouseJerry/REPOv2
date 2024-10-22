-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 10:03 AM
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
-- Database: `erepo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

CREATE TABLE `accesstype` (
  `access_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`access_id`, `type_name`, `description`) VALUES
(1, 'Admin', 'Full access to all features'),
(2, 'User', 'Limited Access');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `officeName` varchar(200) NOT NULL,
  `officeCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `officeName`, `officeCode`) VALUES
(1, 'All Office', 'allOffice'),
(2, 'Batchelor of Science and Technology', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `repo_file`
--

CREATE TABLE `repo_file` (
  `file_id` int(11) NOT NULL,
  `original_file_name` varchar(255) NOT NULL,
  `dateUploaded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `repo_id` int(11) NOT NULL,
  `saved_file_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repo_file`
--

INSERT INTO `repo_file` (`file_id`, `original_file_name`, `dateUploaded`, `user_id`, `repo_id`, `saved_file_name`, `file_type`) VALUES
(19, 'sdsdsdsdsd', '2024-10-22 06:44:20', 1, 8, 'avatar-2.jpg', 'jpg'),
(20, 'sample', '2024-10-22 07:32:31', 1, 8, 'Typography Pastel Supporting Quote Card (1).pdf', 'pdf'),
(23, 'txt', '2024-10-22 07:49:54', 1, 8, 'New! Keyboard shortcuts … Drive key.txt', 'txt');

-- --------------------------------------------------------

--
-- Table structure for table `repo_folder`
--

CREATE TABLE `repo_folder` (
  `repo_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repo_folder`
--

INSERT INTO `repo_folder` (`repo_id`, `title`, `dateCreated`, `user_id`, `office_id`) VALUES
(8, 'CIDCO', '2024-10-22 04:24:22', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `accesstype_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `profile_picture`, `accesstype_id`, `office_id`, `dateCreated`) VALUES
(1, 'Meyer Enriquez Castro', 'meyercastroe@gmail.com', '$2y$10$7aFZCdo7taxnLco11dkdiONixWCtE0HK7mDW9KJXTgB7pDGtKnEJO', 'uploads/6714e5b06f255_Meyer.jpg', 1, 1, '2024-10-20 12:43:34'),
(2, 'Mergie Enriquez', 'mergie@gmail.com', '$2y$10$Vr0sl9flmiir4KEFdses0Op/pV/EdPMHUFI4Fci/BmBXoWXPsYhw2', 'uploads/671710e8ee43d_avatar-2.jpg', 2, 2, '2024-10-20 13:48:39'),
(4, 'Wilmer Castro', 'wilmer@gmail.com', '$2y$10$JeGjWhNihz5HwRfk2n4s2O0JhHnbrmG2JbCw8lCl9VeWCBPT5/k86', NULL, 2, 2, '2024-10-20 13:53:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `repo_file`
--
ALTER TABLE `repo_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `repo_file_ibfk_1` (`repo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `repo_folder`
--
ALTER TABLE `repo_folder`
  ADD PRIMARY KEY (`repo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accesstype_id` (`accesstype_id`),
  ADD KEY `fk_office` (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstype`
--
ALTER TABLE `accesstype`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repo_file`
--
ALTER TABLE `repo_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `repo_folder`
--
ALTER TABLE `repo_folder`
  MODIFY `repo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `repo_file`
--
ALTER TABLE `repo_file`
  ADD CONSTRAINT `repo_file_ibfk_1` FOREIGN KEY (`repo_id`) REFERENCES `repo_folder` (`repo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repo_file_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repo_folder`
--
ALTER TABLE `repo_folder`
  ADD CONSTRAINT `repo_folder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_office` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`accesstype_id`) REFERENCES `accesstype` (`access_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
