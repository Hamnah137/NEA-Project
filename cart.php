<?php
session_start();
require('header.php'); // Include the header file

echo '<h1>Your Cart</h1>';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $product) {
        echo '<p>';
        echo '<strong>'.$product['name'].'</strong><br>';
        echo 'Price: $'.$product['price'].'<br>';
        echo 'Quantity: '.$product['quantity'];
        echo '</p>';
    }
} else {
    echo '<p>Your cart is empty.</p>';
}
?>
