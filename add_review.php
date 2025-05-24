<?php
include("auth.php");
requireLogin();
include("db.php");

$place_id = $_GET['place_id'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO reviews (place_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $place_id, $user_id, $rating, $comment);
    $stmt->execute();

    header("Location: place.php?id=$place_id");
    exit();
}
include("header.php");
?>

<h2>Add Review</h2>
<form method="post">
    <label for="rating">Rating (1-5):</label>
    <select name="rating" required>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <label for="comment">Comment:</label>
    <textarea name="comment" required></textarea>
    <button type="submit">Submit</button>
</form>

<?php include("footer.php"); ?>
