-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 09:36 PM
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
-- Database: `library_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('available','issued') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `cover_image`, `status`, `created_at`) VALUES
(1, 'Introduction to Algorithms', 'Thomas H. Cormen', '9780262033848', 'algorithms.jpg', 'available', '2024-10-03 10:13:14'),
(2, 'Clean Code', 'Robert C. Martin', '9780132350884', 'clean_code.jpg', 'available', '2024-10-03 10:13:14'),
(3, 'Design Patterns', 'Erich Gamma', '9780201633610', 'design_patterns.jpg', 'available', '2024-10-03 10:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('issued','returned') DEFAULT 'issued',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `book_id`, `issue_date`, `return_date`, `status`, `created_at`) VALUES
(1, 3, 1, '2024-10-03', NULL, 'issued', '2024-10-03 10:14:08'),
(2, 3, 2, '2024-09-30', '2024-10-03', 'returned', '2024-10-03 10:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student','librarian') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `profile_picture`) VALUES
(1, 'Admin User', 'admin@example.com', 'password_hash(123)', 'admin', '2024-10-03 10:12:43', NULL),
(2, 'Librarian User', 'librarian@example.com', 'hashed_password_here', 'librarian', '2024-10-03 10:12:43', NULL),
(3, 'John Doe', 'john@example.com', 'hashed_password_here', 'student', '2024-10-03 10:12:43', NULL),
(4, 'Sengwamana Emeran', 'sengwaemeran@gmail.com', '$2y$10$eXB0g8Xfl3NyQGMNTNkAhONRN.vKk0YeXAbA9KNcXmpyNNLz8c/Ti', 'librarian', '2024-10-03 15:32:25', NULL),
(5, 'Bonheur', 'Bonheur@gmail.com', '$2y$10$wnwJNqJ2Q9UFv7ss/dIi7.YqaLuQqzPKO4/tH0v8suJhjIxIythJ', 'student', '2024-10-03 15:33:59', NULL),
(6, 'frank', 'frank@gmail.com', '$2y$10$Trp96Jn0Pk0QaKGgjXNXKeBSXRIVl0JWLzkgTcR2LgQkRLyhFr4ua', 'librarian', '2024-10-05 00:29:46', NULL),
(7, 'Ben', 'Ben@gmail.com', '$2y$10$mQ8GhfVJXOkqyyjV3hdsGuP61F3qNpYrRqZMV4EDfQaBf5NT6CXoS', 'student', '2024-10-05 14:05:08', NULL),
(8, 'Emeran', 'emeran@gmail.com', '$2y$10$NXSPGhGDiphwdra8nhRxfOH459wbuGLHGtEei4Y0YPAIUPp9P.dWi', 'librarian', '2024-10-05 15:33:44', NULL),
(9, 'sonia', 'sonia@gmail.com', '$2y$10$r38aQ2vbh3E0vMhaY9B25usYJTDD1JjBajWR4rX8qmv41YxtclOEi', 'librarian', '2024-10-06 07:17:33', NULL),
(10, 'soso', 'soso@gmail.com', '$2y$10$pUDFEBSl0fjf2oSzn/xWZuzRGwfiAA9aLAT8UGvdvC9xUQRZfnGfW', 'librarian', '2024-10-06 07:51:49', NULL),
(11, 'Kwizera', 'Kwizera@gmail.com', '$2y$10$akFCXw3XurlvVC0E6NbdweCBnh8TIwCnw.KdMDTJjxFByxQMQib.y', 'student', '2024-10-06 18:06:17', NULL),
(12, 'jack', 'musengimanajacques@gmail.com', '$2y$10$SF0ju9vDmrDh1cSB/Al/aOJZ0iQeo7cR8fxXhGPCviHQt97IcW/Uy', 'student', '2024-10-07 12:49:30', NULL),
(13, 'xavier', 'aaaaaa@gmail.com', '$2y$10$26atz0c1NeoUjlI5z7HgSe7mrY.YpclgxINt3.msF/XvsH3hHA.Am', 'student', '2024-10-08 14:13:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
