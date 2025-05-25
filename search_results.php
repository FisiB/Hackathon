<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php';

$search_query = $_GET['query'] ?? '';

if (empty(trim($search_query))) {
    // Optional: Redirect back or show a message if query is empty
    // For now, we'll proceed and it will likely show no results or all if not handled by SQL
    // Or, more strictly:
    // echo "<main class='main-content'><p>Please enter a search term.</p><p><a href='homepage.php' class='btn'>Back to Homepage</a></p></main>";
    // include 'footer.php';
    // exit;
}

$results = [];
if (!empty(trim($search_query))) {
    try {
        // Prepare a statement to search for places by name
        // Using LIKE for partial matches.
        // Consider adding more fields to search in, e.g., description, city name if places are linked to cities
        $stmt = $conn->prepare("SELECT p.id, p.name, p.description, p.image, c.name as city_name 
                                FROM places p 
                                LEFT JOIN cities c ON p.city_id = c.id 
                                WHERE p.name LIKE ? OR p.description LIKE ?");
        $searchTerm = "%" . $search_query . "%";
        $stmt->execute([$searchTerm, $searchTerm]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log error or display a generic error message
        error_log("Search query failed: " . $e->getMessage());
        // For user:
        // echo "<main class='main-content'><p>There was an error performing the search. Please try again later.</p></main>";
        // include 'footer.php';
        // exit;
        // For now, $results will remain empty, leading to "no results" message.
    }
}
?>

<main class="main-content search-results-page">
    <h2>Search Results for "<?= htmlspecialchars($search_query) ?>"</h2>

    <?php if (empty(trim($search_query))): ?>
        <p>Please enter a search term in the <a href="homepage.php">homepage</a>.</p>
    <?php elseif (!empty($results)): ?>
        <div class="places-grid">
            <?php foreach ($results as $place): ?>
                <div class="place-card">
                    <a href="place.php?place_id=<?= $place['id'] ?>">
                        <img src="<?= htmlspecialchars($place['image'] ?: 'path/to/default-image.jpg') ?>" alt="<?= htmlspecialchars($place['name']) ?>" class="place-card-image">
                        <div class="place-card-content">
                            <h3><?= htmlspecialchars($place['name']) ?></h3>
                            <?php if (!empty($place['city_name'])): ?>
                                <p class="place-card-city"><em><?= htmlspecialchars($place['city_name']) ?></em></p>
                            <?php endif; ?>
                            <p><?= nl2br(htmlspecialchars(substr($place['description'], 0, 100))) . (strlen($place['description']) > 100 ? '...' : '') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No places found matching your search criteria "<?= htmlspecialchars($search_query) ?>".</p>
        <p>Try searching for something else or <a href="cities.php" class="btn">explore all cities</a>.</p>
    <?php endif; ?>

</main>

<?php // footer.php inclusion removed ?>