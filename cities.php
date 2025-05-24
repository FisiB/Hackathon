<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php';

$stmt = $conn->query("SELECT * FROM cities");
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="city-list">
    <h2>Popular Cities</h2>
    <div class="cities-grid">
        <?php foreach ($cities as $city): ?>
            <div class="city-card">
                <img src="<?= $city['image'] ?>" alt="<?= $city['name'] ?>">
                <h3><?= $city['name'] ?></h3>
                <p><?= $city['description'] ?></p>
                <a href="places.php?city_id=<?= $city['id'] ?>" class="btn">Explore</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
