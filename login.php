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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows == 1) {
        // User found, redirect to a welcome page or perform any other actions
        echo "Login successful!";
    } else {
        // User not found, display an error message
        echo "Invalid username or password";
    }

    // Free the result set
    $result->free_result();
}

// Close the database connection
$conn->close();
?>
