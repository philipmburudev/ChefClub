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


CREATE TABLE `users` ( 
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(30) NOT NULL,
  `firstName` VARCHAR(30) NOT NULL,
  `lastName` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `dob` DATE,
  `gender` ENUM('Male', 'Female', 'Other'),
  `contact` VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
  `fileName` VARCHAR(100) NOT NULL,
  `user_id` INT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





-- After creating both media and users table

ALTER TABLE `media`
ADD CONSTRAINT `fk_media_users`
FOREIGN KEY (`user_id`)
REFERENCES `users` (`id`)
ON DELETE SET NULL;

CREATE TABLE `recipe` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `ingredients` TEXT NOT NULL,
  `process` LONGTEXT NOT NULL,
  `author` VARCHAR(30) NOT NULL,
  `category` VARCHAR(30) NOT NULL,
  `media_id` INT NULL, -- Include media_id in the initial CREATE TABLE statement
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `recipe`
ADD CONSTRAINT `fk_recipe_media`
FOREIGN KEY (`media_id`)
REFERENCES `media` (`id`)
ON DELETE SET NULL;

ALTER TABLE `recipe`
ADD COLUMN `user_id` INT NULL,
ADD CONSTRAINT `fk_recipe_users`
FOREIGN KEY (`user_id`)
REFERENCES `users` (`id`)
ON DELETE SET NULL;

ALTER TABLE `users`
  ADD UNIQUE KEY `email_UNIQUE` (`email`); -- Added unique index on email field for uniqueness
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;