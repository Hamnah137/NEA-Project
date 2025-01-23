<?php
session_start();
require('db.php');

if (!isset($_SESSION['username'])) {
    echo "You must log in to place an order.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save order details to the database
    $username = $_SESSION['username'];
    $items = json_encode($_SESSION['cart']); // Store cart as JSON
    $total = array_sum(array_column($_SESSION['cart'], 'price'));

    $query = "INSERT INTO orders (username, items, total) VALUES ('$username', '$items', '$total')";
    if (mysqli_query($conn, $query)) {
        // Send confirmation email
        $to = $_SESSION['email']; // Assuming email is stored in session during login
        $subject = "Order Confirmation";
        $message = "Thank you for your order! Total: \$$total";
        mail($to, $subject, $message);

        echo "Order placed successfully!";
        unset($_SESSION['cart']); // Clear cart
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<h3>Checkout</h3>
<p>Total: $<?= array_sum(array_column($_SESSION['cart'], 'price')) ?></p>
<form method="POST">
    <button type="submit">Place Order</button>
</form>
