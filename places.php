<?php
require 'includes/db.php';
require 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM places ORDER BY name");
$places = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>All Places</h2>
<div class="places-list">
<?php foreach ($places as $place): ?>
  <div class="place-item">
    <h3><a href="place.php?id=<?= $place['id'] ?>"><?= htmlspecialchars($place['name']) ?></a> (<?= htmlspecialchars($place['category']) ?>)</h3>
    <?php if ($place['image_url']): ?>
      <img src="images/<?= htmlspecialchars($place['image_url']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" width="200" />
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>

<?php
require 'includes/footer.php';
?>
