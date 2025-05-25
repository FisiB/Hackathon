<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php'; // Include database for fetching featured place

// Fetch a random place for the "Featured Place" section
$featuredPlace = null;
try {
    // Assuming 'places' table has 'id', 'name', 'description', 'image' (or similar for image path/URL)
    // And 'image' column in 'places' table stores the direct URL or path to the place's primary image
    $stmt = $conn->query("SELECT id, name, description, image FROM places ORDER BY RAND() LIMIT 1");
    if ($stmt) {
        $featuredPlace = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    // Log error or handle silently
    error_log("Error fetching featured place: " . $e->getMessage());
}
?>
<main class="main-content homepage-layout">
    <section class="welcome">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Discover amazing cities and share your experiences.</p>

        <section class="search-section">
            <h3>Search for a Place</h3>
            <form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Enter place name..." required>
                <button type="submit" class="btn">Search</button>
            </form>
        </section>

        <a href="cities.php" class="btn">Check the Best Cities to Visit</a>
    </section>

    <?php if ($featuredPlace): ?>
    <section class="featured-place-section">
        <h3>✨ Featured Place ✨</h3>
        <div class="featured-place-card">
            <a href="place.php?place_id=<?= htmlspecialchars($featuredPlace['id']) ?>">
                <?php
                    // Use a default image if the place's image is empty or not found
                    $placeImageUrl = !empty($featuredPlace['image']) ? htmlspecialchars($featuredPlace['image']) : 'images/default_place.jpg';
                ?>
                <img src="<?= $placeImageUrl ?>" alt="<?= htmlspecialchars($featuredPlace['name']) ?>" class="featured-place-image">
                <div class="featured-place-content">
                    <h4><?= htmlspecialchars($featuredPlace['name']) ?></h4>
                    <p><?= nl2br(htmlspecialchars(substr($featuredPlace['description'], 0, 120))) . (strlen($featuredPlace['description']) > 120 ? '...' : '') ?></p>
                </div>
            </a>
        </div>
    </section>
    <?php endif; ?>

</main>
<?php // footer.php inclusion removed ?>
