<?php
// 1. SECURITY SETTINGS
ini_set('session.cookie_httponly', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Strict');

session_start();
require 'db_connect.php'; // CONNECT TO DATABASE

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// 2. RATE LIMITING (Brute Force Protection)
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['first_attempt_time'] = time();
}
$maxAttempts = 5;
$lockoutSeconds = 300; // 5 minutes

if ($_SESSION['login_attempts'] >= $maxAttempts) {
    if ((time() - $_SESSION['first_attempt_time']) < $lockoutSeconds) {
        $_SESSION['error'] = 'Too many login attempts. Please wait a few minutes.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['first_attempt_time'] = time();
    }
}

// 3. CHECK CSRF TOKEN
$csrf = $_POST['csrf_token'] ?? '';
if (empty($csrf) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrf)) {
    $_SESSION['error'] = 'Invalid request (CSRF).';
    header('Location: index.php');
    exit;
}

// 4. GET INPUT
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// 5. DATABASE VERIFICATION (The Critical Part)
// Prepare statement to prevent SQL Injection
$stmt = $conn->prepare("SELECT id, full_name, username, password, role FROM admins WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify Hash from Database
    if (password_verify($password, $user['password'])) {
        
        // --- SUCCESS ---
        session_regenerate_id(true);
        
        // Set ALL variables needed for Dashboard/Profile
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];          // REQUIRED for Profile Page
        $_SESSION['admin_name'] = $user['full_name']; // REQUIRED for Avatar
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
        $_SESSION['last_activity'] = time();

        // Clear security counters
        unset($_SESSION['login_attempts']);
        unset($_SESSION['first_attempt_time']);
        unset($_SESSION['csrf_token']);

        header('Location: dashboard.php');
        exit;

    } else {
        // Password Incorrect
        $_SESSION['login_attempts']++;
        $_SESSION['error'] = 'Invalid username or password!';
        header('Location: index.php');
        exit;
    }
} else {
    // Username not found
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = 'Invalid username or password!';
    header('Location: index.php');
    exit;
}
?>