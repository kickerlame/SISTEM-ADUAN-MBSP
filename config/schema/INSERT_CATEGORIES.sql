-- Insert Default Complaint Categories
-- Run this after creating departments table
-- These categories will be used in the complaint form dropdown for users

-- First, ensure you have at least one department (department_id = 1)
-- The COMPLETE_NEW_SCHEMA.sql already creates sample departments

-- Insert the 5 required categories for user complaint form
-- These will appear in the dropdown when users create new complaints
INSERT INTO `complaint_categories` (`department_id`, `category_name`, `created_at`) 
VALUES 
(1, 'Infrastructure', NOW()),
(1, 'Jalan Raya', NOW()),
(1, 'Elektrik', NOW()),
(1, 'Air', NOW()),
(1, 'Pest Control', NOW())
ON DUPLICATE KEY UPDATE category_name = category_name;

-- Note: If you get foreign key error, make sure department_id = 1 exists in departments table
-- The COMPLETE_NEW_SCHEMA.sql creates sample departments, so department_id = 1 should exist
