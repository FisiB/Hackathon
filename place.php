<?php
include("auth.php");
requireLogin();
include("db.php");
include("header.php");

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM places WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$place = $stmt->get_result()->fetch_assoc();

$reviewStmt = $conn->prepare("SELECT r.rating, r.comment, u.email FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.place_id = ?");
$reviewStmt->bind_param("i", $id);
$reviewStmt->execute();
$reviews = $reviewStmt->get_result();
?>

<h2><?= htmlspecialchars($place['name']) ?></h2>
<p><?= htmlspecialchars($place['description']) ?></p>
<a href="add_review.php?place_id=<?= $id ?>" class="btn">Add Review</a>

<h3>Reviews</h3>
<?php while ($review = $reviews->fetch_assoc()): ?>
    <div>
        <strong><?= htmlspecialchars($review['email']) ?>:</strong>
        <span>⭐ <?= $review['rating'] ?>/5</span>
        <p><?= htmlspecialchars($review['comment']) ?></p>
    </div>
<?php endwhile; ?>

<?php include("footer.php"); ?>
