<?php
require 'config.php';
require 'includes/functions.php';

if (isLoggedIn()) {
    redirect('users/dashboard.php'); // redirect logged-in users
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $email = cleanInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = "Both fields are required.";
    } else {
        $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            redirect('users/dashboard.php');
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
<?php include 'header.php'; ?>

<div class="auth-container">
    <h2>Login</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST" action="">
        <?= csrfInput(); ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>

<?php include 'footer.php'; ?>
