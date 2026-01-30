<?php
/**
 * Create Admin Account Script
 * 
 * This script allows you to create a new admin account.
 * IMPORTANT: Delete this file after creating the admin account for security reasons!
 */

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "group_assignment";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_username = trim($_POST['admin_username'] ?? '');
    $admin_password = trim($_POST['admin_password'] ?? '');
    $admin_confirm_password = trim($_POST['admin_confirm_password'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $staff_id = trim($_POST['staff_id'] ?? '');
    $phone_no = trim($_POST['phone_no'] ?? '');

    // Validation
    if (empty($admin_username) || empty($admin_password) || empty($full_name) || empty($staff_id)) {
        $error = "All fields are required.";
    } elseif ($admin_password !== $admin_confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($admin_password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Hash the password
        $hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

        // Check if username already exists
        $check_query = "SELECT officer_id FROM officers WHERE username = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $admin_username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Username already exists. Please choose a different username.";
        } else {
            // Insert admin account
            $insert_query = "INSERT INTO officers (username, password, role, status, full_name, staff_id, department_id, phone_no, created_at) VALUES (?, ?, 'admin', 'active', ?, ?, 1, ?, NOW())";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("sssss", $admin_username, $hashed_password, $full_name, $staff_id, $phone_no);

            if ($insert_stmt->execute()) {
                $message = "✅ Admin account created successfully!<br>";
                $message .= "Username: <strong>" . htmlspecialchars($admin_username) . "</strong><br>";
                $message .= "Password: <strong>" . htmlspecialchars($admin_password) . "</strong><br>";
                $message .= "<br><span style='color: red;'><strong>⚠️ IMPORTANT:</strong> Delete this file (create_admin.php) immediately after creating the admin account for security reasons!</span>";
            } else {
                $error = "Error creating admin account: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #764ba2;
        }
        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Create Admin Account</h1>

        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="admin_username">Username:</label>
                <input type="text" id="admin_username" name="admin_username" required placeholder="e.g., admin">
            </div>

            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required placeholder="e.g., Administrator">
            </div>

            <div class="form-group">
                <label for="staff_id">Staff ID:</label>
                <input type="text" id="staff_id" name="staff_id" required placeholder="e.g., ADM001">
            </div>

            <div class="form-group">
                <label for="phone_no">Phone Number (Optional):</label>
                <input type="text" id="phone_no" name="phone_no" placeholder="e.g., 012-3456789">
            </div>

            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required placeholder="Minimum 6 characters">
            </div>

            <div class="form-group">
                <label for="admin_confirm_password">Confirm Password:</label>
                <input type="password" id="admin_confirm_password" name="admin_confirm_password" required placeholder="Confirm your password">
            </div>

            <button type="submit">Create Admin Account</button>
        </form>

        <div class="warning">
            <strong>⚠️ SECURITY WARNING:</strong><br>
            This file should be deleted immediately after creating the admin account. Do not leave it on the server!<br><br>
            To delete: Navigate to <code>webroot/create_admin.php</code> and delete the file.
        </div>
    </div>
</body>
</html>
