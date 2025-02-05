<?php
session_start();  // Start session to track the user

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect them to login page
    header("Location: login.php");
    exit();
}

include 'db.php';  // Include the database connection

// Get the product_id from the form submission
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    // If product_id is missing, redirect or show an error
    echo "Error: Product ID is missing!";
    exit();
}

// Get the user id from session
$username = $_SESSION['username'];
$query = "SELECT user_id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
if ($result && $row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
} else {
    // If user doesn't exist in the database, redirect to login
    header("Location: login.php");
    exit();
}

// Get review details from form
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$created_at = date('Y-m-d H:i:s');

// Handle the optional review image upload
$review_image = null;
if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["review_image"]["name"]);
    
    // Check if the file is an image
    if (getimagesize($_FILES["review_image"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["review_image"]["tmp_name"], $target_file)) {
            $review_image = $target_file;  // Store file path
        }
    }
}

// Insert review into the product_reviews table
$query = "INSERT INTO product_reviews (product_id, user_id, rating, comment, review_image, created_at) 
          VALUES ('$product_id', '$user_id', '$rating', '$comment', '$review_image', '$created_at')";

if (mysqli_query($conn, $query)) {
    echo "<p>Review submitted successfully!</p>";
} else {
    echo "<p>Error submitting review: " . mysqli_error($conn) . "</p>";
}

// Close the database connection
mysqli_close($conn);

// Redirect the user to the product page or product reviews page after submitting
header("Location: product_reviews_page.php?product_id=$product_id");
exit();
?>
