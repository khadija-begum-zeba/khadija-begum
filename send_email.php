<?php
include('connect_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message, submission_time) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Message stored in the database successfully!";

        // Send the message via email
        $to = "211000122e@eastdelta.edu.bd"; 
        $fromName = "Contact Form";
        $fromEmail = "https://khadija-begum-zeba.github.io/resume-of-khadija-begum/"; 
        $subject = "[Contact Form] " . $subject;
        $body = "Name: " . $name . "\n\nEmail: " . $email . "\n\nSubject: " . $subject . "\n\nMessage: " . $message;

        $headers = "From: " . $fromName . " <" . $fromEmail . ">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";

        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent to your email successfully!";
        } else {
            echo "Failed to send the message to your email. Check the server's mail configuration and spam folder.";
        }
    } else {
        echo "Failed to store the message in the database.";
    }

    $stmt->close();
    $conn->close();
}
?>
