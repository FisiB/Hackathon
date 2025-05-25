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
// Fetch all cities, including the new image_url field
$stmt = $conn->query("SELECT id, name, image_url FROM cities ORDER BY name ASC");
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through each city and show image + link
foreach ($cities as $city) {
    $imgPath = 'images/default.jpg'; // Default fallback image

    if (!empty($city['image_url'])) {
        $imgPath = htmlspecialchars($city['image_url']); // Use the URL if available
    } else {
        // Fallback to local image if image_url is not set
        $localImgPath = 'images/' . strtolower(str_replace(' ', '_', $city['name'])) . '.jpg'; // Handle spaces in names for filenames
        if (file_exists($localImgPath)) {
            $imgPath = $localImgPath;
        }
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
<?php // footer.php inclusion removed ?>
