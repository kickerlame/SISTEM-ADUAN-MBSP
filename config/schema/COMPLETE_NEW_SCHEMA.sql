-- ============================================
-- MBSP Complaint Management System
-- COMPLETE FRESH DATABASE SCHEMA
-- ============================================
-- This will DELETE all existing tables and recreate them
-- BACKUP YOUR DATA FIRST!
-- ============================================

-- Drop all existing tables (in reverse order of dependencies)
-- Disable foreign key checks to allow dropping tables with dependencies
SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables that might have foreign keys first
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

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- 1. REFERENCE TABLES
-- ============================================

-- Reference Status Table
CREATE TABLE `ref_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_color` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reference Priority Table
CREATE TABLE `ref_priority` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_label` varchar(50) NOT NULL,
  `sla_hours` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Departments Table
CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. OFFICERS TABLE (Admin/Staff - Combined with old users)
-- ============================================
-- This replaces the old users table for admin/officer roles
CREATE TABLE `officers` (
  `officer_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT 'Login username',
  `password` varchar(255) NOT NULL COMMENT 'Hashed password',
  `role` enum('admin','officer') NOT NULL COMMENT 'admin or officer',
  `status` varchar(50) DEFAULT NULL COMMENT 'active, inactive, etc',
  `full_name` varchar(100) NOT NULL COMMENT 'Full name of officer',
  `staff_id` varchar(20) NOT NULL COMMENT 'Staff ID number',
  `department_id` int(11) NOT NULL COMMENT 'Department assignment',
  `phone_no` varchar(20) DEFAULT NULL COMMENT 'Phone number',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`officer_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `staff_id` (`staff_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `officers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. USERS TABLE (Public Users Only)
-- ============================================
-- This is NEW - for regular public users who file complaints
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT 'Login username (usually email or IC)',
  `password` varchar(255) NOT NULL COMMENT 'Hashed password',
  `ic_number` varchar(20) NOT NULL COMMENT 'IC Number (required)',
  `full_name` varchar(100) NOT NULL COMMENT 'Full Name (required)',
  `email` varchar(100) DEFAULT NULL COMMENT 'Email address',
  `phone_mobile` varchar(20) DEFAULT NULL COMMENT 'Mobile phone',
  `status` varchar(50) DEFAULT 'active' COMMENT 'active, inactive, etc',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `ic_number` (`ic_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. COMPLAINANTS TABLE
-- ============================================
CREATE TABLE `complainants` (
  `complainant_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `ic_number` varchar(12) NOT NULL,
  `phone_mobile` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`complainant_id`),
  UNIQUE KEY `ic_number` (`ic_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. COMPLAINT CATEGORIES TABLE
-- ============================================
CREATE TABLE `complaint_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `complaint_categories_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 6. COMPLAINTS TABLE
-- ============================================
-- Updated: officer_id now references officers table
-- Updated: Added attachment fields for file uploads
CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_no` varchar(50) NOT NULL COMMENT 'Auto-generated complaint number',
  `complaint_title` varchar(255) NOT NULL COMMENT 'Title of the complaint',
  `complainant_id` int(11) NOT NULL COMMENT 'Who filed the complaint',
  `category_id` int(11) NOT NULL COMMENT 'Complaint category',
  `status_id` int(11) NOT NULL COMMENT 'Current status',
  `priority_id` int(11) NOT NULL COMMENT 'Priority level',
  `officer_id` int(11) DEFAULT NULL COMMENT 'Assigned officer (assigned by admin)',
  `location_address` text NOT NULL COMMENT 'Location of complaint',
  `district` varchar(50) NOT NULL COMMENT 'District: SPU, SPT, or SPS',
  `details` text NOT NULL COMMENT 'Complaint details',
  `latitude` decimal(10,8) DEFAULT NULL COMMENT 'Optional GPS latitude',
  `longitude` decimal(11,8) DEFAULT NULL COMMENT 'Optional GPS longitude',
  `is_validated` tinyint(1) DEFAULT 0 COMMENT 'Validation status',
  `deadline_at` datetime DEFAULT NULL COMMENT 'Deadline for resolution',
  `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)',
  `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_id`),
  UNIQUE KEY `complaint_no` (`complaint_no`),
  KEY `complainant_id` (`complainant_id`),
  KEY `category_id` (`category_id`),
  KEY `status_id` (`status_id`),
  KEY `priority_id` (`priority_id`),
  KEY `officer_id` (`officer_id`),
  CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`complainant_id`) REFERENCES `complainants` (`complainant_id`) ON DELETE RESTRICT,
  CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `complaint_categories` (`category_id`) ON DELETE RESTRICT,
  CONSTRAINT `complaints_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `ref_status` (`status_id`) ON DELETE RESTRICT,
  CONSTRAINT `complaints_ibfk_4` FOREIGN KEY (`priority_id`) REFERENCES `ref_priority` (`priority_id`) ON DELETE RESTRICT,
  CONSTRAINT `complaints_ibfk_5` FOREIGN KEY (`officer_id`) REFERENCES `officers` (`officer_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. COMPLAINT LOGS TABLE
-- ============================================
-- Updated: user_id can reference either officers or users
-- Note: For officer actions, use officer_id in separate field if needed
CREATE TABLE `complaint_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Can be user_id or officer_id depending on who made change',
  `status_id` int(11) DEFAULT NULL COMMENT 'Status after change',
  `action_taken` varchar(255) NOT NULL COMMENT 'Action description',
  `notes` text DEFAULT NULL COMMENT 'Additional notes',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `complaint_id` (`complaint_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `complaint_logs_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`) ON DELETE CASCADE,
  CONSTRAINT `complaint_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 8. INSERT DEFAULT/SAMPLE DATA
-- ============================================

-- Insert default statuses
INSERT INTO `ref_status` (`status_name`, `status_color`) VALUES
('Baru', '#FF6384'),
('Dalam Proses', '#36A2EB'),
('Menunggu', '#FFCE56'),
('Selesai', '#4BC0C0');

-- Insert default priorities (color coding: normal=green, critical=yellow, segera=red)
INSERT INTO `ref_priority` (`priority_label`, `sla_hours`) VALUES
('Normal', 72),
('Critical', 24),
('Segera', 4);

-- Insert sample departments
INSERT INTO `departments` (`department_name`, `description`) VALUES
('Pengurusan Aduan', 'Department for managing complaints'),
('Kejuruteraan', 'Engineering Department'),
('Penyelenggaraan', 'Maintenance Department'),
('Perkhidmatan Awam', 'Public Services Department');

-- Insert default complaint categories (for user complaint form)
INSERT INTO `complaint_categories` (`department_id`, `category_name`, `created_at`) VALUES
(1, 'Infrastructure', NOW()),
(1, 'Jalan Raya', NOW()),
(1, 'Elektrik', NOW()),
(1, 'Air', NOW()),
(1, 'Pest Control', NOW());

-- Insert sample admin officer (password: admin123)
-- You should change this password after first login!
INSERT INTO `officers` (`username`, `password`, `role`, `status`, `full_name`, `staff_id`, `department_id`, `created_at`) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', 'System Administrator', 'ADM001', 1, NOW());

-- ============================================
-- SUCCESS MESSAGE
-- ============================================
SELECT 'Database schema created successfully!' AS Status,
       'New structure: officers (admin/staff), users (public users), all relationships updated' AS Note;
