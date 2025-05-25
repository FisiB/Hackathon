<?php
include 'db.php'; // Your database connection

header('Content-Type: text/plain'); // Output as plain text for easy copying

echo "-- SQL statements to update city image URLs --\n";
echo "-- Copy and paste these into your SQL execution tool (e.g., phpMyAdmin) --\n\n";

try {
    $stmt = $conn->query("SELECT id, name FROM cities ORDER BY name ASC");
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cities)) {
        echo "-- No cities found in the database. --\n";
        exit;
    }

    foreach ($cities as $city) {
        $city_id = $city['id'];
        $city_name_raw = $city['name'];
        
        // Prepare city name for URL: replace spaces with commas for Unsplash, URL encode
        $search_term = urlencode(str_replace(' ', ',', $city_name_raw) . ',city,skyline'); // Add generic terms
        $image_url = "https://source.unsplash.com/600x400/?" . $search_term;

        // Escape the URL for SQL (though PDO would handle this if we were executing directly)
        // For plain text output, direct usage is fine, but be mindful if copy-pasting.
        // Using $conn->quote() would be safer if we were building a query to execute here.
        // However, for simple echo, this is okay. User must ensure quotes are handled by their SQL tool.
        $escaped_image_url = str_replace("'", "''", $image_url); // Basic escaping for SQL string

        echo "UPDATE cities SET image_url = '" . $escaped_image_url . "' WHERE id = " . $city_id . ";\n";
    }

    echo "\n-- End of SQL statements --\n";

} catch (PDOException $e) {
    echo "-- Error fetching cities: " . $e->getMessage() . " --\n";
}

?>