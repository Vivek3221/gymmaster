-- Plans Table SQL
-- Run this in your database to create the plans table

CREATE TABLE IF NOT EXISTS `plans` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `partner_id`  INT(11)      NOT NULL DEFAULT 0,
  `title`       VARCHAR(150) NOT NULL,
  `duration_months` TINYINT(3) NOT NULL COMMENT '1=1 Month, 2=2 Months, 3=3 Months, 6=6 Months, 12=12 Months',
  `days`        INT(11)      NOT NULL COMMENT 'Auto-calculated: duration_months * 30',
  `price`       DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `description` TEXT         NULL,
  `active`      TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created`     DATETIME     NULL,
  `modified`    DATETIME     NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_partner_id` (`partner_id`),
  INDEX `idx_active`     (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Also add subscription_start_date and reminder_date columns to plan_subscribers table
ALTER TABLE `plan_subscribers`
  ADD `subscription_start_date` DATE NULL AFTER `payment_due_date`,
  ADD `reminder_date`            DATE NULL AFTER `subscription_start_date`;

