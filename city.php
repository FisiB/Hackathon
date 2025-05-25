<?php include 'main_header.php'; ?>
<link rel="stylesheet" href="style.css">

<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=city_tourist", "root", "");

// Get city ID from URL
$cityId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Fetch city data from DB
$stmt = $pdo->prepare("SELECT * FROM cities WHERE id = ?");
$stmt->execute([$cityId]);
$city = $stmt->fetch(PDO::FETCH_ASSOC);

// If city not found
if (!$city) {
    echo "<h2 style='text-align:center; color:red;'>City not found.</h2>";
    exit;
}

// Format city name to lowercase with no spaces for image filenames
$cityName = strtolower(str_replace(' ', '', $city['name']));
$backgroundImg = "images/{$cityName}background.jpg";
$galleryImgs = [
    "images/{$cityName}1.jpg",
    "images/{$cityName}2.jpg",
    "images/{$cityName}3.jpg"
];
?>

<div style="padding: 40px; text-align: center;">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: #333;"><?php echo htmlspecialchars($city['name']); ?></h1>

    <p style="font-size: 1.2rem; max-width: 800px; margin: auto; color: #555;">
        <?php echo nl2br(htmlspecialchars($city['description'])); ?>
    </p>

    <?php if (!empty($city['description2'])): ?>
        <div style="margin-top: 30px;">
            <p style="font-size: 1.1rem; max-width: 900px; margin: auto; color: #444;">
                <?php echo nl2br(htmlspecialchars($city['description2'])); ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Background Image -->
    <?php if (file_exists($backgroundImg)): ?>
        <div style="margin: 40px 0;">
            <img src="<?php echo $backgroundImg; ?>" 
                 alt="City Background" 
                 style="width: 100%; max-height: 500px; border-radius: 12px; object-fit: cover;">
        </div>
    <?php endif; ?>

    <!-- Gallery Images -->
    <div style="margin-top: 30px; display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <?php foreach ($galleryImgs as $img): ?>
            <?php if (file_exists($img)): ?>
                <img src="<?php echo $img; ?>" 
                     alt="<?php echo htmlspecialchars($city['name']); ?> image" 
                     style="width: 300px; height: 200px; border-radius: 10px; object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
