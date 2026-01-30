# 🔗 All Access Links & Testing Guide

## 🌐 Base URL
```
http://localhost/group_assignment
```

---

## 👤 LOGIN PAGES

### Admin/Officer Login
```
http://localhost/group_assignment/users/login
```
**Default Admin:**
- Username: `admin`
- Password: `admin123`

### Public User Registration
```
http://localhost/group_assignment/users/add
```
**For public users to register:**
- Username
- Password
- IC Number (required)
- Full Name (required)
- Email (optional)
- Phone (optional)

### Public User Login
```
http://localhost/group_assignment/users/login
```
**Same login page - system checks both Officers and Users tables**

---

## 🏠 MAIN PAGES (After Login)

### Complaints Dashboard
```
http://localhost/group_assignment/complaints
http://localhost/group_assignment/complaints/index
```

### Add New Complaint (Public Users Only)
```
http://localhost/group_assignment/complaints/add
```
*Note: Admin cannot add complaints - only view/manage*

### View Complaint
```
http://localhost/group_assignment/complaints/view/{id}
```
Example: `http://localhost/group_assignment/complaints/view/1`

### Edit Complaint
```
http://localhost/group_assignment/complaints/edit/{id}
```

---

## 👥 ADMIN PAGES (Admin Only)

### Officers Management
```
http://localhost/group_assignment/officers
http://localhost/group_assignment/officers/index
http://localhost/group_assignment/officers/add
http://localhost/group_assignment/officers/view/{id}
http://localhost/group_assignment/officers/edit/{id}
```

### Users Management (Public Users)
```
http://localhost/group_assignment/users
http://localhost/group_assignment/users/index
http://localhost/group_assignment/users/view/{id}
http://localhost/group_assignment/users/edit/{id}
```

### Departments
```
http://localhost/group_assignment/departments
http://localhost/group_assignment/departments/index
http://localhost/group_assignment/departments/add
http://localhost/group_assignment/departments/view/{id}
http://localhost/group_assignment/departments/edit/{id}
```

### Complaint Categories
```
http://localhost/group_assignment/complaint-categories
http://localhost/group_assignment/complaint-categories/index
http://localhost/group_assignment/complaint-categories/add
```

### Complainants
```
http://localhost/group_assignment/complainants
http://localhost/group_assignment/complainants/index
http://localhost/group_assignment/complainants/view/{id}
```
*Note: Admin cannot add complainants - they register when filing complaints*

### Reference Status
```
http://localhost/group_assignment/ref-status
http://localhost/group_assignment/ref-status/index
```

### Reference Priority
```
http://localhost/group_assignment/ref-priority
http://localhost/group_assignment/ref-priority/index
```

---

## 📝 PUBLIC PAGES (No Login Required)

### Submit Complaint (Public)
```
http://localhost/group_assignment/pintas
http://localhost/group_assignment/pintas/index
```

### Success Page (After Public Complaint)
```
http://localhost/group_assignment/pintas/success
```

---

## 🛠️ UTILITY PAGES

### Password Hash Generator
```
http://localhost/group_assignment/generate_password.php
```
*Use this to generate password hashes for database*

---

## 🧪 TESTING CHECKLIST

### ✅ Test Admin Login
1. Go to: `http://localhost/group_assignment/users/login`
2. Login with: `admin` / `admin123`
3. Should see: Complaints dashboard with admin menu

### ✅ Test Creating Officer (Admin)
1. Login as admin
2. Go to: `http://localhost/group_assignment/officers/add`
3. Fill form:
   - Username: `officer1`
   - Password: `officer123`
   - Role: `officer`
   - Full Name: `Test Officer`
   - Staff ID: `OFF001`
   - Department: Select one
4. Save
5. Should create in `officers` table (NOT users table)

### ✅ Test Public User Registration
1. Go to: `http://localhost/group_assignment/users/add`
2. Fill form:
   - Username: `publicuser1`
   - Password: `user123`
   - IC Number: `123456789012`
   - Full Name: `Public User Test`
   - Email: `test@example.com`
3. Save
4. Should create in `users` table (NOT officers table)
5. Should auto-login and redirect to complaints

### ✅ Test Public User Login
1. Logout if logged in
2. Go to: `http://localhost/group_assignment/users/login`
3. Login with public user credentials
4. Should see: Complaints dashboard (limited view)

### ✅ Test Officer Login
1. Logout
2. Login with officer credentials
3. Should see: Only assigned complaints

### ✅ Test Admin Creating Complaint (Should Fail)
1. Login as admin
2. Go to complaints index
3. Should NOT see "New Complaint" button
4. Try: `http://localhost/group_assignment/complaints/add` directly
5. Should redirect or show error

### ✅ Test Public User Creating Complaint
1. Login as public user
2. Should see "New Complaint" button
3. Click it or go to: `http://localhost/group_assignment/complaints/add`
4. Should be able to create complaint

---

## 🔍 VERIFY DATABASE

### Check Officers Table
```sql
SELECT * FROM officers;
```
Should show: admin, and any officers you created

### Check Users Table
```sql
SELECT * FROM users;
```
Should show: Only public users (NOT admins/officers)

### Verify Structure
```sql
DESCRIBE officers;
DESCRIBE users;
```
Officers should have: username, password, role, full_name, staff_id, department_id
Users should have: username, password, ic_number, full_name, email, phone_mobile

---

## 🚨 COMMON ISSUES

### "Username tidak dijumpai" on login
- Check if user exists in correct table
- Admin/Officer = `officers` table
- Public User = `users` table

### Can't create officer
- Make sure you're logged in as admin
- Check if department exists
- Verify form fields match database structure

### Can't register public user
- Make sure IC number is unique
- Check username is unique
- Verify all required fields are filled

---

## 📋 QUICK REFERENCE

| Action | URL | Access Level |
|--------|-----|--------------|
| Admin Login | `/users/login` | Public |
| User Registration | `/users/add` | Public |
| Complaints List | `/complaints` | All logged in |
| Add Complaint | `/complaints/add` | Users only |
| Officers List | `/officers` | Admin only |
| Add Officer | `/officers/add` | Admin only |
| Users List | `/users` | Admin only |
| Departments | `/departments` | Admin only |

---

**Remember:** 
- **Officers table** = Admin/Staff (created by admin via Officers menu)
- **Users table** = Public users (self-register via Users/add)
- Both use same login page, system checks both tables
