<?php
session_start();
include 'auth_header.php';
?>
<main class="auth-main">
    <form action="auth.php" method="post" class="auth-form">
        <h2>Sign Up</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</main>
</body>
</html>
