<?php
declare(strict_types=1);
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.html');
    exit;
}

$fullname = trim((string) ($_POST['fullname'] ?? ''));
$email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
$password = (string) ($_POST['password'] ?? '');
$confirmPassword = (string) ($_POST['confirm_password'] ?? '');

if ($fullname === '' || strlen($fullname) > 255 || !$email || strlen($password) < 8 || strlen($password) > 255) {
    header('Location: signup.html?error=invalid');
    exit;
}

if ($password !== $confirmPassword) {
    header('Location: signup.html?error=match');
    exit;
}

$stmt = $conn->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    header('Location: signup.html?error=exists');
    exit;
}
$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $fullname, $email, $hashedPassword);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: login.html?signup=success');
exit;
?>