<?php
session_start();
require('db.php'); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: You must be logged in to submit a review.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $user_id = $_SESSION['user_id'];
    $rating = intval($_POST['rating']);
    $review = mysqli_real_escape_string($conn, $_POST['review']); // Use $conn here

    // Check if it's a product review (based on the presence of product_id)
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Insert product review into the database
        $query = "INSERT INTO product_reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query); // Use $conn here

        if ($stmt === false) {
            die("❌ Database Error: " . $conn->error); // Use $conn here
        }

        $stmt->bind_param("iiis", $product_id, $user_id, $rating, $review);

        if ($stmt->execute()) {
            // Redirect back to the product details page
            header("Location: product_details.php?product_id=" . $product_id);
            exit;
        } else {
            echo "❌ Error submitting product review: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // No product_id means it's a site review
        // Insert site review into the database
        $query = "INSERT INTO site_reviews (user_id, rating, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query); // Use $conn here

        if ($stmt === false) {
            die("❌ Database Error: " . $conn->error); // Use $conn here
        }

        $stmt->bind_param("iis", $user_id, $rating, $review);

        if ($stmt->execute()) {
            // Redirect back to the site review page (or wherever you want)
            header("Location: site_reviews.php");
            exit;
        } else {
            echo "❌ Error submitting site review: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close(); // Use $conn here
}
?>


