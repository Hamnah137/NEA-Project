<?php
session_start(); // Start session to store cart data

// Check if all required parameters are passed
if (isset($_GET['product_id'], $_GET['product_name'], $_GET['product_price'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $product_price = $_GET['product_price'];

    // Check if the cart exists in the session, if not, initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to the cart
    $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => isset($_SESSION['cart'][$product_id]) ? $_SESSION['cart'][$product_id]['quantity'] + 1 : 1
    ];

    // Redirect to a page to show the cart (e.g., cart.php)
    header("Location: cart.php");
    exit;
} else {
    echo "Invalid request. Please ensure all product details are provided.";
    exit;
}