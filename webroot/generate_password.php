<?php
/**
 * Password Hash Generator
 * 
 * Use this to generate password hashes for your database
 * Access: http://localhost/group_assignment/generate_password.php
 */

// Generate hash for 'admin123'
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h2>Password Hash Generator</h2>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<p><strong>Hash:</strong> <code>$hash</code></p>";
echo "<hr>";

// SQL to update
echo "<h3>SQL to Update Database:</h3>";
echo "<pre>";
echo "UPDATE `officers` \n";
echo "SET `password` = '$hash' \n";
echo "WHERE `username` = 'admin';";
echo "</pre>";

echo "<hr>";
echo "<h3>Or Generate Your Own:</h3>";
echo "<form method='POST'>";
echo "<input type='text' name='password' placeholder='Enter password' value='admin123'>";
echo "<button type='submit'>Generate Hash</button>";
echo "</form>";

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $customPassword = $_POST['password'];
    $customHash = password_hash($customPassword, PASSWORD_DEFAULT);
    echo "<p><strong>Password:</strong> $customPassword</p>";
    echo "<p><strong>Hash:</strong> <code>$customHash</code></p>";
    echo "<pre>";
    echo "UPDATE `officers` \n";
    echo "SET `password` = '$customHash' \n";
    echo "WHERE `username` = 'admin';";
    echo "</pre>";
}
?>
