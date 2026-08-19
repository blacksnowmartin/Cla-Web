<?php
declare(strict_types=1);
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

$email = filter_var(trim((string) ($_POST['username'] ?? '')), FILTER_VALIDATE_EMAIL);
$password = (string) ($_POST['password'] ?? '');

if (!$email || $password === '' || strlen($password) > 255) {
    header('Location: login.html?error=invalid');
    exit;
}

$stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($id, $hashedPassword);

if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
    $_SESSION['email'] = $email;
    $stmt->close();
    $conn->close();
    header('Location: index.html?login=success');
    exit;
}

$stmt->close();
$conn->close();
header('Location: login.html?error=invalid');
exit;
?>