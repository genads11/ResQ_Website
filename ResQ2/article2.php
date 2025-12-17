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
                <span class="article-date"><?php echo date('F j, Y', strtotime('-3 days')); ?></span>
                <span class="news-category">Relief</span>
            </div>
            <h2 class="article-title">Medical Mission Provides Free Health Services in Catanduanes</h2>
            <div class="article-author">
                <span>By ResQ Team</span>
            </div>
            <div class="article-image">
                <img src="images/relief-distribution.jpg" alt="Medical Mission">
            </div>
            <div class="article-content">
                <p class="lead">A comprehensive medical mission was conducted last week in San Andres, Catanduanes, providing free consultations, medicines, and health screenings to over 500 residents. The mission, organized in partnership with the Department of Health and local health organizations, will return next month to continue serving the community.</p>
                
                <p>The medical mission was held at the San Andres Municipal Gymnasium, where healthcare professionals from Manila and the Bicol region set up various stations for different medical services. The event was particularly important for residents who have limited access to healthcare facilities, especially those living in remote areas of the island.</p>
                
                <h3>Services Provided</h3>
                <p>The medical mission offered a wide range of health services:</p>
                <ul>
                    <li>General medical consultations for adults and children</li>
                    <li>Free medicines for common illnesses</li>
                    <li>Blood pressure and blood sugar screening</li>
                    <li>Dental check-ups and extractions</li>
                    <li>Eye examinations and reading glasses distribution</li>
                    <li>Health education and nutrition counseling</li>
                    <li>Vaccination services for children and adults</li>
                </ul>
                
                <h3>Impact on the Community</h3>
                <p>Dr. Juan Dela Cruz, the mission coordinator, expressed satisfaction with the turnout. "We saw many residents who haven't had a medical check-up in years due to the distance and cost of traveling to the main health center. This mission brings essential healthcare directly to them."</p>
                
                <p>One of the beneficiaries, 65-year-old Lola Rosa from Barangay Poblacion, shared her gratitude: "I've been having headaches for months but couldn't afford to see a doctor. The mission gave me free consultation and medicine. I'm very thankful."</p>
                
                <h3>Statistics</h3>
                <ul>
                    <li>Over 500 residents received medical consultations</li>
                    <li>300+ individuals received free medicines</li>
                    <li>150 children were vaccinated</li>
                    <li>80 dental procedures were performed</li>
                    <li>200+ pairs of reading glasses were distributed</li>
                </ul>
                
                <h3>Upcoming Mission</h3>
                <p>The medical mission team has committed to returning next month to provide follow-up care and serve residents who were unable to attend this session. The next mission will also include specialized services such as minor surgeries and laboratory tests.</p>
                
                <p>Mayor Peter C. Cua expressed his appreciation: "We are grateful for the medical professionals who volunteered their time and expertise. This mission is a lifeline for many of our residents, especially after the challenges we've faced with recent typhoons."</p>
                
                <p>Residents are encouraged to watch for announcements about the next medical mission date. Pre-registration will be available at barangay halls to ensure efficient service delivery.</p>
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

