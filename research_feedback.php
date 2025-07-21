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

// Get completed work history for feedback
$completed_work = [];
$sql = "SELECT b.id, b.service_type, b.preferred_date, 
               w.full_name AS worker_name, c.full_name AS customer_name 
        FROM bookings b
        LEFT JOIN workers w ON b.worker_id = w.id
        LEFT JOIN customers c ON b.customer_id = c.id
        WHERE (w.email = '$email' OR c.email = '$email') 
          AND b.status = 'Completed'
          AND b.id NOT IN (SELECT booking_id FROM feedback WHERE user_id = $user_id)
        ORDER BY b.preferred_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $completed_work[] = $row;
    }
}

// Handle feedback submission
$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_feedback'])) {
    $booking_id = $_POST['booking_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    
    // Verify user has access to this booking
    $verify_sql = "SELECT b.id 
                   FROM bookings b
                   LEFT JOIN workers w ON b.worker_id = w.id
                   LEFT JOIN customers c ON b.customer_id = c.id
                   WHERE b.id = $booking_id 
                   AND (w.email = '$email' OR c.email = '$email')
                   AND b.status = 'Completed'";
    
    $verify_result = $conn->query($verify_sql);
    
    if ($verify_result->num_rows > 0) {
        // Insert feedback
        $insert_sql = "INSERT INTO feedback (booking_id, user_id, rating, comments)
                       VALUES ($booking_id, $user_id, $rating, '$comments')";
        
        if ($conn->query($insert_sql)) {
            $success_msg = "Thank you for your feedback!";
            // Refresh completed work list
            header("Refresh:2");
        } else {
            $error_msg = "Error submitting feedback: " . $conn->error;
        }
    } else {
        $error_msg = "Invalid booking selected";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - Give Feedback</title>
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

        .feedback-container {
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-top: 20px;
        }

        .section-title {
            color: var(--primary);
            font-size: 1.4rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(96, 108, 56, 0.2);
        }

        .work-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .work-card {
            background: var(--light-gray);
            border-radius: 10px;
            padding: 15px;
            border-left: 3px solid var(--secondary);
            transition: var(--transition);
        }

        .work-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .work-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .work-title {
            font-weight: 600;
            color: var(--primary);
            font-size: 1rem;
        }

        .work-date {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .feedback-form {
            background: var(--light-gray);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary);
        }

        .form-select, .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(96, 108, 56, 0.2);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .rating-container {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .rating-input {
            display: none;
        }

        .rating-label {
            font-size: 1.8rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-input:checked ~ .rating-label {
            color: #ffcc00;
        }

        .rating-label:hover,
        .rating-label:hover ~ .rating-label {
            color: #ffcc00;
        }

        .submit-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .submit-btn:hover {
            background: var(--pakistan-green);
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
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

        .alert {
            padding: 15px;
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
            
            .work-grid {
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
            <h1 class="page-title">Give Feedback</h1>
        </div>

        <?php if($success_msg): ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif; ?>
        
        <?php if($error_msg): ?>
            <div class="alert alert-error"><?= $error_msg ?></div>
        <?php endif; ?>

        <div class="feedback-container">
            <h2 class="section-title">Select Completed Work</h2>
            
            <?php if(count($completed_work) > 0): ?>
                <div class="work-grid">
                    <?php foreach($completed_work as $work): ?>
                    <div class="work-card" onclick="selectWork(<?= $work['id'] ?>, '<?= $work['service_type'] ?> on <?= date('M d, Y', strtotime($work['preferred_date'])) ?>')">
                        <div class="work-header">
                            <div class="work-title"><?= $work['service_type'] ?></div>
                            <div class="work-date"><?= date('M d, Y', strtotime($work['preferred_date'])) ?></div>
                        </div>
                        
                        <?php if(isset($work['worker_name'])): ?>
                            <div><strong>Worker:</strong> <?= $work['worker_name'] ?></div>
                        <?php endif; ?>
                        
                        <?php if(isset($work['customer_name'])): ?>
                            <div><strong>Customer:</strong> <?= $work['customer_name'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="feedback-form">
                    <h3 class="section-title">Your Feedback</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        
                        <div class="form-group">
                            <label class="form-label">Selected Work:</label>
                            <div id="selected-work" style="padding: 10px; background: #fff; border-radius: 8px; min-height: 20px;">
                                Please select a completed work above
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Rating:</label>
                            <div class="rating-container">
                                <?php for($i=5; $i>=1; $i--): ?>
                                    <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" class="rating-input">
                                    <label for="star<?= $i ?>" class="rating-label">★</label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Comments:</label>
                            <textarea name="comments" class="form-textarea" placeholder="Share your experience..." required></textarea>
                        </div>
                        
                        <button type="submit" name="submit_feedback" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Submit Feedback
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No Feedback Needed</h3>
                    <p>You have no completed services pending feedback</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function selectWork(bookingId, workTitle) {
            document.getElementById('booking_id').value = bookingId;
            document.getElementById('selected-work').innerHTML = workTitle;
            
            // Highlight selected card
            document.querySelectorAll('.work-card').forEach(card => {
                card.style.borderLeft = '3px solid var(--secondary)';
                card.style.background = 'var(--light-gray)';
            });
            
            event.currentTarget.style.borderLeft = '3px solid var(--primary)';
            event.currentTarget.style.background = 'var(--white)';
        }
    </script>
</body>

</html>