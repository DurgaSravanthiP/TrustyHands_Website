<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS LoginPage";
if ($conn->query($sql)) {
    echo "Database 'LoginPage' created successfully!<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db("LoginPage");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'users' created successfully!<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS customers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'customers' created successfully!<br>";
} else {
    echo "Error creating customers table: " . $conn->error . "<br>";
}

// Create bookings table (MODIFIED)
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(6) UNSIGNED NOT NULL,
    worker_id INT(6) UNSIGNED NOT NULL,
    service_type VARCHAR(50) NOT NULL,
    preferred_date DATE NOT NULL,
    problem_description TEXT,
    tools_required TEXT,
    image_path VARCHAR(255),
    payment_mode ENUM('Cash', 'UPI', 'Card'),
    status ENUM('Pending', 'Confirmed', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
)";

if ($conn->query($sql)) {
    echo "Table 'bookings' created successfully!<br>";
} else {
    echo "Error creating bookings table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS workers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    dob DATE,
    gender ENUM('Male', 'Female', 'Other'),
    location VARCHAR(100),
    id_proof_path VARCHAR(255),
    service_type VARCHAR(50) NOT NULL,
    experience INT(3),
    skills TEXT,
    languages VARCHAR(255),
    available_hours VARCHAR(100),
    min_price_per_hour DECIMAL(10,2) NOT NULL,
    max_price_per_hour DECIMAL(10,2) NOT NULL,
    resume_path VARCHAR(255),
    profile_picture_path VARCHAR(255),
    work_samples_path VARCHAR(255),
    agreement_accepted BOOLEAN DEFAULT 0,
    info_confirmed BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'workers' created successfully!<br>";
} else {
    echo "Error creating workers table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'contact_submissions' created successfully!<br>";
} else {
    echo "Error creating contact submissions table: " . $conn->error . "<br>";
}
// Create feedback table
$sql = "CREATE TABLE IF NOT EXISTS feedback (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id INT(6) UNSIGNED NOT NULL,
    user_id INT(6) UNSIGNED NOT NULL,
    rating TINYINT(1) NOT NULL,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql)) {
    echo "Table 'feedback' created successfully!<br>";
} else {
    echo "Error creating feedback table: " . $conn->error . "<br>";
}
$conn->close();
?>