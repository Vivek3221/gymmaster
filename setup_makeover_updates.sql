-- ============================================================
-- Makeover Updates - Database Migration Script
-- Safe and idempotent database setup
-- ============================================================

-- 1. User ownership: track which staff/front-desk user added the client
ALTER TABLE `users`
ADD COLUMN `added_by` INT(11) NULL AFTER `trainer_userid`;

ALTER TABLE `users`
ADD INDEX `idx_users_added_by` (`added_by`);

-- 2. Payments: payment date, discount tracking, and audit/soft-delete
ALTER TABLE `payments`
ADD COLUMN `payment_date` DATE NULL AFTER `amount`,
ADD COLUMN `discount_percent` DECIMAL(5,2) DEFAULT 0.00 AFTER `payment_date`,
ADD COLUMN `discount_amount` DECIMAL(10,2) DEFAULT 0.00 AFTER `discount_percent`,
ADD COLUMN `discount_reason` TEXT NULL AFTER `discount_amount`,
ADD COLUMN `is_deleted` TINYINT(1) DEFAULT 0 AFTER `mode_ofpay`,
ADD COLUMN `deleted_by` INT(11) NULL AFTER `is_deleted`,
ADD COLUMN `deleted_at` DATETIME NULL AFTER `deleted_by`,
ADD COLUMN `deletion_reason` TEXT NULL AFTER `deleted_at`;

ALTER TABLE `payments`
ADD INDEX `idx_payments_payment_date` (`payment_date`),
ADD INDEX `idx_payments_is_deleted` (`is_deleted`);

-- 3. PT Payrolls: soft delete & audit
ALTER TABLE `pt_payrolls`
ADD COLUMN `is_deleted` TINYINT(1) DEFAULT 0 AFTER `status`,
ADD COLUMN `deleted_by` INT(11) NULL AFTER `is_deleted`,
ADD COLUMN `deleted_at` DATETIME NULL AFTER `deleted_by`,
ADD COLUMN `deletion_reason` TEXT NULL AFTER `deleted_at`;

ALTER TABLE `pt_payrolls`
ADD INDEX `idx_pt_payrolls_is_deleted` (`is_deleted`);

-- 4. Delegated permissions table for payment and payout deletion
CREATE TABLE IF NOT EXISTS `payment_delete_permissions` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `granted_by` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert initial root users as active
INSERT INTO `payment_delete_permissions` (`email`, `granted_by`, `is_active`, `created`, `modified`)
VALUES 
    ('mukeshkr3221@gmail.com', 'system_root', 1, NOW(), NOW()),
    ('ad1234@yopmail.com', 'system_root', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE is_active = 1, modified = NOW();
