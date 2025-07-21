<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works - Trustyhands Premium Service Platform</title>
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

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #FF9933, var(--white), #138808);
            z-index: 100;
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
            background: linear-gradient(135deg, var(--primary), #283618);
            color: var(--white);
            box-shadow: 0 3px 10px rgba(96, 108, 56, 0.3);
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
            /* Reduced padding */
            margin-bottom: 30px;
            /* Reduced margin */
        }

        .about-hero h1 {
            font-size: 2.5rem;
            /* Slightly smaller */
            margin-bottom: 15px;
            /* Reduced margin */
            font-weight: 700;
        }

        .about-hero p {
            font-size: 1.1rem;
            /* Slightly smaller */
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 50px 0;
        }

        .section-title {
            text-align: center;
            font-size: 1.6rem;
            margin-bottom: 40px;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin: 12px auto 0;
            border-radius: 3px;
        }

        /* Steps Section */
        .steps-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 60px;
        }

        .process-card {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            border-radius: 14px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
            border: 1px solid rgba(96, 108, 56, 0.1);
        }

        .process-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .process-icon {
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

        .process-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .step-list {
            text-align: left;
            margin-top: 20px;
        }

        .step-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed rgba(96, 108, 56, 0.2);
        }

        .step-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .step-number {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .step-content h4 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: var(--text);
        }

        /* Benefits Section */
        .benefits {
            background: var(--light-background);
            padding: 60px 0;
            border-radius: 14px;
            margin-bottom: 60px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .benefit-card {
            background: var(--white);
            border-radius: 14px;
            padding: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
            border: 1px solid rgba(96, 108, 56, 0.1);
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .benefit-card h3 {
            font-size: 1.2rem;
            margin-bottom: 12px;
            color: var(--primary);
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
            margin-bottom: 60px;
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

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* FAQ Section */
        .faqs {
            padding: 40px 0;
            background: rgba(188, 108, 37, 0.05);
            border-radius: 14px;
            margin-bottom: 60px;
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
            .steps-container {
                flex-direction: column;
            }
        }

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

            .page-title {
                padding: 50px 0 30px;
            }

            .page-title h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.4rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .page-title h1 {
                font-size: 1.6rem;
            }

            .process-card {
                padding: 20px;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 10% auto;
            padding: 30px;
            border-radius: 15px;
            max-width: 450px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: modalOpen 0.4s;
        }

        @keyframes modalOpen {
            from {
                opacity: 0;
                transform: translateY(-60px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-icon {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .modal-content h2 {
            color: var(--primary);
            margin-bottom: 15px;
        }

        .modal-content p {
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: var(--text-light);
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
            transition: var(--transition);
        }

        .close:hover {
            color: var(--accent);
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
                    <li><a href="research_servicespage1.php" class="active">Services</a></li>
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
            <h1>How Trustyhands Works</h1>
            <p>Simple steps to get quality services or start earning with Trustyhands</p>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">For Customers</h2>
            <p
                style="text-align: center; max-width: 800px; margin: 0 auto 40px; font-size: 1.1rem; color: var(--text-light);">
                Getting the service you need is quick and easy with Trustyhands. Follow these simple steps to find
                trusted professionals.
            </p>

            <div class="steps-container">
                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Find & Book</h3>
                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Browse Services</h4>
                                <p>Explore our wide range of professional services</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Select a Worker</h4>
                                <p>View profiles, ratings, and reviews</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Book Your Service</h4>
                                <p>Choose date, time, and service details</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Get Service</h3>
                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h4>Confirm Appointment</h4>
                                <p>Receive confirmation and reminders</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <h4>Professional Service</h4>
                                <p>Our expert arrives on time to serve you</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">6</div>
                            <div class="step-content">
                                <h4>Secure Payment</h4>
                                <p>Pay safely through our platform</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="section-title">For Workers</h2>
            <p
                style="text-align: center; max-width: 800px; margin: 0 auto 40px; font-size: 1.1rem; color: var(--text-light);">
                Join our platform to offer your services and grow your business. Here's how to get started as a
                Trustyhands professional.
            </p>

            <div class="steps-container">
                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3>Join & Setup</h3>
                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Create Profile</h4>
                                <p>Sign up and complete your professional profile</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Verification</h4>
                                <p>Complete our verification process</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Set Availability</h4>
                                <p>Choose when and where you want to work</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="process-card">
                    <div class="process-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Work & Earn</h3>
                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h4>Get Hired</h4>
                                <p>Receive service requests from customers</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <h4>Complete Service</h4>
                                <p>Provide excellent service to customers</p>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-number">6</div>
                            <div class="step-content">
                                <h4>Get Paid</h4>
                                <p>Receive secure payments through our platform</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="container">
            <h2 class="section-title">Why Choose Trustyhands</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Verified Professionals</h3>
                    <p>All workers undergo thorough background checks and verification</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Transparent Pricing</h3>
                    <p>No hidden fees. Know the cost upfront with no surprises</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated support team is available anytime to help</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Customer Ratings</h3>
                    <p>Read reviews and choose the best professional for your needs</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers and skilled professionals on our platform today.</p>
            <div class="cta-buttons">
                <button class="btn btn-secondary trigger-modal">Find a Worker</button>
                <button class="btn btn-darker trigger-modal">Become a Worker</button>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="faqs">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How quickly can I get service after booking?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Most services can be scheduled within 24 hours. For urgent requests, we have professionals
                            available for same-day service in many areas.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How do I become a Trustyhands worker?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Simply sign up on our platform, complete your profile, and go through our verification
                            process. Once approved, you can start accepting service requests.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        What safety measures are in place?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>All workers are verified through background checks. We also have a rating system and 24/7
                            support to ensure safety for both customers and workers.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How does payment work?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Customers pay securely through our platform. Workers receive payment directly to their
                            account after service completion, minus our small service fee.</p>
                    </div>
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
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Login Required</h2>
            <p>Please login or signup to access all features of Trustyhands</p>
            <div class="modal-buttons">
                <a href="research_index.php#signIn" class="btn btn-outline">Log In</a>
                <a href="research_index.php#signup" class="btn btn-primary">Sign Up</a>
            </div>
        </div>
    </div>
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
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                if (link.textContent === 'How It Works') {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
        // Get the modal
        const modal = document.getElementById("loginModal");

        // Get buttons that open the modal
        const btns = document.querySelectorAll(".trigger-modal");

        // Get the <span> element that closes the modal
        const span = document.querySelector(".close");

        // When user clicks on a button, open modal
        btns.forEach(btn => {
            btn.addEventListener("click", () => {
                modal.style.display = "block";
            });
        });

        // When user clicks on <span> (x), close modal
        span.addEventListener("click", () => {
            modal.style.display = "none";
        });

        // When user clicks anywhere outside modal, close it
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

    </script>
</body>

</html>