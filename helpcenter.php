<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Trustyhands</title>
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
                url('https://images.unsplash.com/photo-1586769852836-bc069f19e1b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');
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

        /* FAQ Section */
        .faqs {
            padding: 40px 0;
            background: rgba(188, 108, 37, 0.05);
            border-radius: 14px;
            margin: 30px 0;
        }

        .faq-container {
            max-width: 750px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .faq-question {
            padding: 15px 20px;
            background: var(--primary);
            color: var(--white);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 18px;
            background: var(--white);
            display: none;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .faq-answer.active {
            display: block;
        }

        /* CTA Section */
        .cta {
            padding: 50px 0;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            margin: 30px 0;
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

        /* Search box styling */
        .search-box {
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            z-index: 2;
        }

        .search-input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border-radius: 30px;
            border: 2px solid rgba(96, 108, 56, 0.2);
            font-size: 1rem;
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(96, 108, 56, 0.2);
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
            .content-grid {
                grid-template-columns: 1fr;
            }

            .page-hero {
                padding: 50px 0;
            }

            .section-title {
                font-size: 1.6rem;
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

    <!-- Help Center Content -->
    <section class="page-hero">
        <div class="container">
            <h1>Help Center</h1>
            <p>Find answers to common questions and get support</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="content-card">
                <h2 class="section-title">How Can We Help You Today?</h2>

                <div style="display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <div class="resource-item">
                            <div class="resource-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="resource-content">
                                <h4>For Customers</h4>
                                <p>Booking services, payments, account issues</p>
                            </div>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 200px;">
                        <div class="resource-item">
                            <div class="resource-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="resource-content">
                                <h4>For Workers</h4>
                                <p>Account setup, job management, payments</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="search-box">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search help articles..." class="search-input">
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h2 class="section-title">Popular Help Topics</h2>

                <div class="content-grid">
                    <div class="grid-item">
                        <h3><i class="fas fa-question-circle"></i> Getting Started</h3>
                        <ul>
                            <li>Creating an account</li>
                            <li>Verifying your profile</li>
                            <li>Setting up payment methods</li>
                            <li>Understanding our platform</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-calendar-check"></i> Booking Services</h3>
                        <ul>
                            <li>How to book a service</li>
                            <li>Rescheduling appointments</li>
                            <li>Cancellation policy</li>
                            <li>Finding the right professional</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-money-bill-wave"></i> Payments & Pricing</h3>
                        <ul>
                            <li>Payment methods accepted</li>
                            <li>Understanding service fees</li>
                            <li>Refund policy</li>
                            <li>Promotions and discounts</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-shield-alt"></i> Safety & Trust</h3>
                        <ul>
                            <li>Worker verification process</li>
                            <li>Safety guidelines</li>
                            <li>Reporting issues</li>
                            <li>Insurance coverage</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="faqs">
                <div class="container">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <div class="faq-container">
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How do I create an account?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>To create an account, click on the "Sign Up" button at the top right corner of our
                                    website. You can sign up using your email address, phone number, or through your
                                    Google or Facebook account. After providing your basic information, you'll receive a
                                    verification email or SMS to activate your account.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How can I pay for services?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>We accept various payment methods including credit/debit cards, net banking, UPI, and
                                    digital wallets like Paytm and Google Pay. Payment is made securely through our
                                    platform after service completion. All transactions are encrypted and protected for
                                    your security.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                What if I need to cancel a booking?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>You can cancel a booking up to 24 hours before the scheduled service without any
                                    charge. For cancellations within 24 hours, a small fee may apply depending on the
                                    service. To cancel, go to your bookings section in the app or website and select the
                                    booking you wish to cancel.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How are workers verified?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>All workers undergo a rigorous 5-step verification process including identity
                                    verification, background checks, skill assessment, document verification, and
                                    reference checks. We also verify their professional experience and certifications to
                                    ensure they meet our quality standards.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                What if I'm not satisfied with the service?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>If you're not satisfied with the service, please contact our support team within 48
                                    hours of service completion. We'll work to resolve the issue, which may include a
                                    partial or full refund or arranging for re-service by a different professional. Our
                                    goal is to ensure 100% customer satisfaction.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How can I become a service professional?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>To join as a service professional, visit our "Become a Worker" page and fill out the
                                    application form. You'll need to provide proof of your skills, experience, and
                                    identification documents. After verification and a background check, you'll be
                                    onboarded to our platform and can start accepting jobs.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                What safety measures are in place?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>We prioritize safety with verified professionals, in-app tracking, SOS button, and
                                    service insurance. All professionals undergo safety training and background checks.
                                    Customers can share service details with emergency contacts and track service
                                    professionals in real-time through the app.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How do I contact customer support?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>You can contact our 24/7 customer support through multiple channels: in-app chat,
                                    email at support@trustyhands.com, or by calling our toll-free number 1800-123-4567.
                                    We also have a comprehensive Help Center with articles and guides for self-service
                                    support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cta">
                <h2>Still Need Help?</h2>
                <p>Our support team is available 24/7 to assist you with any questions or issues</p>
                <button class="btn btn-secondary">Contact Support</button>
            </div>
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
    <script>
        // Function to toggle FAQ
        function toggleFaq(element) {
            const answer = element.nextElementSibling;
            const isActive = answer.classList.contains('active');

            // Close all open FAQs
            document.querySelectorAll('.faq-answer').forEach(ans => {
                ans.classList.remove('active');
            });

            // Toggle the clicked FAQ
            if (!isActive) {
                answer.classList.add('active');
            }
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function () {
            // Set active navigation
            document.querySelectorAll('nav a').forEach(link => {
                link.classList.remove('active');
            });

            // Add search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('keyup', function (e) {
                if (e.key === 'Enter') {
                    alert(`Searching for: ${this.value}`);
                    // In a real implementation, you would filter/search content here
                }
            });

            // Add contact button functionality
            const contactBtn = document.querySelector('.btn-secondary');
            contactBtn.addEventListener('click', function () {
                alert('Redirecting to contact support page...');
                // In a real implementation, you would redirect to contact page
            });
        });
    </script>
</body>

</html>