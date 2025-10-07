<?php
require 'header.php'; 

try {
    // SQL to create the users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);
    
    echo "<div class='setup'>";
    echo "<h2><i class='fa-solid fa-check'></i> Users table created successfully!</h2>";
    echo "<p>Delete this file (install.php) immediately for security reasons.</p>";
    echo "</div>";
} catch (PDOException $e) {
    echo "<h2> Error creating table:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}


require 'footer.php'; 

?>
