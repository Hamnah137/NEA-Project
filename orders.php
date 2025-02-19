<?php
session_start();
require('header.php'); // Include header

// Database connection
include 'db.php';

echo '<h2>Your Orders</h2>';

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
                echo '<p>';
                echo 'Order ID: ' . $row['order_id'] . '<br>';
                echo 'Total: $' . $row['total'] . '<br>';
                echo 'Status: ' . $row['status'] . '<br>';
                echo 'Order Date: ' . $row['order_date'] . '<br>';
                echo '</p>';
            }
        } else {
            echo '<p>You have no orders.</p>';
        }
    } else {
        // If query execution failed
        die('Execute error: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    echo '<p>You must be logged in to view your orders.</p>';
}
?>

