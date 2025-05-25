<?php
session_start();
include 'auth_header.php';
?>
<main class="auth-main">
    <form action="auth.php" method="post" class="auth-form">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<p style="color: red; text-align: center;">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
    </form>
</main>
<?php // footer.php inclusion removed ?>
