<?php
require 'auth.php';

$place_id = $_GET['place_id'] ?? 0;

$stmt = $conn->prepare("SELECT name FROM places WHERE id = ?");
$stmt->bind_param("i", $place_id);
$stmt->execute();
$stmt->bind_result($place_name);
$stmt->fetch();
$stmt->close();

echo "<h2>Reviews for $place_name</h2>";

$stmt = $conn->prepare("
    SELECT r.rating, r.comment, u.username 
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.place_id = ?
");
$stmt->bind_param("i", $place_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div>
        <strong>{$row['username']}:</strong> 
        <span>{$row['rating']} stars</span><br>
        <p>{$row['comment']}</p>
    </div><hr>";
}
$stmt->close();
?>
