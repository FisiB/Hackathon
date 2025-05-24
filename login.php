<?php
session_start();
require 'includes/db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $errors[] = "Please enter username and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Invalid username or password.";
        }
    }
}

require 'includes/header.php';
?>

<h2>Login</h2>

<?php if ($errors): ?>
  <div class="error-messages">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="login.php" class="form">
  <label for="username">Username:</label><br />
  <input type="text" name="username" id="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" /><br />

  <label for="password">Password:</label><br />
  <input type="password" name="password" id="password" required /><br />

  <button type="submit" class="btn">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a>.</p>

<?php
require 'includes/footer.php';
?>
