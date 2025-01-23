<?php
include 'db_connection.php';
$product_id = /* the current product ID */;

$query = "SELECT users.username, rating, review, created_at FROM ProductReviews
          JOIN users ON ProductReviews.user_id = users.user_id
          WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='review'>";
    echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
    echo "<span>Rating: " . htmlspecialchars($row['rating']) . "/5</span>";
    echo "<p>" . htmlspecialchars($row['review']) . "</p>";
    echo "<small>Posted on: " . htmlspecialchars($row['created_at']) . "</small>";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>
