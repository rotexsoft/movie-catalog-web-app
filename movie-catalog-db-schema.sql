DROP DATABASE IF EXISTS `movie_catalog`;
CREATE DATABASE `movie_catalog`; 
USE `movie_catalog`; 

CREATE TABLE `movie_listings`( 
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `title` TEXT NOT NULL, 
    `release_year` VARCHAR(4) NOT NULL, 
    `genre` VARCHAR(255), 
    `duration_in_minutes` INT, 
    `mpaa_rating` VARCHAR(255), 
    `record_creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `record_last_modification_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`id`) 
); 

CREATE TABLE user_authentication_accounts (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `username` VARCHAR(255), 
    `password` VARCHAR(255),
    `record_creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `record_last_modification_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);
