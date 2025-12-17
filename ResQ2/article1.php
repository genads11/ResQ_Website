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
    <header class="main-header">
        <div class="header-container">
            <div class="header-content">
                <div class="header-left">
                    <img src="images/logowebsites.png" alt="ResQ Logo" class="site-logo">
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
                </div>
            </div>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="index.php#relief" class="nav-link">Relief Updates</a></li>
                    <li><a href="index.php#coverage" class="nav-link">Relief Coverage</a></li>
                    <li><a href="index.php#municipality" class="nav-link">Municipality News</a></li>
                    <li><a href="index.php#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <article class="featured-article">
            <div class="article-meta">
                <span class="article-date"><?php echo date('F j, Y', strtotime('-2 days')); ?></span>
                <span class="news-category">Relief</span>
            </div>
            <h2 class="article-title">New Relief Distribution Center Opens in Barangay Central, San Andres</h2>
            <div class="article-author">
                <span>By ResQ Team</span>
            </div>
            <div class="article-image">
                <img src="images/dswd.jpg" alt="Distribution Center">
            </div>
            <div class="article-content">
                <p class="lead">A new relief distribution center has been established in Barangay Central to better serve residents in the northern part of San Andres, Catanduanes. The center will operate Monday through Saturday to provide continuous relief support to families affected by recent typhoons.</p>
                
                <p>The opening ceremony was attended by Mayor Peter C. Cua, barangay officials, and representatives from the Provincial Government of Catanduanes. The new facility is strategically located to serve residents from Barangay Central and surrounding areas, reducing travel time for families in need of assistance.</p>
                
                <h3>Facility Features</h3>
                <p>The new distribution center includes:</p>
                <ul>
                    <li>A covered area of 200 square meters for organized distribution</li>
                    <li>Storage facilities for relief goods and supplies</li>
                    <li>Registration area for efficient processing of beneficiaries</li>
                    <li>Parking space for residents coming from remote areas</li>
                    <li>Accessibility features for persons with disabilities</li>
                </ul>
                
                <h3>Operating Schedule</h3>
                <p>The center operates from Monday to Saturday, 8:00 AM to 5:00 PM. This extended schedule ensures that working residents can also access relief services after their work hours or on weekends.</p>
                
                <p>"This new center is part of our commitment to bring relief services closer to our constituents," said Barangay Captain Maria Santos. "We want to make sure that every family in our area has easy access to the assistance they need."</p>
                
                <h3>Services Offered</h3>
                <p>Residents can avail of the following services at the new distribution center:</p>
                <ul>
                    <li>Food packages and essential supplies</li>
                    <li>Registration for financial assistance programs</li>
                    <li>Information about other available relief programs</li>
                    <li>Coordination for medical and health services</li>
                </ul>
                
                <p>The establishment of this new center is part of San Andres' comprehensive disaster response strategy, ensuring that relief operations can continue efficiently even during challenging weather conditions common in Catanduanes.</p>
                
                <p>Residents are encouraged to bring valid identification and barangay clearance when visiting the center to ensure smooth processing of their requests.</p>
            </div>
            <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #e0e0e0;">
                <a href="index.php" style="color: #3498db; text-decoration: none; font-weight: 600;">← Back to Home</a>
            </div>
        </article>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>About</h4>
                    <p>ResQ provides timely updates on relief efforts, community coverage, and local news to keep residents informed about developments in the island province.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php#relief">Relief Updates</a></li>
                        <li><a href="index.php#coverage">Relief Coverage</a></li>
                        <li><a href="index.php#municipality">Municipality News</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>Email: info@sanandrescatanduanes.gov.ph</p>
                    <p>Phone: (052) 811-1234</p>
                    <p>Address: Municipal Hall, San Andres, Catanduanes</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> ResQ. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

