<?php 
session_start();
require('header.php'); // Include the header file
<div class="product-reviews">
    <h3>Customer Reviews</h3>
    ?>
    <?php
    // Fetch reviews for the product
    $product_id = $_GET['id']; // Get product ID
    $reviews = getReviewsForProduct($product_id); // Fetch reviews from the database

    if (empty($reviews)) {
        echo "<p>No reviews yet. Be the first to review!</p>";
    } else {
        foreach ($reviews as $review) {
            echo "<div class='review'>
                    <p><strong>{$review['user_name']}</strong></p>
                    <p>{$review['comment']}</p>
                    <p>Rating: {$review['rating']}/5</p>
                  </div>";
        }
    }
    ?>

    <?php if (isset($_SESSION['user_id'])) { ?>
        <form action="submit_review.php" method="POST">
            <label for="rating">Rating: </label>
            <select name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <textarea name="review" placeholder="Write your review here..." required></textarea>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
            <button type="submit">Submit Review</button>
        </form>
    <?php } else { ?>
        <p>You must be logged in to leave a review.</p>
    <?php } ?>
</div>
