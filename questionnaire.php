<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'main_header.php'; // Using main_header for logged-in users
include 'db.php';

// Check if user has already submitted preferences
$stmt_check = $conn->prepare("SELECT id FROM user_preferences WHERE user_id = ?");
$stmt_check->execute([$_SESSION['user_id']]);
if ($stmt_check->fetch()) {
    // If preferences exist, redirect to homepage or a 'preferences already set' page
    header("Location: homepage.php"); 
    exit;
}
?>

<main class="page-container questionnaire-container">
    <h2>Tell Us About Your Travel Style!</h2>
    <p>Your answers will help us recommend the best places for you.</p>

    <form action="save_preferences.php" method="post" class="questionnaire-form">
        
        <fieldset>
            <legend>What are your primary interests?</legend>
            <label><input type="checkbox" name="interests[]" value="historical"> Historical Sites & Landmarks</label>
            <label><input type="checkbox" name="interests[]" value="nature"> Nature & Outdoors</label>
            <label><input type="checkbox" name="interests[]" value="adventure"> Adventure & Activities</label>
            <label><input type="checkbox" name="interests[]" value="beaches"> Beaches & Relaxation</label>
            <label><input type="checkbox" name="interests[]" value="city_life"> Vibrant City Life & Nightlife</label>
            <label><input type="checkbox" name="interests[]" value="museums"> Museums & Art Galleries</label>
            <label><input type="checkbox" name="interests[]" value="foodie_spots"> Foodie Spots & Culinary Experiences</label>
        </fieldset>

        <fieldset>
            <legend>What's your typical travel budget?</legend>
            <label><input type="radio" name="budget_range" value="budget" required> Budget-friendly</label>
            <label><input type="radio" name="budget_range" value="moderate"> Moderate</label>
            <label><input type="radio" name="budget_range" value="upscale"> Upscale / Luxury</label>
        </fieldset>

        <fieldset>
            <legend>Who do you usually travel with?</legend>
            <label><input type="radio" name="travel_companions" value="solo" required> Solo</label>
            <label><input type="radio" name="travel_companions" value="partner"> Partner / Spouse</label>
            <label><input type="radio" name="travel_companions" value="family"> Family (with kids)</label>
            <label><input type="radio" name="travel_companions" value="friends"> Friends</label>
        </fieldset>

        <fieldset>
            <legend>What's your preferred travel pace?</legend>
            <label><input type="radio" name="travel_pace" value="relaxed" required> Relaxed (take it easy)</label>
            <label><input type="radio" name="travel_pace" value="balanced"> Balanced (mix of activities & downtime)</label>
            <label><input type="radio" name="travel_pace" value="action-packed"> Action-packed (see and do as much as possible)</label>
        </fieldset>

        <button type="submit" class="btn">Save Preferences & Continue</button>
    </form>
</main>

<?php include 'footer.php'; ?>