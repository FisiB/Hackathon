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

        <section class="search-section">
            <h3>Search for a Place</h3>
            <form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Enter place name..." required>
                <button type="submit" class="btn">Search</button>
            </form>
        </section>

        <a href="cities.php" class="btn">Check the Best Cities to Visit</a>
    </section>
</main>
<?php include 'footer.php'; ?>
