<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$place_id = $_POST['place_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO reviews (place_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
$stmt->execute([$place_id, $user_id, $rating, $comment]);

header("Location: place.php?place_id=" . $place_id);
exit;
