<?php
require_once __DIR__ . '/config.php';

// Handle login and register from modal
$auth_errors = [];
$auth_success = '';
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modal_login'])) {
        // Login processing
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $auth_errors[] = 'Valid email required.';
        if ($password === '') $auth_errors[] = 'Password required.';

        if (empty($auth_errors)) {
            $stmt = $pdo->prepare('SELECT id, password, is_admin, is_verified FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = (int)$user['is_admin'];
                if ($is_ajax) {
                    echo json_encode(['success' => true, 'redirect' => $user['is_admin'] ? 'admin/dashboard.php' : 'index.php']);
                    exit;
                }
                if ($user['is_admin']) {
                    header('Location: admin/dashboard.php');
                    exit;
                }
                header('Location: index.php');
                exit;
            } else {
                $auth_errors[] = 'Invalid credentials.';
            }
        }
    } elseif (isset($_POST['modal_register'])) {
        // Register processing
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if ($name === '') $auth_errors[] = 'Name is required.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $auth_errors[] = 'Valid email is required.';
        if (strlen($password) < 6) $auth_errors[] = 'Password must be at least 6 characters.';
        if ($password !== $password2) $auth_errors[] = 'Passwords do not match.';

        if (empty($auth_errors)) {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $auth_errors[] = 'Email already registered.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $ins = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
                $ins->execute([$name, $email, $hash]);
                $auth_success = 'Registration successful. Please login.';
            }
        }
    }

    // For AJAX requests, return JSON response
    if ($is_ajax) {
        header('Content-Type: application/json');
        echo json_encode([
            'errors' => $auth_errors,
            'success' => $auth_success
        ]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResQ</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_tabs.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo_tabs.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo_tabs.png">
    <meta name="theme-color" content="#0ea5e9">
    <link rel="stylesheet" href="styles.css">
    <script src="animations.js" defer></script>
</head>
<body>
        <?php include __DIR__ . '/partials/header.php'; ?>

        <!-- Auth modal (global) -->
        <div id="auth-modal" role="dialog" aria-hidden="true">
            <div class="auth-modal-backdrop"></div>
            <div class="auth-modal-box" role="document">
                <button class="auth-modal-close" aria-label="Close">×</button>
                <div class="auth-tab-buttons">
                    <button data-tab="login" class="active">Login</button>
                    <button data-tab="register">Register</button>
                </div>
                <div class="auth-forms">
                    <div class="auth-form auth-form-login">
                        <div id="login-errors" class="errors" style="color:red;margin-bottom:10px;display:none;"></div>
                        <div id="login-success" class="success" style="color:green;margin-bottom:10px;display:none;"></div>
                        <form id="modal-login-form" method="post">
                            <input type="hidden" name="modal_login" value="1">
                            <label>Email<br><input class="auth-input" name="email" type="email" required></label>
                            <label style="margin-top:10px">Password<br><input class="auth-input" name="password" type="password" required></label>
                            <div style="margin-top:12px;text-align:center"><button class="auth-btn" type="submit">Login</button></div>
                        </form>
                    </div>
                    <div class="auth-form auth-form-register" style="display:none">
                        <div id="register-errors" class="errors" style="color:red;margin-bottom:10px;display:none;"></div>
                        <div id="register-success" class="success" style="color:green;margin-bottom:10px;display:none;"></div>
                        <form id="modal-register-form" method="post">
                            <input type="hidden" name="modal_register" value="1">
                            <label>Name<br><input class="auth-input" name="name" required></label>
                            <label style="margin-top:10px">Email<br><input class="auth-input" name="email" type="email" required></label>
                            <label style="margin-top:10px">Password<br><input class="auth-input" name="password" type="password" required></label>
                            <label style="margin-top:10px">Confirm Password<br><input class="auth-input" name="password2" type="password" required></label>
                            <div style="margin-top:12px;text-align:center"><button class="auth-btn" type="submit">Create account</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <main class="container">
        <!-- Featured Article (dynamic from DB) -->
        <?php
            $articles = [];
            try {
                $articles = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC LIMIT 6')->fetchAll();
            } catch (Exception $e) {
                // DB may be empty; fallback to static content below
                $articles = [];
            }

            $featured = $articles[0] ?? null;
        ?>
        <article class="featured-article fade-in" id="home">
            <div class="article-meta">
                <span class="article-date"><?= htmlspecialchars($featured['created_at'] ?? date('F j, Y')) ?></span>
                <span class="article-category">Featured</span>
            </div>
            <h2 class="article-title"><?= htmlspecialchars($featured['title'] ?? 'San Andres, Catanduanes Launches Comprehensive Relief Program for Typhoon-Affected Families') ?></h2>
            <div class="article-author">
                <span><?= htmlspecialchars($featured['author'] ?? 'ResQ Team') ?></span>
            </div>
            <div class="article-image">
                <img src="<?= htmlspecialchars($featured['image'] ?? 'images/relief-distribution.jpg') ?>" alt="Featured Image">
            </div>
            <div class="article-content">
                <p class="lead"><?= nl2br(htmlspecialchars($featured['content'] ? substr($featured['content'],0,400) : 'The Municipality of San Andres in Catanduanes has initiated a comprehensive relief program aimed at providing essential aid to families affected by recent typhoons and natural disasters.')) ?></p>
                <?php if ($featured): ?>
                    <p><a href="article.php?id=<?= $featured['id'] ?>" class="read-more">Read full article →</a></p>
                <?php else: ?>
                    <p>In a coordinated effort with the Provincial Government of Catanduanes, local government units, and non-governmental organizations, San Andres has set up multiple distribution centers across the municipality. These centers are operating daily from 8:00 AM to 5:00 PM to ensure maximum accessibility for all residents, including those in remote coastal and mountainous areas.</p>
                <?php endif; ?>
            </div>
        </article>

        <!-- Relief Updates Section -->
        <section class="news-section fade-in" id="relief">
            <h2 class="section-title">Latest Relief Updates</h2>
            <div class="news-grid">
                <?php
                  // display next 3 articles in news grid
                  $newsItems = array_slice($articles, 1, 3);
                  if (empty($newsItems)) {
                    // fallback to static cards if DB empty
                ?>
                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y', strtotime('-2 days')); ?></span>
                        <span class="news-category">Relief</span>
                    </div>
                    <h3 class="news-title">New Relief Distribution Center Opens in Barangay Central, San Andres</h3>
                    <p class="news-excerpt">A new distribution center has been established in Barangay Central to better serve residents in the northern part of San Andres, Catanduanes. The center will operate Monday through Saturday to provide continuous relief support.</p>
                    <a href="article1.php" class="read-more">Read more →</a>
                </article>

                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y', strtotime('-3 days')); ?></span>
                        <span class="news-category">Relief</span>
                    </div>
                    <h3 class="news-title">Medical Mission Provides Free Health Services in Catanduanes</h3>
                    <p class="news-excerpt">A medical mission was conducted last week in San Andres, Catanduanes, providing free consultations, medicines, and health screenings to over 500 residents. The mission will return next month to continue serving the community.</p>
                    <a href="article2.php" class="read-more">Read more →</a>
                </article>

                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?php echo date('F j, Y', strtotime('-5 days')); ?></span>
                        <span class="news-category">Relief</span>
                    </div>
                    <h3 class="news-title">Catanduanes Relief Packages Include Fresh Produce from Local Farmers</h3>
                    <p class="news-excerpt">In support of local agriculture in Catanduanes, relief packages now include fresh vegetables and fruits sourced directly from San Andres farmers, ensuring both food security and economic support for the island province.</p>
                    <a href="article3.php" class="read-more">Read more →</a>
                </article>
                <?php } else {
                    foreach ($newsItems as $n) {
                ?>
                <article class="news-card">
                    <div class="news-meta">
                        <span class="news-date"><?= htmlspecialchars(date('F j, Y', strtotime($n['created_at'] ?? 'now'))) ?></span>
                        <span class="news-category">Relief</span>
                    </div>
                    <h3 class="news-title"><?= htmlspecialchars($n['title']) ?></h3>
                    <p class="news-excerpt"><?= nl2br(htmlspecialchars(substr($n['content'],0,180))) ?></p>
                    <a href="article.php?id=<?= $n['id'] ?>" class="read-more">Read more →</a>
                </article>
                <?php }
                  }
                ?>
            </div>
        </section>

        <!-- Relief Coverage Section -->
        <section class="news-section fade-in" id="coverage">
            <h2 class="section-title">Relief Coverage</h2>
            <div class="coverage-grid">
                <?php
                  $coverageItems = array_slice($articles, 4, 3);
                  if (empty($coverageItems)) {
                ?>
                <article class="coverage-card">
                    <div class="coverage-image">
                            <img src="images/ini.jpg" alt="Distribution">
                    </div>
                    <div class="coverage-content">
                        <h3 class="coverage-title">On-the-Ground: A Day at the San Andres Distribution Center</h3>
                        <p class="coverage-excerpt">Our team visited the main distribution center in San Andres, Catanduanes to document the relief operations. See how volunteers and staff work together to ensure smooth distribution of aid packages across the island.</p>
                        <div class="coverage-stats">
                            <span>📊 2,500+ families served</span>
                            <span>⏰ Daily operations</span>
                        </div>
                        <a href="article4.php" class="read-more" style="margin-top: 10px; display: inline-block;">Read more →</a>
                    </div>
                </article>

                <?php } else {
                    foreach ($coverageItems as $c) {
                ?>
                <article class="coverage-card">
                    <div class="coverage-image">
                        <img src="<?= htmlspecialchars($c['image'] ?? 'images/relief-distribution.jpg') ?>" alt="<?= htmlspecialchars($c['title']) ?>">
                    </div>
                    <div class="coverage-content">
                        <h3 class="coverage-title"><?= htmlspecialchars($c['title']) ?></h3>
                        <p class="coverage-excerpt"><?= nl2br(htmlspecialchars(substr($c['content'],0,200))) ?></p>
                        <div class="coverage-stats">
                            <span>👥 Community</span>
                        </div>
                        <a href="article.php?id=<?= $c['id'] ?>" class="read-more" style="margin-top: 10px; display: inline-block;">Read more →</a>
                    </div>
                </article>
                <?php }
                  }
                ?>
                <article class="coverage-card">
                    <div class="coverage-image">
                            <img src="images/centerp-2.jpg" alt="Community">
                    </div>
                    <div class="coverage-content">
                        <h3 class="coverage-title">Catanduanes Community Volunteers: The Backbone of Relief Efforts</h3>
                        <p class="coverage-excerpt">Meet the dedicated volunteers from San Andres and across Catanduanes who have been working tirelessly to ensure relief reaches those who need it most. Their stories of service and commitment inspire the entire island community.</p>
                        <div class="coverage-stats">
                            <span>👥 200+ volunteers</span>
                            <span>❤️ Community-driven</span>
                        </div>
                        <a href="article5.php" class="read-more" style="margin-top: 10px; display: inline-block;">Read more →</a>
                    </div>
                </article>

                <article class="coverage-card">
                    <div class="coverage-image">
                            <img src="images/relief-distribution.jpg" alt="Success">
                    </div>
                    <div class="coverage-content">
                        <h3 class="coverage-title">Success Stories: How Relief is Making a Difference in Catanduanes</h3>
                        <p class="coverage-excerpt">Read inspiring stories from families in San Andres, Catanduanes who have received assistance and how the relief program has helped them get back on their feet during challenging times after typhoons.</p>
                        <div class="coverage-stats">
                            <span>✨ Real impact</span>
                            <span>📝 Personal stories</span>
                        </div>
                        <a href="article6.php" class="read-more" style="margin-top: 10px; display: inline-block;">Read more →</a>
                    </div>
                </article>
            </div>
        </section>

        <!-- Municipality News Section -->
        <section class="news-section fade-in" id="municipality">
            <h2 class="section-title">Municipality News</h2>
            <div class="news-list">
                <article class="news-item">
                    <div class="news-item-date">
                        <span class="date-day"><?php echo date('j'); ?></span>
                        <span class="date-month"><?php echo date('M'); ?></span>
                    </div>
                    <div class="news-item-content">
                        <h3 class="news-item-title">San Andres, Catanduanes Council Approves New Infrastructure Projects</h3>
                        <p class="news-item-excerpt">The municipal council of San Andres, Catanduanes has approved several infrastructure projects aimed at improving road connectivity and public facilities. The projects are expected to begin next quarter to strengthen the island's resilience.</p>
                        <span class="news-item-category">Infrastructure</span>
                    </div>
                </article>

                <article class="news-item">
                    <div class="news-item-date">
                        <span class="date-day"><?php echo date('j', strtotime('-1 day')); ?></span>
                        <span class="date-month"><?php echo date('M', strtotime('-1 day')); ?></span>
                    </div>
                    <div class="news-item-content">
                        <h3 class="news-item-title">San Andres School Receives Educational Materials Donation</h3>
                        <p class="news-item-excerpt">A generous donation of books, computers, and learning materials has been received by San Andres Elementary School in Catanduanes, benefiting over 500 students across the municipality.</p>
                        <span class="news-item-category">Education</span>
                    </div>
                </article>

                <article class="news-item">
                    <div class="news-item-date">
                        <span class="date-day"><?php echo date('j', strtotime('-4 days')); ?></span>
                        <span class="date-month"><?php echo date('M', strtotime('-4 days')); ?></span>
                    </div>
                    <div class="news-item-content">
                        <h3 class="news-item-title">Catanduanes Launches Environmental Cleanup Initiative</h3>
                        <p class="news-item-excerpt">A community-wide environmental cleanup initiative has been launched in San Andres, Catanduanes, with residents and local organizations participating in tree planting and waste management programs to protect the island's natural beauty.</p>
                        <span class="news-item-category">Environment</span>
                    </div>
                </article>

                <article class="news-item">
                    <div class="news-item-date">
                        <span class="date-day"><?php echo date('j', strtotime('-6 days')); ?></span>
                        <span class="date-month"><?php echo date('M', strtotime('-6 days')); ?></span>
                    </div>
                    <div class="news-item-content">
                        <h3 class="news-item-title">New Health Center Opens in San Andres, Catanduanes</h3>
                        <p class="news-item-excerpt">A new health center has been inaugurated in the remote area of San Andres, Catanduanes, providing essential healthcare services to residents who previously had to travel long distances across the island.</p>
                        <span class="news-item-category">Healthcare</span>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>

