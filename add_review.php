<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $place_id = (int)($_POST['place_id'] ?? 0);
    $rating = (int)($_POST['rating'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    if ($place_id <= 0 || $rating < 1 || $rating > 5) {
        die("Invalid input.");
    }

    $stmt = $pdo->prepare("INSERT INTO reviews (user_id, place_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $place_id, $rating, $comment]);

    header("Location: ../place.php?id=$place_id");
    exit;
}
?>
