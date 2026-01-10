<?php
require 'db_connect.php';

// The new password we want to set
$new_password = 'admin123';

// Generate a secure hash
$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

// Update the database
$sql = "UPDATE admins SET password = ? WHERE username = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $new_hash);

if ($stmt->execute()) {
    echo "<h1>✅ Success!</h1>";
    echo "<p>Password for user <b>'admin'</b> has been reset.</p>";
    echo "<p>New Password: <b>$new_password</b></p>";
    echo "<a href='index.php'>Go to Login Page</a>";
} else {
    echo "Error updating record: " . $conn->error;
}
?>