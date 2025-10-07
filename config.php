<?php

// config.php

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/', // 🔥 ensures session works across all folders
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// ================================
// Site Constants
// ================================
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('SITE_NAME', 'BuzniCalc');

// ================================
// PDO Database Connection
// ================================
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch assoc arrays
            PDO::ATTR_EMULATE_PREPARES => false, // Use native prepared statements
        ]
    );
} catch (PDOException $e) {
    // Log error and show generic message
    error_log("Database Connection Error: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}

?>