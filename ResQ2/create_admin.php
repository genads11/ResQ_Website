<?php
// One-time helper to create an admin user. Remove this file after use.
require_once __DIR__ . '/config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $ins = $pdo->prepare('INSERT INTO users (name, email, password, is_admin, is_verified) VALUES (?, ?, ?, 1, 1)');
        try {
            $ins->execute([$name, $email, $hash]);
            $msg = 'Admin created. Please delete create_admin.php for security.';
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage();
        }
    } else {
        $msg = 'Provide valid name, email, and a password >=6 chars.';
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Create Admin</title>
<link rel="stylesheet" href="styles.css"></head><body>
<?php include __DIR__ . '/partials/header.php'; ?>
<main>
    <div class="auth-card">
        <h2>Create Admin (one-time)</h2>
        <?php if ($msg) echo '<p>'.htmlspecialchars($msg).'</p>'; ?>
        <form method="post">
            <label>Name
                <input class="auth-input" name="name" required>
            </label>
            <label style="margin-top:10px">Email
                <input class="auth-input" name="email" type="email" required>
            </label>
            <label style="margin-top:10px">Password
                <input class="auth-input" name="password" type="password" required>
            </label>
            <div style="margin-top:16px"><button class="auth-btn" type="submit">Create Admin</button></div>
        </form>
        <div class="auth-footer">After creating an admin, delete this file for security.</div>
    </div>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body></html>
