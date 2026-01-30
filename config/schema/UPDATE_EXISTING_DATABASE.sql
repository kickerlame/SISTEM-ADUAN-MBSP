-- ============================================
-- UPDATE EXISTING DATABASE - PASTE THIS IN PHPADMIN SQL TAB
-- ============================================
-- This script updates your existing database with new fields
-- Safe to run even if some columns already exist
-- Copy and paste everything below into phpMyAdmin SQL tab

-- ============================================
-- STEP 1: Update Users Table
-- ============================================

-- Add ic_number column (if not exists)
SET @dbname = DATABASE();
SET @tablename = "users";
SET @columnname = "ic_number";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (TABLE_SCHEMA = @dbname)
      AND (TABLE_NAME = @tablename)
      AND (COLUMN_NAME = @columnname)
  ) > 0,
  "SELECT 1",
  CONCAT("ALTER TABLE ", @tablename, " ADD COLUMN ", @columnname, " varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`")
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Add full_name column (if not exists)
SET @columnname = "full_name";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (TABLE_SCHEMA = @dbname)
      AND (TABLE_NAME = @tablename)
      AND (COLUMN_NAME = @columnname)
  ) > 0,
  "SELECT 1",
  CONCAT("ALTER TABLE ", @tablename, " ADD COLUMN ", @columnname, " varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`")
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Update role enum to include 'user' (safe - won't break if already updated)
-- Only run this if role column is ENUM type
ALTER TABLE `users` 
MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- ============================================
-- STEP 2: Update Complaints Table
-- ============================================

-- Add attachment_path column (if not exists)
SET @tablename = "complaints";
SET @columnname = "attachment_path";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (TABLE_SCHEMA = @dbname)
      AND (TABLE_NAME = @tablename)
      AND (COLUMN_NAME = @columnname)
  ) > 0,
  "SELECT 1",
  CONCAT("ALTER TABLE ", @tablename, " ADD COLUMN ", @columnname, " varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`")
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Add attachment_name column (if not exists)
SET @columnname = "attachment_name";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (TABLE_SCHEMA = @dbname)
      AND (TABLE_NAME = @tablename)
      AND (COLUMN_NAME = @columnname)
  ) > 0,
  "SELECT 1",
  CONCAT("ALTER TABLE ", @tablename, " ADD COLUMN ", @columnname, " varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`")
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- ============================================
-- VERIFICATION (Optional - uncomment to check)
-- ============================================
-- DESCRIBE `users`;
-- DESCRIBE `complaints`;

-- ============================================
-- SUCCESS MESSAGE
-- ============================================
SELECT 'Database update completed successfully!' AS Status,
       'New columns: users.ic_number, users.full_name, complaints.attachment_path, complaints.attachment_name' AS Changes;
