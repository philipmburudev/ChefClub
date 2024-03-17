-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Generation Time: Feb 23, 2024 at 12:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

DROP DATABASE IF EXISTS chef_cl;
CREATE DATABASE chef_cl;
USE chef_cl;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chef_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userType` ENUM('Guest','Regular','Admin') NOT NULL,
  `text` MEDIUMTEXT NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `user` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fileName` VARCHAR(50) NOT NULL, 
  `type` ENUM('Image','Video') NOT NULL,
  `usedFor` ENUM('Asset','Content') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL, -- Increased length for title
  `ingredients` TEXT NOT NULL, -- Changed field name to lowercase
  `process` LONGTEXT NOT NULL, -- Changed field name to lowercase
  `author` VARCHAR(30) NOT NULL,
  `category` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

 
---ALTER TABLE `recipe` 
---ADD `image` VARCHAR(255) NOT NULL AFTER `category`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` VARCHAR(30) NOT NULL,
  `firstName` VARCHAR(30) NOT NULL,
  `lastName` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL, -- Increased length for password and hashed
  `access` ENUM('REGULAR','ADMIN') NOT NULL DEFAULT 'REGULAR',
  `email` VARCHAR(100) NOT NULL, -- Increased length for email
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email_UNIQUE` (`email`); -- Added unique index on email field for uniqueness
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;