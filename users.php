<!-- Code to see users registered in the website -->

<?php
// Include database connection file
include('db.php');

// Start the session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header("Location: login.php");
    exit();
}

// Fetch all orders from the orders table
$stmt = $pdo->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll();

// Fetch order details and calculate the total price for each order
$order_details = [];
foreach ($orders as $order) {
    // Get order items for the current order
    $stmt = $pdo->prepare("SELECT p.product_name, od.quantity, od.price, (od.quantity * od.price) AS total_price 
                           FROM orderdetails od 
                           JOIN products p ON od.product_id = p.product_id 
                           WHERE od.order_id = ?");
    $stmt->execute([$order['order_id']]);
    $order_details[$order['order_id']] = $stmt->fetchAll();

    // Calculate total price for the order
    $total_price = 0;
    foreach ($order_details[$order['order_id']] as $item) {
        $total_price += $item['total_price'];
    }
    $order_details[$order['order_id']]['total_price'] = $total_price;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .order-actions {
            display: flex;
            justify-content: space-between;
        }

        .view-button, .update-button {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .update-button {
            background-color: #ff9800;
        }

        .view-button:hover, .update-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Manage Orders</h1>
    
    <!-- Display orders -->
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td>$<?php echo number_format($order_details[$order['order_id']]['total_price'], 2); ?></td>
                    <td class="order-actions">
                        <a href="view_order_details.php?order_id=<?php echo $order['order_id']; ?>" class="view-button">View Details</a>
                        <a href="update_order_status.php?order_id=<?php echo $order['order_id']; ?>" class="update-button">Update Status</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
