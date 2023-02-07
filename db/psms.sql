-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 03:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_logged_in` datetime DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `last_logged_in`, `created_at`) VALUES
(1, 'John Smith', 'john.smith@example.com', 'p@$$w0rd', NULL, '2023-01-15'),
(2, 'Jane Doe', 'jane.doe@example.com', 's3cureP@ss', NULL, '2023-01-15'),
(3, 'Bob Johnson', 'bob.johnson@example.com', 'B0bj0hn$0n', NULL, '2023-01-15'),
(4, 'Priyanshu Singh', 'iampriyanshu20@gmail.com', 'mypwd123', NULL, '2023-01-15'),
(5, 'Sagnik Sarkar', 'sagnik@gmail.com', 'admin@sagnik', NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `pet_id`, `quantity`, `min_quantity`, `max_quantity`) VALUES
(1, 1, 49, 20, 100),
(2, 2, 30, 10, 50),
(3, 3, 40, 20, 80),
(4, 4, 25, 10, 40),
(5, 5, 45, 20, 80),
(6, 6, 35, 15, 60),
(7, 7, 20, 10, 30),
(8, 8, 30, 15, 50),
(9, 9, 50, 25, 80),
(10, 10, 40, 20, 70),
(11, 11, 35, 15, 60);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'LIVE',
  `date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `user_id`, `pet_id`, `quantity`, `total_price`, `status`, `date`) VALUES
(1, 6, 4, 2, 700, 'CANCELED', '0000-00-00'),
(2, 3, 3, 5, 3000, 'LIVE', '2023-01-15'),
(3, 6, 4, 3, 1050, 'CANCELED', '2023-01-15'),
(12, 6, 4, 1, 350, 'CANCELED', '2023-01-15'),
(13, 6, 4, 1, 350, 'LIVE', '2023-01-15'),
(14, 6, 7, 1, 10, 'LIVE', '2023-01-15'),
(15, 6, 7, 1, 10, 'LIVE', '2023-01-15'),
(16, 6, 7, 3, 30, 'LIVE', '2023-01-15'),
(17, 7, 1, 1, 500, 'CANCELED', '2023-01-15');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `update_inventory_on_cancel` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    IF NEW.status = 'CANCELLED' THEN
        UPDATE inventory SET quantity = quantity + OLD.quantity
        WHERE pet_id = OLD.pet_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_inventory_on_order` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    UPDATE inventory SET quantity = quantity - NEW.quantity
    WHERE pet_id = NEW.pet_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pid` int(11) NOT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pid`, `species`, `breed`, `age`, `price`) VALUES
(1, 'Dog', 'Golden Retriever', 2, '500.00'),
(2, 'Dog', 'Labrador Retriever', 1, '400.00'),
(3, 'Dog', 'German Shepherd', 3, '600.00'),
(4, 'Cat', 'Siamese', 2, '350.00'),
(5, 'Cat', 'Persian', 1, '300.00'),
(6, 'Cat', 'Maine Coon', 3, '400.00'),
(7, 'Fish', 'Goldfish', 1, '10.00'),
(8, 'Fish', 'Koi', 2, '20.00'),
(9, 'Fish', 'Tetra', 3, '5.00'),
(10, 'Bird', 'Parakeet', 1, '50.00'),
(11, 'Bird', 'Cockatiel', 2, '40.00'),
(12, 'Bird', 'African Grey', 3, '300.00'),
(13, 'Dog', 'Pomeranian', 0, '600.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_logged_in` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `last_logged_in`, `created_at`) VALUES
(1, 'Michael Jordan', 'michael.jordan@example.com', 'p@$$w0rd', NULL, '2023-01-15 12:33:05'),
(2, 'Katy Perry', 'katy.perry@example.com', 's3cureP@ss', NULL, '2023-01-15 12:33:05'),
(3, 'David Beckham', 'david.beckham@example.com', 'B0bj0hn$0n', NULL, '2023-01-15 12:33:06'),
(6, 'Priyanshu Singh', 'iampriyanshu20@gmail.com', 'MYPWD123', NULL, '2023-01-15 13:09:31'),
(7, 'Sagnik Sarkar', 'sagnik@gmail.com', 'sagnik123', NULL, '2023-01-15 21:18:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
