<?php
require 'includes/db.php';
require 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM places LIMIT 3");
$places = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Welcome to the City Tourist Website</h2>
<p>Discover the best places in the city!</p>

<h3>Featured Places</h3>
<div class="places-list">
<?php foreach ($places as $place): ?>
  <div class="place-item">
    <h4><a href="place.php?id=<?= $place['id'] ?>"><?= htmlspecialchars($place['name']) ?></a></h4>
    <p><?= htmlspecialchars(substr($place['description'], 0, 150)) ?>...</p>
    <?php if ($place['image_url']): ?>
      <img src="images/<?= htmlspecialchars($place['image_url']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" width="200" />
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>

<?php
require 'includes/footer.php';
?>
