<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

define('UPLOAD_DIR_REVIEWS', 'uploads/review_images/'); // Ensure this directory exists and is writable

$place_id = $_POST['place_id'] ?? null;
$rating = $_POST['rating'] ?? null;
$comment = $_POST['comment'] ?? '';
$user_id = $_SESSION['user_id'];
$image_path = null;

// Basic validation
if (!$place_id || !$rating) {
    // Handle error: redirect back with a message
    $_SESSION['review_error'] = "Place ID and Rating are required.";
    // Attempt to redirect back to the specific place page if place_id is known
    $redirect_url = $place_id ? "place.php?place_id=" . $place_id : "cities.php"; // Fallback to cities if place_id unknown
    header("Location: " . $redirect_url);
    exit;
}


// Handle file upload
if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['review_image']['tmp_name'];
    $file_name = basename($_FILES['review_image']['name']);
    $file_size = $_FILES['review_image']['size'];
    $file_type = $_FILES['review_image']['type'];
    $file_ext_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_parts));

    // Validate file type and size
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $max_file_size = 5 * 1024 * 1024; // 5MB

    if (in_array($file_ext, $allowed_extensions) && $file_size <= $max_file_size) {
        // Create a unique filename
        $new_file_name = uniqid('review_', true) . '.' . $file_ext;
        $destination = UPLOAD_DIR_REVIEWS . $new_file_name;

        if (!is_dir(UPLOAD_DIR_REVIEWS)) {
            mkdir(UPLOAD_DIR_REVIEWS, 0775, true); // Create directory if it doesn't exist
        }

        if (move_uploaded_file($tmp_name, $destination)) {
            $image_path = $destination;
        } else {
            $_SESSION['review_error'] = "Failed to move uploaded file.";
            // Log error: error_log("Failed to move uploaded file: " . $destination);
        }
    } else {
        $_SESSION['review_error'] = "Invalid file type or size. Max 5MB and only JPG, PNG, GIF allowed.";
    }
} elseif (isset($_FILES['review_image']) && $_FILES['review_image']['error'] != UPLOAD_ERR_NO_FILE) {
    // Handle other upload errors
    $_SESSION['review_error'] = "File upload error: " . $_FILES['review_image']['error'];
}


// If there was a review error (e.g. file upload failed but comment was valid)
// redirect back to the place page to show the error.
if (isset($_SESSION['review_error'])) {
    header("Location: place.php?place_id=" . $place_id);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO reviews (place_id, user_id, rating, comment, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$place_id, $user_id, $rating, $comment, $image_path]);
} catch (PDOException $e) {
    $_SESSION['review_error'] = "Database error: Could not save review. " . $e->getMessage();
    // Log error: error_log("Database error on review insert: " . $e->getMessage());
    header("Location: place.php?place_id=" . $place_id);
    exit;
}

header("Location: place.php?place_id=" . $place_id);
exit;
