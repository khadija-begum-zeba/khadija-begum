<?php
include('connect_db.php');

// Create table for Education
$sqlEducation = "CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(255),
    program VARCHAR(255),
    institute VARCHAR(255),
    cgpa_gpa VARCHAR(10)
)";

// Create table for Experience
$sqlExperience = "CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(255),
    company VARCHAR(255),
    location VARCHAR(255),
    start_date VARCHAR(20),
    end_date VARCHAR(20)
)";

// Create table for Portfolio
$sqlPortfolio = "CREATE TABLE IF NOT EXISTS portfolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    project_name VARCHAR(255),
    image_path VARCHAR(255)
)";

// Create table for Contact Messages
$sqlContactMessages = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sqlEducation) === TRUE) {
    echo "Table 'education' created successfully\n";
} else {
    echo "Error creating table 'education': " . $conn->error . "\n";
}

if ($conn->query($sqlExperience) === TRUE) {
    echo "Table 'experience' created successfully\n";
} else {
    echo "Error creating table 'experience': " . $conn->error . "\n";
}

if ($conn->query($sqlPortfolio) === TRUE) {
    echo "Table 'portfolio' created successfully\n";
} else {
    echo "Error creating table 'portfolio': " . $conn->error . "\n";
}

if ($conn->query($sqlContactMessages) === TRUE) {
    echo "Table 'contact_messages' created successfully\n";
} else {
    echo "Error creating table 'contact_messages': " . $conn->error . "\n";
}

$conn->close();
?>
