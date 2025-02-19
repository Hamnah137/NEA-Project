<?php
session_start();

// Check if the cart is set
if (isset($_SESSION['cart'])) {
    // Check if the item ID exists in the cart
    if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
        // Remove the item from the cart using its ID
        unset($_SESSION['cart'][$_GET['id']]);
    }
}

// Redirect back to the cart page
header('Location: cart.php');
exit();
?>

