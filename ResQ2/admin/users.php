<?php
require_once __DIR__ . '/_auth.php';
// approve/revoke
if (!empty($_GET['approve'])) {
    $id = (int)$_GET['approve'];
    $pdo->prepare('UPDATE users SET is_verified = 1 WHERE id = ?')->execute([$id]);
    header('Location: users.php'); exit;
}
if (!empty($_GET['revoke'])) {
    $id = (int)$_GET['revoke'];
    $pdo->prepare('UPDATE users SET is_verified = 0 WHERE id = ?')->execute([$id]);
    header('Location: users.php'); exit;
}
$users = $pdo->query('SELECT id, name, email, is_verified, is_admin, created_at FROM users ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - ResQ</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../images/logo_tabs.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo_tabs.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/logo_tabs.png">
    <meta name="theme-color" content="#0ea5e9">
    <link rel="stylesheet" href="../styles.css">
    <script src="../animations.js" defer></script>
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main class="container">
        <section class="news-section fade-in">
            <h2 class="section-title">Manage Users</h2>
            <p><a href="dashboard.php" class="read-more" style="margin-bottom: 20px; display: inline-block;">← Back to Dashboard</a></p>

            <?php if (!$users): ?>
                <p>No users registered yet.</p>
            <?php else: ?>
                <div class="user-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th>Admin</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $u['id'] ?></td>
                                    <td><?= htmlspecialchars($u['name']) ?></td>
                                    <td style="max-width: 200px; word-wrap: break-word;"><?= htmlspecialchars($u['email']) ?></td>
                                    <td><span class="status-<?= $u['is_verified'] ? 'success' : 'warning' ?>"><?= $u['is_verified'] ? 'Yes' : 'No' ?></span></td>
                                    <td><span class="status-<?= $u['is_admin'] ? 'success' : 'warning' ?>"><?= $u['is_admin'] ? 'Yes' : 'No' ?></span></td>
                                    <td><?= date('M j, Y', strtotime($u['created_at'])) ?></td>
                                    <td>
                                        <?php if (!$u['is_verified']): ?>
                                            <a href="?approve=<?= $u['id'] ?>" class="auth-btn" style="padding: 6px 12px; font-size: 0.9rem;">Approve</a>
                                        <?php else: ?>
                                            <a href="?revoke=<?= $u['id'] ?>" class="auth-btn" style="padding: 6px 12px; font-size: 0.9rem; background: var(--warning);">Revoke</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
