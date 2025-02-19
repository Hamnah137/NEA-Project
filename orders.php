<?php
session_start();
require('header.php'); // Include header

// Database connection
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .orders-container {
            width: 70%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .order-item {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-left: 5px solid #4CAF50;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-item p {
            margin: 5px 0;
            font-size: 1.1em;
            color: #555;
        }

        .order-id {
            font-weight: bold;
            color: #333;
        }

        .order-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #2196F3;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #1976D2;
        }

        .no-orders {
            font-size: 1.2em;
            color: #999;
            text-align: center;
        }

        .login-prompt {
            font-size: 1.2em;
            color: #f44336;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="orders-container">
        <h2>Your Orders</h2>

        <?php
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Prepare the SQL query
            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
            
            // Check if the statement was prepared correctly
            if ($stmt === false) {
                die('MySQL prepare error: ' . $conn->error); // If there was an error preparing the statement
            }

            $stmt->bind_param("i", $userId); // Bind the user_id parameter

            // Execute the statement
            if ($stmt->execute()) {
                $result = $stmt->get_result(); // Get the result set

                if ($result->num_rows > 0) {
                    // Output the orders
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="order-item">';
                        echo '<p><span class="order-id">Order ID:</span> ' . $row['order_id'] . '</p>';
                        echo '<p><span class="order-id">Total:</span> $' . $row['total'] . '</p>';
                        echo '<p><span class="order-id">Status:</span> ' . $row['status'] . '</p>';
                        echo '<p><span class="order-id">Order Date:</span> ' . $row['order_date'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-orders">You have no orders.</p>';
                }
            } else {
                // If query execution failed
                die('Execute error: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo '<p class="login-prompt">You must be logged in to view your orders.</p>';
        }
        ?>

        <div class="order-buttons">
            <a href="shop.php"><button class="btn btn-primary">Continue Shopping 🛒</button></a>
            <a href="index.php"><button class="btn btn-secondary">Go to Home 🏠</button></a>
        </div>
    </div>

</body>
</html>
