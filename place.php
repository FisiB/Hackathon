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
    echo "<p class='no-place-message'>No place selected. Please go back and select a place.</p>";
    include 'footer.php'; // Include footer for consistent page structure
    exit;
}

$stmt = $conn->prepare("SELECT * FROM places WHERE id = ?");
$stmt->execute([$place_id]);
$place = $stmt->fetch();

$stmt = $conn->prepare("SELECT r.comment, r.rating, r.image_path, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.place_id = ? ORDER BY r.created_at DESC");
$stmt->execute([$place_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="place-detail">
    <h2><?= htmlspecialchars($place['name']) ?></h2>
    <div class="place-image-container">
        <img src="<?= $place['image'] ?>" alt="<?= htmlspecialchars($place['name']) ?>" class="place-image">
    </div>
    <p class="place-description"><?= nl2br(htmlspecialchars($place['description'])) ?></p>

    <div class="reviews-section">
        <h3>Reviews</h3>
        <?php if (empty($reviews)): ?>
            <p>No reviews yet. Be the first to leave a review!</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <strong><?= htmlspecialchars($review['username']) ?>:</strong>
                    <span class="review-rating">Rating: <?= htmlspecialchars($review['rating']) ?>/5</span>
                    <p class="review-comment"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                    <?php if (!empty($review['image_path']) && file_exists($review['image_path'])): ?>
                        <div class="review-image-container">
                            <img src="<?= htmlspecialchars($review['image_path']) ?>" alt="Review image for <?= htmlspecialchars($place['name']) ?>" class="review-image">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="review-form-section">
        <h4>Leave a Review</h4>
        <?php
        if (isset($_SESSION['review_error'])) {
            echo '<p class="review-form-error">' . htmlspecialchars($_SESSION['review_error']) . '</p>';
            unset($_SESSION['review_error']);
        }
        ?>
        <form action="add_review.php" method="post" class="review-form" enctype="multipart/form-data">
            <input type="hidden" name="place_id" value="<?= $place['id'] ?>">
            <div>
                <label for="rating">Rating (1–5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required>
            </div>
            <div>
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
            </div>
            <div>
                <label for="review_image">Upload an image (optional):</label>
                <input type="file" id="review_image" name="review_image" accept="image/jpeg, image/png, image/gif">
            </div>
            <button type="submit">Submit Review</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>
