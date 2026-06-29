-- ============================================================
-- Manual Collection Module - Database Setup
-- Run this SQL in your gymmaster database
-- ============================================================

-- 1. Add collection_type column to plan_subscribers table
ALTER TABLE `plan_subscribers` 
ADD COLUMN `collection_type` VARCHAR(20) NOT NULL DEFAULT 'normal' AFTER `id`;

-- 2. Create manual_collection_access table for email-based permissions
CREATE TABLE IF NOT EXISTS `manual_collection_access` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `added_by` VARCHAR(255) DEFAULT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Insert the initial allowed emails
INSERT INTO `manual_collection_access` (`email`, `added_by`, `is_active`, `created`, `modified`)
VALUES 
    ('ad1234@yopmail.com', 'system', 1, NOW(), NOW()),
    ('mukesh3221@gmail.com', 'system', 1, NOW(), NOW());
