<?php
session_start();
require 'includes/db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!$username || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password !== $password_confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = "Username or email already taken.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password_hash]);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        }
    }
}

require 'includes/header.php';
?>

<h2>Register</h2>

<?php if ($errors): ?>
  <div class="error-messages">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="register.php" class="form">
  <label for="username">Username:</label><br />
  <input type="text" name="username" id="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" /><br />

  <label for="email">Email:</label><br />
  <input type="email" name="email" id="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" /><br />

  <label for="password">Password:</label><br />
  <input type="password" name="password" id="password" required /><br />

  <label for="password_confirm">Confirm Password:</label><br />
  <input type="password" name="password_confirm" id="password_confirm" required /><br />

  <button type="submit" class="btn">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a>.</p>

<?php
require 'includes/footer.php';
?>
