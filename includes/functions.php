<?php
// ================================
// General Helper Functions
// ================================

/**
 * Sanitize input data
 *
 * @param string $data
 * @return string
 */
function cleanInput($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if a user is logged in
 *
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Redirect to a given URL
 *
 * @param string $url
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Generate a random token (e.g., for CSRF or password resets)
 *
 * @param int $length
 * @return string
 */
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * Flash message system
 */
function setFlash($type, $message) {
    if (!isset($_SESSION['flash'])) {
        $_SESSION['flash'] = [];
    }
    $_SESSION['flash'][$type] = $message;
}

function getFlash($type) {
    if (isset($_SESSION['flash'][$type])) {
        $msg = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $msg;
    }
    return null;
}

/**
 * Hash password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/* ================================
   CSRF Protection Functions
   ================================ */

/**
 * Generate or return CSRF token
 *
 * @return string
 */
function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = generateToken(32);
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF token
 *
 * @param string $token
 * @return bool
 */
function verifyCsrfToken($token) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        // Token is valid, optionally regenerate for next form
        $_SESSION['csrf_token'] = generateToken(32);
        return true;
    }
    return false;
}

/**
 * Generate hidden CSRF input for forms
 *
 * Usage: echo csrfInput();
 */
function csrfInput() {
    $token = csrfToken();
    return '<input type="hidden" name="csrf_token" value="'. $token .'">';
}


/**
 * Calculate profit margin and profit amount
 *
 * @param float $cost
 * @param float $selling_price
 * @return array
 */
function calculateProfitMargin($cost, $selling_price) {
    $profit = $selling_price - $cost;
    $margin = ($profit / $selling_price) * 100;
    return [
        'profit' => round($profit, 2),
        'margin' => round($margin, 2)
    ];
}

