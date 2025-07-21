<?php
session_start();

// Redirect to homepage if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: research_homepage.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustyhands - Login & Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Color Palette */
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

        /* Password toggle button */
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            cursor: pointer;
            z-index: 10;
            font-size: 15px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .recover {
            text-align: right;
            font-size: 0.85rem;
            margin-bottom: 1rem;
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

        .or {
            text-align: center;
            margin: 1.2rem 0;
            position: relative;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .or::before,
        .or::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: rgba(96, 108, 56, 0.2);
        }

        .or::before {
            left: 0;
        }

        .or::after {
            right: 0;
        }

        .icons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 1.2rem;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-background);
            color: var(--primary);
            font-size: 1.1rem;
            transition: var(--transition);
            border: 2px solid rgba(96, 108, 56, 0.1);
        }

        .social-icon:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-4px);
            border-color: var(--primary);
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .links p {
            color: var(--text-light);
        }

        .switch-btn {
            background: none;
            border: none;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            padding: 0 4px;
        }

        .switch-btn:hover {
            text-decoration: underline;
        }

        #signup {
            display: none;
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

        /* Responsive Design */
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

            .input-group {
                margin-bottom: 0.9rem;
            }

            input {
                padding: 9px 36px 9px 36px;
                font-size: 13.5px;
            }

            .social-icon {
                width: 34px;
                height: 34px;
                font-size: 1rem;
            }

            .links {
                flex-direction: column;
                align-items: center;
                gap: 4px;
                margin-top: 0.8rem;
            }

            .btn {
                padding: 10px;
                font-size: 0.9rem;
            }

            .or {
                margin: 1rem 0;
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
            <?php if(isset($_SESSION['errors'])): ?>
            <div class="error-message">
                <?php foreach($_SESSION['errors'] as $error): ?>
                <p>
                    <?= $error ?>
                </p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
            <?php endif; ?>

            <!-- Sign Up Form -->
            <div id="signup">
                <h1 class="form-title">Create Account</h1>
                <form method="post" action="research_register.php">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="fName" id="fName" placeholder="First Name" required
                            value="<?= isset($_SESSION['form_data']['fName']) ? htmlspecialchars($_SESSION['form_data']['fName']) : '' ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="lName" id="lName" placeholder="Last Name" required
                            value="<?= isset($_SESSION['form_data']['lName']) ? htmlspecialchars($_SESSION['form_data']['lName']) : '' ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            value="<?= isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : '' ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="signupPassword" placeholder="Password" required>
                        <span class="password-toggle" id="signupPasswordToggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <input type="submit" class="btn" value="Sign Up" name="signUp">
                </form>

                <div class="or">or continue with</div>

                <div class="icons">
                    <div class="social-icon">
                        <i class="fab fa-google"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>

                <div class="links">
                    <p>Already Have Account?</p>
                    <button class="switch-btn" id="signInButton">Sign In</button>
                </div>
            </div>

            <!-- Sign In Form -->
            <div id="signIn">
                <h1 class="form-title">Welcome Back</h1>
                <form method="post" action="research_register.php">
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="loginEmail" placeholder="Email" required
                            value="<?= isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : '' ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                        <span class="password-toggle" id="loginPasswordToggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>

                    <div class="recover">
                        <a href="research_resetPassword.php">Forgot Password?</a>
                    </div>

                    <input type="submit" class="btn" value="Sign In" name="signIn">
                </form>

                <div class="or">or continue with</div>

                <div class="icons">
                    <div class="social-icon">
                        <i class="fab fa-google"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>

                <div class="links">
                    <p>Don't have account yet?</p>
                    <button class="switch-btn" id="signUpButton">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle between signup and signin forms
        const signUpButton = document.getElementById('signUpButton');
        const signInButton = document.getElementById('signInButton');
        const signInForm = document.getElementById('signIn');
        const signUpForm = document.getElementById('signup');

        signUpButton.addEventListener('click', function () {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        });

        signInButton.addEventListener('click', function () {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        });

        // Password visibility toggle functionality
        function setupPasswordToggle(passwordId, toggleId) {
            const passwordField = document.getElementById(passwordId);
            const toggleIcon = document.getElementById(toggleId);

            toggleIcon.addEventListener('click', function () {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordField.type = 'password';
                    toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        }

        // Setup toggles for both forms
        document.addEventListener('DOMContentLoaded', function () {
            setupPasswordToggle('signupPassword', 'signupPasswordToggle');
            setupPasswordToggle('loginPassword', 'loginPasswordToggle');
        });
    </script>
</body>

</html>