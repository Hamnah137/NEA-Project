<?php 
session_start();
require('db.php');

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit();
}

// Fetch orders
$order_query = $conn->query("SELECT orders.*, users.username FROM orders JOIN users ON orders.user_id = users.user_id ORDER BY orders.order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Manage Orders</h1>
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Total</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $order_query->fetch_assoc()) { ?>
                <tr>
                    <td><?= $order['order_id']; ?></td>
                    <td><?= htmlspecialchars($order['username']); ?></td>
                    <td>$<?= number_format($order['total'], 2); ?></td>
                    <td><?= $order['order_date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
