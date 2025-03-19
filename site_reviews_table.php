<!-- Code for the process of submitting site review -->

<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['user_id'])) {
        echo "Error: You must be logged in to submit a review.";
        exit;
    }

    // Check if the comment field exists
    if (!isset($_POST['comment']) || empty($_POST['comment'])) {
        echo "❌ Error: Review cannot be empty.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $rating = intval($_POST['rating']);
    $review = mysqli_real_escape_string($conn, $_POST['comment']);
    $imagePath = NULL;

    // Handle image upload
    if (!empty($_FILES['review_image']['name'])) {
        $targetDir = "uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
        }

        $imageName = basename($_FILES['review_image']['name']);
        $targetFilePath = $targetDir . time() . "_" . $imageName;

        if (move_uploaded_file($_FILES['review_image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        } else {
            echo "❌ Error uploading image.";
            exit;
        }
    }

    // Insert into site_reviews table
    $query = "INSERT INTO site_reviews (user_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("❌ Database Error: " . $conn->error);
    }

    $stmt->bind_param("iis", $user_id, $rating, $review);

    if ($stmt->execute()) {
        echo "✅ Review submitted successfully.";
    } else {
        echo "❌ Error submitting review: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
