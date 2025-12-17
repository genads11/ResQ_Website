<?php
require_once __DIR__ . '/config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required.';
    if ($password === '') $errors[] = 'Password required.';

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id, password, is_admin, is_verified FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = (int)$user['is_admin'];
            if ($user['is_admin']) {
                header('Location: admin/dashboard.php');
                exit;
            }
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Invalid credentials.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
  <style>form{max-width:420px;margin:24px auto;padding:16px;background:#fff;border-radius:6px}</style>
</head>
<body>
  <?php include __DIR__ . '/partials/header.php'; ?>
  <main>
    <div class="auth-card">
      <h2>Login</h2>
      <?php if (!empty($_GET['registered'])): ?><p style="color:var(--success)">Registration successful. Please login.</p><?php endif; ?>
      <?php if (!empty($errors)): ?>
        <div class="errors"><ul><?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
      <?php endif; ?>
      <form method="post" action="login.php">
        <label>Email
          <input class="auth-input" name="email" type="email" required>
        </label>
        <label style="margin-top:12px">Password
          <input class="auth-input" name="password" type="password" required>
        </label>
        <div style="margin-top:16px">
          <button class="auth-btn" type="submit">Login</button>
        </div>
      </form>
      <div class="auth-footer">Don't have an account? <a href="register.php">Create one</a></div>
    </div>
  </main>
  <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>

