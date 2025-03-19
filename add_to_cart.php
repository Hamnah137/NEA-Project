<!-- The code for the product to add to the cart -->
 
<?php
session_start(); // Start session to store cart data

// Check if all required parameters are passed, either via GET or POST
if (isset($_GET['product_id'], $_GET['product_name'], $_GET['product_price'])) {
    // Handle GET request (used for home page)
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $product_price = $_GET['product_price'];
    $product_image = $_GET['product_image']; // Add product image
} elseif (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    // Handle POST request (used for shop page)
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; // Add product image
} else {
    echo "Invalid request. Please ensure all product details are provided.";
    exit;
}

// Check if the cart exists in the session, if not, initialize it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to the cart
if (isset($_SESSION['cart'][$product_id])) {
    // If the product already exists in the cart, increase the quantity
    $_SESSION['cart'][$product_id]['quantity']++;
} else {
    // Otherwise, add the new product to the cart
    $_SESSION['cart'][$product_id] = [
        'image' => $product_image, // Store the image URL
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];
}

// Redirect to the cart page
header("Location: cart.php");
exit;
