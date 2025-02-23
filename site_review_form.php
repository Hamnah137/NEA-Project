<?php  
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>log in</a> to leave a review.</p>";
} else {
?>
    <form action="site_reviews_table.php" method="POST" enctype="multipart/form-data">
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>
        
        <label for="review">Review:</label>
        <textarea name="review" required></textarea> <!-- This name should match the PHP code -->

        <label for="review_image">Upload Image (Optional):</label>
        <input type="file" name="review_image" accept="image/*">

        <button type="submit">Submit Site Review</button>
    </form>
<?php
}
?>
