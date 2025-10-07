<?php
require 'config.php';
require 'includes/functions.php';

// Only proceed if user is logged in
if (isLoggedIn()) {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }

    // Regenerate a new session ID for safety
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    session_regenerate_id(true);
}

// Redirect to login page
redirect('login.php');
