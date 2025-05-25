-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2025 at 08:05 AM
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
-- Database: `charitysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_requested` decimal(10,2) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  `request_date` datetime NOT NULL,
  `admin_action_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `user_id`, `amount_requested`, `reason`, `status`, `request_date`, `admin_action_date`) VALUES
(2, 16, 85000.00, 'studies', 'approved', '2025-05-19 14:28:31', NULL),
(3, 17, 560.00, 'school', 'approved', '2025-05-20 21:09:36', NULL),
(5, 19, 470000.00, 'hospital construction', 'approved', '2025-05-20 22:44:38', NULL),
(6, 10, 11000.00, 'education', 'approved', '2025-05-20 22:48:07', NULL),
(7, 21, 45000.00, 'medical purpose', 'approved', '2025-05-22 22:25:18', NULL),
(8, 9, 8000.00, 'handicapped people', 'approved', '2025-05-22 22:42:19', NULL),
(9, 23, 8.00, 'samosa', 'approved', '2025-05-22 22:46:49', NULL),
(11, 26, 1.00, 'kachcha mango', 'approved', '2025-05-23 22:48:45', NULL),
(12, 27, 52000.00, 'buying laptop', 'approved', '2025-05-24 09:16:55', NULL),
(13, 9, 458000.00, 'medical', 'approved', '2025-05-24 10:06:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `donation_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `user_id`, `amount`, `donation_date`, `status`) VALUES
(1, 10, 12000.00, '2025-05-22', 'approved'),
(2, 9, 85000.00, '0000-00-00', 'approved'),
(3, 16, 650000.00, '2025-05-21', 'rejected'),
(4, 16, 42000.00, '2025-04-29', 'pending'),
(5, 17, 45000.00, '2025-05-20', 'pending'),
(6, 21, 458200.00, '2025-05-23', 'pending'),
(7, 9, 34000.00, '2025-05-28', 'approved'),
(8, 23, 10000000.00, '2025-05-22', 'pending'),
(9, 24, 8500.00, '2025-05-15', 'pending'),
(10, 9, 500.00, '2025-05-16', 'pending'),
(11, 9, 5000.00, '2025-05-17', 'pending'),
(12, 9, 54000.00, '2025-05-02', 'pending'),
(13, 26, 0.01, '2025-05-23', 'pending'),
(14, 27, 45000.00, '2025-05-15', 'pending'),
(15, 28, 55500.00, '2025-05-27', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `address`, `phone`, `place`) VALUES
(1, NULL, NULL, NULL, 'user', NULL, NULL, NULL),
(2, 'admin', 'admin@gmail.com', '$2y$10$vV4xlX9N//gR7/yhFRv8i.FI2tQmIXFhBn4bZan2qQeJ/RfBapgNO', 'admin', NULL, NULL, NULL),
(4, NULL, NULL, NULL, 'user', NULL, NULL, NULL),
(5, NULL, NULL, NULL, 'user', NULL, NULL, NULL),
(7, 'admin', 'admi@gmail.com', '$2y$10$Hb24yL.epDhUE5N8e.NBquluea/j3emyQAHscYK.SF5/su9wVYrZS', 'admin', NULL, NULL, NULL),
(9, 'Ananya Mesta', 'ananyamesta186@gmail.com', '$2y$10$PZbfUG3Z/CgJMnFDiLMuIe75zwletYaMDBKcF9zM5P.2NSqstAt0G', 'user', NULL, '4582451214', 'honnavar'),
(10, 'dimple', 'dimple@gmail.com', '$2y$10$5F6V9dQH8SibCx/4N.nC2euJIgooCwmEU1UKEZ2dtQZmQUZysBF.K', 'user', NULL, NULL, NULL),
(12, 'usha', 'usha@gmail.com', '$2y$10$CFunocPC/JRkDsB3N5geW.fUxp2.R0Fzgreqrm2Nwlsyk/0gD9xte', 'user', NULL, NULL, NULL),
(13, 'chandushree', 'chandu@gmail.com', '$2y$10$CY.odarOtNOt7hoe92dp3u5lJNq/eMg2Gek9RnNGyTvfpULdc3oGy', 'user', NULL, NULL, NULL),
(14, 'sumitha', 'sumith@gmail.com', '$2y$10$wmOHMnzcPFatYu37iYQdfOSRkA2.sOiEKqwSkCSBdO8gL7WmJbJuy', 'user', NULL, NULL, NULL),
(15, 'tulsi', 'tulsi@gmail.com', '$2y$10$0Japl/NH.X8iGL0BLxPgjOaFMnKUQ5qzNoS9GoBSB/h2yVQi4Zpg2', 'user', NULL, NULL, NULL),
(16, 'preksha', 'prekhsa@gmail.com', '$2y$10$HLZOM77YGfOwsjA51MLPB.Ghzc8sKOnFiFZtndr8A3qyQL8GCTXh.', 'user', NULL, NULL, NULL),
(17, 'umera', 'umera@gmail.com', '$2y$10$o8q61ZtZmM0Xt3.jTlPpx.XFxt/HPbpEL4jGlFJ0qQZ8AI1XDtIym', 'user', NULL, NULL, NULL),
(18, 'srushti', 'srushti@gmail.com', '$2y$10$wHagE.qOOqlCkBlrDsjC7OumdtlQJGw1ELio2/mi3TRw1VA197wpC', 'user', NULL, NULL, NULL),
(19, 'rajeshwari', 'raji@gmail.com', '$2y$10$1FLjqiWDeTl8aMcb0xvt8OqN0zfsLQn2yPPhWXnv5T9XEamJC01MO', 'user', NULL, NULL, NULL),
(21, 'swathi', 'swathi@gmail.com', '$2y$10$kWNn7rN64xEwBWontNc3YO8JpXtb7r8UR1A3H83vFffnhjN.afIV2', 'user', NULL, NULL, NULL),
(22, 'Ananya', 'ana@gmail.com', '$2y$10$73APp9b2rJ8hR.cDWLve7.u2NMAvOJSOlnkQ4rKe0nb3cChmk/RV6', 'user', NULL, NULL, NULL),
(23, 'swati naik', 'swatinaik430@gmail.com', '$2y$10$B3S54GUSKXaX5RYvtyxSxe1aN0DK.EA2pIW5/vEbp2K/C2KQPH.o.', 'user', NULL, NULL, NULL),
(24, 'seema', 'seema@gmail.com', '$2y$10$LLuETacxHFZhIBZvVQUbBu.6i0ZJLBkUiFZTvihFkAokU30XC5OnW', 'user', NULL, NULL, NULL),
(25, 'vanishree', 'vanishree@gmail.com', '$2y$10$gOvZNQGK8/6XrrE3g11/2eU0Uj1khVDRZXpqrzgAsvIU8iC./Co0m', 'user', NULL, '4582154968', 'kundapura'),
(26, 'Shrushti Sardar', 'shrushtisardar@gmail.com', '$2y$10$DvWbTx8J1OrLo3j4aRdhNON2r/uvzEEX4v9tRR1fBAASIacfcbdKO', 'user', NULL, '1234567891', 'Kankanadi'),
(27, 'afsha', 'afsha@gmail.com', '$2y$10$YCP3vZXe66dDPgQwyfLFBeqsouKpzXXnqgsj.zjd9RqiNRyKMFaTa', 'user', NULL, '4582154274', 'moodbidri'),
(28, 'annu', 'annu@gmail.com', '$2y$10$yd71WykDG0bIAGKOLvoGHORGvrgY0do0nxyD31o7vUYSmTIu1/PpC', 'user', NULL, '2424104254', 'mijar'),
(29, 'druba', 'druba@gmail.com', '$2y$10$DpNRq.Z8O3OMMAX0EL4XUeQke4X9qjnfy4bFE/4HEbdJYRsWdg.ZC', 'user', NULL, '575458758', 'moodbidri'),
(30, 'MadhuraTandel', 'MadhuraTandel@gmail.com', '$2y$10$aM3h6TfkHwgy3X1W1Z7bZeSyi3cZwTLa0LB8ltDPCVjmQQb.yNH3K', 'user', NULL, '8542157849', 'gangolli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `donors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
