-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2026 at 04:47 AM
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
-- Database: `cemetery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `graves`
--

CREATE TABLE `graves` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapi`
--

CREATE TABLE `mapi` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapi`
--

INSERT INTO `mapi` (`id`, `first_name`, `middle_name`, `last_name`, `plot_id`, `floor_number`, `circle_group`, `group_code`, `age_at_death`, `birth_date`, `death_date`, `created_at`, `contract_start`, `contract_end`) VALUES
(1, '123', '123', '123', 'A1', 1, 'A-01', 'A-01', 1, '2004-12-12', '2005-12-12', '2026-04-14 09:36:30', '2004-12-12', '2005-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `mapii`
--

CREATE TABLE `mapii` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapiii`
--

CREATE TABLE `mapiii` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapiv`
--

CREATE TABLE `mapiv` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapv`
--

CREATE TABLE `mapv` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) NOT NULL,
  `plot_id` varchar(10) NOT NULL DEFAULT 'A1',
  `floor_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `circle_group` varchar(10) NOT NULL DEFAULT 'A-01',
  `group_code` varchar(10) NOT NULL DEFAULT 'A-01',
  `age_at_death` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `graves`
--
ALTER TABLE `graves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapi`
--
ALTER TABLE `mapi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapii`
--
ALTER TABLE `mapii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapiii`
--
ALTER TABLE `mapiii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapiv`
--
ALTER TABLE `mapiv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapv`
--
ALTER TABLE `mapv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `graves`
--
ALTER TABLE `graves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mapi`
--
ALTER TABLE `mapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mapii`
--
ALTER TABLE `mapii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapiii`
--
ALTER TABLE `mapiii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapiv`
--
ALTER TABLE `mapiv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapv`
--
ALTER TABLE `mapv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
