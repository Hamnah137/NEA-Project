<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = /* retrieve logged-in user ID here */;
    $rating = $_POST['rating'];
    $review = mysqli_real_escape_string($conn, $_POST['review']); // Sanitizing the review input

    $query = "INSERT INTO SiteReviews (user_id, rating, review) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $user_id, $rating, $review);

    if ($stmt->execute()) {
        echo "Site review submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
