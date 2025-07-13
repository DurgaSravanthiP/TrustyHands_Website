<?php
session_start();
include("research_db_connect.php");

if(!isset($_SESSION['email'])) {
    header("Location: research_index.php");
    exit();
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Trustyhands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .welcome-container {
            text-align: center;
            padding: 15%;
        }
        .welcome-message {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .btn-logout {
            display: inline-block;
            padding: 15px 30px;
            background: #606c38;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: #283618;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <p class="welcome-message">
            Hello <?php echo htmlspecialchars($user['firstName']).' '.htmlspecialchars($user['lastName']); ?> :)
        </p>
        <a href="research_logout.php" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</body>
</html>