<?php
session_start();
require('header.php'); // Include header here

include 'db.php'; // Database connection

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: shop.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $totalPrice = 0;

    if ($userId) {
        // Insert order without address
        $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date) VALUES (?, NOW())");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $orderId = $stmt->insert_id;

            // Insert order items
            foreach ($_SESSION['cart'] as $productId => $product) {
                $quantity = $product['quantity'];
                $price = $product['price'];
                $totalPrice += ($price * $quantity);

                $stmtItem = $conn->prepare("INSERT INTO orderdetails (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmtItem->bind_param("iiid", $orderId, $productId, $quantity, $price);
                $stmtItem->execute();
            }

            // Clear cart after order
            unset($_SESSION['cart']);

            // Redirect to order success page
            header("Location: order_success.php?order_id=" . $orderId);
            exit;
        } else {
            echo '<p>Error placing order. Please try again.</p>';
        }
    } else {
        echo '<p>Please ensure you are logged in to place an order.</p>';
    }
}
?>

<h2>Checkout</h2>
<form method="POST">
    <button type="submit">Place Order</button>
</form>
<a href="cart.php"><button>Back to Cart</button></a>
