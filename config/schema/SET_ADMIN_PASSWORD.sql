-- ============================================
-- Set Admin Password to 'admin123'
-- ============================================
-- Run this if the default password doesn't work
-- This sets the password hash for 'admin123'

UPDATE `officers` 
SET `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE `username` = 'admin';

-- Verify it worked
SELECT username, role, full_name FROM `officers` WHERE `username` = 'admin';
