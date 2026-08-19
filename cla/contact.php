<?php
declare(strict_types=1);
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
$phone = trim((string) ($_POST['phone'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || strlen($name) > 255 || !$email || strlen($phone) > 40 || $message === '' || strlen($message) > 5000) {
    header('Location: contact.html?error=invalid');
    exit;
}

$stmt = $conn->prepare('INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $name, $email, $phone, $message);
$stmt->execute();
$stmt->close();
$conn->close();

header('Location: contact.html?sent=success');
exit;
?>