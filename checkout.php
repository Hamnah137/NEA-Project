<?php
session_start();
require('header.php'); // Include header here

include 'db.php'; // Database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Ensure errors are displayed
ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log');  // Log errors for further analysis

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Cart is empty or not properly initialized.";
    exit;  // Stop if cart is empty or not properly initialized
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in. Please log in first.";
    exit; // Exit if user is not logged in
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // User ID from session
    $totalPrice = 0; // Calculate total price from cart

    // Calculate total price from cart
    foreach ($_SESSION['cart'] as $productId => $product) {
        $quantity = $product['quantity'];
        $price = $product['price'];
        $totalPrice += ($price * $quantity);
    }

    // Check if totalPrice is a valid number
    if ($totalPrice <= 0) {
        echo "Error: Total price is invalid.";
        exit; // Terminate if total price is invalid
    }

    // Insert order with total price
    $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, total, status) VALUES (?, NOW(), ?, 'pending')");
    if ($stmt === false) {
        die('Error preparing order query: ' . $conn->error); // Immediate termination if error occurs
    }

    $stmt->bind_param("id", $userId, $totalPrice); // Binding user_id and total price (assuming total is a float)

    // Check if query is executed
    if (!$stmt->execute()) {
        echo "Error placing order: " . $stmt->error; // Display query error if execution fails
        exit; // Terminate if there's an error with the order insertion
    }
    $orderId = $stmt->insert_id; // Get inserted order ID

    // Insert order items
    foreach ($_SESSION['cart'] as $productId => $product) {
        $quantity = $product['quantity'];
        $price = $product['price'];

        $stmtItem = $conn->prepare("INSERT INTO orderdetails (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        if ($stmtItem === false) {
            die('Error preparing order item query: ' . $conn->error);
        }

        $stmtItem->bind_param("iiid", $orderId, $productId, $quantity, $price);

        // Check if query is executed for order item insertion
        if (!$stmtItem->execute()) {
            echo "Error inserting order items: " . $stmtItem->error;
            exit; // Terminate if there's an error with item insertion
        }
    }

    // Clear cart after order
    unset($_SESSION['cart']);

    // Redirect to order success page
    header("Location: order_success.php?order_id=" . $orderId);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        .cart-summary {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #555;
        }

        .cart-total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }

        .checkout-form {
            text-align: center;
        }

        .btn {
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #bbb;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>

        <div class="cart-summary">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalAmount = 0;
                    foreach ($_SESSION['cart'] as $productId => $product):
                        $totalAmount += $product['price'] * $product['quantity'];
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td><?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">
                <p>Total Amount: <?php echo number_format($totalAmount, 2); ?></p>
            </div>
        </div>

        <form method="POST" class="checkout-form">
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>

        <div class="back-link">
            <a href="cart.php"><button class="btn btn-secondary">Back to Cart</button></a>
        </div>
    </div>
</body>
</html>
