<?php
session_start();

// Redirect to homepage if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: research_homepage.html");
    exit;
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LoginPage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$errors = [];
$success = false;
$email = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Email verification phase
    if (isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        // Basic validation
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        } else {
            // Check if email exists in database
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                $errors[] = "Email not found in our system";
            } else {
                // Email is valid and exists - show password reset form
                $_SESSION['reset_email'] = $email;
                $_SESSION['reset_user_id'] = $result->fetch_assoc()['id'];
            }
            $stmt->close();
        }
    }
    
    // Password reset phase
    if (isset($_POST['new_password'])) {
        $email = $_SESSION['reset_email'] ?? '';
        $user_id = $_SESSION['reset_user_id'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Validate passwords
        if (empty($newPassword)) {
            $errors[] = "New password is required";
        } elseif (strlen($newPassword) < 8) {
            $errors[] = "Password must be at least 8 characters";
        }
        
        if ($newPassword !== $confirmPassword) {
            $errors[] = "Passwords do not match";
        }
        
        if (empty($errors)) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update password in database
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashedPassword, $user_id);
            
            if ($stmt->execute()) {
                $success = true;
                // Clear reset session
                unset($_SESSION['reset_email']);
                unset($_SESSION['reset_user_id']);
            } else {
                $errors[] = "Error updating password: " . $conn->error;
            }
            $stmt->close();
        }
    }
    
    // Cancel reset
    if (isset($_GET['cancel'])) {
        unset($_SESSION['reset_email']);
        unset($_SESSION['reset_user_id']);
        header("Location: research_resetPassword.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* All CSS from research_index.php */
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
            --text: #333;
            --text-light: #666;
            --shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, var(--light-background), #fdf7d5);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 12px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .logo i {
            color: var(--accent);
            font-size: 26px;
        }

        .logo-text {
            font-size: 13px;
            color: var(--text-light);
            max-width: 300px;
            margin: 4px auto 0;
            line-height: 1.4;
        }

        .container {
            background: var(--white);
            width: 100%;
            max-width: 460px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
        }

        .form-container {
            position: relative;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            color: var(--primary);
            margin-bottom: 1.2rem;
            position: relative;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 35px;
            height: 3px;
            background: var(--accent);
            border-radius: 3px;
        }

        form {
            margin: 0;
        }

        .input-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 10px 40px 10px 40px;
            border: 2px solid rgba(96, 108, 56, 0.2);
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--light-background);
            color: var(--text);
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(96, 108, 56, 0.1);
        }

        .error-message {
            background: #ffebee;
            color: #b71c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #b71c1c;
            font-size: 13px;
        }

        .error-message p {
            margin: 4px 0;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #2e7d32;
            font-size: 13px;
            text-align: center;
        }

        .recover {
            text-align: center;
            font-size: 0.85rem;
            margin-top: 1rem;
        }

        .recover a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .recover a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 11px;
            background: linear-gradient(135deg, var(--primary), var(--dark-background));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 8px rgba(96, 108, 56, 0.25);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(96, 108, 56, 0.35);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.08;
        }

        .decoration-1 {
            top: 12px;
            right: 12px;
            font-size: 70px;
            color: var(--primary);
        }

        .decoration-2 {
            bottom: 12px;
            left: 12px;
            font-size: 50px;
            color: var(--accent);
            transform: rotate(180deg);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link i {
            margin-right: 5px;
        }

        .back-link:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        /* Fixed password toggle positioning */
        .password-toggle-container {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary);
            z-index: 2;
        }

        .password-toggle {
            font-size: 15px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 16px;
            }

            .logo {
                font-size: 22px;
                gap: 6px;
            }

            .logo i {
                font-size: 24px;
            }

            .form-title {
                font-size: 1.3rem;
            }

            input {
                padding: 9px 36px 9px 36px;
                font-size: 13.5px;
            }

            .btn {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <i class="fas fa-hands-helping decoration decoration-1"></i>
        <i class="fas fa-tools decoration decoration-2"></i>

        <div class="logo-container">
            <a href="#" class="logo">
                <i class="fas fa-hands-helping"></i>
                <span>Trustyhands</span>
            </a>
            <p class="logo-text">Premium service platform connecting customers with trusted professionals</p>
        </div>

        <div class="form-container">
            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if ($success): ?>
                <div class="success-message">
                    <p>Your password has been updated successfully!</p>
                    <p style="margin-top: 10px;">
                        <a href="research_index.php" style="color: var(--primary); font-weight: 500;">
                            <i class="fas fa-sign-in-alt"></i> Login to your account
                        </a>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (!$success): ?>
                <?php if (!isset($_SESSION['reset_email'])): ?>
                    <!-- Email Verification Form -->
                    <h1 class="form-title">Reset Your Password</h1>
                    <p style="text-align: center; margin-bottom: 1.5rem; color: var(--text-light);">
                        Enter your email to reset your password
                    </p>
                    
                    <form method="post" action="research_resetPassword.php">
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="resetEmail" placeholder="Your email address" required
                                value="<?= htmlspecialchars($email) ?>">
                        </div>
                        
                        <button type="submit" class="btn">Continue</button>
                    </form>
                    
                    <div class="recover">
                        <a href="research_index.php">
                            <i class="fas fa-arrow-left"></i> Back to Login
                        </a>
                    </div>
                    
                <?php else: ?>
                    <!-- Password Reset Form -->
                    <h1 class="form-title">Create New Password</h1>
                    <p style="text-align: center; margin-bottom: 1.5rem; color: var(--text-light);">
                        Reset password for: <strong><?= htmlspecialchars($_SESSION['reset_email']) ?></strong>
                    </p>
                    
                    <form method="post" action="research_resetPassword.php">
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="new_password" id="newPassword" placeholder="New password" required>
                            <span class="password-toggle-container" id="toggleNewPassword">
                                <i class="fas fa-eye password-toggle"></i>
                            </span>
                        </div>
                        
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm new password" required>
                            <span class="password-toggle-container" id="toggleConfirmPassword">
                                <i class="fas fa-eye password-toggle"></i>
                            </span>
                        </div>
                        
                        <button type="submit" class="btn">Reset Password</button>
                    </form>
                    
                    <div class="recover">
                        <a href="research_resetPassword.php?cancel=true">
                            <i class="fas fa-arrow-left"></i> Use different email
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility('newPassword', this);
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('confirmPassword', this);
        });
        
        function togglePasswordVisibility(inputId, container) {
            const input = document.getElementById(inputId);
            const icon = container.querySelector('.password-toggle');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>