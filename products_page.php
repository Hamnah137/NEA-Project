<?php
session_start();
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    $product_id = $_POST['product_id'];
    $review = $_POST['review'];
    $username = $_SESSION['username'];

    $query = "INSERT INTO reviews (product_id, username, review) VALUES ('$product_id', '$username', '$review')";
    mysqli_query($conn, $query);
}
?>
<form method="POST">
    <input type="hidden" name="product_id" value="1"> <!-- Dynamic product ID -->
    <textarea name="review" placeholder="Write your review here..."></textarea>
    <button type="submit">Submit Review</button>
</form>
