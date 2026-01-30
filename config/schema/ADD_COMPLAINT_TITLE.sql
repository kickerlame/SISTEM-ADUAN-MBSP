-- Migration: Add complaint_title field to complaints table
-- Run this to add the complaint_title column

ALTER TABLE `complaints`
ADD COLUMN `complaint_title` varchar(255) NOT NULL COMMENT 'Title of the complaint' AFTER `complaint_no`;
