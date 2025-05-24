<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php';
?>
<main class="main-content">
    <section class="welcome">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Discover amazing cities and share your experiences.</p>
        <a href="cities.php" class="btn">Check the Best Cities to Visit</a>
    </section>
</main>
</body>
</html>
