<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>City Tourist Website</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
  <h1><a href="index.php">City Tourist</a></h1>
  <nav>
    <a href="places.php">Places</a>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
    <?php else: ?>
      <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
<hr>
<main>
