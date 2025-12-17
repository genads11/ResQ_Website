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
                <span class="article-date"><?php echo date('F j, Y', strtotime('-1 week')); ?></span>
                <span class="news-category">Coverage</span>
            </div>
            <h2 class="article-title">On-the-Ground: A Day at the San Andres Distribution Center</h2>
            <div class="article-author">
                <span>By ResQ Team</span>
            </div>
            <div class="article-image">
                <img src="images/ini.jpg" alt="Distribution Day">
            </div>
            <div class="article-content">
                <p class="lead">Our team visited the main distribution center in San Andres, Catanduanes to document the relief operations. See how volunteers and staff work together to ensure smooth distribution of aid packages across the island, serving over 2,500 families daily.</p>
                
                <h3>Early Morning Setup</h3>
                <p>At 6:00 AM, while most of San Andres is still waking up, the distribution center is already bustling with activity. Volunteers arrive early to organize relief packages, set up registration tables, and prepare the facility for the day ahead. The atmosphere is one of purpose and dedication.</p>
                
                <p>"We start early because many residents travel from far-flung barangays," explained Center Coordinator Ana Martinez. "Some families leave their homes at 5 AM to reach the center. We want to be ready when they arrive."</p>
                
                <h3>The Distribution Process</h3>
                <p>By 8:00 AM, the first beneficiaries begin arriving. The process is well-organized:</p>
                <ol>
                    <li><strong>Registration:</strong> Residents present their IDs and barangay clearance at the registration desk</li>
                    <li><strong>Verification:</strong> Staff verify eligibility and check records</li>
                    <li><strong>Package Preparation:</strong> Volunteers prepare customized packages based on family size</li>
                    <li><strong>Distribution:</strong> Beneficiaries receive their relief packages</li>
                    <li><strong>Documentation:</strong> Each distribution is recorded for tracking and reporting</li>
                </ol>
                
                <h3>Stories from the Ground</h3>
                <p>We met several families during our visit. One family, the Dela Cruz family from Barangay San Isidro, traveled for two hours to reach the center. "Our house was damaged by the last typhoon," shared Nanay Lita. "This relief package will help us get through the week while we repair our home."</p>
                
                <p>Another beneficiary, Mang Roberto, a fisherman whose boat was destroyed, expressed his gratitude: "The typhoon season has been difficult for us fishermen. This assistance helps us feed our families while we work on getting back to sea."</p>
                
                <h3>Volunteer Dedication</h3>
                <p>The heart of the operation is the dedicated team of volunteers. Many of them are also typhoon survivors who chose to help others despite their own challenges. Volunteer Maria Santos shared, "I lost my home too, but I'm here because I want to help. We're all in this together."</p>
                
                <p>Volunteers work in shifts, but many stay longer than required. They handle everything from heavy lifting to comforting distressed beneficiaries. Their commitment is evident in every interaction.</p>
                
                <h3>Challenges and Solutions</h3>
                <p>Operating a distribution center in Catanduanes comes with unique challenges. Weather conditions can be unpredictable, and transportation from remote areas can be difficult. However, the team has developed solutions:</p>
                <ul>
                    <li>Mobile distribution units for remote barangays</li>
                    <li>Weather-resistant storage facilities</li>
                    <li>Flexible scheduling for working residents</li>
                    <li>Coordination with barangay officials for efficient communication</li>
                </ul>
                
                <h3>Impact and Statistics</h3>
                <p>On a typical day, the center serves:</p>
                <ul>
                    <li>200-300 families</li>
                    <li>Approximately 1,200-1,800 individuals</li>
                    <li>Distributes over 2,000 kilograms of food and supplies</li>
                </ul>
                
                <p>Since operations began, the center has served over 2,500 unique families, with many returning for follow-up assistance as needed.</p>
                
                <h3>A Day in Numbers</h3>
                <p>By the end of our visit at 5:00 PM, we witnessed:</p>
                <ul>
                    <li>287 families served</li>
                    <li>1,156 individuals assisted</li>
                    <li>45 volunteers working throughout the day</li>
                    <li>Zero complaints about the process</li>
                </ul>
                
                <p>The efficiency and compassion shown by everyone involved is a testament to the resilience and community spirit of San Andres, Catanduanes. Despite facing their own challenges, residents come together to support each other.</p>
                
                <p>As we left, the center was preparing for the next day, ensuring that tomorrow's beneficiaries would receive the same level of care and support. The work continues, day after day, as San Andres rebuilds and recovers.</p>
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

