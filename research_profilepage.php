<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: research_homepage1.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LoginPage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user details
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$firstName = $_SESSION['firstName'] ?? 'User';
$lastName = $_SESSION['lastName'] ?? '';

// Check if user is a worker
$is_worker = false;
$worker_details = [];
$sql = "SELECT * FROM workers WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $is_worker = true;
    $worker_details = $result->fetch_assoc();
}

// Check if user is a customer
$is_customer = false;
$customer_details = [];
$sql = "SELECT * FROM customers WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $is_customer = true;
    $customer_details = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - My Profile</title>
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
            --white: #ffffff;
            --light-gray: #f8f9f8;
            --text: #333;
            --text-light: #666;
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
            background-color: var(--cornsilk);
            color: var(--text);
            line-height: 1.6;
            font-size: 14px;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(96, 108, 56, 0.2);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: var(--white);
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-btn:hover {
            background: var(--tigers-eye);
            transform: translateY(-2px);
        }

        .page-title {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 600;
        }

        .card {
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--primary);
            font-size: 1.4rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--earth-yellow);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 18px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .info-value {
            font-size: 0.95rem;
            padding: 8px 12px;
            background: rgba(96, 108, 56, 0.05);
            border-radius: 8px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #728c45);
            color: var(--white);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), #bc6c25);
            color: var(--white);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        }

        .empty-state {
            text-align: center;
            padding: 25px;
            color: var(--text-light);
            background: rgba(221, 161, 94, 0.05);
            border-radius: 12px;
            margin-top: 15px;
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--earth-yellow);
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--text);
        }

        @media (max-width: 768px) {
            .header-bar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-bar">
            <a href="research_homepage.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h1 class="page-title">My Profile</h1>
        </div>

        <div class="card">
            <h2 class="section-title">Basic Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">
                        <?php echo $firstName . ' ' . $lastName; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">
                        <?php echo $email; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Account Type</div>
                    <div class="info-value">
                        <?php 
                        if($is_worker && $is_customer) echo "Worker & Customer";
                        elseif($is_worker) echo "Worker";
                        elseif($is_customer) echo "Customer";
                        else echo "Basic Account";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="section-title">Worker Profile</h2>
            <?php if($is_worker): ?>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Service Type</div>
                    <div class="info-value">
                        <?php echo $worker_details['service_type'] ?? 'Not specified'; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Experience</div>
                    <div class="info-value">
                        <?php echo $worker_details['experience'] ?? '0'; ?> years
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Location</div>
                    <div class="info-value">
                        <?php echo $worker_details['location'] ?? 'Not specified'; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Hourly Rate</div>
                    <div class="info-value">₹
                        <?php echo $worker_details['min_price_per_hour'] ?? '0'; ?> - ₹
                        <?php echo $worker_details['max_price_per_hour'] ?? '0'; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-hard-hat"></i>
                <h3>You don't have a worker profile yet</h3>
                <p>Create a worker profile to start offering your services</p>
                <a href="research_joinAsWorker.php" class="btn btn-primary">
                    Become a Worker
                </a>
            </div>
            <?php endif; ?>
        </div>

        <div class="card">
            <h2 class="section-title">Customer Profile</h2>
            <?php if($is_customer): ?>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">
                        <?php echo $customer_details['phone_number'] ?? 'Not specified'; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Address</div>
                    <div class="info-value">
                        <?php echo $customer_details['address'] ?? 'Not specified'; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-tag"></i>
                <h3>Complete your customer profile</h3>
                <p>Add your details to book services faster</p>
                <a href="research_bookWorker.php" class="btn btn-primary">
                    Complete Customer Profile
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>