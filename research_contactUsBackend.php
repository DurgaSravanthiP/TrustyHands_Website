<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Sanitize input data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_submissions (full_name, email, phone, subject, message)
            VALUES ('$full_name', '$email', '$phone', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Store success message in session
        $_SESSION['form_success'] = true;
    } else {
        error_log("Error: " . $sql . "<br>" . $conn->error);
    }

    $conn->close();

    // Redirect back to contact page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>