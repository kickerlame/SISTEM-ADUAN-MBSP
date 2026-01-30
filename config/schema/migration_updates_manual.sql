-- Migration Script - MANUAL VERSION (Works on MySQL 5.7+)
-- Run each ALTER TABLE statement one at a time
-- If you get "Duplicate column" error, that column already exists (skip it)

-- ============================================
-- STEP 1: Check Current Structure
-- ============================================
-- First, check what columns already exist:
-- DESCRIBE `users`;
-- DESCRIBE `complaints`;

-- ============================================
-- STEP 2: Update Users Table
-- ============================================
-- Add ic_number column (run this, skip if you get "Duplicate column" error)
ALTER TABLE `users` 
ADD COLUMN `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`;

-- Add full_name column (run this, skip if you get "Duplicate column" error)
ALTER TABLE `users` 
ADD COLUMN `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`;

-- Update role enum to include 'user' (run this - may need adjustment if role is not enum)
ALTER TABLE `users` 
MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- ============================================
-- STEP 3: Update Complaints Table
-- ============================================
-- Add attachment_path column (run this, skip if you get "Duplicate column" error)
ALTER TABLE `complaints`
ADD COLUMN `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`;

-- Add attachment_name column (run this, skip if you get "Duplicate column" error)
ALTER TABLE `complaints`
ADD COLUMN `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`;

-- ============================================
-- STEP 4: Verify Changes
-- ============================================
-- Check the updated structure:
-- DESCRIBE `users`;
-- DESCRIBE `complaints`;
