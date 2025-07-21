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

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

// Handle mark as completed action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complete_booking'])) {
    $booking_id = $_POST['booking_id'];
    
    // Verify user owns this booking
    $verify_sql = "SELECT b.* 
                   FROM bookings b
                   LEFT JOIN workers w ON b.worker_id = w.id
                   LEFT JOIN customers c ON b.customer_id = c.id
                   WHERE b.id = '$booking_id' 
                   AND (w.email = '$email' OR c.email = '$email')";
    
    $verify_result = $conn->query($verify_sql);
    
    if ($verify_result->num_rows > 0) {
        // Update status to completed
        $update_sql = "UPDATE bookings SET status = 'Completed' WHERE id = '$booking_id'";
        if ($conn->query($update_sql)) {
            $success_msg = "Booking marked as completed!";
        } else {
            $error_msg = "Error updating booking: " . $conn->error;
        }
    } else {
        $error_msg = "You don't have permission to update this booking";
    }
}

// Get bookings for this user
$bookings = [];
$sql = "SELECT b.*, w.full_name AS worker_name, c.full_name AS customer_name 
        FROM bookings b
        LEFT JOIN workers w ON b.worker_id = w.id
        LEFT JOIN customers c ON b.customer_id = c.id
        WHERE w.email = '$email' OR c.email = '$email'
        ORDER BY b.preferred_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - My Bookings</title>
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

        .booking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .booking-card {
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow);
            padding: 20px;
            transition: var(--transition);
            border-left: 4px solid var(--primary);
            position: relative;
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .booking-title {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .booking-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ff9800;
        }

        .status-confirmed {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
        }

        .status-completed {
            background: rgba(33, 150, 243, 0.2);
            color: #2196f3;
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-label {
            width: 100px;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
        }

        .detail-value {
            flex: 1;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            grid-column: 1 / -1;
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--earth-yellow);
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--text);
        }

        .complete-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .complete-btn:hover {
            background: var(--pakistan-green);
        }

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.2);
            color: #2e7d32;
            border-left: 4px solid #2e7d32;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.2);
            color: #c62828;
            border-left: 4px solid #c62828;
        }

        @media (max-width: 768px) {
            .header-bar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .booking-grid {
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
            <h1 class="page-title">My Bookings</h1>
        </div>

        <?php if(isset($success_msg)): ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif; ?>
        
        <?php if(isset($error_msg)): ?>
            <div class="alert alert-error"><?= $error_msg ?></div>
        <?php endif; ?>

        <div class="booking-grid">
            <?php if(count($bookings) > 0): ?>
            <?php foreach($bookings as $booking): ?>
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-title">
                        <?= $booking['service_type'] ?>
                    </div>
                    <div class="booking-status status-<?= strtolower($booking['status']) ?>">
                        <?= $booking['status'] ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Date:</div>
                    <div class="detail-value">
                        <?= date('M d, Y', strtotime($booking['preferred_date'])) ?>
                    </div>
                </div>

                <?php if(isset($booking['worker_name'])): ?>
                <div class="detail-row">
                    <div class="detail-label">Worker:</div>
                    <div class="detail-value">
                        <?= $booking['worker_name'] ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(isset($booking['customer_name'])): ?>
                <div class="detail-row">
                    <div class="detail-label">Customer:</div>
                    <div class="detail-value">
                        <?= $booking['customer_name'] ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="detail-row">
                    <div class="detail-label">Payment:</div>
                    <div class="detail-value">
                        <?= $booking['payment_mode'] ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Description:</div>
                    <div class="detail-value">
                        <?= substr($booking['problem_description'], 0, 80) ?>...
                    </div>
                </div>

                <?php if($booking['status'] == 'Pending'): ?>
                <form method="POST" action="">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                    <button type="submit" name="complete_booking" class="complete-btn">
                        <i class="fas fa-check-circle"></i> Mark as Completed
                    </button>
                </form>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>No Bookings Found</h3>
                <p>You haven't made or received any service bookings yet</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>