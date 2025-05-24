<?php
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $city_id = $_POST['city_id'];

    $stmt = $conn->prepare("INSERT INTO places (name, description, city_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $desc, $city_id);
    if ($stmt->execute()) {
        echo "Place added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="post">
    <h2>Add Tourist Place</h2>
    <input type="text" name="name" placeholder="Place name" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="city_id" placeholder="City ID" required><br>
    <button type="submit">Add Place</button>
</form>
