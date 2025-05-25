<?php
session_start(); // Ensure session is started
if (!isset($_SESSION['user_id'])) { // Protect page
    header("Location: login.php");
    exit;
}
include 'main_header.php';
include 'db.php'; // Include database connection
?>

<?php
// Get city ID from URL
$cityId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Fetch city data from DB, including image_url
$stmt = $conn->prepare("SELECT * FROM cities WHERE id = ?"); // Use $conn from db.php
$stmt->execute([$cityId]);
$city = $stmt->fetch(PDO::FETCH_ASSOC);

// If city not found
if (!$city) {
    echo "<h2 class='city-not-found'>City not found.</h2>";
    // footer.php inclusion removed
    exit;
}

// Initialize background image path
$backgroundImg = null;
if (!empty($city['image_url'])) {
    $backgroundImg = htmlspecialchars($city['image_url']);
} else {
    // Fallback to local background image if image_url is not set
    $cityNameFormatted = strtolower(str_replace(' ', '', $city['name'])); // Keep for gallery
    $localBackgroundImg = "images/{$cityNameFormatted}background.jpg";
    if (file_exists($localBackgroundImg)) {
        $backgroundImg = $localBackgroundImg;
    }
}

// Format city name to lowercase with no spaces for local gallery image filenames
$cityName = strtolower(str_replace(' ', '', $city['name']));
$galleryImgs = [
    "images/{$cityName}1.jpg",
    "images/{$cityName}2.jpg",
    "images/{$cityName}3.jpg"
];
?>

<div class="city-detail-container">
    <h1 class="city-detail-title"><?php echo htmlspecialchars($city['name']); ?></h1>

    <p class="city-detail-description">
        <?php echo nl2br(htmlspecialchars($city['description'])); ?>
    </p>

    <?php if (!empty($city['description2'])): ?>
        <div class="city-detail-description2-container">
            <p class="city-detail-description2">
                <?php echo nl2br(htmlspecialchars($city['description2'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Background Image -->
    <?php if ($backgroundImg): // Check if $backgroundImg has a value (either URL or existing local file) ?>
        <div class="city-background-image-container">
            <img src="<?php echo $backgroundImg; ?>"
                 alt="<?php echo htmlspecialchars($city['name']); ?> Background"
                 class="city-background-image">
        </div>
    <?php else: // Optional: display a default background or message if no image is found ?>
        <!-- <p>No background image available for this city.</p> -->
    <?php endif; ?>

    <!-- Gallery Images (keeps existing local file logic) -->
    <div class="city-gallery-container">
        <?php foreach ($galleryImgs as $img): ?>
            <?php if (file_exists($img)): ?>
                <img src="<?php echo $img; ?>"
                     alt="<?php echo htmlspecialchars($city['name']); ?> image"
                     class="city-gallery-image">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php // footer.php inclusion removed ?>
