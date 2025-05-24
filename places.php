<?php
include("auth.php");
requireLogin();
include("db.php");
include("header.php");

$city = $_GET['city'] ?? '';

$stmt = $conn->prepare("SELECT * FROM places WHERE city = ?");
$stmt->bind_param("s", $city);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Places in <?= htmlspecialchars($city) ?></h2>

<?php while ($place = $result->fetch_assoc()): ?>
    <div class="city-card">
        <img src="images/<?= htmlspecialchars($place['image']) ?>" alt="<?= htmlspecialchars($place['name']) ?>">
        <div class="city-info">
            <h3><?= htmlspecialchars($place['name']) ?></h3>
            <p><?= htmlspecialchars($place['description']) ?></p>
            <a href="place.php?id=<?= $place['id'] ?>" class="btn">View Reviews</a>
        </div>
    </div>
<?php endwhile; ?>

<?php include("footer.php"); ?>
