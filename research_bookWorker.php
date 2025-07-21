<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LoginPage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = '';
$success = '';
$showWorkerSelection = false;
$workers = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select_worker'])) {
        // Worker selection form submitted
        $booking_id = $_POST['booking_id'];
        $worker_id = $_POST['worker_id'];
        
        // Update booking with worker ID
        $sql = "UPDATE bookings SET worker_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $worker_id, $booking_id);
        
        if ($stmt->execute()) {
            $success = "Worker selected successfully! Booking is now complete.";
        } else {
            $error = "Error selecting worker: " . $conn->error;
        }
        
        $stmt->close();
    } else {
        // Main form submitted
        $full_name = $conn->real_escape_string($_POST['full_name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $email = $conn->real_escape_string($_POST['email']);
        $address = $conn->real_escape_string($_POST['address']);
        $city = $conn->real_escape_string($_POST['city']);
        $service = $conn->real_escape_string($_POST['service']);
        
        // MODIFIED: Capture new fields
        $date = $_POST['date'];
        $problem_description = $conn->real_escape_string($_POST['problem_description'] ?? '');
        $tools_required = $conn->real_escape_string($_POST['tools_required'] ?? '');
        $payment = $conn->real_escape_string($_POST['payment'] ?? '');

        // Handle file upload
        $image_path = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            }
        }
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Insert into customers table

            $sql = "INSERT INTO customers (full_name, phone_number, email, address) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $full_name, $phone, $email, $address);
            $stmt->execute();
            $customer_id = $stmt->insert_id;
            $stmt->close();
            
            // MODIFIED: Insert into bookings table
            $sql = "INSERT INTO bookings (customer_id, service_type, preferred_date, 
                    problem_description, tools_required, image_path, payment_mode)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssss", $customer_id, $service, $date, 
                              $problem_description, $tools_required, $image_path, $payment);
            $stmt->execute();
            $booking_id = $stmt->insert_id;
            $stmt->close();
            
            $conn->commit();
            
            // Get workers for selected service and city
            $sql = "SELECT * FROM workers 
                    WHERE service_type = ? 
                    AND LOWER(location) = LOWER(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $service, $city);
            $stmt->execute();
            $result = $stmt->get_result();
            $workers = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            
            $showWorkerSelection = true;
            $success = "Your booking details have been saved. Please contact the worker using their phone number and confirm the worker.";
        } catch (Exception $e) {
            $conn->rollback();
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Worker | TrustyHands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ... [Existing CSS remains unchanged] ... */
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
            text-decoration: none;
        }

        .logo i {
            color: var(--accent);
        }

        .back-home {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .back-home:hover {
            color: var(--accent);
        }

        /* Booking Form Section */
        .booking-section {
            padding: 40px 0;
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

        .booking-container {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .service-categories {
            flex: 1;
            background: var(--white);
            border-radius: 14px;
            padding: 25px;
            box-shadow: var(--shadow);
            height: fit-content;
        }

        .service-categories h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }

        .service-card {
            background: rgba(96, 108, 56, 0.05);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid rgba(96, 108, 56, 0.1);
        }

        .service-card:hover,
        .service-card.active {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
            background: rgba(96, 108, 56, 0.1);
        }

        .service-card.active {
            border: 2px solid var(--primary);
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
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
        }

        .booking-form-container {
            flex: 2;
            background: var(--white);
            border-radius: 14px;
            padding: 30px;
            box-shadow: var(--shadow);
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(96, 108, 56, 0.1);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text);
        }

        .form-group label.required::after {
            content: " *";
            color: #e74c3c;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
            background: var(--light-gray);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(96, 108, 56, 0.2);
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            background: var(--light-gray);
            cursor: pointer;
            transition: var(--transition);
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: rgba(96, 108, 56, 0.05);
        }

        .upload-area i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .upload-area p {
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .upload-btn {
            display: inline-block;
            padding: 8px 20px;
            background: var(--primary);
            color: white;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .upload-btn:hover {
            background: var(--accent);
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(96, 108, 56, 0.3);
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--accent), #dda15e);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(96, 108, 56, 0.4);
        }

        /* Worker Selection Section */
        .worker-selection {
            padding: 40px 0;
            display: <?=$showWorkerSelection ? 'block': 'none' ?>;
        }

        .workers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .worker-card {
            background: var(--white);
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }

        .worker-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .worker-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 15px;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .worker-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .worker-service {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .worker-rating {
            color: var(--accent);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .worker-experience {
            background: rgba(96, 108, 56, 0.1);
            padding: 5px 10px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .worker-select-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .worker-select-btn:hover {
            background: linear-gradient(135deg, var(--accent), #dda15e);
            transform: translateY(-3px);
        }

        /* Footer */
        footer {
            background-color: var(--dark-background);
            padding: 40px 0 15px;
            position: relative;
            margin-top: 0;
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

        .notification {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 500;
        }

        .error {
            background-color: #fdecea;
            color: #e74c3c;
            border-left: 4px solid #e74c3c;
        }

        .success {
            background-color: #eafaf1;
            color: #27ae60;
            border-left: 4px solid #27ae60;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .booking-container {
                flex-direction: column;
            }

            .service-categories {
                width: 100%;
            }

            .workers-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 20px;
            }

            .workers-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .workers-grid {
                grid-template-columns: 1fr;
            }
        }

        /* NEW: Worker card styles */
        .worker-card {
            background: var(--white);
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }

        .worker-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .worker-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 15px;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .worker-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .worker-service {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .worker-rating {
            color: var(--accent);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .worker-experience {
            background: rgba(96, 108, 56, 0.1);
            padding: 5px 10px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .worker-select-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .worker-select-btn:hover {
            background: linear-gradient(135deg, var(--accent), #dda15e);
            transform: translateY(-3px);
        }

        .workers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-container">
                <a href="#" class="logo">
                    <i class="fas fa-hands-helping"></i>
                    TrustyHands
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <a href="research_homepage.php" class="back-home">
            <i class="fas fa-arrow-left"></i> Back to Homepage
        </a>

        <?php if ($error): ?>
        <div class="notification error">
            <?= $error ?>
        </div>
        <?php endif; ?>

        <?php if ($success && !$showWorkerSelection): ?>
        <div class="notification success">
            <?= $success ?>
        </div>
        <?php endif; ?>

        <?php if (!$showWorkerSelection): ?>
        <div class="booking-section">
            <h2 class="section-title">Book a TrustyHands Worker</h2>

            <div class="booking-container">
                <div class="booking-form-container">
                    <form method="POST" enctype="multipart/form-data">
                        <!-- Customer Information -->
                        <div class="form-section">
                            <h3><i class="fas fa-user"></i> Customer Information</h3>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="full-name" class="required">Full Name</label>
                                    <input type="text" id="full-name" name="full_name" placeholder="John Doe" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" placeholder="+1 (123) 456-7890" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email" class="required">Email ID</label>
                                    <input type="email" id="email" name="email" placeholder="john.doe@example.com"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="required">City</label>
                                    <input type="text" id="city" name="city" placeholder="Enter your city" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="required">Full Address</label>
                                <textarea id="address" name="address" rows="3" placeholder="Enter your full address"
                                    required></textarea>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="form-section">
                            <h3><i class="fas fa-tools"></i> Service Details</h3>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="service-type" class="required">Type of Service Required</label>
                                    <select id="service-type" name="service" required>
                                        <option value="">Select a service</option>
                                        <option value="Plumbing Services">Plumbing Services</option>
                                        <option value="Electrical Work">Electrical Work</option>
                                        <option value="Deep Cleaning">Deep Cleaning</option>
                                        <option value="Carpentry">Carpentry</option>
                                        <option value="Painting Services">Painting Services</option>
                                        <option value="AC Service">AC Service</option>
                                        <option value="Packers & Movers">Packers & Movers</option>
                                        <option value="Kitchen Cleaning">Kitchen Cleaning</option>
                                        <option value="Event Staffing">Event Staffing</option>
                                        <option value="Home Sanitization">Home Sanitization</option>
                                        <option value="Babysitting">Babysitting</option>
                                        <option value="Gardening Services">Gardening Services</option>
                                        <option value="Bathroom Cleaning">Bathroom Cleaning</option>
                                        <option value="Fridge Repair">Fridge Repair</option>
                                        <option value="TV Repair">TV Repair</option>
                                        <option value="Cook Services">Cook Services</option>
                                        <option value="Washing Machine Repair">Washing Machine Repair</option>
                                        <option value="Car Detailing">Car Detailing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="date" class="required">Preferred Date</label>
                                    <input type="date" id="date" name="date" required>
                                </div>
                            </div>

                            <!-- MODIFIED: Problem description and tools required -->
                            <div class="form-group">
                                <label for="problem-description">Describe the problem</label>
                                <textarea id="problem-description" name="problem_description" rows="4"
                                    placeholder="Describe the issue you're facing..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tools-required">Tools Required (if any)</label>
                                <textarea id="tools-required" name="tools_required" rows="2"
                                    placeholder="List any specific tools needed..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Image (optional)</label>
                                <div class="upload-area" id="upload-area">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click to upload or drag and drop</p>
                                    <span class="upload-btn">Choose File</span>
                                    <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="form-section">
                            <h3><i class="fas fa-credit-card"></i> Payment Information (Optional)</h3>

                            <div class="form-group">
                                <label for="payment">Mode of Payment</label>
                                <select id="payment" name="payment">
                                    <option value="">Select payment method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="UPI">UPI</option>
                                    <option value="Card">Card</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-calendar-check"></i> Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Worker Selection Section -->
        <?php if ($showWorkerSelection): ?>
        <div class="worker-selection">
            <h2 class="section-title">Select Your Worker in
                <?= htmlspecialchars($city) ?>
            </h2>

            <?php if ($success): ?>
            <div class="notification success">
                <?= $success ?>
            </div>
            <?php endif; ?>

            <div class="workers-grid">
                <?php if (count($workers) > 0): ?>
                <?php foreach ($workers as $worker): ?>
                <div class="worker-card">
                    <?php if (!empty($worker['profile_picture_path'])): ?>
                    <img src="<?= $worker['profile_picture_path'] ?>" alt="<?= $worker['full_name'] ?>"
                        class="worker-image">
                    <?php else: ?>
                    <div class="worker-image"
                        style="background: #fefae0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user" style="font-size: 3rem; color: #606c38;"></i>
                    </div>
                    <?php endif; ?>

                    <h3 class="worker-name">
                        <?= $worker['full_name'] ?>
                    </h3>
                    <div class="worker-service">
                        <?= $worker['service_type'] ?>
                    </div>

                    <div class="worker-experience">
                        <i class="fas fa-briefcase"></i>
                        <?= $worker['experience'] ?> years experience
                    </div>

                    <div class="worker-detail">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= $worker['location'] ?>
                    </div>

                    <div class="worker-detail">
                        <i class="fas fa-clock"></i>
                        <?= $worker['available_hours'] ?>
                    </div>

                    <div class="worker-detail">
                        <i class="fas fa-phone"></i>
                        <?= $worker['phone_number'] ?>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
                        <input type="hidden" name="worker_id" value="<?= $worker['id'] ?>">
                        <button type="submit" name="select_worker" class="worker-select-btn">
                            <i class="fas fa-check"></i> Select Worker
                        </button>
                    </form>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="notification error" style="grid-column: 1 / -1; text-align: center;">
                    No workers available for
                    <?= htmlspecialchars($service) ?> in
                    <?= htmlspecialchars($city) ?>. Please try a different service or city.
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
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
                        <li><a href="research_homepage.php">Home</a></li>
                        <li><a href="research_aboutUspage.php">About Us</a></li>
                        <li><a href="research_servicespage.php">Services</a></li>
                        <li><a href="research_howitWorkspage.php">How it Works</a></li>
                        <li><a href="research_contactUspage.php">Contact Us</a></li>
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
        // File upload functionality
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('image');

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                uploadArea.innerHTML = `
                    <i class="fas fa-check-circle"></i>
                    <p>File selected: ${e.target.files[0].name}</p>
                    <span class="upload-btn">Change File</span>
                `;
            }
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').min = today;
    </script>
</body>

</html>
<?php $conn->close(); ?>