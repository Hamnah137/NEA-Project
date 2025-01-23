<?php
include 'db_connection.php';

$query = "SELECT users.username, rating, review, created_at FROM SiteReviews
          JOIN users ON SiteReviews.user_id = users.user_id";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<div class='review'>";
    echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
    echo "<span>Rating: " . htmlspecialchars($row['rating']) . "/5</span>";
    echo "<p>" . htmlspecialchars($row['review']) . "</p>";
    echo "<small>Posted on: " . htmlspecialchars($row['created_at']) . "</small>";
    echo "</div>";
}

$conn->close();
?>
