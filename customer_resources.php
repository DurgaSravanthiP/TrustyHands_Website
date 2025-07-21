<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Resources - Trustyhands Premium Service Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --dark-moss-green: #606c38;
            --pakistan-green: #283618;
            --cornsilk: #fefae0;
            --earth-yellow: #dda15e;
            --tigers-eye: #bc6c25;

            --primary: var(--dark-moss-green);
            --secondary: var(--earth-yellow);
            --accent: var(--tigers-eye);
            --light-background: var(--cornsilk);
            --dark-background: var(--pakistan-green);
            --white: #ffffff;
            --light-gray: #f8f9f8;
            --text: #333;
            --text-light: #666;
            --text-footer: #ddd;
            --shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-gray);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            font-size: 14px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.5px;
        }

        .logo i {
            color: var(--accent);
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 20px;
        }

        nav a:hover {
            color: var(--primary);
            background: rgba(96, 108, 56, 0.1);
        }

        nav a.active {
            color: var(--primary);
            background: rgba(96, 108, 56, 0.1);
            font-weight: 600;
        }

        nav a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 13px;
            letter-spacing: 0.2px;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            box-shadow: 0 3px 10px rgba(96, 108, 56, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(96, 108, 56, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), #bc6c25);
            color: var(--white);
            box-shadow: 0 3px 10px rgba(221, 161, 94, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(221, 161, 94, 0.4);
        }

        .btn-darker {
            background: linear-gradient(135deg, var(--primary), var(--dark-background));
            color: var(--white);
            box-shadow: 0 3px 10px rgba(96, 108, 56, 0.3);
        }

        /* Hero Section */
        .page-hero {
            background: linear-gradient(rgba(40, 54, 24, 0.85), rgba(40, 54, 24, 0.85)),
                url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            color: var(--white);
            text-align: center;
            padding: 80px 0;
            margin-bottom: 40px;
        }

        .page-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .page-hero p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Resources Section */
        .resources-section {
            padding: 50px 0;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 40px;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 70px;
            height: 3px;
            background: var(--accent);
            margin: 12px auto 0;
            border-radius: 3px;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .resource-card {
            background: var(--white);
            border-radius: 14px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(96, 108, 56, 0.1);
            text-align: center;
        }

        .resource-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .resource-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(96, 108, 56, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--primary);
        }

        .resource-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .resource-card ul {
            list-style: none;
            text-align: left;
            margin-bottom: 20px;
        }

        .resource-card ul li {
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }

        .resource-card ul li:before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--accent);
            font-size: 1.2rem;
        }

        /* Guides Section */
        .guides-section {
            background: var(--light-background);
            padding: 60px 0;
            border-radius: 14px;
            margin-bottom: 50px;
        }

        .guides-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .guides-content {
            flex: 1;
            min-width: 300px;
        }

        .guides-image {
            flex: 1;
            min-width: 300px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.06);
            height: 350px;
            background: url('https://images.unsplash.com/photo-1581578021243-93b5fccf16a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80') center/cover;
        }

        .guides-list {
            margin-top: 25px;
        }

        .guide-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(96, 108, 56, 0.05);
            border-radius: 10px;
        }

        .guide-item i {
            font-size: 1.4rem;
            color: var(--primary);
            min-width: 30px;
        }

        /* Support Section */
        .support-section {
            padding: 50px 0;
        }

        .support-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .support-card {
            background: var(--white);
            border-radius: 14px;
            padding: 25px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
        }

        .support-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .support-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        /* CTA Section */
        .cta {
            padding: 70px 0;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            margin: 50px 0;
        }

        .cta h2 {
            font-size: 2rem;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .cta p {
            font-size: 1.1rem;
            max-width: 650px;
            margin: 0 auto 30px;
            position: relative;
            z-index: 1;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Footer */
        footer {
            background-color: var(--dark-background);
            padding: 40px 0 15px;
            position: relative;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 18px;
            color: var(--earth-yellow);
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: var(--text-footer);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-column a:hover {
            color: var(--earth-yellow);
            padding-left: 3px;
        }

        .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 18px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(221, 161, 94, 0.15);
            border-radius: 50%;
            transition: var(--transition);
            font-size: 1rem;
            color: var(--earth-yellow);
        }

        .social-icons a:hover {
            background-color: var(--earth-yellow);
            color: var(--dark-background);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-footer);
            position: relative;
            z-index: 1;
            font-size: 0.9rem;
        }

        a.btn {
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .header-container {
                flex-direction: column;
                gap: 12px;
            }

            nav ul {
                gap: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-hero h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .guides-container {
                flex-direction: column;
            }

            .guides-image {
                height: 300px;
            }

            .section-title {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            .page-hero h1 {
                font-size: 1.7rem;
            }

            .page-hero {
                padding: 60px 0;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 8px;
            }
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-hands-helping"></i>
                <span>Trustyhands</span>
            </div>
            <nav>
                <ul>
                    <li><a href="research_homepage1.php">Home</a></li>
                    <li><a href="research_aboutUspage1.php">About Us</a></li>
                    <li><a href="research_servicespage1.php">Services</a></li>
                    <li><a href="research_howItWorkspage1.php">How It Works</a></li>
                    <li><a href="research_contactUspage1.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="research_index.php#signIn" class="btn btn-outline">Log In</a>
                <a href="research_index.php#signup" class="btn btn-primary">Sign Up</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h1>Customer Resources</h1>
            <p>Helpful tools, guides, and support for your service needs</p>
        </div>
    </section>

    <!-- Resources Section -->
    <section class="resources-section">
        <div class="container">
            <h2 class="section-title">Essential Resources for Customers</h2>

            <div class="resources-grid">
                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Service Guides</h3>
                    <p>Comprehensive guides to help you prepare for and understand various services:</p>
                    <ul>
                        <li>Home maintenance checklists</li>
                        <li>Pre-service preparation</li>
                        <li>Understanding service costs</li>
                        <li>Emergency preparedness</li>
                        <li>Seasonal home care</li>
                    </ul>
                    <button class="btn btn-outline">View Guides</button>
                </div>

                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <h3>How-To Videos</h3>
                    <p>Instructional videos for common home maintenance tasks and DIY projects:</p>
                    <ul>
                        <li>Basic home repairs</li>
                        <li>Troubleshooting tips</li>
                        <li>Preventative maintenance</li>
                        <li>Home safety checks</li>
                        <li>Preparing for professionals</li>
                    </ul>
                    <button class="btn btn-outline">Watch Videos</button>
                </div>

                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Planning Tools</h3>
                    <p>Helpful calculators and planners for your home service needs:</p>
                    <ul>
                        <li>Service cost estimator</li>
                        <li>Maintenance scheduler</li>
                        <li>Home project budget planner</li>
                        <li>Energy savings calculator</li>
                        <li>Home value estimator</li>
                    </ul>
                    <button class="btn btn-outline">Use Tools</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Guides Section -->
    <section class="guides-section">
        <div class="container">
            <div class="guides-container">
                <div class="guides-content">
                    <h2 class="section-title">Home Service Guides</h2>
                    <p>Our expert guides help you navigate home services and make informed decisions for your property.
                    </p>

                    <div class="guides-list">
                        <div class="guide-item">
                            <i class="fas fa-home"></i>
                            <div>
                                <h3>Finding the Right Professional</h3>
                                <p>Learn how to choose the best service provider for your specific needs.</p>
                            </div>
                        </div>

                        <div class="guide-item">
                            <i class="fas fa-calendar-check"></i>
                            <div>
                                <h3>Scheduling Services</h3>
                                <p>Tips for scheduling services at convenient times and managing appointments.</p>
                            </div>
                        </div>

                        <div class="guide-item">
                            <i class="fas fa-star"></i>
                            <div>
                                <h3>Understanding Ratings</h3>
                                <p>How to interpret worker ratings and reviews to make the best choice.</p>
                            </div>
                        </div>

                        <div class="guide-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <h3>Safety Best Practices</h3>
                                <p>Guidelines for ensuring a safe and secure service experience.</p>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Explore All Guides</button>
                </div>

                <div class="guides-image"></div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section class="support-section">
        <div class="container">
            <h2 class="section-title">Customer Support</h2>

            <div class="support-grid">
                <div class="support-card">
                    <i class="fas fa-headset"></i>
                    <h3>24/7 Support</h3>
                    <p>Our customer service team is available around the clock to assist with any questions or issues.
                    </p>
                    <button class="btn btn-outline">Contact Support</button>
                </div>

                <div class="support-card">
                    <i class="fas fa-question-circle"></i>
                    <h3>Help Center</h3>
                    <p>Find answers to common questions about booking, payments, and account management.</p>
                    <button class="btn btn-outline">Visit Help Center</button>
                </div>

                <div class="support-card">
                    <i class="fas fa-comments"></i>
                    <h3>Community Forums</h3>
                    <p>Connect with other customers, share experiences, and get advice.</p>
                    <button class="btn btn-outline">Join Community</button>
                </div>

                <div class="support-card">
                    <i class="fas fa-lightbulb"></i>
                    <h3>Tips & Best Practices</h3>
                    <p>Learn how to get the most out of your services and home maintenance.</p>
                    <button class="btn btn-outline">Read Tips</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Book Your Next Service?</h2>
            <p>Connect with trusted professionals for all your home service needs</p>
            <button class="btn btn-secondary">Find a Professional</button>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="logo" style="margin-bottom: 15px; font-size: 20px; color: var(--earth-yellow);">
                        <i class="fas fa-hands-helping"></i>
                        <span>Trustyhands</span>
                    </div>
                    <p style="font-size: 0.9rem; max-width: 300px; margin-bottom: 18px; color: var(--text-footer);">
                        Connecting customers with trusted local workers for any task, anytime, anywhere.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="research_homepage1.php">Home</a></li>
                        <li><a href="research_aboutUspage1.php">About Us</a></li>
                        <li><a href="research_servicespage1.php">Services</a></li>
                        <li><a href="research_howitWorkspage1.php">How it Works</a></li>
                        <li><a href="research_contactUspage1.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="helpcenter.php">Help Center</a></li>
                        <li><a href="safety.php">Safety Guidelines</a></li>
                        <li><a href="worker_resources.php">Worker Resources</a></li>
                        <li><a href="customer_resources.php">Customer Resources</a></li>
                        <li><a href="community.php">Community</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="terms.php">Terms of Service</a></li>
                        <li><a href="Privacy_Policy.php">Privacy Policy</a></li>
                        <li><a href="Worker_Agreement.php">Worker Agreement</a></li>
                        <li><a href="Cookie_Policy.php">Cookie Policy</a></li>
                        <li><a href="GDPR.php">GDPR Compliance</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Trustyhands. All rights reserved. Premium Service Platform</p>
            </div>
        </div>
    </footer>
</body>

</html>