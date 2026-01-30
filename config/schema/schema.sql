-- MBSP Complaint Management System Database Schema
-- Based on code changes and entity structures

-- Users Table (Updated with ic_number and full_name for regular users)
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','officer','user') NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users',
  `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Departments Table
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Officers Table
CREATE TABLE IF NOT EXISTS `officers` (
  `officer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`officer_id`),
  UNIQUE KEY `staff_id` (`staff_id`),
  KEY `user_id` (`user_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `officers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `officers_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Complaint Categories Table
CREATE TABLE IF NOT EXISTS `complaint_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `complaint_categories_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reference Status Table
CREATE TABLE IF NOT EXISTS `ref_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_color` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reference Priority Table
CREATE TABLE IF NOT EXISTS `ref_priority` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_label` varchar(50) NOT NULL,
  `sla_hours` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Complainants Table
CREATE TABLE IF NOT EXISTS `complainants` (
  `complainant_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `ic_number` varchar(20) NOT NULL,
  `phone_mobile` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`complainant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Complaints Table (Updated - removed latitude/longitude fields from forms)
CREATE TABLE IF NOT EXISTS `complaints` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_no` varchar(50) NOT NULL,
  `complainant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `officer_id` int(11) DEFAULT NULL COMMENT 'Assigned officer (assigned by admin)',
  `location_address` text NOT NULL,
  `district` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL COMMENT 'Optional - removed from forms',
  `longitude` decimal(11,8) DEFAULT NULL COMMENT 'Optional - removed from forms',
  `is_validated` tinyint(1) DEFAULT 0,
  `deadline_at` datetime DEFAULT NULL,
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

-- Complaint Logs Table
CREATE TABLE IF NOT EXISTS `complaint_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL COMMENT 'Status after change',
  `action_taken` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `complaint_id` (`complaint_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `complaint_logs_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`) ON DELETE CASCADE,
  CONSTRAINT `complaint_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Data for Reference Tables

-- Insert default statuses
INSERT INTO `ref_status` (`status_name`, `status_color`) VALUES
('Baru', '#FF6384'),
('Dalam Proses', '#36A2EB'),
('Menunggu', '#FFCE56'),
('Selesai', '#4BC0C0');

-- Insert default priorities (with color coding: normal-green, critical-yellow, segera-red)
INSERT INTO `ref_priority` (`priority_label`, `sla_hours`) VALUES
('Normal', 72),
('Critical', 24),
('Segera', 4);

-- Insert default departments (example)
INSERT INTO `departments` (`department_name`, `description`) VALUES
('Pengurusan Aduan', 'Department for managing complaints'),
('Kejuruteraan', 'Engineering Department'),
('Penyelenggaraan', 'Maintenance Department'),
('Perkhidmatan Awam', 'Public Services Department');

-- Migration Script to Update Existing Tables
-- Run this if you already have tables and need to update them

-- Add new columns to users table (if not exist)
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`,
ADD COLUMN IF NOT EXISTS `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`;

-- Update users table to support 'user' role (if using enum)
ALTER TABLE `users` MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- Add attachment fields to complaints table (if not exist)
ALTER TABLE `complaints`
ADD COLUMN IF NOT EXISTS `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`,
ADD COLUMN IF NOT EXISTS `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`;

-- Update complaint_logs to use status_id instead of status_after if needed
-- ALTER TABLE `complaint_logs` CHANGE COLUMN `status_after` `status_id` int(11) DEFAULT NULL;
