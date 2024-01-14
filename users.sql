CREATE DATABASE IF NOT EXISTS `usersdb`;

USE usersdb;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fullname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `mobileNumber` VARCHAR(15) NOT NULL,
    `addr` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

