<?php
// config.php

$host = 'localhost';
$db = 'city_tourist';
$user = 'root';
$pass = ''; // Change if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

session_start();
?>
