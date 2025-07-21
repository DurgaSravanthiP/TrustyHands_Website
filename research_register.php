<?php
session_start();
include 'research_db_connect.php';

// Handle sign-up
if(isset($_POST['signUp'])){
    // Sanitize input
    $firstName = trim(htmlspecialchars($_POST['fName']));
    $lastName = trim(htmlspecialchars($_POST['lName']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Validate input
    $errors = [];
    
    // Name validation (2-50 characters, letters and spaces only)
    if(empty($firstName) || !preg_match("/^[a-zA-Z ]{2,50}$/", $firstName)) {
        $errors[] = "First name must be 2-50 letters and spaces";
    }
    
    if(empty($lastName) || !preg_match("/^[a-zA-Z ]{2,50}$/", $lastName)) {
        $errors[] = "Last name must be 2-50 letters and spaces";
    }
    
    // Email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Password validation (min 8 characters)
    if(strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    // If validation errors
    if(!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = [
            'fName' => $firstName,
            'lName' => $lastName,
            'email' => $email
        ];
        header("Location: research_index.php#signup");
        exit();
    }
    
    // Check if email exists
    $checkEmail = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $_SESSION['errors'] = ["Email Address Already Exists!"];
        $_SESSION['form_data'] = [
            'fName' => $firstName,
            'lName' => $lastName,
            'email' => $email
        ];
        header("Location: research_index.php#signup");
        exit();
    }
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                    VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
    
    if($stmt->execute()){
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['email'] = $email;
        
        // Clear form data from session
        unset($_SESSION['form_data']);
        
        header("Location: research_homepage.php");
        exit();
    } else {
        $_SESSION['errors'] = ["Database error: " . $conn->error];
        $_SESSION['form_data'] = [
            'fName' => $firstName,
            'lName' => $lastName,
            'email' => $email
        ];
        header("Location: research_index.php#signup");
        exit();
    }
}

// Handle sign-in
if(isset($_POST['signIn'])){
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Basic validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'] = ["Invalid email format"];
        $_SESSION['form_data'] = ['email' => $email];
        header("Location: research_index.php#signIn");
        exit();
    }
    
    // Get user from database
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 0){
        $_SESSION['errors'] = ["Email not found"];
        $_SESSION['form_data'] = ['email' => $email];
        header("Location: research_index.php#signIn");
        exit();
    }
    
    $row = $result->fetch_assoc();
    
    // Verify password
    if(password_verify($password, $row['password'])){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['email'] = $row['email'];
        
        // Clear form data from session
        unset($_SESSION['form_data']);
        
        header("Location: research_homepage.php");
        exit();
    } else {
        $_SESSION['errors'] = ["Incorrect password"];
        $_SESSION['form_data'] = ['email' => $email];
        header("Location: research_index.php#signIn");
        exit();
    }
}