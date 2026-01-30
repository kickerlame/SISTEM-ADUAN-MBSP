-- ============================================
-- DROP ALL TABLES - Run this first if you get foreign key errors
-- ============================================
-- This will drop ALL tables in the database
-- Use this if you're getting foreign key constraint errors
-- ============================================

SET FOREIGN_KEY_CHECKS = 0;

-- Drop all possible tables (add more if you have others)
DROP TABLE IF EXISTS `complaint_attachments`;
DROP TABLE IF EXISTS `complaint_logs`;
DROP TABLE IF EXISTS `complaints`;
DROP TABLE IF EXISTS `complaint_categories`;
DROP TABLE IF EXISTS `complainants`;
DROP TABLE IF EXISTS `officers`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `departments`;
DROP TABLE IF EXISTS `ref_priority`;
DROP TABLE IF EXISTS `ref_status`;

-- If you have other tables, add them here
-- DROP TABLE IF EXISTS `your_other_table`;

SET FOREIGN_KEY_CHECKS = 1;

SELECT 'All tables dropped successfully!' AS Status;
