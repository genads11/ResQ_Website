<?php
// Header partial: requires `config.php` to be loaded beforehand if user data is needed
?>
<header class="main-header">
    <div class="header-container">
        <div class="header-content">
            <div class="header-left">
                <img src="/ResQ2/images/logowebsites.png?v=2" alt="ResQ Logo" class="site-logo">
                <div class="header-text">
                    <h1 class="site-title">ResQ</h1>
                    <p class="site-tagline">Your Source for Relief Updates & Local News</p>
                </div>
            </div>
            <div class="header-right">
                <button type="button" class="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false">
                    <span class="toggle-icon">🌙</span>
                    <span class="toggle-label">Dark mode</span>
                </button>
                <?php if (function_exists('is_logged_in') && is_logged_in()): $u = current_user($pdo); ?>
                    <div class="user-links" style="display:flex;align-items:center;gap:10px;margin-left:8px">
                        <?php if (!empty($u['is_admin'])): ?><a href="/ResQ2/admin/dashboard.php" class="nav-account">Admin</a><?php endif; ?>
                        <span class="nav-account"> Hello, <?=htmlspecialchars($u['name'])?></span>
                        <a href="/ResQ2/logout.php" class="nav-account">Logout</a>
                    </div>
                <?php else: ?>
                        <div class="auth-links" style="display:flex;align-items:center;gap:8px;margin-left:8px">
                            <a href="#" class="nav-account open-auth" data-auth="login">Login</a>
                            <a href="#" class="nav-account open-auth" data-auth="register">Register</a>
                        </div>
                <?php endif; ?>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="#home" class="nav-link active">Home</a></li>
                <li><a href="#relief" class="nav-link">Relief Updates</a></li>
                <li><a href="#coverage" class="nav-link">Relief Coverage</a></li>
                <li><a href="#municipality" class="nav-link">Municipality News</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
