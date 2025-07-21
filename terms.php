<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - Terms of Service</title>
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
            background-color: var(--white);
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
            text-decoration: none;
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

        .btn-darker:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(96, 108, 56, 0.4);
        }

        /* Page Hero Section */
        .page-hero {
            background: linear-gradient(rgba(40, 54, 24, 0.85), rgba(40, 54, 24, 0.85)),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            color: var(--white);
            text-align: center;
            padding: 70px 0;
            margin-bottom: 20px;
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

        /* Content Section */
        .content-section {
            padding: 30px 0;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 25px;
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

        .section-subtitle {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 15px;
            position: relative;
            padding-left: 15px;
        }

        .section-subtitle::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
        }

        .content-card {
            background: var(--white);
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(96, 108, 56, 0.1);
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .grid-item {
            background: rgba(96, 108, 56, 0.05);
            border-radius: 14px;
            padding: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .grid-item h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid-item h3 i {
            color: var(--accent);
        }

        .grid-item ul {
            padding-left: 20px;
        }

        .grid-item ul li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 10px;
        }

        .grid-item ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--accent);
        }

        .resources-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .resource-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: rgba(96, 108, 56, 0.05);
            border-radius: 8px;
            transition: var(--transition);
        }

        .resource-item:hover {
            background: rgba(96, 108, 56, 0.1);
            transform: translateX(5px);
        }

        .resource-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--light-background);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .resource-content h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: var(--primary);
        }

        .community-post {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--earth-yellow);
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .post-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--light-background);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .post-author {
            font-weight: 600;
            color: var(--primary);
        }

        .post-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .post-content {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .post-stats {
            display: flex;
            gap: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .post-stats i {
            margin-right: 5px;
        }

        /* Terms of Service Styling */
        .terms-section {
            margin-bottom: 30px;
        }

        .terms-section h2 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.5rem;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(96, 108, 56, 0.2);
        }

        .terms-section h3 {
            color: var(--tigers-eye);
            margin: 20px 0 10px;
            font-size: 1.2rem;
        }

        .terms-section p {
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .terms-section ul {
            padding-left: 30px;
            margin-bottom: 20px;
        }

        .terms-section li {
            margin-bottom: 10px;
            position: relative;
        }

        .terms-section li::before {
            content: '•';
            position: absolute;
            left: -15px;
            color: var(--accent);
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

        /* Tabs for switching pages */
        .tabs-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .tab {
            padding: 15px 30px;
            background: var(--light-background);
            cursor: pointer;
            font-weight: 600;
            color: var(--primary);
            border-radius: 8px 8px 0 0;
            margin: 0 5px;
            transition: var(--transition);
        }

        .tab.active {
            background: var(--primary);
            color: white;
        }

        /* FIXED THE ISSUE: Changed display to block by default */
        .page-content {
            display: block;
            /* Changed from none to block */
        }

        /* Removed the .page-content.active rule since we don't need it anymore */

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
            .content-grid {
                grid-template-columns: 1fr;
            }

            .page-hero {
                padding: 50px 0;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .tabs-container {
                flex-direction: column;
            }

            .tab {
                border-radius: 8px;
                margin-bottom: 5px;
            }
        }

        @media (max-width: 480px) {
            .page-hero h1 {
                font-size: 1.7rem;
            }

            .content-card {
                padding: 20px;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 100;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .scroll-top.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top:hover {
            background: var(--tigers-eye);
            transform: translateY(-3px);
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

    <!-- Terms of Service Page Content -->
    <div id="terms-page" class="page-content">
        <!-- Terms Hero Section -->
        <section class="page-hero"
            style="background-image: linear-gradient(rgba(40, 54, 24, 0.85), rgba(40, 54, 24, 0.85)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');">
            <div class="container">
                <h1>Terms of Service</h1>
                <p>Last Updated: October 15, 2023</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-card">
                    <div class="terms-section">
                        <p>Welcome to Trustyhands! These Terms of Service ("Terms") govern your access to and use of our
                            website, services, and applications (collectively, the "Service"). Please read these Terms
                            carefully before using the Service.</p>
                    </div>

                    <div class="terms-section">
                        <h2>1. Acceptance of Terms</h2>
                        <p>By accessing or using the Service, you agree to be bound by these Terms and our Privacy
                            Policy. If you do not agree to these Terms, you may not use the Service.</p>
                    </div>

                    <div class="terms-section">
                        <h2>2. Description of Service</h2>
                        <p>Trustyhands provides a platform that connects customers seeking home services ("Customers")
                            with independent service professionals ("Service Providers"). We are not a provider of home
                            services and do not employ Service Providers.</p>
                    </div>

                    <div class="terms-section">
                        <h2>3. User Accounts</h2>
                        <h3>3.1 Account Creation</h3>
                        <p>To access certain features, you must register for an account. You agree to provide accurate
                            information and update it as necessary.</p>

                        <h3>3.2 Account Security</h3>
                        <p>You are responsible for maintaining the confidentiality of your account credentials and for
                            all activities under your account.</p>
                    </div>

                    <div class="terms-section">
                        <h2>4. Service Bookings</h2>
                        <h3>4.1 Booking Process</h3>
                        <p>Customers may book services through the platform. All services are provided by independent
                            Service Providers, not by Trustyhands.</p>

                        <h3>4.2 Cancellation Policy</h3>
                        <p>Cancellations made less than 24 hours before a scheduled service may incur a fee as specified
                            in our Cancellation Policy.</p>
                    </div>

                    <div class="terms-section">
                        <h2>5. Payments and Fees</h2>
                        <h3>5.1 Service Fees</h3>
                        <p>Customers agree to pay the amount specified at the time of booking. Payment is processed
                            through our secure payment system.</p>

                        <h3>5.2 Trustyhands Service Fee</h3>
                        <p>We charge a service fee for use of the platform, which is included in the total price shown
                            to Customers.</p>
                    </div>

                    <div class="terms-section">
                        <h2>6. User Responsibilities</h2>
                        <h3>6.1 Customer Responsibilities</h3>
                        <ul>
                            <li>Provide accurate service requirements</li>
                            <li>Ensure safe access to the service location</li>
                            <li>Provide necessary information to Service Providers</li>
                        </ul>

                        <h3>6.2 Service Provider Responsibilities</h3>
                        <ul>
                            <li>Provide services with reasonable skill and care</li>
                            <li>Comply with all applicable laws and regulations</li>
                            <li>Maintain appropriate insurance</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2>7. Intellectual Property</h2>
                        <p>All content on the Service, including text, graphics, logos, and software, is the property of
                            Trustyhands or its licensors and is protected by intellectual property laws.</p>
                    </div>

                    <div class="terms-section">
                        <h2>8. Disclaimers and Limitations</h2>
                        <h3>8.1 Service "As Is"</h3>
                        <p>The Service is provided "as is" without warranties of any kind. We do not guarantee the
                            quality of services provided by Service Providers.</p>

                        <h3>8.2 Limitation of Liability</h3>
                        <p>Trustyhands shall not be liable for any indirect, incidental, or consequential damages
                            arising from your use of the Service.</p>
                    </div>

                    <div class="terms-section">
                        <h2>9. Modifications to Terms</h2>
                        <p>We may modify these Terms at any time. We will provide notice of significant changes. Your
                            continued use constitutes acceptance of the revised Terms.</p>
                    </div>

                    <div class="terms-section">
                        <h2>10. Governing Law</h2>
                        <p>These Terms shall be governed by the laws of the State of California, without regard to its
                            conflict of laws principles.</p>
                    </div>

                    <div class="terms-section">
                        <h2>11. Contact Information</h2>
                        <p>For questions about these Terms, please contact us at legal@trustyhands.com or at our mailing
                            address:</p>
                        <p>Trustyhands Inc.<br>
                            123 Service Avenue<br>
                            San Francisco, CA 94107</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function () {
            // Set active navigation
            document.querySelectorAll('nav a').forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Scroll to top functionality
            const scrollTopBtn = document.getElementById('scrollTop');

            // Show/hide scroll to top button
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollTopBtn.classList.add('visible');
                } else {
                    scrollTopBtn.classList.remove('visible');
                }
            });

            // Scroll to top when clicked
            scrollTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>