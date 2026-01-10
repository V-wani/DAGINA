<?php
require 'auth.php';
require 'db_connect.php';

// Prevent direct access via URL
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: profile.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$action = $_POST['action'] ?? '';

// --- 1. UPDATE GENERAL INFO ---
if ($action === 'update_info') {
    
    // Sanitize input
    $full_name = trim($_POST['full_name']);

    // Validation: Check if empty or too long
    if (empty($full_name)) {
        $_SESSION['error'] = "Full name cannot be empty.";
        header("Location: profile.php");
        exit();
    }
    
    if (strlen($full_name) > 50) {
        $_SESSION['error'] = "Name is too long (max 50 characters).";
        header("Location: profile.php");
        exit();
    }
    
    // Update Database
    $stmt = $conn->prepare("UPDATE admins SET full_name = ? WHERE id = ?");
    $stmt->bind_param("si", $full_name, $admin_id);
    
    if ($stmt->execute()) {
        // Update Session immediately so UI reflects change
        $_SESSION['admin_name'] = $full_name;
        $_SESSION['success'] = "Profile details updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update profile. Please try again.";
    }

// --- 2. CHANGE PASSWORD ---
} elseif ($action === 'change_password') {
    
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // 1. Basic Validation
    if (empty($current_pass) || empty($new_pass) || empty($confirm_pass)) {
        $_SESSION['error'] = "All password fields are required.";
        header("Location: profile.php");
        exit();
    }

    // 2. Strength Validation
    if (strlen($new_pass) < 8) {
        $_SESSION['error'] = "New password must be at least 8 characters long.";
        header("Location: profile.php");
        exit();
    }

    // 3. Match Validation
    if ($new_pass !== $confirm_pass) {
        $_SESSION['error'] = "New passwords do not match.";
        header("Location: profile.php");
        exit();
    }

    // 4. Verify Current Password from DB
    $stmt = $conn->prepare("SELECT password FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // Should not happen if logged in, but safe to check
        $_SESSION['error'] = "User not found.";
        header("Location: logout.php");
        exit();
    }

    $admin = $result->fetch_assoc();

    if (!password_verify($current_pass, $admin['password'])) {
        $_SESSION['error'] = "The current password you entered is incorrect.";
        header("Location: profile.php");
        exit();
    }

    // 5. Update Password
    $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
    
    $updateStmt = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
    $updateStmt->bind_param("si", $new_hash, $admin_id);
    
    if ($updateStmt->execute()) {
        // Security: Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);
        $_SESSION['success'] = "Password changed successfully!";
    } else {
        $_SESSION['error'] = "Database error. Could not change password.";
    }

} else {
    // Invalid Action
    $_SESSION['error'] = "Invalid action.";
}

// Redirect back to profile
header("Location: profile.php");
exit();
?>