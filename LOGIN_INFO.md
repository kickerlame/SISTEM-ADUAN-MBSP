# Login Information & Access Guide

## 🚀 How to Access the System

### URL:
```
http://localhost/group_assignment
```
or
```
http://localhost/group_assignment/users/login
```

## 🔐 Default Admin Login

After running the database schema, you can login with:

**Username:** `admin`  
**Password:** `admin123`

**Note:** The default password is `admin123`. **CHANGE THIS IMMEDIATELY** after first login for security!

## 📝 Default User Created

The schema automatically creates one admin user:
- **Username:** admin
- **Password:** admin123 (hashed in database)
- **Role:** admin
- **Full Name:** System Administrator
- **Staff ID:** ADM001
- **Department:** Pengurusan Aduan (Department ID: 1)

## 🔄 How to Change Password

### Option 1: Via Web Interface (After Login)
1. Login as admin
2. Go to Officers section
3. Edit your admin account
4. Change password
5. Save

### Option 2: Via Database (Direct SQL)
```sql
-- Change admin password to 'newpassword123'
-- This will hash the password automatically
UPDATE `officers` 
SET `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE `username` = 'admin';
```

**Better:** Use PHP to generate proper hash:
```php
<?php
echo password_hash('your_new_password', PASSWORD_DEFAULT);
?>
```
Then update the database with the generated hash.

## 👥 User Types & Access

### 1. **Admin** (Officers table, role='admin')
- Full system access
- Can manage all complaints
- Can assign officers to complaints
- Can manage officers, departments, categories
- Can view all complaints

### 2. **Officer** (Officers table, role='officer')
- Can view assigned complaints only
- Can update complaint status
- Limited access

### 3. **User** (Users table - Public users)
- Can register and login
- Can file complaints
- Can view their own complaints
- Cannot access admin areas

## 🆕 Creating New Officers/Admins

### Via Web Interface:
1. Login as admin
2. Go to "Officers" menu
3. Click "Add Officer"
4. Fill in:
   - Username
   - Password
   - Role (admin or officer)
   - Full Name
   - Staff ID
   - Department
   - Phone (optional)
5. Save

### Via SQL (Direct):
```sql
-- Create new admin officer
INSERT INTO `officers` 
(`username`, `password`, `role`, `status`, `full_name`, `staff_id`, `department_id`, `created_at`) 
VALUES 
('newadmin', '$2y$10$...hashed_password...', 'admin', 'active', 'New Admin Name', 'ADM002', 1, NOW());

-- Create new officer
INSERT INTO `officers` 
(`username`, `password`, `role`, `status`, `full_name`, `staff_id`, `department_id`, `created_at`) 
VALUES 
('officer1', '$2y$10$...hashed_password...', 'officer', 'active', 'Officer Name', 'OFF001', 1, NOW());
```

## 🔍 Troubleshooting

### Can't Login?
1. Check database connection in `config/app_local.php`
2. Verify the `officers` table exists and has the admin user
3. Check browser console for errors
4. Clear browser cache/cookies

### Password Not Working?
1. The password is case-sensitive
2. Make sure you're using: `admin123` (lowercase)
3. If still not working, reset via SQL (see above)

### Page Not Found?
- Make sure you're accessing: `http://localhost/group_assignment`
- Check if Laragon/Apache is running
- Verify the project folder name matches the URL

## 📞 Quick Test

After login, you should see:
- Dashboard/Complaints page
- Navigation menu with: Complaints, Officers, Departments, Categories, Complainants (if admin)
- Your username and role displayed in top nav
- Logout button

## ⚠️ Security Reminder

**IMPORTANT:** Change the default admin password immediately after first login!
