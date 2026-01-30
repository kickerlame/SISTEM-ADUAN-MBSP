-- Migration Script to Update Existing Database
-- Run this file if you already have tables and need to update them based on code changes
-- Make sure to backup your database before running these migrations

-- ============================================
-- 1. Update Users Table - Add fields for regular users
-- ============================================
-- NOTE: For MySQL 5.7 and below, IF NOT EXISTS is not supported
-- Check if columns exist first, then add if they don't
-- Or simply run these - they will error if columns already exist (safe to ignore)

-- Step 1: Check if columns exist (run these to check)
-- DESCRIBE `users`; 
-- Look for 'ic_number' and 'full_name' in the output

-- Step 2: Add columns (will error if already exist - that's OK)
-- Remove comments (--) when ready to run

-- ALTER TABLE `users` 
-- ADD COLUMN `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`;

-- ALTER TABLE `users` 
-- ADD COLUMN `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`;

-- Update users table to support 'user' role (if using enum)
-- Note: If your role column is not enum, this may fail - adjust accordingly
ALTER TABLE `users` 
MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- ============================================
-- 2. Update Complaints Table - Add attachment support
-- ============================================
-- Check first: DESCRIBE `complaints`; (look for attachment_path and attachment_name)
-- Then run these one at a time:

-- ALTER TABLE `complaints`
-- ADD COLUMN `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`;

-- ALTER TABLE `complaints`
-- ADD COLUMN `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`;

-- Note: latitude and longitude fields are kept in the table but removed from forms
-- They remain as optional fields in the database

-- ============================================
-- 3. Update Complaint Logs - Change status_after to status_id (if needed)
-- ============================================
-- Uncomment below if you need to rename status_after to status_id
-- ALTER TABLE `complaint_logs` CHANGE COLUMN `status_after` `status_id` int(11) DEFAULT NULL;

-- ============================================
-- 4. Verify Foreign Key Constraints
-- ============================================
-- Make sure all foreign keys are properly set
-- This should already be in place if tables were created correctly

-- ============================================
-- NOTES:
-- ============================================
-- 1. The latitude and longitude columns remain in the database but are not shown in forms
-- 2. Users table now supports 'user' role for regular public users
-- 3. Regular users can have ic_number and full_name for identification
-- 4. Complaints can have optional file attachments via attachment_path and attachment_name
