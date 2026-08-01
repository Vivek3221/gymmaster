-- ============================================================
-- PT Plans & User-Centric PT Payroll System - Database Setup
-- Run this SQL in your gymmaster database
-- ============================================================

-- 1. PT Master Plans Table
CREATE TABLE IF NOT EXISTS `pt_plans` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `duration_months` INT(11) NOT NULL DEFAULT 1,
    `total_classes` INT(11) NOT NULL DEFAULT 12,
    `price` DECIMAL(10,2) NOT NULL,
    `per_class_rate` DECIMAL(10,2) NOT NULL,
    `status` TINYINT(1) DEFAULT 1,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Client PT Subscriptions Table
CREATE TABLE IF NOT EXISTS `user_pt_subscriptions` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `trainer_id` INT(11) NOT NULL,
    `pt_plan_id` INT(11) NOT NULL,
    `plan_name` VARCHAR(255) NOT NULL,
    `total_classes` INT(11) NOT NULL,
    `completed_classes` INT(11) NOT NULL DEFAULT 0,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `client_per_class_rate` DECIMAL(10,2) NOT NULL,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'Active',
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Add user & financial fields to pt_class_entries table (if not exists)
ALTER TABLE `pt_class_entries`
ADD COLUMN `user_id` INT(11) NULL AFTER `trainer_id`,
ADD COLUMN `user_pt_subscription_id` INT(11) NULL AFTER `user_id`,
ADD COLUMN `client_per_class_rate` DECIMAL(10,2) DEFAULT 0.00 AFTER `rate_per_class`,
ADD COLUMN `gym_profit` DECIMAL(10,2) DEFAULT 0.00 AFTER `client_per_class_rate`;

-- 4. Drop single trainer-month unique constraint if exists to support user-wise entries
ALTER TABLE `pt_class_entries` DROP INDEX `trainer_month_year`;
