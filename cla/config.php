<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password
$db = 'cla_db';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>