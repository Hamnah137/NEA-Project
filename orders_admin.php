<!-- Code to show the order to admin that who did the order and when he did -->

<?php 
session_start();
require('db.php');

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit();
}

// Fetch orders along with product details
$order_query = $conn->query("
    SELECT orders.*, users.username, orderdetails.product_id, orderdetails.quantity, products.name AS product_name
    FROM orders 
    JOIN users ON orders.user_id = users.user_id
    JOIN orderdetails ON orders.order_id = orderdetails.order_id
    JOIN products ON orderdetails.product_id = products.product_id
    ORDER BY orders.order_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            width: 90%;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #FFD700;
        }

        a {
            color: #4ABDAC;
            text-decoration: none;
            font-size: 1.1em;
            display: inline-block;
            margin-bottom: 20px;
        }

        a:hover {
            color: #0078ff;
            text-decoration: underline;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            color: #fff;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #444;
        }

        table th {
            background-color: #333;
            color: #FFD700;
        }

        table td {
            background-color: #222;
        }

        table tr:hover {
            background-color: #444;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

    </style>
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
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $current_order_id = null;
            while ($order = $order_query->fetch_assoc()) {
                if ($current_order_id != $order['order_id']) {
                    if ($current_order_id != null) {
                        echo '</tr>';
                    }
                    $current_order_id = $order['order_id'];
                    echo '<tr>';
                    echo "<td>" . $order['order_id'] . "</td>";
                    echo "<td>" . htmlspecialchars($order['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($order['product_name']) . "</td>";
                    echo "<td>" . $order['quantity'] . "</td>";
                    echo "<td>$" . number_format($order['total'], 2) . "</td>";
                    echo "<td>" . $order['order_date'] . "</td>";
                } else {
                    echo '<tr>';
                    echo "<td></td><td></td>"; // Empty cells for consistency
                    echo "<td>" . htmlspecialchars($order['product_name']) . "</td>";
                    echo "<td>" . $order['quantity'] . "</td>";
                    echo "<td></td><td></td>"; // Empty cells for consistency
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
