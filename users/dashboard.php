<?php
require '../config.php';
require '../includes/functions.php';

if (!isLoggedIn()) {
    redirect('../login.php');
}

$user_name = $_SESSION['user_name'];
?>
<?php include '../header.php'; ?>

<div class="dashboard-wrapper">
    <?php include 'sidebar.php'; ?>

    <main class="dashboard-main">
        <h1>Welcome, <?= htmlspecialchars($user_name) ?>!</h1>
        <p class="dashboard-intro">
            In this dashboard, you can easily access all your tools and features, track your progress, and manage your account efficiently. Everything you need is just a click away.
        </p>
    </main>
</div>

<?php include '../footer.php'; ?>
