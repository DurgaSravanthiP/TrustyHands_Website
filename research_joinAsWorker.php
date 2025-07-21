<?php
// Database connection
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
$formData = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $location = $conn->real_escape_string($_POST['location']);
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $experience = $conn->real_escape_string($_POST['experience']);
    $skills = $conn->real_escape_string($_POST['skills']);
    $languages = $conn->real_escape_string($_POST['languages']);
    $available_hours = $conn->real_escape_string($_POST['available_hours']);
    
    $min_price_per_hour = $conn->real_escape_string($_POST['min_price_per_hour']);
    $max_price_per_hour = $conn->real_escape_string($_POST['max_price_per_hour']);
    
    $agreement = isset($_POST['agreement']) ? 1 : 0;
    $confirmation = isset($_POST['confirmation']) ? 1 : 0;
    
    // Store form data for repopulating
    $formData = [
        'full_name' => $full_name,
        'phone' => $phone,
        'email' => $email,
        'dob' => $dob,
        'gender' => $gender,
        'location' => $location,
        'service_type' => $service_type,
        'experience' => $experience,
        'skills' => $skills,
        'languages' => $languages,
        'available_hours' => $available_hours,
        'min_price_per_hour' => $min_price_per_hour,
        'max_price_per_hour' => $max_price_per_hour
    ];
    
    // Validate required fields
    if (empty($full_name) || empty($phone) || empty($email) || empty($dob) || 
        empty($gender) || empty($location) || empty($service_type) || 
        empty($experience) || empty($languages) || empty($available_hours) || empty($min_price_per_hour) || empty($max_price_per_hour)) { 
        $error = "Please fill all required fields";
    } elseif (!$agreement || !$confirmation) {
        $error = "You must agree to the terms and confirm your information";
    } else {
        // Handle file uploads
        $id_proof_path = handleFileUpload('id_proof');
        $resume_path = handleFileUpload('resume');
        $profile_picture_path = handleFileUpload('profile_picture');
        $work_samples_path = handleFileUpload('work_samples');
        
        if ($error) {
            // Error already set by handleFileUpload
        } else {
            // Insert into workers table
            // In the form processing section:
$sql = "INSERT INTO workers (
    full_name, phone_number, email, dob, gender, location, 
    id_proof_path, service_type, experience, skills, languages, 
    available_hours, 
    min_price_per_hour, max_price_per_hour, 
    resume_path, profile_picture_path, work_samples_path,
    agreement_accepted, info_confirmed
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssisssddsssii", 
    $full_name, $phone, $email, $dob, $gender, $location,
    $id_proof_path, $service_type, $experience, $skills, $languages,
    $available_hours, 
    $min_price_per_hour, $max_price_per_hour,
    $resume_path, $profile_picture_path, $work_samples_path,
    $agreement, $confirmation
);
            if ($stmt->execute()) {
                $success = "Registration successful! Welcome to TrustyHands.";
                // Clear form data on success
                $formData = [];
            } else {
                $error = "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
    }
}

