<?php
require_once __DIR__ . '/config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($name === '') $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
    if ($password !== $password2) $errors[] = 'Passwords do not match.';

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email already registered.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $ins->execute([$name, $email, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
  <style>form{max-width:420px;margin:24px auto;padding:16px;background:#fff;border-radius:6px}</style>
</head>
<body>
  <?php include __DIR__ . '/partials/header.php'; ?>
  <main>
    <div class="auth-card">
      <h2>Create account</h2>
      <?php if (!empty($errors)): ?>
        <div class="errors"><ul><?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
      <?php endif; ?>
      <form method="post" action="register.php">
        <label>Name
          <input class="auth-input" name="name" value="<?=htmlspecialchars($name ?? '')?>" required>
        </label>
        <label style="margin-top:10px">Email
          <input class="auth-input" name="email" type="email" value="<?=htmlspecialchars($email ?? '')?>" required>
        </label>
        <label style="margin-top:10px">Password
          <input class="auth-input" name="password" type="password" required>
        </label>
        <label style="margin-top:10px">Confirm password
          <input class="auth-input" name="password2" type="password" required>
        </label>
        <div style="margin-top:16px">
          <button class="auth-btn" type="submit">Create account</button>
        </div>
      </form>
      <div class="auth-footer">Already have an account? <a href="login.php">Login</a></div>
    </div>
  </main>
  <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
<?php
require_once __DIR__ . '/config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($name === '') $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
    if ($password !== $password2) $errors[] = 'Passwords do not match.';

    if (empty($errors)) {
        // check for existing email
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email already registered.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $ins->execute([$name, $email, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
  <style>form{max-width:420px;margin:24px auto;padding:16px;background:#fff;border-radius:6px}</style>
</head>
<body>
  <main>
    <h2 style="text-align:center">Register</h2>
    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul><?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul>
      </div>
    <?php endif; ?>
    <form method="post" action="register.php">
      <label>Name<br><input name="name" value="<?=htmlspecialchars($name ?? '')?>" required></label><br>
      <label>Email<br><input name="email" type="email" value="<?=htmlspecialchars($email ?? '')?>" required></label><br>
      <label>Password<br><input name="password" type="password" required></label><br>
      <label>Confirm Password<br><input name="password2" type="password" required></label><br>
      <button type="submit">Create account</button>
    </form>
    <p style="text-align:center"><a href="login.php">Already have an account? Login</a></p>
  </main>
</body>
</html>
