# Database Setup Instructions

## Option 1: Fresh Database (No existing data)

If you're starting fresh or want to recreate everything:

```bash
# 1. Create database (if not exists)
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS group_assignment CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 2. Import full schema
mysql -u root -p group_assignment < config/schema/schema.sql
```

Or via phpMyAdmin:
1. Open phpMyAdmin
2. Select/create your database `group_assignment`
3. Go to "Import" tab
4. Choose `config/schema/schema.sql`
5. Click "Go"

## Option 2: Existing Database (Keep existing data)

If you already have a database with data:

**IMPORTANT: Backup first!**
```bash
# Backup your database
mysqldump -u root -p group_assignment > backup_$(date +%Y%m%d_%H%M%S).sql
```

Then run migration:
```bash
# Run migration updates
mysql -u root -p group_assignment < config/schema/migration_updates.sql
```

**Note:** If you get errors about "IF NOT EXISTS" (older MySQL versions):
- MySQL 5.7 doesn't support `IF NOT EXISTS` for ALTER TABLE
- Manually check if columns exist first, or upgrade to MySQL 8.0+

### Manual Migration Steps (if automated fails):

```sql
-- 1. Check if columns exist
SHOW COLUMNS FROM `users` LIKE 'ic_number';
SHOW COLUMNS FROM `users` LIKE 'full_name';

-- 2. If columns don't exist, add them manually:
ALTER TABLE `users` 
ADD COLUMN `ic_number` varchar(20) DEFAULT NULL COMMENT 'IC Number for regular users' AFTER `status`,
ADD COLUMN `full_name` varchar(100) DEFAULT NULL COMMENT 'Full Name for regular users' AFTER `ic_number`;

-- 3. Update role enum
ALTER TABLE `users` MODIFY COLUMN `role` enum('admin','officer','user') NOT NULL;

-- 4. Add attachment fields to complaints (check first)
SHOW COLUMNS FROM `complaints` LIKE 'attachment_path';

-- If they don't exist:
ALTER TABLE `complaints`
ADD COLUMN `attachment_path` varchar(255) DEFAULT NULL COMMENT 'File attachment path' AFTER `deadline_at`,
ADD COLUMN `attachment_name` varchar(255) DEFAULT NULL COMMENT 'Original file name' AFTER `attachment_path`;
```

## Verify Database Setup

After running schema/migration, verify with:

```sql
-- Check users table structure
DESCRIBE `users`;

-- Check complaints table structure  
DESCRIBE `complaints`;

-- Check if reference data exists
SELECT * FROM `ref_status`;
SELECT * FROM `ref_priority`;
SELECT * FROM `departments`;
```

## Create Admin User (if needed)

If you need to create an admin user manually:

```sql
-- Password: 'admin123' (change this!)
INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', NOW());
```

Or register through the web interface at `/users/add`
