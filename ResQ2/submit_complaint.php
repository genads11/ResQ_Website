<?php
require_once __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$category = trim($_POST['category'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $category === '' || $message === '') {
    $_SESSION['error'] = 'Please fill in all required fields.';
    header('Location: index.php#complaint'); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Please enter a valid email address.';
    header('Location: index.php#complaint'); exit;
}

$userId = $_SESSION['user_id'] ?? null;
$ins = $pdo->prepare('INSERT INTO complaints (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)');
$ins->execute([$userId, $name, $email, $category, $message]);

$_SESSION['success'] = 'Thank you! Your complaint has been submitted successfully. We will review it shortly.';
header('Location: index.php#complaint');
exit;
?>
