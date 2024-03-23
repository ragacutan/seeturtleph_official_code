-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_db
-- Generation Time: Nov 22, 2023 at 12:52 AM
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

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `users_id`, `category_id`, `title`, `date`, `time`, `location`, `body`, `last_updated`, `date_created`) VALUES
(1, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', '', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:13:33'),
(2, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', 'Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:13:48'),
(3, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', 'Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:16:02'),
(4, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:16:05'),
(5, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:17:59'),
(6, 25, 1, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:18:04'),
(7, 25, 4, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:18:19'),
(8, 25, 4, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:18:48'),
(9, 25, 4, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:18:51'),
(10, 25, 4, 'Nesting Site Patrolling', '25 November 2023', '5:00 pm', 'San Juan', ' Nesting Site Patrolling involves regularly monitoring and safeguarding nesting locations of wildlife, particularly birds and reptiles, to ensure their protection and conservation. This proactive surveillance aims to mitigate potential threats, such as poaching or habitat disturbances, and contributes to the overall well-being and successful reproduction of these species. Patrols are conducted to enhance conservation efforts, collect data on nesting activities, and promote sustainable practices that foster the preservation of critical nesting sites.', NULL, '2023-11-21 20:19:27'),
(11, 25, 1, 'A Wild Night For Project Curma', '', '4:24 am', '', 'What a wild night it has been for the CURMA team on November 13! As people were getting ready for bed, our team was just gearing up for an action-packed night of sea turtle nesting. Here\'s a recap of the incredible events:\r\nFirst Nest: Marven Abat\'s Discovery\r\nAt around 9 PM, local surfer Marven Abat made the first call of the night. Excitement filled the air as Marven reported a turtle laying eggs just in front of the Surfest Rest Guest House. Thanks to the cooperation of the La Union Surf Club, the turtle was given the space she needed, and she laid a clutch of 44 eggs.\r\nSecond Nest: Joshua Cabagbag Makes a Find\r\nAs we were on our way to the hatchery at around 11 PM, the second call came from our Bacnotan Patroller, Jessie Cabagbag. His son Joshua had found his very first nest right in Baroro, Bacnotan. Joshua, having been taught by his father to recognize turtle tracks, discovered a nest containing a clutch of 97 eggs.\r\nThird Nest: Johnny Manglugay and Bantay\'s Discovery\r\nJust when we thought the night was winding down, our patroller Johnny Manglugay, and his loyal dog Bantay made the third discovery. While on their walk, Bantay\'s keen sense of smell led them to a nest. Johnny dug in and uncovered 103 eggs, marking his first nest of the season.\r\nA Night of Firsts and New Experiences\r\nThis night was filled with firsts - Joshua\'s first nest, Johnny\'s first nest of the season, the first nesting in that area of Urbiztondo, and the first-time experience for our new volunteer Regine Ragojos amid a turtle action-packed night.\r\nThank you to Marven Abat, Jessie Cabagbag, Johnny Manglugay, and all our dedicated volunteers for their tireless efforts in ensuring the safety and well-being of these incredible sea creatures. Every nest found is a step closer to the conservation of our precious marine life.🐢💚🌏.', NULL, '2023-11-21 20:25:50');

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
  `turtle_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nesting_data`
--

INSERT INTO `nesting_data` (`id`, `location_nest`, `latitude`, `longitude`, `clutch_size`, `new_location`, `number_transplanted`, `date_transplanted`, `date_1`, `time_1`, `no_hatchling_1`, `collected_by_1`, `date_2`, `time_2`, `no_hatchling_2`, `collected_by_2`, `date_3`, `time_3`, `no_hatchling_3`, `collected_by_3`, `date_4`, `time_4`, `no_hatchling_4`, `collected_by_4`, `no_egg_hatched`, `no_egg_unhatched`, `no_unhatched_fertile`, `live_piped_eggs`, `dead_piped_eggs`, `without_visible_development`, `predated`, `hatchling_dead_nest`, `hatchling_live_nest`, `turtle_id`) VALUES
(4, 'Urbiztondo, San Juan, La Union', '16.676606', '120.335292', '', 'Ili Norte, San Juan, La Union', '127', '03 November 2023', '01 November 2023', '10:08 am', '12', 'admin', '04 November 2023', '10:08 am', '12', 'admin', '01 November 2023', '10:08 am', '12', 'admin', '10 November 2023', '10:08 am', '12', 'admin', '12', '1', '12', '12', '12', '12', '12', '12', '12', 'PH1864B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleInitial` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `image_url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastName`, `firstName`, `middleInitial`, `age`, `region`, `province`, `municipality`, `barangay`, `sex`, `contactNumber`, `email`, `password`, `account_type`, `verification_code`, `email_verified_at`, `image_url`) VALUES
(1, 'Gacutan', 'Ram', 'N', 21, '', '', '', '', 'Male', '2147483647', 'ramgacutan@gmail.com', '123', '', '', NULL, ''),
(4, 'Gacutan', 'Ram Adrian', 'N', 21, '', '', '', '', ' Male', '09668106151', 'ragacutan31@gmail.com', '42842973bc45476b61f0dfb9a5a067c2', '', '', NULL, ''),
(7, 'Gacutan', 'Ram Adrian', 'N', 13, '', '', '', '', ' Male', '09668106151', 'ragacutan20@gmail.com', '30c84b2a0b14989f8baf867350b37751', 'user', '430688', NULL, ''),
(15, 'Gacutan', 'Ram Adrian', 'Naanod', 21, '02', 'BATANES', 'BASCO', 'CHANARIAN', 'Female', '09686769701', 'ragacutan23@gmail.com', '5a5ce0896edd4a1001ef2179acb7c014', 'user', '190256', '2023-08-11 06:04:26', ''),
(16, 'Gacutan', 'Ram Adrian', 'Naanod', 21, '', '', '', '', ' Male', '09686769701', 'ramadrian.gacutan@student.dmmmsu.edu.ph', '6c0e8dfde2f1df48d52dc4bf185dfa53', 'government', '163590', '2023-08-11 06:10:52', ''),
(18, 'Gacutan', 'Ram Adrian', 'N', 21, '', '', '', '', ' Male', '09686769701', 'seeturtle2023@gmail.com', '8ed69b46d3aa207210ef9efd31e25a1d', 'admin', '119774', '2023-08-11 06:16:27', ''),
(19, 'Gacutan', 'Ramon', 'B.', 21, '01', 'LA UNION', 'SAN GABRIEL', 'LIPAY NORTE', ' Male', '09686769701', 'ragacutan1@gmail.com', 'b7043e1e90c2e8353909a9d5c71c7530', 'user', '250760', NULL, ''),
(20, 'Gacutan', 'Ram Adrian ', 'N.', 21, '01', 'LA UNION', 'NAGUILIAN', 'BARAOAS NORTE', ' Male', '09686769701', 'ragacutan30@gmail.com', '4a5a7544d5f4f78f91d56bc0f8ad391c', 'user', '160117', NULL, ''),
(24, 'default', 'default', 'default', 21, '10', 'BUKIDNON', 'LIBONA', 'SANTA FE', ' Male', '09111111111', 'default@gmail.com', '61a0e182a1a08a2669978b7d25766f7b', 'user', '244896', '2023-11-04 13:58:56', 'IMG-655878d6c78844.65638405.png'),
(25, 'admin', 'admin', 'admin', 21, '01', 'ILOCOS NORTE', 'PINILI', 'PUZOL', ' Male', '09222222222', 'admin@gmail.com', '519d6970f0e92201fe62825a07837937', 'admin', '312952', '2023-11-04 14:01:15', ''),
(26, 'admin', 'admin', 'admin', 21, '12', 'COTABATO (NORTH COT.)', 'MIDSAYAP', 'CENTRAL BULANAN', ' Male', '09222222222', 'sowil17281@rdluxe.com', 'bf6beb0a651ccc18bf025b5972b91a9e', 'user', '271656', NULL, ''),
(27, 'test', 'test', 'test', 21, 'NCR', 'NATIONAL CAPITAL REGION - FOURTH DISTRICT', 'CITY OF LAS PIÑAS', 'TALON UNO', ' Male', '09333333333', 'ritoji2172@othao.com', '41fc4d2ef00f056d980b057784dc78bb', 'user', '128519', '2023-11-04 14:29:38', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nesting_data`
--
ALTER TABLE `nesting_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
