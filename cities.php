<?php
include("auth.php");
requireLogin();
include("header.php");
?>

<h2>Top Cities to Visit</h2>

<div class="city-card">
    <img src="images/rome.jpg" alt="Rome">
    <div class="city-info">
        <h3>Rome, Italy</h3>
        <p>Known for its ancient history and landmarks like the Colosseum and Vatican City.</p>
        <a href="places.php?city=Rome" class="btn">Explore</a>
    </div>
</div>

<div class="city-card">
    <img src="images/paris.jpg" alt="Paris">
    <div class="city-info">
        <h3>Paris, France</h3>
        <p>The city of lights, famous for the Eiffel Tower, art, food and romantic atmosphere.</p>
        <a href="places.php?city=Paris" class="btn">Explore</a>
    </div>
</div>

<div class="city-card">
    <img src="images/tokyo.jpg" alt="Tokyo">
    <div class="city-info">
        <h3>Tokyo, Japan</h3>
        <p>A high-tech metropolis blending tradition with innovation, temples, and anime culture.</p>
        <a href="places.php?city=Tokyo" class="btn">Explore</a>
    </div>
</div>

<?php include("footer.php"); ?>
