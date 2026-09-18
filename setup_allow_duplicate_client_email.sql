-- Migration: Allow duplicate email for clients across partners
-- Drops UNIQUE index on email and creates a standard non-unique index.

ALTER TABLE `users` DROP INDEX `email`;
ALTER TABLE `users` ADD INDEX `idx_email` (`email`);
