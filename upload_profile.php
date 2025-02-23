<?php
session_start();
require('db.php');

// Assuming user is logged in and user ID is stored in session
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "You must be logged in to upload a profile picture.";
    exit;
}

// Check if the form is submitted and file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    // Set the directory to store the uploaded images
    $upload_dir = 'images/'; // Folder for profile images
    $file_name = $_FILES['profile_pic']['name'];
    $file_tmp = $_FILES['profile_pic']['tmp_name'];
    $file_type = $_FILES['profile_pic']['type'];

    // Create a unique file name to avoid overwriting existing files
    $unique_name = uniqid() . '-' . basename($file_name);

    // Move the uploaded file to the 'images/' directory
    if (move_uploaded_file($file_tmp, $upload_dir . $unique_name)) {
        // File path to save in the database
        $file_path = $upload_dir . $unique_name;

        // Prepare the SQL query to update the profile picture in the database
        $query = "UPDATE users SET profile_image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $file_path, $user_id); // Bind the parameters
        
        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            echo "Profile picture uploaded successfully!";
        } else {
            echo "Error updating profile picture in database.";
        }
    } else {
        echo "Error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
</head>
<body>

<!-- Profile Picture Upload Form -->
<div class="container" style="margin-top: 100px;">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profile_pic">Upload New Profile Picture:</label>
            <input type="file" name="profile_pic" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

</body>
</html>
