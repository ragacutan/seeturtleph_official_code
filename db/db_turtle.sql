-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_db
-- Generation Time: Apr 01, 2024 at 12:43 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_turtle`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `last_updated` date DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `last_updated`, `date_created`) VALUES
(1, 'Training', NULL, '2023-11-20 03:37:45'),
(2, 'Awareness', NULL, '2023-11-20 03:38:00'),
(3, 'Volunteer', NULL, '2023-11-20 03:38:54'),
(4, 'News', NULL, '2023-11-20 03:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nesting_data`
--

CREATE TABLE `nesting_data` (
  `id` int NOT NULL,
  `location_nest` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `clutch_size` varchar(255) NOT NULL,
  `new_location` varchar(255) NOT NULL,
  `number_transplanted` varchar(255) NOT NULL,
  `date_transplanted` varchar(255) NOT NULL,
  `date_1` varchar(255) NOT NULL,
  `time_1` varchar(255) NOT NULL,
  `no_hatchling_1` varchar(255) DEFAULT NULL,
  `collected_by_1` varchar(255) NOT NULL,
  `date_2` varchar(255) NOT NULL,
  `time_2` varchar(255) NOT NULL,
  `no_hatchling_2` varchar(255) DEFAULT NULL,
  `collected_by_2` varchar(255) NOT NULL,
  `date_3` varchar(255) NOT NULL,
  `time_3` varchar(255) NOT NULL,
  `no_hatchling_3` varchar(255) DEFAULT NULL,
  `collected_by_3` varchar(255) NOT NULL,
  `date_4` varchar(255) NOT NULL,
  `time_4` varchar(255) NOT NULL,
  `no_hatchling_4` varchar(255) DEFAULT NULL,
  `collected_by_4` varchar(255) NOT NULL,
  `no_egg_hatched` varchar(255) DEFAULT NULL,
  `no_egg_unhatched` varchar(255) DEFAULT NULL,
  `no_unhatched_fertile` varchar(255) DEFAULT NULL,
  `live_piped_eggs` varchar(255) DEFAULT NULL,
  `dead_piped_eggs` varchar(255) DEFAULT NULL,
  `without_visible_development` varchar(255) DEFAULT NULL,
  `predated` varchar(255) DEFAULT NULL,
  `hatchling_dead_nest` varchar(255) DEFAULT NULL,
  `hatchling_live_nest` varchar(255) DEFAULT NULL,
  `turtle_id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `middleInitial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `birthdate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `age` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `province` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `municipality` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `barangay` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `contactNumber` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `account_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `verification_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastName`, `firstName`, `middleInitial`, `birthdate`, `age`, `region`, `province`, `municipality`, `barangay`, `sex`, `contactNumber`, `email`, `password`, `account_type`, `verification_code`, `email_verified_at`, `filename`) VALUES
(1, '', 'Super Admin Account', '', '', '', '', '', '', '', '', '', 'superadmin@seeturtleph.com', '7f46c3a1007b79bc99a033a8fa801897', 'superadmin', '', '2024-02-16 12:53:23', NULL),
(35, 'Account', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin@seeturtleph.com', '4929b3800a64e4d26388f0bfb601335e', 'admin', NULL, '2024-02-17 03:35:55', NULL),
(38, 'Account', 'Staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'staff@seeturtleph.com', 'b859923726a3a6104ae6f9ee6cd42a09', 'staff', NULL, '2024-02-17 03:39:55', NULL),
(39, 'Gacutan', 'Ram Adrian', 'Naanod', '2002-04-30', '21', '01', 'LA UNION', 'NAGUILIAN', 'BARAOAS NORTE', ' Male', '09668106151', 'ragacutan30@gmail.com', 'da65e5240b9c321fdea83ddd8a8d6422', 'user', '199802', '2024-02-19 15:03:13', 'profile/download (1).png'),
(40, 'Sermonia', 'Briand Angelo', 'C', '2003-03-12', '20', '01', 'LA UNION', 'NAGUILIAN', 'LIOAC SUR', ' Male', '09459622065', 'briandsermonia12@gmail.com', '0defde1d48e4f883a2e5d42c40a4b9cd', 'user', '234934', '2024-02-28 21:51:36', NULL),
(43, 'Gacutan', 'Ram Adrian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ragacutan23@gmail.com', '6fcb89fc8eb7a286c6e481d0f894b5b6', 'admin', NULL, '2024-03-01 01:52:52', NULL),
(44, 'ACCOUNT', 'DMMMSU-MLUC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dmmmsu-mluc@dmmmsu.edu.ph', '4cffcde43650e3b799a9618e904ea351', 'government', NULL, '2024-03-28 13:43:34', NULL),
(45, 'Tamayo', 'Carlos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'projectcurma', '80cda6dab8bbd241133f5310f9faaffd', 'admin', NULL, '2024-04-01 12:06:41', NULL),
(46, 'Gacutan', 'Ram Adrian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dmmmsu-mluc', 'fb49882455d7ae315862902d8109e7fd', 'government', NULL, '2024-04-01 12:24:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_ibfk_1` (`users_id`),
  ADD KEY `materials_ibfk_2` (`category_id`);

--
-- Indexes for table `nesting_data`
--
ALTER TABLE `nesting_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nesting_data`
--
ALTER TABLE `nesting_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
