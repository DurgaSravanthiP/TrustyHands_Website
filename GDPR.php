<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDPR Compliance - Trustyhands Premium Service Platform</title>
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

        /* Hero Section */
        .about-hero {
            background: linear-gradient(rgba(40, 54, 24, 0.85), rgba(40, 54, 24, 0.85)),
                url('https://media.istockphoto.com/id/1412440577/vector/hiring-a-new-member.jpg?s=612x612&w=0&k=20&c=4qK1gAhY5ByiR9r-tGdaI_xL2GcVSmNPRpPj0l5K0QY=');
            background-size: cover;
            background-position: center;
            color: var(--white);
            text-align: center;
            padding: 70px 0;
            margin-bottom: 30px;
        }

        .about-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* Main Content */
        .legal-content {
            background: var(--white);
            border-radius: 14px;
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            line-height: 1.8;
        }

        .legal-content h2 {
            color: var(--primary);
            margin: 30px 0 15px;
            font-size: 1.5rem;
        }

        .legal-content h3 {
            color: var(--accent);
            margin: 25px 0 10px;
            font-size: 1.2rem;
        }

        .legal-content p {
            margin-bottom: 15px;
            color: var(--text-light);
        }

        .legal-content ul {
            margin: 15px 0 25px 30px;
        }

        .legal-content li {
            margin-bottom: 10px;
            color: var(--text-light);
        }

        .update-date {
            text-align: right;
            font-style: italic;
            color: var(--text-light);
            margin-top: 30px;
            border-top: 1px solid rgba(96, 108, 56, 0.1);
            padding-top: 15px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 12px;
            }

            nav ul {
                gap: 8px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .about-hero h1 {
                font-size: 1.8rem;
            }

            .legal-content {
                padding: 25px;
            }
        }

        @media (max-width: 480px) {
            .legal-content {
                padding: 20px 15px;
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
    <section class="about-hero">
        <div class="container">
            <h1>GDPR Compliance</h1>
            <p>Our commitment to data protection</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="legal-section">
        <div class="container">
            <div class="legal-content">
                <h2>1. Our GDPR Commitment</h2>
                <p>Trustyhands is committed to compliance with the EU General Data Protection Regulation (GDPR). We
                    protect the personal data of our EU users according to GDPR requirements.</p>

                <h2>2. Data Protection Principles</h2>
                <p>We adhere to the following principles:</p>
                <ul>
                    <li><strong>Lawfulness, fairness and transparency:</strong> Processing data legally and
                        transparently</li>
                    <li><strong>Purpose limitation:</strong> Collecting data for specified purposes</li>
                    <li><strong>Data minimization:</strong> Only collecting necessary data</li>
                    <li><strong>Accuracy:</strong> Keeping data accurate and up-to-date</li>
                    <li><strong>Storage limitation:</strong> Retaining data only as long as necessary</li>
                    <li><strong>Integrity and confidentiality:</strong> Securing personal data</li>
                </ul>

                <h2>3. Your Rights Under GDPR</h2>
                <h3>3.1 Right to Access</h3>
                <p>You can request a copy of your personal data held by us.</p>

                <h3>3.2 Right to Rectification</h3>
                <p>You can request correction of inaccurate personal data.</p>

                <h3>3.3 Right to Erasure</h3>
                <p>You can request deletion of your personal data ("right to be forgotten").</p>

                <h3>3.4 Right to Restriction</h3>
                <p>You can request restriction of processing your data.</p>

                <h3>3.5 Right to Data Portability</h3>
                <p>You can receive your data in a structured, machine-readable format.</p>

                <h3>3.6 Right to Object</h3>
                <p>You can object to processing of your personal data.</p>

                <h2>4. Data Processing Agreements</h2>
                <p>We have Data Processing Agreements (DPAs) with all third-party service providers that handle EU
                    personal data.</p>

                <h2>5. International Data Transfers</h2>
                <p>When transferring data outside the EEA, we use:</p>
                <ul>
                    <li>EU Standard Contractual Clauses</li>
                    <li>Adequacy decisions</li>
                    <li>Other approved transfer mechanisms</li>
                </ul>

                <h2>6. Data Protection Officer</h2>
                <p>We have appointed a Data Protection Officer (DPO):</p>
                <p>Contact our DPO at: <strong>dpo@trustyhands.com</strong></p>

                <h2>7. Data Breach Procedures</h2>
                <p>In case of a data breach affecting EU personal data, we will:</p>
                <ul>
                    <li>Notify supervisory authorities within 72 hours</li>
                    <li>Notify affected individuals without undue delay</li>
                    <li>Take immediate steps to contain and mitigate the breach</li>
                </ul>

                <div class="update-date">
                    <p>Last Updated: October 15, 2023</p>
                </div>
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
</body>

</html>