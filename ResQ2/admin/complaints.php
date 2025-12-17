<?php
require_once __DIR__ . '/_auth.php';
// mark reviewed
if (!empty($_GET['mark'])) {
    $id = (int)$_GET['mark'];
    $pdo->prepare('UPDATE complaints SET status = "reviewed" WHERE id = ?')->execute([$id]);
    header('Location: complaints.php'); exit;
}
$rows = $pdo->query('SELECT c.*, u.name as user_name FROM complaints c LEFT JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Complaints - ResQ</title>
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
            <h2 class="section-title">Manage Complaints</h2>
            <p><a href="dashboard.php" class="read-more" style="margin-bottom: 20px; display: inline-block;">← Back to Dashboard</a></p>

            <?php if (!$rows): ?>
                <p>No complaints submitted yet.</p>
            <?php else: ?>
                <div class="complaint-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r): ?>
                                <tr>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= htmlspecialchars($r['user_name'] ?? $r['name'] ?? 'Guest') ?></td>
                                    <td><?= htmlspecialchars($r['subject']) ?></td>
                                    <td style="max-width: 300px; word-wrap: break-word;"><?= nl2br(htmlspecialchars($r['message'])) ?></td>
                                    <td><span class="status-<?= $r['status'] === 'new' ? 'warning' : 'success' ?>"><?= ucfirst($r['status']) ?></span></td>
                                    <td><?= date('M j, Y H:i', strtotime($r['created_at'])) ?></td>
                                    <td>
                                        <?php if ($r['status'] === 'new'): ?>
                                            <a href="?mark=<?= $r['id'] ?>" class="auth-btn" style="padding: 6px 12px; font-size: 0.9rem;">Mark Reviewed</a>
                                        <?php else: ?>
                                            <span style="color: var(--success);">Reviewed</span>
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
