<?php
require_once __DIR__ . '/_auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ResQ</title>
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
            <h2 class="section-title">Admin Dashboard</h2>
            <div class="news-grid">
                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y'); ?></span>
                        <span class="news-category">Management</span>
                    </div>
                    <h3 class="news-title">Manage Articles</h3>
                    <p class="news-excerpt">Create, edit, and publish news articles and relief updates for the website.</p>
                    <a href="articles.php" class="read-more">Manage Articles →</a>
                </article>

                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y'); ?></span>
                        <span class="news-category">Users</span>
                    </div>
                    <h3 class="news-title">Review Users</h3>
                    <p class="news-excerpt">Approve new user registrations and manage user accounts.</p>
                    <a href="users.php" class="read-more">Review Users →</a>
                </article>

                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y'); ?></span>
                        <span class="news-category">Support</span>
                    </div>
                    <h3 class="news-title">View Complaints</h3>
                    <p class="news-excerpt">Review and respond to user complaints and feedback.</p>
                    <a href="complaints.php" class="read-more">View Complaints →</a>
                </article>

                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y'); ?></span>
                        <span class="news-category">Navigation</span>
                    </div>
                    <h3 class="news-title">Go to Public Site</h3>
                    <p class="news-excerpt">View the public-facing website and relief information.</p>
                    <a href="../index.php" class="read-more">Visit Site →</a>
                </article>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
