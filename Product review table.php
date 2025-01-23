<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $user_id = /* retrieve logged-in user ID here */;
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $query = "INSERT INTO ProductReviews (product_id, user_id, rating, review) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiis", $product_id, $user_id, $rating, $review);
    
    if ($stmt->execute()) {
        echo "Product review submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>