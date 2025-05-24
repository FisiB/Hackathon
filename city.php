<!-- city.php -->
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

// Fetch city images (assuming they are stored in a table or use default set)
$imageFolder = "images/";
$imagePrefix = strtolower($city['name']);
$images = glob($imageFolder . $imagePrefix . "*.jpg"); // images/london1.jpg, london2.jpg...
?>

<div style="padding: 40px; text-align: center;">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: #333;"><?php echo htmlspecialchars($city['name']); ?></h1>

    <p style="font-size: 1.2rem; max-width: 800px; margin: auto; color: #555;"><?php echo nl2br(htmlspecialchars($city['description'])); ?></p>

    <?php if (!empty($city['description2'])): ?>
        <div style="margin-top: 30px;">
            <p style="font-size: 1.1rem; max-width: 900px; margin: auto; color: #444;"><?php echo nl2br(htmlspecialchars($city['description2'])); ?></p>
        </div>
    <?php endif; ?>

    <div style="margin-top: 40px; display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <?php foreach ($images as $img): ?>
            <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($city['name']); ?>" style="width: 300px; height: 200px; border-radius: 10px; object-fit: cover;">
        <?php endforeach; ?>
    </div>
</div>
