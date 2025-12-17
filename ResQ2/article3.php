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
                <span class="article-date"><?php echo date('F j, Y', strtotime('-5 days')); ?></span>
                <span class="news-category">Relief</span>
            </div>
            <h2 class="article-title">Catanduanes Relief Packages Include Fresh Produce from Local Farmers</h2>
            <div class="article-author">
                <span>By ResQ Team</span>
            </div>
            <div class="article-image">
                <img src="images/center.jpg" alt="Local Farmers">
            </div>
            <div class="article-content">
                <p class="lead">In support of local agriculture in Catanduanes, relief packages now include fresh vegetables and fruits sourced directly from San Andres farmers, ensuring both food security and economic support for the island province. This innovative approach helps disaster-affected families while supporting the local farming community.</p>
                
                <p>The initiative, launched by the Municipal Agriculture Office in partnership with the Department of Agriculture, directly purchases produce from local farmers in San Andres and surrounding areas. This creates a win-win situation: families receive nutritious fresh food, and farmers have a stable market for their products.</p>
                
                <h3>Supporting Local Agriculture</h3>
                <p>Mayor Peter C. Cua explained the program's dual purpose: "Instead of importing all relief goods from outside Catanduanes, we're prioritizing our local farmers. This not only provides fresh, nutritious food to our constituents but also helps our agricultural sector recover from typhoon damage."</p>
                
                <p>Farmers like Mang Jose, a vegetable grower from Barangay San Isidro, expressed his appreciation: "The typhoons destroyed many of our crops, but this program gives us hope. We can continue farming knowing there's a market for our produce."</p>
                
                <h3>What's Included in Relief Packages</h3>
                <p>Each relief package now contains:</p>
                <ul>
                    <li>Fresh vegetables (eggplant, okra, string beans, leafy greens)</li>
                    <li>Root crops (sweet potato, cassava, taro)</li>
                    <li>Fruits (banana, papaya, coconut)</li>
                    <li>Rice and canned goods</li>
                    <li>Basic cooking ingredients</li>
                </ul>
                
                <h3>Economic Impact</h3>
                <p>The program has already benefited over 50 local farmers in San Andres, providing them with a steady income source. The Municipal Agriculture Office estimates that the program has injected over ₱500,000 into the local agricultural economy since its launch.</p>
                
                <p>"This is more sustainable than just giving aid," said Municipal Agriculturist Maria Garcia. "We're building resilience by supporting both the recipients and the producers. It's a model we hope to continue and expand."</p>
                
                <h3>Quality and Freshness</h3>
                <p>All produce is carefully selected and inspected to ensure quality and freshness. The vegetables and fruits are harvested within 24 hours of distribution, ensuring maximum nutritional value for recipients.</p>
                
                <p>Recipients have expressed satisfaction with the fresh produce. "The vegetables are so fresh, much better than what we usually get," shared one beneficiary. "It's also nice to know we're helping our local farmers."</p>
                
                <h3>Future Plans</h3>
                <p>The municipality plans to expand this program to include more farmers and potentially establish a permanent local procurement system for other municipal programs. There are also discussions about providing training and support to help farmers increase their production capacity.</p>
                
                <p>This initiative represents a shift towards more sustainable and community-centered disaster response, recognizing that recovery involves not just immediate relief but also long-term economic support for the island's agricultural sector.</p>
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

