<?php
session_start(); // Ensure session is started for header/footer if they use session vars
if (!isset($_SESSION['user_id'])) { // Protect page
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php'; // Include database connection
?>

<div class="city-list">

<?php
// Fetch all cities
$stmt = $conn->query("SELECT id, name FROM cities ORDER BY name ASC");
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through each city and show image + link
foreach ($cities as $city) {
    // Image file (optional: fallback image if file doesn't exist)
    $imgPath = 'images/' . strtolower($city['name']) . '.jpg';
    if (!file_exists($imgPath)) {
        $imgPath = 'images/default.jpg'; // Add a default.jpg image
    }

    echo '<div class="city-card">';
    echo '<a href="city.php?id=' . $city['id'] . '">';
    echo '<img src="' . $imgPath . '" alt="' . htmlspecialchars($city['name']) . '">';
    echo '<div class="content">';
    echo '<h3>' . htmlspecialchars($city['name']) . '</h3>';
    echo '<p>Click to explore more about ' . htmlspecialchars($city['name']) . '.</p>';
    echo '</div></a></div>';
}
?>

</div>
<?php include 'footer.php'; ?>
