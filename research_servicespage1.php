<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Trustyhands Premium Service Platform</title>
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

        /* Hero Section */
        .about-hero {
            background: linear-gradient(rgba(40, 54, 24, 0.85), rgba(40, 54, 24, 0.85)),
                url('https://as1.ftcdn.net/jpg/02/88/87/08/1000_F_288870859_TApbprozXIUOwNTFMWREYJLHHKP332JM.jpg');
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

        /* Search and Filter Section */
        .search-filter {
            background: var(--white);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .search-container {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 200px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 18px 10px 40px;
            border-radius: 30px;
            border: 2px solid var(--light-background);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-box input:focus {
            border-color: var(--primary);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }

        .sort-filter {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .sort-filter select {
            padding: 8px 15px;
            border-radius: 30px;
            border: 2px solid var(--light-background);
            font-size: 0.9rem;
            background: var(--white);
            cursor: pointer;
        }

        .category-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .category-tab {
            padding: 6px 16px;
            background: var(--light-background);
            border-radius: 30px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .category-tab.active,
        .category-tab:hover {
            background: var(--primary);
            color: var(--white);
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
            margin: 25px 0 40px;
        }

        .service-card {
            background: var(--white);
            border-radius: 10px;
            padding: 22px 12px 12px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(96, 108, 56, 0.1);
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: rgba(96, 108, 56, 0.3);
        }

        .service-icon {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 10px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text);
        }

        .service-desc {
            color: var(--text-light);
            font-size: 0.8rem;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--white);
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
            z-index: 10;
            background: rgba(255, 255, 255, 0.8);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .close-modal:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .modal-header {
            padding: 20px 20px 12px;
            background: var(--primary);
            color: var(--white);
            position: relative;
            border-radius: 15px 15px 0 0;
        }

        .modal-header h2 {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }

        .modal-body {
            padding: 20px;
        }

        .service-details {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .service-details-img {
            flex: 1;
            min-width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--light-background), #fdf7d5);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2rem;
        }

        .service-details-info {
            flex: 2;
            min-width: 200px;
        }

        .details-meta {
            display: flex;
            gap: 12px;
            margin: 12px 0;
            flex-wrap: wrap;
        }

        .meta-item {
            text-align: center;
            min-width: 70px;
        }

        .meta-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .meta-label {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .book-now-btn {
            width: 100%;
            padding: 10px;
            background: var(--accent);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.95rem;
            margin: 15px 0;
            box-shadow: 0 4px 8px rgba(188, 108, 37, 0.3);
        }

        .book-now-btn:hover {
            background: #a55a1d;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(188, 108, 37, 0.4);
        }

        /* Join as Worker */
        .join-worker {
            background: linear-gradient(135deg, var(--primary), var(--dark-background));
            color: var(--white);
            padding: 40px 0;
            text-align: center;
            margin: 40px 0;
            border-radius: 15px;
        }

        .join-worker h2 {
            font-size: 1.8rem;
            margin-bottom: 12px;
        }

        .join-worker p {
            max-width: 600px;
            margin: 0 auto 20px;
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Testimonials */
        .testimonials {
            padding: 50px 0;
            background: var(--light-background);
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 30px;
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

        .testimonial-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .testimonial {
            background-color: var(--white);
            padding: 25px;
            border-radius: 14px;
            position: relative;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .testimonial:hover {
            transform: translateY(-6px);
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .testimonial-header i {
            font-size: 1.8rem;
            color: var(--accent);
            margin-right: 12px;
        }

        .testimonial::before {
            content: '"';
            position: absolute;
            top: 12px;
            right: 20px;
            font-size: 4.5rem;
            color: rgba(188, 108, 37, 0.1);
            font-family: Georgia, serif;
            line-height: 1;
            z-index: 0;
        }

        .client {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .client-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-right: 12px;
            background: var(--light-background);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--primary);
            font-weight: bold;
        }

        .client-info h4 {
            color: var(--text);
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .client-info p {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* FAQs */
        .faqs {
            padding: 50px 0;
            background: var(--white);
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .faq-question {
            padding: 16px 20px;
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
            background: var(--light-background);
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
            margin-top: 40px;
            color: var(--white);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
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

            .services-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .service-card {
                height: auto;
            }

            .service-icon {
                font-size: 1.6rem;
            }

            .page-title h1 {
                font-size: 1.9rem;
            }

            .page-title p {
                font-size: 0.95rem;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .search-container {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .modal-content {
                width: 95%;
            }

            .service-details {
                flex-direction: column;
            }

            .service-details-img {
                min-width: 100%;
                height: 80px;
            }

            .details-meta {
                gap: 10px;
            }

            .meta-item {
                min-width: 60px;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* New styles for view info button */
        .view-info-btn {
            padding: 6px 12px;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            border: none;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            font-size: 12px;
            align-self: center;
            width: 90px;
            margin-top: 8px;
        }

        .view-info-btn:hover {
            background: var(--dark-background);
            transform: translateY(-2px);
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
            <h1>Our Premium Services</h1>
            <p>Find trusted professionals for all your home service needs</p>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-filter">
        <div class="container">
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search for a service (e.g. 'electrician')">
                </div>
                <div class="sort-filter">
                    <select id="sortSelect">
                        <option value="popularity">Sort by: Popularity</option>
                        <option value="price-low">Sort by: Price (Low to High)</option>
                        <option value="price-high">Sort by: Price (High to Low)</option>
                        <option value="rating">Sort by: Highest Rating</option>
                    </select>
                </div>
            </div>

            <div class="category-tabs">
                <div class="category-tab active" data-category="all">All Services</div>
                <div class="category-tab" data-category="domestic">Domestic Help</div>
                <div class="category-tab" data-category="repairs">Repairs</div>
                <div class="category-tab" data-category="event">Event Help</div>
                <div class="category-tab" data-category="movers">Movers</div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services">
        <div class="container">
            <div class="services-grid" id="servicesGrid">
                <!-- Service cards will be dynamically loaded here -->
            </div>
        </div>
    </section>

    <!-- Join as Worker Section -->
    <section class="join-worker">
        <div class="container">
            <h2>Want to Offer Your Services?</h2>
            <p>Join thousands of skilled professionals earning competitive income by offering your expertise to our
                community of customers.</p>
            <button class="btn btn-secondary">Join as a Worker</button>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Customer Testimonials</h2>
            <div class="testimonial-container">
                <div class="testimonial">
                    <div class="testimonial-header">
                        <i class="fas fa-user"></i>
                        <h3>Plumbing Services</h3>
                    </div>
                    <p>"Trustyhands saved me when my kitchen sink burst on a Sunday! Found a plumber within 20 minutes
                        who fixed everything professionally. The platform is incredibly easy to use and the quality of
                        service exceeded my expectations."</p>
                    <div class="client">
                        <div class="client-avatar">SJ</div>
                        <div class="client-info">
                            <h4>Sarah Johnson</h4>
                            <p>Homeowner in New York</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-header">
                        <i class="fas fa-broom"></i>
                        <h3>Cleaning Services</h3>
                    </div>
                    <p>"The deep cleaning service was exceptional! The team arrived on time, brought all their own
                        supplies, and left my home spotless. I've booked them for monthly cleanings now. Highly
                        recommend Trustyhands for all home services!"</p>
                    <div class="client">
                        <div class="client-avatar">MC</div>
                        <div class="client-info">
                            <h4>Michael Chen</h4>
                            <p>Busy Professional</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-header">
                        <i class="fas fa-tools"></i>
                        <h3>Electrical Work</h3>
                    </div>
                    <p>"I needed several electrical outlets installed in my home office. The electrician from
                        Trustyhands was knowledgeable, efficient, and cleaned up after himself. Pricing was transparent
                        and fair. Will definitely use again!"</p>
                    <div class="client">
                        <div class="client-avatar">ER</div>
                        <div class="client-info">
                            <h4>Emma Rodriguez</h4>
                            <p>Remote Worker</p>
                        </div>
                    </div>
                </div>
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
                        Are all workers background verified?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all workers on Trustyhands undergo a thorough background verification process. This
                            includes identity verification, criminal background checks, and professional reference
                            checks. Your safety is our top priority.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How does payment work?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We offer secure payment processing through our platform. You can pay via credit card, debit
                            card, or digital wallet. Payment is only released to the worker after you confirm
                            satisfactory completion of the service.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Can I reschedule my booking?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely! You can reschedule your booking up to 24 hours before the appointment at no extra
                            charge. Simply go to your bookings in the app or website and select the reschedule option.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        What if I'm not satisfied with the service?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We stand behind our services with a 100% satisfaction guarantee. If you're not completely
                            satisfied with the work performed, contact our support team within 48 hours and we'll
                            arrange for the issue to be resolved at no additional cost.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How are workers rated and reviewed?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>After each completed service, customers are prompted to rate their experience and provide
                            feedback. These ratings and reviews are displayed on worker profiles to help you make
                            informed decisions when booking services.</p>
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

    <!-- Service Modal -->
    <div class="modal" id="serviceModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2 id="modalServiceTitle">Plumbing Services</h2>
                <div class="rating">
                    <i class="fas fa-star"></i> 4.8 (124 Reviews)
                </div>
            </div>
            <div class="modal-body">
                <div class="service-details">
                    <div class="service-details-img">
                        <i id="modalServiceIcon" class="fas fa-faucet"></i>
                    </div>
                    <div class="service-details-info">
                        <p id="modalServiceDesc">Our certified plumbers provide comprehensive solutions for all your
                            plumbing needs. From leak repairs to new installations, we ensure quality workmanship and
                            reliable service.</p>

                        <div class="details-meta">
                            <div class="meta-item">
                                <div class="meta-value" id="workersCount">30+</div>
                                <div class="meta-label">Professionals</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-value" id="priceRange">₹500-1500</div>
                                <div class="meta-label">Price Range</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-value" id="availability">24/7</div>
                                <div class="meta-label">Availability</div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="book-now-btn" id="bookNowBtn">Book Now</button>
            </div>
        </div>
    </div>

    <script>
        // Service data with Indian pricing
        const servicesData = [
            {
                id: 1,
                title: "Plumbing Services",
                icon: "fa-faucet",
                description: "Expert solutions for leaks, installations, and all plumbing needs.",
                category: "repairs",
                rating: 4.8,
                reviews: 124,
                price: "₹500-1500",
                workers: 32
            },
            {
                id: 2,
                title: "Electrical Work",
                icon: "fa-bolt",
                description: "Certified electricians for installations, repairs and maintenance.",
                category: "repairs",
                rating: 4.9,
                reviews: 98,
                price: "₹600-2000",
                workers: 28
            },
            {
                id: 3,
                title: "Deep Cleaning",
                icon: "fa-broom",
                description: "Thorough cleaning for homes, offices and commercial spaces.",
                category: "domestic",
                rating: 4.7,
                reviews: 210,
                price: "₹800-2500",
                workers: 45
            },
            {
                id: 4,
                title: "Carpentry",
                icon: "fa-hammer",
                description: "Custom woodwork, furniture repair and installations.",
                category: "repairs",
                rating: 4.8,
                reviews: 76,
                price: "₹700-1800",
                workers: 22
            },
            {
                id: 5,
                title: "Painting Services",
                icon: "fa-paint-roller",
                description: "Interior and exterior painting for homes and businesses.",
                category: "repairs",
                rating: 4.7,
                reviews: 89,
                price: "₹1000-5000",
                workers: 31
            },
            {
                id: 6,
                title: "AC Service",
                icon: "fa-wind",
                description: "Maintenance, repair and installation for all AC units.",
                category: "repairs",
                rating: 4.9,
                reviews: 142,
                price: "₹500-1200",
                workers: 38
            },
            {
                id: 7,
                title: "Packers & Movers",
                icon: "fa-boxes",
                description: "Professional packing and relocation services.",
                category: "movers",
                rating: 4.6,
                reviews: 67,
                price: "₹1500-8000",
                workers: 24
            },
            {
                id: 8,
                title: "Kitchen Cleaning",
                icon: "fa-utensils",
                description: "Deep cleaning for kitchens and appliances.",
                category: "domestic",
                rating: 4.8,
                reviews: 93,
                price: "₹600-1500",
                workers: 29
            },
            {
                id: 9,
                title: "Event Staffing",
                icon: "fa-glass-cheers",
                description: "Professional staff for events, parties and gatherings.",
                category: "event",
                rating: 4.7,
                reviews: 78,
                price: "₹250-500/hr",
                workers: 42
            },
            {
                id: 10,
                title: "Home Sanitization",
                icon: "fa-hand-sparkles",
                description: "Professional sanitization for healthy living.",
                category: "domestic",
                rating: 4.9,
                reviews: 115,
                price: "₹900-2000",
                workers: 33
            },
            {
                id: 11,
                title: "Babysitting",
                icon: "fa-baby",
                description: "Reliable childcare professionals for your family.",
                category: "domestic",
                rating: 4.8,
                reviews: 86,
                price: "₹150-300/hr",
                workers: 27
            },
            {
                id: 12,
                title: "Gardening Services",
                icon: "fa-leaf",
                description: "Landscaping, lawn care and garden maintenance.",
                category: "domestic",
                rating: 4.7,
                reviews: 64,
                price: "₹700-2000",
                workers: 19
            },
            {
                id: 13,
                title: "Bathroom Cleaning",
                icon: "fa-shower",
                description: "Deep cleaning and sanitization for bathrooms.",
                category: "domestic",
                rating: 4.8,
                reviews: 92,
                price: "₹700-1800",
                workers: 26
            },
            {
                id: 14,
                title: "Fridge Repair",
                icon: "fa-snowflake",
                description: "Expert repair for all refrigerator models.",
                category: "repairs",
                rating: 4.7,
                reviews: 75,
                price: "₹800-2500",
                workers: 18
            },
            {
                id: 15,
                title: "TV Repair",
                icon: "fa-tv",
                description: "Professional repair for all television types.",
                category: "repairs",
                rating: 4.6,
                reviews: 68,
                price: "₹600-2000",
                workers: 21
            },
            // New services added below
            {
                id: 16,
                title: "Cook Services",
                icon: "fa-utensils",
                description: "Professional cooks for daily meals or special occasions.",
                category: "domestic",
                rating: 4.9,
                reviews: 145,
                price: "₹300-800/day",
                workers: 36
            },
            {
                id: 17,
                title: "Washing Machine Repair",
                icon: "fa-soap",
                description: "Expert technicians for all washing machine brands.",
                category: "repairs",
                rating: 4.7,
                reviews: 83,
                price: "₹700-1800",
                workers: 23
            },
            {
                id: 18,
                title: "Car Detailing",
                icon: "fa-car",
                description: "Professional interior and exterior car cleaning services.",
                category: "repairs",
                rating: 4.8,
                reviews: 97,
                price: "₹1000-3000",
                workers: 28
            }
        ];

        // Function to render services
        function renderServices(services) {
            const servicesGrid = document.getElementById('servicesGrid');
            servicesGrid.innerHTML = '';

            services.forEach(service => {
                const serviceCard = document.createElement('div');
                serviceCard.className = 'service-card';
                serviceCard.dataset.category = service.category;

                serviceCard.innerHTML = `
                    <div>
                        <div class="service-icon">
                            <i class="fas ${service.icon}"></i>
                        </div>
                        <h3 class="service-title">${service.title}</h3>
                        <p class="service-desc">${service.description}</p>
                    </div>
                    <button class="view-info-btn" onclick="openModal(${service.id})">View Info</button>
                `;

                servicesGrid.appendChild(serviceCard);
            });
        }

        // Function to open modal
        function openModal(serviceId) {
            const service = servicesData.find(s => s.id === serviceId);
            if (!service) return;

            const modal = document.getElementById('serviceModal');
            document.getElementById('modalServiceTitle').textContent = service.title;
            document.getElementById('modalServiceDesc').textContent = service.description;
            document.getElementById('workersCount').textContent = `${service.workers}+`;
            document.getElementById('priceRange').textContent = service.price;
            document.getElementById('modalServiceIcon').className = `fas ${service.icon}`;

            // Set up Book Now button
            const bookNowBtn = document.getElementById('bookNowBtn');
            bookNowBtn.onclick = function () {
                alert(`Booking request for ${service.title} has been submitted! Our team will contact you shortly.`);
                closeModal();
            };

            modal.style.display = 'flex';
        }

        // Function to close modal
        function closeModal() {
            document.getElementById('serviceModal').style.display = 'none';
        }

        // Function to filter services by category
        function filterServices(category) {
            if (category === 'all') {
                renderServices(servicesData);
                return;
            }

            const filteredServices = servicesData.filter(service => service.category === category);
            renderServices(filteredServices);
        }

        // Function to search services
        function searchServices(query) {
            const filteredServices = servicesData.filter(service =>
                service.title.toLowerCase().includes(query.toLowerCase()) ||
                service.description.toLowerCase().includes(query.toLowerCase())
            );
            renderServices(filteredServices);
        }

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
            // Render all services initially
            renderServices(servicesData);

            // Category tab functionality
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.addEventListener('click', function () {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    const category = this.dataset.category;
                    filterServices(category);
                });
            });

            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function () {
                searchServices(this.value);
            });

            // Sort functionality
            document.getElementById('sortSelect').addEventListener('change', function () {
                const sortBy = this.value;
                let sortedServices = [...servicesData];

                switch (sortBy) {
                    case 'price-low':
                        sortedServices.sort((a, b) => {
                            const aPrice = parseInt(a.price.replace(/\D/g, ''));
                            const bPrice = parseInt(b.price.replace(/\D/g, ''));
                            return aPrice - bPrice;
                        });
                        break;
                    case 'price-high':
                        sortedServices.sort((a, b) => {
                            const aPrice = parseInt(a.price.replace(/\D/g, ''));
                            const bPrice = parseInt(b.price.replace(/\D/g, ''));
                            return bPrice - aPrice;
                        });
                        break;
                    case 'rating':
                        sortedServices.sort((a, b) => b.rating - a.rating);
                        break;
                    case 'popularity':
                        sortedServices.sort((a, b) => b.reviews - a.reviews);
                        break;
                }

                renderServices(sortedServices);
            });

            // Close modal if clicked outside
            window.onclick = function (event) {
                const modal = document.getElementById('serviceModal');
                if (event.target === modal) {
                    closeModal();
                }
            };
        });
    </script>
</body>

</html>