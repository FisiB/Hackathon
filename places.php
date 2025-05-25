<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php';

$city_id = $_GET['city_id'] ?? null;
if (!$city_id) {
    echo "<p class='no-city-message'>Invalid city selected. Please go back and select a city.</p>";
    include 'footer.php'; // Include footer for consistent page structure
    exit;
}

$stmt = $conn->prepare("SELECT name FROM cities WHERE id = ?");
$stmt->execute([$city_id]);
$city = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM places WHERE city_id = ?");
$stmt->execute([$city_id]);
$places = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="places-section">
    <h2>Places to Visit in <?= htmlspecialchars($city['name']) ?></h2>
    <div class="places-grid">
        <?php foreach ($places as $place): ?>
            <div class="place-card">
                <img src="<?= $place['image'] ?>" alt="<?= $place['name'] ?>">
                <h3><?= $place['name'] ?></h3>
                <p><?= $place['description'] ?></p>
                <a href="place.php?place_id=<?= $place['id'] ?>" class="btn">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include 'footer.php'; ?>