// Function to handle file uploads (unchanged)
function handleFileUpload($fieldName) {
    global $error;
    $target_dir = "uploads/";
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == UPLOAD_ERR_OK) {
        $file_name = uniqid() . '_' . basename($_FILES[$fieldName]['name']);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate file type based on field
        $valid = true;
        if ($fieldName == 'id_proof') {
            $allowed_types = ['pdf', 'jpg', 'jpeg', 'png'];
            $max_size = 2 * 1024 * 1024; // 2MB
        } elseif ($fieldName == 'profile_picture') {
            $allowed_types = ['jpg', 'jpeg', 'png'];
            $max_size = 1 * 1024 * 1024; // 1MB
        } else {
            $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
            $max_size = 5 * 1024 * 1024; // 5MB
        }
        
        // Check file type
        if (!in_array($file_type, $allowed_types)) {
            $error = "Invalid file type for $fieldName. Allowed types: " . implode(', ', $allowed_types);
            $valid = false;
        }
        
        // Check file size
        if ($_FILES[$fieldName]['size'] > $max_size) {
            $error = "File too large for $fieldName. Maximum size: " . ($max_size / (1024 * 1024)) . "MB";
            $valid = false;
        }
        
        if ($valid) {
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_file)) {
                return $target_file;
            } else {
                $error = "Error uploading $fieldName file.";
            }
        }
    }
    
    return ''; // Return empty string if no file uploaded
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as a Worker | TrustyHands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            max-width: 1000px;
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

        /* Registration Form Section */
        .registration-section {
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

        .form-container {
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

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }

        .checkbox-group input {
            width: auto;
            margin-top: 4px;
        }

        .checkbox-group label {
            font-weight: normal;
            margin-bottom: 0;
        }

        .checkbox-group a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }

        /* Preview Section */
        .preview-container {
            margin-top: 30px;
            background: rgba(96, 108, 56, 0.05);
            border-radius: 10px;
            padding: 20px;
            border: 1px dashed var(--primary);
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .profile-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--light-background);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid var(--primary);
        }

        .profile-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-info {
            flex: 1;
        }

        .preview-name {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .preview-service {
            background: var(--primary);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .preview-details {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .preview-detail {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }

        .preview-detail i {
            color: var(--accent);
        }

        /* Footer */
        footer {
            background-color: var(--dark-background);
            padding: 40px 0 15px;
            position: relative;
            margin-top: 40px;
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
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 20px;
            }

            .preview-container {
                flex-direction: column;
                text-align: center;
            }

            .profile-preview {
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        .preview-price {
            background: var(--earth-yellow);
            color: var(--dark-background);
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.85rem;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>


<body>
    <!-- ... (header remains unchanged) ... -->
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
        <!-- ... (back link remains unchanged) ... -->
        <a href="research_homepage.php" class="back-home">
            <i class="fas fa-arrow-left"></i> Back to Homepage
        </a>
        <div class="registration-section">
            <!-- ... (title and notifications remain unchanged) ... -->
            <h2 class="section-title">Join as a TrustyHands Worker</h2>

            <!-- Notification Messages -->
            <?php if ($error): ?>
            <div class="notification error">
                <?= $error ?>
            </div>
            <?php endif; ?>

            <?php if ($success): ?>
            <div class="notification success">
                <?= $success ?>
            </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="form-container">
                <!-- ... (personal info section unchanged) ... -->
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="full-name" class="required">Full Name</label>
                            <input type="text" id="full-name" name="full_name" placeholder="John Doe" required
                                value="<?= isset($formData['full_name']) ? htmlspecialchars($formData['full_name']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+1 (123) 456-7890" required
                                value="<?= isset($formData['phone']) ? htmlspecialchars($formData['phone']) : '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="required">Email ID</label>
                            <input type="email" id="email" name="email" placeholder="john.doe@example.com" required
                                value="<?= isset($formData['email']) ? htmlspecialchars($formData['email']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="dob" class="required">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required
                                value="<?= isset($formData['dob']) ? htmlspecialchars($formData['dob']) : '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender" class="required">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select gender</option>
                                <option value="Male" <?=(isset($formData['gender']) && $formData['gender']=='Male' )
                                    ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?=(isset($formData['gender']) && $formData['gender']=='Female' )
                                    ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?=(isset($formData['gender']) && $formData['gender']=='Other' )
                                    ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="location" class="required">Location / City</label>
                            <input type="text" id="location" name="location" placeholder="Enter your city" required
                                value="<?= isset($formData['location']) ? htmlspecialchars($formData['location']) : '' ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_proof" class="required">ID Proof Upload (Aadhaar, Voter ID, etc.)</label>
                        <div class="upload-area" id="id-proof-area">
                            <i class="fas fa-id-card"></i>
                            <p>Click to upload ID document</p>
                            <span class="upload-btn">Choose File</span>
                            <input type="file" id="id_proof" name="id_proof" accept=".pdf,.jpg,.jpeg,.png"
                                style="display: none;" required>
                        </div>
                        <p class="small" style="margin-top: 8px; color: var(--text-light); font-size: 0.8rem;">
                            (Accepted formats: PDF, JPG, PNG. Max size: 2MB)
                        </p>
                    </div>
                </div>
                <!-- Professional Details -->
                <div class="form-section">
                    <h3><i class="fas fa-tools"></i> Professional Details</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="service_type" class="required">Type of Work</label>
                            <select id="service_type" name="service_type" required>
                                <option value="">Select a service</option>
                                <option value="Plumbing Services" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Plumbing Services' ) ? 'selected' : '' ?>>Plumbing
                                    Services</option>
                                <option value="Electrical Work" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Electrical Work' ) ? 'selected' : '' ?>>Electrical Work
                                </option>
                                <option value="Deep Cleaning" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Deep Cleaning' ) ? 'selected' : '' ?>>Deep Cleaning
                                </option>
                                <option value="Carpentry" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Carpentry' ) ? 'selected' : '' ?>>Carpentry</option>
                                <option value="Painting Services" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Painting Services' ) ? 'selected' : '' ?>>Painting
                                    Services</option>
                                <option value="AC Service" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='AC Service' ) ? 'selected' : '' ?>>AC Service</option>
                                <option value="Packers & Movers" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Packers & Movers' ) ? 'selected' : '' ?>>Packers &
                                    Movers</option>
                                <option value="Kitchen Cleaning" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Kitchen Cleaning' ) ? 'selected' : '' ?>>Kitchen
                                    Cleaning</option>
                                <option value="Event Staffing" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Event Staffing' ) ? 'selected' : '' ?>>Event Staffing
                                </option>
                                <option value="Home Sanitization" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Home Sanitization' ) ? 'selected' : '' ?>>Home
                                    Sanitization</option>
                                <option value="Babysitting" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Babysitting' ) ? 'selected' : '' ?>>Babysitting</option>
                                <option value="Gardening Services" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Gardening Services' ) ? 'selected' : '' ?>>Gardening
                                    Services</option>
                                <option value="Bathroom Cleaning" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Bathroom Cleaning' ) ? 'selected' : '' ?>>Bathroom
                                    Cleaning</option>
                                <option value="Fridge Repair" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Fridge Repair' ) ? 'selected' : '' ?>>Fridge Repair
                                </option>
                                <option value="TV Repair" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='TV Repair' ) ? 'selected' : '' ?>>TV Repair</option>
                                <option value="Cook Services" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Cook Services' ) ? 'selected' : '' ?>>Cook Services
                                </option>
                                <option value="Washing Machine Repair" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Washing Machine Repair' ) ? 'selected' : '' ?>>Washing
                                    Machine Repair</option>
                                <option value="Car Detailing" <?=(isset($formData['service_type']) &&
                                    $formData['service_type']=='Car Detailing' ) ? 'selected' : '' ?>>Car Detailing
                                </option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="experience" class="required">Years of Experience</label>
                            <select id="experience" name="experience" required>
                                <option value="">Select experience</option>
                                <option value="1" <?=(isset($formData['experience']) && $formData['experience']=='1' )
                                    ? 'selected' : '' ?>>0-1 years</option>
                                <option value="2" <?=(isset($formData['experience']) && $formData['experience']=='2' )
                                    ? 'selected' : '' ?>>1-3 years</option>
                                <option value="5" <?=(isset($formData['experience']) && $formData['experience']=='5' )
                                    ? 'selected' : '' ?>>3-5 years</option>
                                <option value="10" <?=(isset($formData['experience']) && $formData['experience']=='10' )
                                    ? 'selected' : '' ?>>5-10 years</option>
                                <option value="15" <?=(isset($formData['experience']) && $formData['experience']=='15' )
                                    ? 'selected' : '' ?>>10+ years</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="skills" class="required">Skills Description</label>
                        <textarea id="skills" name="skills" rows="3" placeholder="Describe your skills and expertise"
                            required><?= isset($formData['skills']) ? htmlspecialchars($formData['skills']) : '' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="languages" class="required">Languages Spoken</label>
                        <input type="text" id="languages" name="languages" placeholder="English, Hindi, etc." required
                            value="<?= isset($formData['languages']) ? htmlspecialchars($formData['languages']) : '' ?>">
                    </div>
                    <!-- In the Professional Details section -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="available_hours" class="required">Available Working Hours</label>
                            <input type="text" id="available_hours" name="available_hours"
                                placeholder="e.g., 9 AM - 6 PM, Mon-Fri" required
                                value="<?= isset($formData['available_hours']) ? htmlspecialchars($formData['available_hours']) : '' ?>">
                        </div>
                    </div>

                    <!-- CHANGE: Price range fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="min_price_per_hour" class="required">Minimum Rate per Hour (₹)</label>
                            <input type="number" id="min_price_per_hour" name="min_price_per_hour"
                                placeholder="e.g., 200" min="1" step="1" required
                                value="<?= isset($formData['min_price_per_hour']) ? htmlspecialchars($formData['min_price_per_hour']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="max_price_per_hour" class="required">Maximum Rate per Hour (₹)</label>
                            <input type="number" id="max_price_per_hour" name="max_price_per_hour"
                                placeholder="e.g., 500" min="1" step="1" required
                                value="<?= isset($formData['max_price_per_hour']) ? htmlspecialchars($formData['max_price_per_hour']) : '' ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="resume">Upload Resume or Certificate (optional)</label>
                        <div class="upload-area" id="resume-area">
                            <i class="fas fa-file-alt"></i>
                            <p>Click to upload resume or certificates</p>
                            <span class="upload-btn">Choose File</span>
                            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx"
                                style="display: none;">
                        </div>
                        <p class="small" style="margin-top: 8px; color: var(--text-light); font-size: 0.8rem;">
                            (Accepted formats: PDF, DOC, DOCX. Max size: 5MB)
                        </p>
                    </div>
                </div>

                <!-- Media -->
                <div class="form-section">
                    <!-- ... (title and file uploads unchanged) ... -->
                    <h3><i class="fas fa-images"></i> Media</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="profile_picture" class="required">Upload Profile Picture</label>
                            <div class="upload-area" id="profile-picture-area">
                                <i class="fas fa-camera"></i>
                                <p>Click to upload profile photo</p>
                                <span class="upload-btn">Choose File</span>
                                <input type="file" id="profile_picture" name="profile_picture" accept=".jpg,.jpeg,.png"
                                    style="display: none;" required>
                            </div>
                            <p class="small" style="margin-top: 8px; color: var(--text-light); font-size: 0.8rem;">
                                (Accepted formats: JPG, PNG. Max size: 1MB)
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="work_samples">Upload Work Samples (optional)</label>
                            <div class="upload-area" id="work-samples-area">
                                <i class="fas fa-images"></i>
                                <p>Click to upload work samples</p>
                                <span class="upload-btn">Choose File</span>
                                <input type="file" id="work_samples" name="work_samples" accept=".jpg,.jpeg,.png,.pdf"
                                    style="display: none;">
                            </div>
                            <p class="small" style="margin-top: 8px; color: var(--text-light); font-size: 0.8rem;">
                                (Accepted formats: JPG, PNG, PDF. Max size: 5MB)
                            </p>
                        </div>
                    </div>

                    <!-- Profile Preview -->
                    <div class="preview-container" id="preview-container" style="display: none;">
                        <div class="profile-preview" id="profile-preview">
                            <i class="fas fa-user" id="default-icon"
                                style="font-size: 2.5rem; color: var(--primary);"></i>
                        </div>
                        <div class="preview-info">
                            <div class="preview-name" id="preview-name">Your Name</div>
                            <div class="preview-service" id="preview-service">Service Type</div>
                            <div class="preview-price" id="preview-price">₹0/hour</div>
                            <div class="preview-details">
                                <div class="preview-detail">
                                    <i class="fas fa-briefcase"></i>
                                    <span id="preview-experience">Experience</span>
                                </div>
                                <div class="preview-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span id="preview-location">Location</span>
                                </div>
                                <div class="preview-detail">
                                    <i class="fas fa-clock"></i>
                                    <span id="preview-hours">Working Hours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ... (agreement section unchanged) ... -->
                <div class="form-section">
                    <h3><i class="fas fa-check-circle"></i> Agreement / Confirmation</h3>

                    <div class="checkbox-group">
                        <input type="checkbox" id="agreement" name="agreement" value="1" <?=isset($_POST['agreement'])
                            ? 'checked' : '' ?>>
                        <label for="agreement">I agree to the <a href="#">terms and conditions</a> of
                            TrustyHands</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="confirmation" name="confirmation" value="1"
                            <?=isset($_POST['confirmation']) ? 'checked' : '' ?>>
                        <label for="confirmation">I confirm that all information provided is true and accurate</label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-user-check"></i> Complete Registration
                </button>
            </form>
        </div>
    </div>

    <!-- ... (footer unchanged) ... -->
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
        function setupFileUpload(uploadAreaId, fileInputId) {
            const uploadArea = document.getElementById(uploadAreaId);
            const fileInput = document.getElementById(fileInputId);

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

                    // Special handling for profile picture
                    if (fileInputId === 'profile_picture') {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            document.getElementById('profile-preview').innerHTML = `
                                <img src="${e.target.result}" alt="Profile Preview">
                            `;
                            document.getElementById('preview-container').style.display = 'flex';
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                }
            });
        }

        // Initialize file upload areas
        setupFileUpload('id-proof-area', 'id_proof');
        setupFileUpload('resume-area', 'resume');
        setupFileUpload('profile-picture-area', 'profile_picture');
        setupFileUpload('work-samples-area', 'work_samples');

        // Update preview as user types
        const nameInput = document.getElementById('full-name');
        const serviceSelect = document.getElementById('service_type');
        const experienceSelect = document.getElementById('experience');
        const locationInput = document.getElementById('location');
        const hoursInput = document.getElementById('available_hours');

        function updatePreview() {
            if (nameInput.value) {
                document.getElementById('preview-name').textContent = nameInput.value;
                document.getElementById('preview-container').style.display = 'flex';
            }

            if (serviceSelect.value) {
                document.getElementById('preview-service').textContent = serviceSelect.options[serviceSelect.selectedIndex].text;
            }

            if (experienceSelect.value) {
                const expText = experienceSelect.options[experienceSelect.selectedIndex].text;
                document.getElementById('preview-experience').textContent = expText;
            }

            if (locationInput.value) {
                document.getElementById('preview-location').textContent = locationInput.value;
            }

            if (hoursInput.value) {
                document.getElementById('preview-hours').textContent = hoursInput.value;
            }
        }

        // Add event listeners
        nameInput.addEventListener('input', updatePreview);
        serviceSelect.addEventListener('change', updatePreview);
        experienceSelect.addEventListener('change', updatePreview);
        locationInput.addEventListener('input', updatePreview);
        hoursInput.addEventListener('input', updatePreview);

        // Set max date for date of birth (18 years ago)
        const today = new Date();
        const minDob = new Date();
        minDob.setFullYear(today.getFullYear() - 100);
        const maxDob = new Date();
        maxDob.setFullYear(today.getFullYear() - 18);

        document.getElementById('dob').max = maxDob.toISOString().split('T')[0];
        document.getElementById('dob').min = minDob.toISOString().split('T')[0];
        // Update preview function
        function updatePreview() {
            if (nameInput.value) {
                document.getElementById('preview-name').textContent = nameInput.value;
                document.getElementById('preview-container').style.display = 'flex';
            }

            if (serviceSelect.value) {
                document.getElementById('preview-service').textContent = serviceSelect.options[serviceSelect.selectedIndex].text;
            }

            if (experienceSelect.value) {
                const expText = experienceSelect.options[experienceSelect.selectedIndex].text;
                document.getElementById('preview-experience').textContent = expText;
            }

            if (locationInput.value) {
                document.getElementById('preview-location').textContent = locationInput.value;
            }

            if (hoursInput.value) {
                document.getElementById('preview-hours').textContent = hoursInput.value;
            }

            // CHANGE: Price range preview
            if (minPriceInput.value && maxPriceInput.value) {
                document.getElementById('preview-price').textContent =
                    `₹${minPriceInput.value} - ₹${maxPriceInput.value}/hour`;
            }
        }

        // Add event listeners for all relevant fields
        nameInput.addEventListener('input', updatePreview);
        serviceSelect.addEventListener('change', updatePreview);
        experienceSelect.addEventListener('change', updatePreview);
        locationInput.addEventListener('input', updatePreview);
        hoursInput.addEventListener('input', updatePreview);

        // CHANGE: Add price inputs
        const minPriceInput = document.getElementById('min_price_per_hour');
        const maxPriceInput = document.getElementById('max_price_per_hour');
        minPriceInput.addEventListener('input', updatePreview);
        maxPriceInput.addEventListener('input', updatePreview);

    </script>
</body>

</html>
<?php $conn->close(); ?>