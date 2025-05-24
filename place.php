<!-- Add this inside place.php where the review form and reviews display -->

<h3>Reviews</h3>
<div class="reviews-container">
  <?php if (count($reviews) === 0): ?>
    <p>No reviews yet. Be the first to review!</p>
  <?php else: ?>
    <ul>
    <?php foreach ($reviews as $review): ?>
      <li>
        <strong><?= htmlspecialchars($review['username']) ?></strong> 
        (<?= $review['rating'] ?>/5) — <em><?= nl2br(htmlspecialchars($review['comment'])) ?></em>
        <br><small><?= $review['created_at'] ?></small>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php if (isset($_SESSION['user_id'])): ?>
  <h3>Leave a Review</h3>
  <form method="POST" action="actions/add_review.php" class="form review-form">
    <input type="hidden" name="place_id" value="<?= $place['id'] ?>" />
    <label for="rating">Rating (1-5):</label>
    <select name="rating" id="rating" required>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <option value="<?= $i ?>"><?= $i ?></option>
      <?php endfor; ?>
    </select>
    <br />
    <label for="comment">Comment:</label><br />
    <textarea name="comment" id="comment" rows="5" required></textarea>
    <br />
    <button type="submit" class="btn">Submit Review</button>
  </form>
<?php else: ?>
  <p><a href="login.php">Log in</a> to leave a review.</p>
<?php endif; ?>
