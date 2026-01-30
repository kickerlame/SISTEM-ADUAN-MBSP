-- ============================================
-- SIMPLE UPDATE - Copy & Paste This Entire File
-- ============================================
-- If you get "Duplicate column" errors, that's OK - just means columns already exist
-- You can safely ignore those errors and continue
-- ============================================

-- Update Users Table
ALTER TABLE `users` ADD COLUMN `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`;
ALTER TABLE `users` ADD COLUMN `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`;
ALTER TABLE `users` MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- Update Complaints Table
ALTER TABLE `complaints` ADD COLUMN `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`;
ALTER TABLE `complaints` ADD COLUMN `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`;
