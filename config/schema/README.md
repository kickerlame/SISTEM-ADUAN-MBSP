# Database Schema Files

This directory contains SQL schema files for the MBSP Complaint Management System.

## Files:

### 1. `schema.sql`
Complete database schema with all tables. Use this to create a fresh database from scratch.

**Usage:**
```bash
mysql -u your_username -p your_database_name < config/schema/schema.sql
```

Or import via phpMyAdmin or your preferred database tool.

### 2. `migration_updates.sql`
Migration script to update existing databases with new fields based on code changes.

**Important Notes:**
- **Backup your database before running migrations!**
- Some MySQL versions may not support `IF NOT EXISTS` for `ALTER TABLE ADD COLUMN`
- If you get errors, manually check if columns exist before running the SQL
- The migration script adds:
  - `ic_number` and `full_name` fields to `users` table (for regular users)
  - `attachment_path` and `attachment_name` fields to `complaints` table (for file uploads)
  - Updates `role` enum to include 'user' role

**Usage:**
```bash
mysql -u your_username -p your_database_name < config/schema/migration_updates.sql
```

### 3. `i18n.sql`
Internationalization table for translations (CakePHP standard).

### 4. `sessions.sql`
Sessions table for storing PHP sessions (CakePHP standard).

## Database Structure Overview:

### Core Tables:
- **users** - System users (admin, officer, user roles)
  - Added: `ic_number`, `full_name` for regular users
- **officers** - Officer profiles linked to users
- **departments** - Organization departments
- **complaint_categories** - Categories of complaints
- **ref_status** - Complaint statuses (Baru, Dalam Proses, Menunggu, Selesai)
- **ref_priority** - Priority levels (Normal=green, Critical=yellow, Segera=red)
- **complainants** - People who file complaints
- **complaints** - Main complaints table
  - Added: `attachment_path`, `attachment_name` for file uploads
  - Note: `latitude` and `longitude` exist but are not shown in forms
- **complaint_logs** - Audit trail for complaint changes

## Key Changes Based on Code Updates:

1. **Users Table**: Now supports regular users with IC number and full name
2. **Complaints Table**: Added file attachment support
3. **Role System**: Users can be 'admin', 'officer', or 'user'
4. **Officer Assignment**: Complaints can be assigned to officers by admins

## Priority Color Coding:
- Normal = Green (#28a745)
- Critical = Yellow (#ffc107) 
- Segera = Red (#dc3545)

## After Running Schema:

1. Default data will be inserted for:
   - Statuses (Baru, Dalam Proses, Menunggu, Selesai)
   - Priorities (Normal, Critical, Segera)
   - Departments (sample data)

2. You may need to create initial admin user manually:
```sql
INSERT INTO `users` (`username`, `password`, `role`, `status`) 
VALUES ('admin', '$2y$10$...hashed_password...', 'admin', 'active');
```

## Troubleshooting:

If you encounter errors:
1. Check MySQL version (needs 5.7+ for better compatibility)
2. Verify database charset is utf8mb4
3. Check if foreign key constraints are enabled
4. Ensure you have proper permissions to create tables and alter schema
