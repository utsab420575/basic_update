﻿--
-- Script was generated by Devart dbForge Studio for MySQL, Version 6.3.358.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 1/8/2025 9:18:18 PM
-- Server version: 5.5.5-10.4.32-MariaDB
-- Client version: 4.1
--


-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

-- 
-- Set default database
--
USE website_update;

--
-- Definition for table failed_jobs
--
DROP TABLE IF EXISTS failed_jobs;
CREATE TABLE failed_jobs (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  uuid VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  queue TEXT NOT NULL,
  payload LONGTEXT NOT NULL,
  exception LONGTEXT NOT NULL,
  failed_at TIMESTAMP NOT NULL DEFAULT 'current_timestamp()',
  PRIMARY KEY (id),
  UNIQUE INDEX failed_jobs_uuid_unique (uuid)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Definition for table home_slides
--
DROP TABLE IF EXISTS home_slides;
CREATE TABLE home_slides (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT 'NULL',
  short_title VARCHAR(255) DEFAULT 'NULL',
  home_slide VARCHAR(255) DEFAULT 'NULL',
  video_url VARCHAR(255) DEFAULT 'NULL',
  created_at TIMESTAMP NULL DEFAULT 'NULL',
  updated_at TIMESTAMP NULL DEFAULT 'NULL',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Definition for table migrations
--
DROP TABLE IF EXISTS migrations;
CREATE TABLE migrations (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(255) NOT NULL,
  batch INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 13
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Definition for table password_reset_tokens
--
DROP TABLE IF EXISTS password_reset_tokens;
CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT 'NULL',
  PRIMARY KEY (email)
)
ENGINE = INNODB
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Definition for table personal_access_tokens
--
DROP TABLE IF EXISTS personal_access_tokens;
CREATE TABLE personal_access_tokens (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  tokenable_type VARCHAR(255) NOT NULL,
  tokenable_id BIGINT(20) UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  token VARCHAR(64) NOT NULL,
  abilities TEXT DEFAULT NULL,
  last_used_at TIMESTAMP NULL DEFAULT 'NULL',
  expires_at TIMESTAMP NULL DEFAULT 'NULL',
  created_at TIMESTAMP NULL DEFAULT 'NULL',
  updated_at TIMESTAMP NULL DEFAULT 'NULL',
  PRIMARY KEY (id),
  UNIQUE INDEX personal_access_tokens_token_unique (token),
  INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

--
-- Definition for table users
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT 'NULL',
  user_name VARCHAR(255) NOT NULL,
  profile_image VARCHAR(255) DEFAULT 'NULL',
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) DEFAULT 'NULL',
  created_at TIMESTAMP NULL DEFAULT 'NULL',
  updated_at TIMESTAMP NULL DEFAULT 'NULL',
  PRIMARY KEY (id),
  UNIQUE INDEX users_email_unique (email),
  UNIQUE INDEX users_user_name_unique (user_name)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 10922
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci
ROW_FORMAT = DYNAMIC;

-- 
-- Dumping data for table failed_jobs
--

-- Table website_update.failed_jobs does not contain any data (it is empty)

-- 
-- Dumping data for table home_slides
--
INSERT INTO home_slides VALUES
(1, 'sdfs', 'Your Trusted Partner', 'upload/home_slide/20250108151419_00460_Untitled.png', 'https://www.youtube.com/watch?v=iD6ThMYed9E', '2025-01-08 11:32:03', '2025-01-08 15:14:19'),
(2, 'Innovating the Future', 'Discover New Horizons', 'slide2.jpg', 'https://example.com/video2', '2025-01-08 11:32:03', '2025-01-08 11:32:03');

-- 
-- Dumping data for table migrations
--
INSERT INTO migrations VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2025_01_01_133349_add_user_name_to_users', 1),
(11, '2025_01_04_115626_add_profile_image_to_users', 2),
(12, '2025_01_08_112044_create_home_slides_table', 3);

-- 
-- Dumping data for table password_reset_tokens
--
INSERT INTO password_reset_tokens VALUES
('utsab@duet.ac.bd', '$2y$12$IU5vMWlyaw4oKar0.9lIQO2TLbgH4DVqY7cXrY4naAEcJA5Ien65y', '2025-01-03 14:29:20');

-- 
-- Dumping data for table personal_access_tokens
--

-- Table website_update.personal_access_tokens does not contain any data (it is empty)

-- 
-- Dumping data for table users
--
INSERT INTO users VALUES
(1, 'utsab vai', 'utsab@duet.ac.bd', NULL, 'utsab12345', '20250104145627_00550_styleist.jpg', '$2y$12$Kf5BRbkEJQ9pQ88Vn9/lFevyG4juXBAVSEG4.4NrgwI.hV5vdiZqO', 'BoTMsQevoS9VsED28g7zsaSX4Lg9KN3Q7NY5OtPmBcjiChEQH8xp3JdWcCsu', '2025-01-01 13:42:57', '2025-01-05 11:04:05'),
(2, 'utsab', 'utsab420575@gmail.com', NULL, 'utsab123456', '20250104141553_00688_dummy profile.png', '$2y$12$KlZ9AfA5UEg/HiZpDpxWIeWY0gjfklFA8hM8WUHFxoefCrwItXzp.', NULL, '2025-01-02 05:06:04', '2025-01-04 14:15:53'),
(3, 'utsab', 'utsab1@gmail.com', NULL, 'utsab1234567', NULL, '$2y$12$FVb4Uzq9Fk/EZK8kDYyTjuxrznsF3DyVncjq3AKmfKydFcEdtTn0e', NULL, '2025-01-02 14:17:30', '2025-01-02 14:17:30');

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;