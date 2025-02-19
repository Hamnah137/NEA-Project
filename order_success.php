<?php
session_start();
require('header.php'); // Include header here

$orderId = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if (!$orderId) {
    header('Location: shop.php');
    exit;
}
?>

<h2>🎉 Thank You for Your Purchase! 🎉</h2>
<p>Your order number <strong>#<?php echo htmlspecialchars($orderId); ?></strong> has been placed successfully. 💖</p>
<p>We've sent you a confirmation email with your order details. 📩</p>
<p>🛍️ Sit back and relax while we prepare your items for delivery!</p>
<a href="shop.php"><button>Continue Shopping 🛒</button></a>
<a href="orders.php"><button>View My Orders 📦</button></a>
