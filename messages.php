<?php
// Database connection configuration
$servername = "localhost";
$username = "tukitcla_tukitcla";
$password = "Martin2003$";
$dbname = "tukitcla_clashop";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone_Number'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $sql = "INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    echo "We received your message and we will get back to you soonest possible within next 24 working hours.";
}

// Close the database connection
$conn->close();
?>
