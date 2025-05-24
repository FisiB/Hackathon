<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php';

$place_id = $_GET['place_id'] ?? null;
if (!$place_id) {
    echo "<p>No place selected.</p>";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM places WHERE id = ?");
$stmt->execute([$place_id]);
$place = $stmt->fetch();

$stmt = $conn->prepare("SELECT r.comment, r.rating, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.place_id = ?");
$stmt->execute([$place_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="place-detail">
    <h2><?= htmlspecialchars($place['name']) ?></h2>
    <img src="<?= $place['image'] ?>" alt="<?= $place['name'] ?>">
    <p><?= $place['description'] ?></p>

    <h3>Reviews</h3>
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <strong><?= htmlspecialchars($review['username']) ?>:</strong>
            <span>Rating: <?= $review['rating'] ?>/5</span>
            <p><?= htmlspecialchars($review['comment']) ?></p>
        </div>
    <?php endforeach; ?>

    <h4>Leave a Review</h4>
    <form action="add_review.php" method="post" class="review-form">
        <input type="hidden" name="place_id" value="<?= $place['id'] ?>">
        <label for="rating">Rating (1–5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label for="comment">Comment:</label>
        <textarea name="comment" required></textarea>

        <button type="submit">Submit Review</button>
    </form>
</main>
</body>
</html>
