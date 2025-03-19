<!-- Code for the process of submitting product review -->

<?php
session_start(); // Ensure session is started
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>log in</a> to leave a review.</p>";
} else {
?>
    <form action="submit_review.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo isset($_GET['product_id']) ? htmlspecialchars($_GET['product_id']) : ''; ?>">
        
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>
        
        <label for="review">Review:</label>
        <textarea name="review" required></textarea>
        
        <label for="review_image">Upload an image:</label>
        <input type="file" name="review_image" accept="image/*">
        
        <button type="submit">Submit Product Review</button>
    </form>
<?php
}
?>

