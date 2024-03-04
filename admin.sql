-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 04:02 PM
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
-- Database: `liabilitymanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile_image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for tables `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile_image`) VALUES
(1, 'Alaa Harmoush', 'alaaharmoush6122003@outlook.com', 'admin', 0x75706c6f6164732f576861747341707020496d61676520323032342d30312d333020617420352e32342e303720504d2e6a706567),
(19, 'test', 'testingourtest@test.com', 'admin', NULL),
(21, 'Dani kais', 'dankais44@gmail.com', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currentliabilities`
--

CREATE TABLE `currentliabilities` (
  `LiabilityID` int(11) NOT NULL,
  `LiabilityName` varchar(255) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `DueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currentliabilities`
--

INSERT INTO `currentliabilities` (`LiabilityID`, `LiabilityName`, `Amount`, `DueDate`) VALUES
(1, 'Rent', 200.00, '2024-02-28'),
(2, 'Utilities', 100.00, '2024-02-25'),
(3, 'Accounts Payable', 150.00, '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `current_assets`
--

CREATE TABLE `current_assets` (
  `asset_id` int(11) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_value` decimal(15,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_assets`
--

INSERT INTO `current_assets` (`asset_id`, `asset_name`, `quantity`, `unit_price`, `total_value`, `purchase_date`, `expiry_date`, `notes`) VALUES
(1, 'Laptops', 15, 1200.00, 18000.00, '2023-01-10', NULL, 'High-end laptops for developers'),
(2, 'Desktop Computers', 10, 2000.00, 20000.00, '2023-02-05', NULL, 'Powerful desktop computers for development tasks'),
(3, 'Software Licenses', 20, 500.00, 10000.00, '2022-12-15', '2025-12-15', 'Annual licenses for development software'),
(4, 'Development Servers', 5, 5000.00, 25000.00, '2023-03-20', NULL, 'Servers for hosting development environments'),
(5, 'Test Devices', 30, 800.00, 24000.00, '2023-01-20', NULL, 'Various devices for testing applications'),
(6, 'Office Furniture', 1, 3000.00, 3000.00, '2023-01-02', NULL, 'Office desks and chairs for developers'),
(7, 'Networking Equipment', 2, 1500.00, 3000.00, '2023-02-10', NULL, 'Routers and switches for network infrastructure');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `phone_number`, `address`) VALUES
(2, 'fadi ajab', 'fadi@gmail.com', '123456789', 'simquaneye al shouf'),
(5, 'same makarem', 'samemak1@outlook.com', '15394562', 'beirut');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `category`, `amount`, `date_added`) VALUES
(1, 'hosting', 90.00, '2024-02-22'),
(2, 'Utility', 210.00, '2024-02-22'),
(3, 'salaries', 900.00, '2024-02-22'),
(4, 'network', 60.00, '2024-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_table`
--

CREATE TABLE `expenses_table` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses_table`
--

INSERT INTO `expenses_table` (`id`, `amount`, `date`, `category`) VALUES
(1, 100.00, '2024-02-26', 'Utilities'),
(2, 200.00, '2024-02-26', 'Salaries'),
(3, 150.00, '2024-02-26', 'Hosting');

-- --------------------------------------------------------

--
-- Table structure for table `income_table`
--

CREATE TABLE `income_table` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_table`
--

INSERT INTO `income_table` (`id`, `amount`, `date`, `category`) VALUES
(1, 600.00, '2024-02-26', 'E-commerce project'),
(2, 700.00, '2024-02-26', 'E-commerce project'),
(3, 150.00, '2024-02-26', 'Domain + Hosting');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `item_price`, `created_at`) VALUES
(4, 'hosting', '1 year hosting', 120.00, '2024-02-22 16:24:47'),
(5, 'hosting', '4 Year Hosting', 370.00, '2024-02-27 15:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currentliabilities`
--
ALTER TABLE `currentliabilities`
  ADD PRIMARY KEY (`LiabilityID`);

--
-- Indexes for table `current_assets`
--
ALTER TABLE `current_assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_table`
--
ALTER TABLE `expenses_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_table`
--
ALTER TABLE `income_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `currentliabilities`
--
ALTER TABLE `currentliabilities`
  MODIFY `LiabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `current_assets`
--
ALTER TABLE `current_assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses_table`
--
ALTER TABLE `expenses_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income_table`
--
ALTER TABLE `income_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;