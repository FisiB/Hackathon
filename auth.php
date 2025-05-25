<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Preferences check removed, redirecting directly to homepage
        header("Location: homepage.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php");
        exit(); // Ensure no further code is executed after redirect
    }

} elseif (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    $user_id = $conn->lastInsertId(); // Get the ID of the newly registered user

    // Log the new user in directly
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // New users are directed to the questionnaire
    header("Location: homepage.php");
    exit();
}
