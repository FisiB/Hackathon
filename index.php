<?php
include("auth.php");
requireLogin();
include("header.php");
?>
<h2>Welcome, Traveler!</h2>
<p>Explore cities, read reviews, and discover hidden gems!</p>
<div style="text-align:center; margin-top:20px;">
    <a href="cities.php" class="btn">Check the Best Cities to Visit</a>
</div>
<?php include("footer.php"); ?>
