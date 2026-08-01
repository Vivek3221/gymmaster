-- ============================================================
-- PT Payroll Management Module - Database Setup
-- Run this SQL in your gymmaster database
-- ============================================================

CREATE TABLE IF NOT EXISTS `pt_rates` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `trainer_id` INT(11) NOT NULL,
    `rate_per_class` DECIMAL(10,2) NOT NULL,
    `effective_from` DATE NOT NULL,
    `status` TINYINT(1) DEFAULT 1,
    `created_by` INT(11) DEFAULT NULL,
    `updated_by` INT(11) DEFAULT NULL,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `pt_class_entries` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `trainer_id` INT(11) NOT NULL,
    `month` INT(2) NOT NULL,
    `year` INT(4) NOT NULL,
    `total_classes` INT(11) NOT NULL,
    `rate_per_class` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `notes` TEXT NULL,
    `created_by` INT(11) DEFAULT NULL,
    `updated_by` INT(11) DEFAULT NULL,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `trainer_month_year` (`trainer_id`, `month`, `year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `pt_payrolls` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `trainer_id` INT(11) NOT NULL,
    `class_entry_id` INT(11) NOT NULL,
    `rate_per_class` DECIMAL(10,2) NOT NULL,
    `total_classes` INT(11) NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'Pending',
    `payment_date` DATE DEFAULT NULL,
    `paid_by` INT(11) DEFAULT NULL,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
