<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Sanitize and prepare data
    $interests = isset($_POST['interests']) ? (array)$_POST['interests'] : [];
    $interest_historical = in_array('historical', $interests);
    $interest_nature = in_array('nature', $interests);
    $interest_adventure = in_array('adventure', $interests);
    $interest_beaches = in_array('beaches', $interests);
    $interest_city_life = in_array('city_life', $interests);
    $interest_museums = in_array('museums', $interests);
    $interest_foodie_spots = in_array('foodie_spots', $interests);

    $budget_range = isset($_POST['budget_range']) ? htmlspecialchars(trim($_POST['budget_range'])) : null;
    $travel_companions = isset($_POST['travel_companions']) ? htmlspecialchars(trim($_POST['travel_companions'])) : null;
    $travel_pace = isset($_POST['travel_pace']) ? htmlspecialchars(trim($_POST['travel_pace'])) : null;

    // Check if preferences already exist for this user
    $stmt_check = $conn->prepare("SELECT id FROM user_preferences WHERE user_id = ?");
    $stmt_check->execute([$user_id]);
    $existing_preference = $stmt_check->fetch();

    if ($existing_preference) {
        // Update existing preferences
        $sql = "UPDATE user_preferences SET 
                    interest_historical = ?, interest_nature = ?, interest_adventure = ?, 
                    interest_beaches = ?, interest_city_life = ?, interest_museums = ?, 
                    interest_foodie_spots = ?, budget_range = ?, travel_companions = ?, 
                    travel_pace = ?, updated_at = CURRENT_TIMESTAMP
                WHERE user_id = ?";
        $params = [
            $interest_historical, $interest_nature, $interest_adventure, 
            $interest_beaches, $interest_city_life, $interest_museums, 
            $interest_foodie_spots, $budget_range, $travel_companions, 
            $travel_pace, $user_id
        ];
    } else {
        // Insert new preferences
        $sql = "INSERT INTO user_preferences (
                    user_id, interest_historical, interest_nature, interest_adventure, 
                    interest_beaches, interest_city_life, interest_museums, 
                    interest_foodie_spots, budget_range, travel_companions, travel_pace
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $user_id, $interest_historical, $interest_nature, $interest_adventure, 
            $interest_beaches, $interest_city_life, $interest_museums, 
            $interest_foodie_spots, $budget_range, $travel_companions, $travel_pace
        ];
    }

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $_SESSION['preferences_saved'] = true; // Optional: set a flag for confirmation
        header("Location: homepage.php"); // Redirect to homepage after saving
        exit;
    } catch (PDOException $e) {
        // Handle error, e.g., log it and show a generic error message
        // For now, just redirect back to questionnaire with an error
        $_SESSION['preference_error'] = "Could not save preferences. Please try again. Error: " . $e->getMessage();
        header("Location: questionnaire.php");
        exit;
    }

} else {
    // If not a POST request, redirect to questionnaire
    header("Location: questionnaire.php");
    exit;
}
?>