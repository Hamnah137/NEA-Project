<?php
session_start();
require('header.php'); // Include the header file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    <?php
    // Check if cart is empty
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        echo "<p>Your cart is empty!</p>";
        echo "<a href='index.php'>Back to Shop</a>";
        exit();
    }

    // Display cart items
    echo "<table border='1'>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>";

    foreach ($_SESSION['cart'] as $index => $item) {
        echo "<tr>
            <td>{$item['name']}</td>
            <td>\${$item['price']}</td>
            <td><a href='remove_item.php?index=$index'>Remove</a></td>
        </tr>";
    }

    echo "</table>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
    ?>
</body>
</html>
