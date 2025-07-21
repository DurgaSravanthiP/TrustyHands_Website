<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Guidelines - Trustyhands</title>
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
                url('https://images.unsplash.com/photo-1581578021060-0b3aab53a6c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');
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

        .safety-badge {
            display: inline-block;
            background: var(--light-background);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .safety-tip {
            background: rgba(188, 108, 37, 0.05);
            border-left: 4px solid var(--accent);
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
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

        /* Safety Level Indicators */
        .safety-levels {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px 0;
        }

        .safety-level {
            flex: 1;
            min-width: 250px;
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary);
        }

        .safety-level.high {
            border-left-color: #4CAF50;
        }

        .safety-level.medium {
            border-left-color: #FFC107;
        }

        .safety-level.low {
            border-left-color: #F44336;
        }

        .safety-level h4 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: var(--primary);
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

            .safety-levels {
                flex-direction: column;
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

    <!-- Safety Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h1>Safety Guidelines</h1>
            <p>Your safety is our top priority. Learn how we protect our community and how you can stay safe.</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="content-card">
                <h2 class="section-title">Our Safety Commitment</h2>
                <p>At Trustyhands, we've built a platform with safety at its core. Our comprehensive safety measures
                    include:</p>

                <div style="display: flex; gap: 15px; margin: 30px 0; flex-wrap: wrap;">
                    <div class="resource-item" style="flex: 1; min-width: 200px;">
                        <div class="resource-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="resource-content">
                            <h4>Verified Professionals</h4>
                            <p>Rigorous background checks and identity verification</p>
                        </div>
                    </div>

                    <div class="resource-item" style="flex: 1; min-width: 200px;">
                        <div class="resource-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="resource-content">
                            <h4>Secure Payments</h4>
                            <p>Encrypted transactions and payment protection</p>
                        </div>
                    </div>

                    <div class="resource-item" style="flex: 1; min-width: 200px;">
                        <div class="resource-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="resource-content">
                            <h4>24/7 Support</h4>
                            <p>Immediate assistance for safety concerns</p>
                        </div>
                    </div>
                </div>

                <div class="safety-tip">
                    <strong>Safety Tip:</strong> Always communicate through the Trustyhands platform to maintain privacy
                    and security. Never share personal contact information until you've established trust.
                </div>
            </div>

            <div class="content-card">
                <h2 class="section-title">Essential Safety Practices</h2>

                <div class="content-grid">
                    <div class="grid-item">
                        <h3><i class="fas fa-user-check"></i> Identity Verification</h3>
                        <ul>
                            <li>Always verify worker profiles with the "Verified" badge</li>
                            <li>Check worker ratings and reviews before hiring</li>
                            <li>Confirm worker identity at the beginning of each job</li>
                            <li>Report any discrepancies immediately</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-comments"></i> Safe Communication</h3>
                        <ul>
                            <li>Use Trustyhands messaging for all communication</li>
                            <li>Never share personal financial information</li>
                            <li>Be cautious of requests for upfront payments</li>
                            <li>Report suspicious messages to our support team</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-home"></i> Home Safety</h3>
                        <ul>
                            <li>Meet in a public place for initial discussions</li>
                            <li>Secure valuables before inviting workers into your home</li>
                            <li>Have another adult present during service appointments</li>
                            <li>Trust your instincts - cancel if something feels wrong</li>
                        </ul>
                    </div>

                    <div class="grid-item">
                        <h3><i class="fas fa-money-bill-wave"></i> Secure Payments</h3>
                        <ul>
                            <li>Always pay through the Trustyhands platform</li>
                            <li>Never pay cash directly to workers</li>
                            <li>Review service agreements before payment</li>
                            <li>Report any requests for offline payments</li>
                        </ul>
                    </div>
                </div>

                <h3 class="section-subtitle">Safety Levels for Different Services</h3>
                <div class="safety-levels">
                    <div class="safety-level high">
                        <h4><i class="fas fa-check-circle"></i> Low Risk Services</h4>
                        <p>Services like gardening, cleaning, or minor repairs that typically require minimal
                            interaction and are performed in open areas.</p>
                        <span class="safety-badge">Low Risk</span>
                    </div>

                    <div class="safety-level medium">
                        <h4><i class="fas fa-exclamation-triangle"></i> Medium Risk Services</h4>
                        <p>Services requiring access to your home like plumbing, electrical work, or installations where
                            workers need access to multiple rooms.</p>
                        <span class="safety-badge">Medium Risk</span>
                    </div>

                    <div class="safety-level low">
                        <h4><i class="fas fa-exclamation-circle"></i> High Risk Services</h4>
                        <p>Services that require extended time in your home, working in private areas, or with
                            vulnerable individuals.</p>
                        <span class="safety-badge">High Risk</span>
                    </div>
                </div>
            </div>

            <div class="faqs">
                <div class="container">
                    <h2 class="section-title">Safety FAQs</h2>
                    <div class="faq-container">
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How does Trustyhands verify workers?
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
                                What should I do if I feel unsafe during a service?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>If you feel unsafe at any point during a service, immediately remove yourself from
                                    the situation and contact our 24/7 safety hotline at 1-800-SAFETY-TH. You can also
                                    use the emergency button in our mobile app to alert our security team and local
                                    authorities if needed.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How are payments protected?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>All payments are processed through our secure platform with bank-grade encryption. We
                                    hold payments in escrow until service completion and satisfaction. Never pay workers
                                    directly - this violates our terms and removes your payment protection.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                What information should I never share?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>Never share sensitive personal information such as your social security number, bank
                                    account details, passwords, or copies of identification documents. Workers only need
                                    your name, service address, and contact number to perform their services.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                What safety features does the app have?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>Our mobile app includes several safety features: real-time location sharing with
                                    emergency contacts, in-app emergency button, service tracking, photo verification of
                                    workers, and the ability to discreetly alert our security team if you feel unsafe.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFaq(this)">
                                How do I report a safety concern?
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>You can report safety concerns through our mobile app, website, or by calling our
                                    safety hotline. We take all reports seriously and investigate them immediately. Your
                                    report can remain anonymous if you prefer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cta">
                <h2>Report a Safety Concern</h2>
                <p>If you encounter any safety issues or suspicious behavior, please report it immediately. Our safety
                    team is available 24/7.</p>
                <button class="btn btn-secondary">Report Now</button>
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
                if (link.href === window.location.href) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Add contact button functionality
            const contactBtn = document.querySelector('.btn-secondary');
            contactBtn.addEventListener('click', function () {
                alert('Redirecting to safety reporting page...');
                // In a real implementation, you would redirect to contact page
            });
        });
    </script>
</body>

</html>