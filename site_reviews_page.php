<?php
include('db.php'); 

$query = "SELECT users.username, users.profile_image, site_reviews.rating, site_reviews.comment, site_reviews.image_path, site_reviews.created_at 
          FROM site_reviews
          JOIN users ON site_reviews.user_id = users.user_id";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows == 0) {
    echo "<p>No reviews available yet.</p>";
}

while ($row = $result->fetch_assoc()) {
    echo "<div class='review'>";

    // Profile image
    if (!empty($row['profile_image'])) {
        echo "<img src='" . htmlspecialchars($row['profile_image']) . "' alt='User Image' width='50' height='50'>";
    } else {
        echo "<img src='default_profile.png' alt='Default User Image' width='50' height='50'>";
    }

    echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
    echo "<span>Rating: " . htmlspecialchars($row['rating']) . "/5</span>";
    echo "<p>" . htmlspecialchars($row['comment']) . "</p>";

    // Review image if available
    if (!empty($row['image_path'])) {
        echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Review Image' width='100' height='100'>";
    }

    echo "<small>Posted on: " . htmlspecialchars($row['created_at']) . "</small>";
    echo "</div><hr>";
}

$conn->close();
?>
