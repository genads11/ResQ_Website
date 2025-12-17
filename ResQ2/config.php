<?php
// Database configuration - update these constants for your environment
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'resq');
define('DB_USER', 'root');
define('DB_PASS', '');

// Start session for auth
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PDO connection
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}

function current_user($pdo) {
    if (!is_logged_in()) return null;
    static $user = null;
    if ($user !== null) return $user;
    $stmt = $pdo->prepare('SELECT id, name, email, is_admin, is_verified FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
