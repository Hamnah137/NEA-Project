<?php
session_start();
// Database connection
include 'db.php';

// Error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login-prompt">You must be logged in to view your reviews.</p>';
    exit();
}

// Get user info
$user_id = $_SESSION['user_id'];

// Fetch user's site reviews
$sql_site_reviews = "SELECT comment, created_at, rating FROM site_reviews WHERE user_id = ?";
$stmt_site_reviews = $conn->prepare($sql_site_reviews);

// Check if the query preparation was successful
if ($stmt_site_reviews === false) {
    die('MySQL prepare error: ' . $conn->error); // Print the error message if preparation failed
}

$stmt_site_reviews->bind_param("i", $user_id);
$stmt_site_reviews->execute();
$site_reviews = $stmt_site_reviews->get_result();

// Fetch user's product reviews
$sql_product_reviews = "SELECT products.name, product_reviews.comment, product_reviews.rating, product_reviews.created_at 
                        FROM product_reviews 
                        JOIN products ON product_reviews.product_id = products.product_id 
                        WHERE product_reviews.user_id = ?";
$stmt_product_reviews = $conn->prepare($sql_product_reviews);

// Check if the query preparation was successful
if ($stmt_product_reviews === false) {
    die('MySQL prepare error: ' . $conn->error); // Print the error message if preparation failed
}

$stmt_product_reviews->bind_param("i", $user_id);
$stmt_product_reviews->execute();
$product_reviews = $stmt_product_reviews->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reviews</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        /* General reset and body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
        }

        /* Header styling */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Footer styling */
        footer {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        /* Main content container */
        .reviews-container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Review items styling */
        .review-item {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fafafa;
            border-left: 5px solid #4CAF50;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .review-item p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #555;
        }

        .product-name, .review-title {
            font-weight: bold;
            color: #333;
        }

        .rating {
            font-size: 1.1em;
            color: #f39c12;
        }

        .no-reviews {
            font-size: 1.2em;
            color: #999;
        }

        .login-prompt {
            font-size: 1.2em;
            color: #f44336;
        }

        .review-item p span {
            font-weight: bold;
        }

        .review-item p {
            line-height: 1.6;
        }

        /* Mobile responsiveness */
        @media screen and (max-width: 768px) {
            .reviews-container {
                width: 95%;
            }

            h2 {
                font-size: 2em;
            }

            .review-item {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Your Reviews</h1>
    </header>

    <div class="reviews-container">
        <h2>Your Site Reviews</h2>

        <?php
        // Check if the user has any site reviews
        if ($site_reviews->num_rows > 0) {
            // Output the site reviews
            while ($row = $site_reviews->fetch_assoc()) {
                echo '<div class="review-item">';
                echo '<p><span class="review-title">Review: </span>' . $row['comment'] . '</p>';
                echo '<p><span class="review-title">Reviewed on: </span>' . $row['created_at'] . '</p>';
                
                // Display the rating if available
                if (isset($row['rating'])) {
                    echo '<p><span class="rating">Rating: </span>' . $row['rating'] . '⭐</p>';
                }
                
                echo '</div>';
            }
        } else {
            echo '<p class="no-reviews">You have not written any site reviews yet.</p>';
        }

        // Close the statement for site reviews
        $stmt_site_reviews->close();
        ?>

        <h2>Your Product Reviews</h2>

        <?php
        // Check if the user has any product reviews
        if ($product_reviews->num_rows > 0) {
            // Output the product reviews
            while ($row = $product_reviews->fetch_assoc()) {
                echo '<div class="review-item">';
                echo '<p><span class="product-name">Product: </span>' . $row['name'] . '</p>';
                echo '<p><span class="review-title">Review: </span>' . $row['comment'] . '</p>';
                echo '<p><span class="rating">Rating: </span>' . $row['rating'] . '⭐</p>';
                echo '<p><span class="review-title">Reviewed on: </span>' . $row['created_at'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p class="no-reviews">You have not written any product reviews yet.</p>';
        }

        // Close the statement for product reviews
        $stmt_product_reviews->close();
        ?>
    </div>

    <!-- Footer -->
<footer>
    <p>&copy; 2025 My Shopping Website. All rights reserved.</p>
</footer>

</body>
</html>
