-- ===================================================
-- Ceylon Therapist Database Schema
-- Architecture: MySQL InnoDB / utf8mb4_unicode_ci
-- ===================================================

CREATE DATABASE IF NOT EXISTS `ceylon_therapist` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ceylon_therapist`;

-- ---------------------------------------------------
-- Table 1: admins (Dedicated Administrator Accounts)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `profile_image` VARCHAR(255) NULL,
    `status` ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE',
    `last_login_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 2: service_categories (GENERAL, FOR_HER, COUPLES)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT NULL,
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 3: services (Therapies & Treatments)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `services` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `short_description` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `duration_minutes` INT UNSIGNED DEFAULT 60,
    `image` VARCHAR(255) NULL,
    `status` ENUM('ACTIVE', 'INACTIVE') DEFAULT 'ACTIVE',
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT `fk_services_category` FOREIGN KEY (`category_id`) 
        REFERENCES `service_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 4: packages (Wellness Packages)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `packages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `short_description` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `duration_minutes` INT UNSIGNED DEFAULT 90,
    `image` VARCHAR(255) NULL,
    `status` ENUM('ACTIVE', 'INACTIVE') DEFAULT 'ACTIVE',
    `display_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 5: package_services (Package & Service pivot)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `package_services` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `package_id` INT UNSIGNED NOT NULL,
    `service_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `fk_ps_package` FOREIGN KEY (`package_id`) 
        REFERENCES `packages` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ps_service` FOREIGN KEY (`service_id`) 
        REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 6: site_settings (General Business Config)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_settings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 7: contact_settings (Contact Info)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_settings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `phone` VARCHAR(50) NULL,
    `whatsapp` VARCHAR(50) NULL,
    `email` VARCHAR(100) NULL,
    `address` TEXT NULL,
    `working_hours` VARCHAR(150) NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 8: enquiries (WhatsApp & Email Bookings)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `enquiries` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `service_id` INT UNSIGNED NULL,
    `package_id` INT UNSIGNED NULL,
    `customer_name` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NULL,
    `email` VARCHAR(150) NULL,
    `preferred_date` DATE NULL,
    `preferred_time` VARCHAR(50) NULL,
    `message` TEXT NULL,
    `source` ENUM('WHATSAPP', 'EMAIL') DEFAULT 'WHATSAPP',
    `status` ENUM('NEW', 'CONTACTED', 'CONFIRMED', 'CANCELLED', 'COMPLETED') DEFAULT 'NEW',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_enquiries_service` FOREIGN KEY (`service_id`) 
        REFERENCES `services` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_enquiries_package` FOREIGN KEY (`package_id`) 
        REFERENCES `packages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------
-- Table 9: media (Media Library Uploaded Files)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `media` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `filename` VARCHAR(255) NOT NULL,
    `stored_name` VARCHAR(255) NOT NULL,
    `path` VARCHAR(255) NOT NULL,
    `mime_type` VARCHAR(100) NOT NULL,
    `file_size` INT UNSIGNED NOT NULL DEFAULT 0,
    `alt_text` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

