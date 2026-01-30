<?php
/**
 * Safe Migration Script
 * 
 * This PHP script checks if columns exist before adding them
 * Run via browser: http://your-domain/config/schema/migration_safe.php
 * Or via CLI: php config/schema/migration_safe.php
 * 
 * WARNING: Make sure to set your database credentials below or use environment variables
 */

// Database configuration - UPDATE THESE or use from config/app_local.php
$db_host = 'localhost';
$db_name = 'group_assignment'; // Change to your database name
$db_user = 'root'; // Change to your database user
$db_pass = ''; // Change to your database password

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n\n";
    
    // Function to check if column exists
    function columnExists($pdo, $table, $column) {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM `{$table}` LIKE ?");
        $stmt->execute([$column]);
        return $stmt->rowCount() > 0;
    }
    
    // ============================================
    // Update Users Table
    // ============================================
    echo "=== Updating Users Table ===\n";
    
    // Add ic_number
    if (!columnExists($pdo, 'users', 'ic_number')) {
        $pdo->exec("ALTER TABLE `users` ADD COLUMN `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`");
        echo "✓ Added ic_number column\n";
    } else {
        echo "○ ic_number column already exists\n";
    }
    
    // Add full_name
    if (!columnExists($pdo, 'users', 'full_name')) {
        $pdo->exec("ALTER TABLE `users` ADD COLUMN `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`");
        echo "✓ Added full_name column\n";
    } else {
        echo "○ full_name column already exists\n";
    }
    
    // Update role enum
    try {
        $pdo->exec("ALTER TABLE `users` MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL");
        echo "✓ Updated role enum to include 'user'\n";
    } catch (PDOException $e) {
        echo "⚠ Could not update role enum: " . $e->getMessage() . "\n";
        echo "  (This might be OK if role is not an enum type)\n";
    }
    
    // ============================================
    // Update Complaints Table
    // ============================================
    echo "\n=== Updating Complaints Table ===\n";
    
    // Add attachment_path
    if (!columnExists($pdo, 'complaints', 'attachment_path')) {
        $pdo->exec("ALTER TABLE `complaints` ADD COLUMN `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path (optional)' AFTER `deadline_at`");
        echo "✓ Added attachment_path column\n";
    } else {
        echo "○ attachment_path column already exists\n";
    }
    
    // Add attachment_name
    if (!columnExists($pdo, 'complaints', 'attachment_name')) {
        $pdo->exec("ALTER TABLE `complaints` ADD COLUMN `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`");
        echo "✓ Added attachment_name column\n";
    } else {
        echo "○ attachment_name column already exists\n";
    }
    
    // ============================================
    // Success
    // ============================================
    echo "\n=== Migration Completed Successfully! ===\n";
    echo "Database has been updated with all required fields.\n";
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
