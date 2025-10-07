<?php
require_once 'includes/functions.php';
require 'config.php';

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzniCalc - Business Online Calculators</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- ===============================
     Header Navigation
=============================== -->

<header>
  <div class="nav-container">
    <div class="logo">
      <a href="/index.php">BuzniCalc</a>
    </div>

    <nav class="nav-links" id="navMenu">
      <?php if (isLoggedIn()) : ?>
          <!-- User is logged in -->
          <a href="/users/dashboard.php">Dashboard</a>
          <a href="/logout.php">Logout</a>
      <?php else : ?>
          <!-- User is not logged in -->
          <a href="/login.php">Login</a>
          <a href="/register.php">Register</a>
      <?php endif; ?>
    </nav>

    <div class="menu-toggle" id="menuToggle">
      ☰
    </div>
  </div>
</header>

<main>
