<?php
require 'config.php';
require 'includes/functions.php';

if (!isLoggedIn()) {
    redirect('../login.php');
}

$result = null;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cost = floatval($_POST['cost'] ?? 0);
    $selling_price = floatval($_POST['selling_price'] ?? 0);

    if ($cost > 0 && $selling_price > 0) {
        $result = calculateProfitMargin($cost, $selling_price);
    } else {
        $error = "Please enter valid numbers greater than 0.";
    }
}
?>

<?php include 'header.php'; ?>

<div class="auth-container">
    <h2>Profit Margin Calculator</h2>

    <?php if(!empty($error)) : ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if(!empty($result)) : ?>
        <div class="success">
            Profit: $<?= $result['profit'] ?><br>
            Margin: <?= $result['margin'] ?>%
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="number" step="0.01" name="cost" placeholder="Cost Price" required value="<?= htmlspecialchars($_POST['cost'] ?? '') ?>">
        <input type="number" step="0.01" name="selling_price" placeholder="Selling Price" required value="<?= htmlspecialchars($_POST['selling_price'] ?? '') ?>">
        <button type="submit">Calculate</button>
    </form>
</div>

<div class="tool-description">
    <p>
        The Profit Margin Calculator helps you quickly determine how much profit you make on each product or service. 
        Enter your cost and selling price to get instant results for your total profit and profit margin percentage.
        It is perfect for entrepreneurs, small business owners, and eCommerce sellers.
    </p>
</div>

<?php include 'footer.php'; ?>
