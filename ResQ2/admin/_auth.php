<?php
require_once __DIR__ . '/../config.php';
$user = current_user($pdo);
if (!$user || empty($user['is_admin'])) {
    header('Location: ../login.php');
    exit;
}
