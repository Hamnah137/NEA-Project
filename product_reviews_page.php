<?php
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>log in</a> to leave a review.</p>";
} else {
    // If the user is logged in, display the review form
    ?>
    <form action="submit_review.php" method="POST" enctype="multipart/form-data">
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label for="review">Review:</label>
        <textarea name="review" required></textarea>

        <label for="review_image">Upload an image (optional):</label>
        <input type="file" name="review_image" accept="image/*">

        <button type="submit">Submit Product Review</button>
    </form>
<?php
    // Now fetch and display the product reviews
    $query = "SELECT users.username, users.profile_image, product_reviews.rating, product_reviews.comment, product_reviews.created_at
              FROM product_reviews
              JOIN users ON product_reviews.user_id = users.user_id";

    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        echo "<p>No product reviews available yet.</p>";
    } else {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review'>";
            if (!empty($row['profile_image'])) {
                echo "<img src='" . htmlspecialchars($row['profile_image']) . "' alt='User Image' width='50' height='50'>";
            } else {
                echo "<img src='default_profile.png' alt='Default User Image' width='50' height='50'>";
            }
            echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
            echo "<span>Rating: " . htmlspecialchars($row['rating']) . "/5</span>";
            echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
            echo "<small>Posted on: " . htmlspecialchars($row['created_at']) . "</small>";
            echo "</div>";
        }
    }
}
$conn->close();
?>

