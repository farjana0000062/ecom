-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 11:17 PM
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
-- Database: `shopper_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `tags`, `image`, `price`, `old_price`, `created_at`) VALUES
(1, 'Red Crop Top', 'Stylish red crop top', 'Women', 'Modern,Latest', 'images/product1.png', 29.99, 39.99, '2025-10-22 20:34:16'),
(2, 'Blue Jeans', 'Comfortable blue jeans', 'Men', 'Casual,Trendy', 'images/product2.png', 49.99, 59.99, '2025-10-22 20:34:16'),
(3, 'Kids T-shirt', 'Cute T-shirt for kids', 'Kids', 'Fun,Latest', 'images/product3.png', 19.99, 24.99, '2025-10-22 20:34:16'),
(4, 'Sneakers', 'White stylish sneakers', 'Unisex', 'Sporty,Latest', 'images/product4.png', 69.99, 79.99, '2025-10-22 20:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(5, '', 'farjanafarjo10@gmail.com', '$2y$10$N9iE4Lu6WjjHQtmnIr47vORoceG26p.Gr5j0y7WVenmBUm32TQyR2', '2025-10-22 20:38:53'),
(9, 'farjana10', 'farjana2223@gamil.com', '$2y$10$5M9BN8vxRPTfxAMP9WDHTuje4seQ8Bo3G0ffKNaNTWBQEihJkBfGK', '2025-10-22 20:48:32'),
(10, 'farjo10', 'anjuman676262@gmail.com', '$2y$10$u93IL2Y3EbDXPTFSEXmmh.Lb1O/QjNdu3grsFgChm2/cnw82DgmSG', '2025-10-22 20:59:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
