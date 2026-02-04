<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['Name']);
    $email = trim($_POST['Email']);
    $phone = trim($_POST['Phone Number']);
    $message = trim($_POST['Message']);

    // Validate
    if (empty($name) || empty($email) || empty($message)) {
        echo "Name, Email, and Message are required.";
        exit();
    }

    // Insert
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "Error sending message: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>