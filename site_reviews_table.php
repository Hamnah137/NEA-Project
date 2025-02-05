<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "Error: You must be logged in to submit a review.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $rating = intval($_POST['rating']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $imagePath = NULL;

    // Handle image upload
    if (!empty($_FILES['review_image']['name'])) {
        $targetDir = "uploads/";
        $imageName = basename($_FILES['review_image']['name']);
        $targetFilePath = $targetDir . time() . "_" . $imageName;

        if (move_uploaded_file($_FILES['review_image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    // Insert into site_reviews table
    $query = "INSERT INTO site_reviews (user_id, rating, review, review_image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $user_id, $rating, $review, $imagePath);

    if ($stmt->execute()) {
        echo "✅ Review submitted successfully.";
    } else {
        echo "❌ Error submitting review: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
