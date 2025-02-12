<?php
require('db.php'); // Include the database connection

session_start();

// Check if product_id is passed in the URL
if (!isset($_GET['id'])) {
    echo "Product not found.";
    exit;
}

$product_id = intval($_GET['id']);

// Fetch product details
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error); // Output the error if the query fails
}

$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Product not found.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <p><?php echo htmlspecialchars($product['description']); ?></p>
    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>

    <h2>Submit a Product Review</h2>
    <form action="submit_review.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>
        <label for="review">Review:</label>
        <textarea name="review" required></textarea>
        <button type="submit">Submit Review</button>
    </form>

    <h3>Product Reviews</h3>
    <?php
    // Display product reviews with profile images
    $review_query = "SELECT users.username, users.profile_image, product_reviews.rating, product_reviews.comment 
                     FROM product_reviews 
                     JOIN users ON product_reviews.user_id = users.user_id 
                     WHERE product_reviews.product_id = ?";
    $review_stmt = $conn->prepare($review_query);
    if ($review_stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    $review_stmt->bind_param("i", $product_id);
    $review_stmt->execute();
    $review_result = $review_stmt->get_result();

    if ($review_result->num_rows > 0) {
        while ($review = $review_result->fetch_assoc()) {
            echo "<div class='review'>";
            if (!empty($review['profile_image'])) {
                echo "<img src='" . htmlspecialchars($review['profile_image']) . "' alt='Profile Image' width='50' height='50'>";
            }
            echo "<strong>" . htmlspecialchars($review['username']) . "</strong>";
            echo "<p>Rating: " . htmlspecialchars($review['rating']) . "/5</p>";
            echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }

    $review_stmt->close();
    ?>

    <h3>Site Reviews</h3>
    <?php
    // Display site reviews with profile images
    $site_review_query = "SELECT users.username, users.profile_image, site_reviews.rating, site_reviews.comment 
                          FROM site_reviews 
                          JOIN users ON site_reviews.user_id = users.user_id";
    $site_review_stmt = $conn->prepare($site_review_query);
    if ($site_review_stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }
    $site_review_stmt->execute();
    $site_review_result = $site_review_stmt->get_result();

    if ($site_review_result->num_rows > 0) {
        while ($review = $site_review_result->fetch_assoc()) {
            echo "<div class='review'>";
            if (!empty($review['profile_image'])) {
                echo "<img src='" . htmlspecialchars($review['profile_image']) . "' alt='Profile Image' width='50' height='50'>";
            }
            echo "<strong>" . htmlspecialchars($review['username']) . "</strong>";
            echo "<p>Rating: " . htmlspecialchars($review['rating']) . "/5</p>";
            echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }

    $site_review_stmt->close();
    ?>

</body>
</html>





