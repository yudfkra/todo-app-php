-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2023 at 04:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `status`, `file`, `created_at`, `updated_at`) VALUES
(31, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Vivamus auctor ante eget porta dictum. Donec tempor, sem eu vehicula ultrices, lectus lacus lacinia lorem, a tempus sapien ante non mauris. Mauris orci dui, dictum et aliquet ac, commodo eget ante. Maecenas rhoncus id massa ac scelerisque. Phasellus urna nisi, malesuada id eleifend ac, tempor id urna. Curabitur sed rutrum enim. Morbi auctor libero ut lorem scelerisque viverra. Donec vestibulum quis nisi et gravida. Nulla eu purus a libero varius sollicitudin sit amet quis nibh. Etiam eget blandit dolor. Cras eu orci in erat pretium commodo. Nam et ornare eros. Nunc maximus nunc sit amet rhoncus semper. Etiam ac orci et lacus ullamcorper rutrum id eu sapien.', 1, NULL, '2023-11-09 10:42:53', NULL),
(32, 1, 'Mauris at mauris semper, eleifend ante eu, cursus felis.', 'Quisque leo orci, suscipit vitae condimentum sit amet, tristique eget turpis. Vivamus vel lorem a velit dignissim varius. Suspendisse potenti. Pellentesque lacinia nisl in laoreet rutrum. In in blandit quam. Donec facilisis felis eget placerat euismod. Nunc mollis est eget posuere feugiat. Vestibulum non sapien dapibus, hendrerit velit tincidunt, volutpat mi.\n\nFusce id nunc id odio blandit vulputate sed at arcu. Ut ullamcorper hendrerit magna, eu elementum libero vestibulum id. Etiam leo dui, scelerisque at quam eget, ultrices gravida sem. Aliquam consequat eu nisi ut facilisis. Nulla pretium vulputate est, vel faucibus libero placerat sed. Ut a lacus vulputate, pharetra dolor eget, molestie orci. Curabitur congue ipsum et elit bibendum egestas. Aliquam eu molestie est, id sodales nisl. Praesent ornare purus nibh, quis hendrerit justo fringilla a.', 2, NULL, '2023-11-09 10:43:42', NULL),
(35, 1, 'Vivamus auctor ante eget porta dictum.', 'Vivamus auctor ante eget porta dictum. Donec tempor, sem eu vehicula ultrices, lectus lacus lacinia lorem, a tempus sapien ante non mauris. Mauris orci dui, dictum et aliquet ac, commodo eget ante. Maecenas rhoncus id massa ac scelerisque. Phasellus urna nisi, malesuada id eleifend ac, tempor id urna. Curabitur sed rutrum enim. Morbi auctor libero ut lorem scelerisque viverra. Donec vestibulum quis nisi et gravida. Nulla eu purus a libero varius sollicitudin sit amet quis nibh. Etiam eget blandit dolor. Cras eu orci in erat pretium commodo. Nam et ornare eros. Nunc maximus nunc sit amet rhoncus semper. Etiam ac orci et lacus ullamcorper rutrum id eu sapien.\n\nMauris at mauris semper, eleifend ante eu, cursus felis. Curabitur porttitor elit eget augue tempus euismod. Etiam lobortis et arcu aliquam consequat. Vestibulum ut sagittis eros. Integer vitae maximus mi, eu sagittis lectus. Maecenas interdum non massa in mollis. Praesent vulputate augue tortor, a ultricies lorem venenatis eget. Donec a augue commodo, malesuada sapien nec, condimentum nunc. Ut mollis vulputate accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec vehicula sagittis commodo. Pellentesque mollis dolor dolor, id cursus orci gravida et.', -1, NULL, '2023-11-09 20:53:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$QgVbKQw.tG09s4IqTtBzL.VLVEzCytZh5rmLjk05/gmS.Ko19hEZC', '2023-11-07 09:11:33', '2023-11-07 09:11:33'),
(2, 'guest', '$2y$10$wZWbMuShv/AFb28mhF1wDOzpJr1pL3s9ljAobLja4K4doi3vAg9jK', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks_users_user_id_Id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_users_user_id_Id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
