<?php
include('db.php'); // Include the database connection

$query = "SELECT users.username, users.profile_image, site_reviews.rating, site_reviews.comment, site_reviews.created_at 
          FROM site_reviews
          JOIN users ON site_reviews.user_id = users.user_id";  // Adjust query to fetch review details
$result = $conn->query($query); // Execute the query

if (!$result) {
    die("Query failed: " . $conn->error); // Display error if the query fails
}

if ($result->num_rows == 0) {
    echo "<p>No reviews available yet.</p>"; // If no reviews found
}

while ($row = $result->fetch_assoc()) {
    // Display each review inside a div
    echo "<div class='review'>";
    
    // Display the user's profile image
    if (!empty($row['profile_image'])) {
        echo "<img src='" . htmlspecialchars($row['profile_image']) . "' alt='User Image' width='50' height='50'>";
    } else {
        echo "<img src='default_profile.png' alt='Default User Image' width='50' height='50'>";
    }

    echo "<strong>" . htmlspecialchars($row['username']) . "</strong>"; // Display username
    echo "<span>Rating: " . htmlspecialchars($row['rating']) . "/5</span>"; // Display rating
    echo "<p>" . htmlspecialchars($row['comment']) . "</p>"; // Display comment

    echo "<small>Posted on: " . htmlspecialchars($row['created_at']) . "</small>"; // Display post date
    echo "</div>";
}

$conn->close(); // Close the connection
?>

