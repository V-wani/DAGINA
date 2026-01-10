<?php
// Secure session cookie settings
ini_set('session.cookie_httponly', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Basic rate limiting (session-based)
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['first_attempt_time'] = time();
}
$maxAttempts = 5;
$lockoutSeconds = 300; // 5 minutes
if ($_SESSION['login_attempts'] >= $maxAttempts && (time() - $_SESSION['first_attempt_time']) < $lockoutSeconds) {
    $_SESSION['error'] = 'Too many login attempts. Please wait a few minutes.';
    header('Location: login.php');
    exit;
}
if ((time() - $_SESSION['first_attempt_time']) > $lockoutSeconds) {
    // reset window
    $_SESSION['login_attempts'] = 0;
    $_SESSION['first_attempt_time'] = time();
}

// Check CSRF token
$csrf = $_POST['csrf_token'] ?? '';
if (empty($csrf) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrf)) {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: login.php');
    exit;
}

/* Admin credentials (keep as code-level constant; consider moving to config or DB later) */
$admin_user = 'admin';
$admin_pass_hash = password_hash('admin@123', PASSWORD_DEFAULT); // replace with stored hash in production

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === $admin_user && password_verify($password, $admin_pass_hash)) {
    // Successful login: regenerate session id and set session vars
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $admin_user;
    // record last activity for timeout
    $_SESSION['last_activity'] = time();
    // clear attempts and CSRF token
    unset($_SESSION['login_attempts']);
    unset($_SESSION['first_attempt_time']);
    unset($_SESSION['csrf_token']);

    header('Location: dashboard.php');
    exit;
} else {
    // failed
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = 'Invalid username or password!';
    header('Location: login.php');
    exit;
}
