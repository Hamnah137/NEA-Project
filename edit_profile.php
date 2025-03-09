<?php
session_start();
include('header.php');
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user info
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];  // New name field
    
    // Handle profile picture upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = $_FILES['profile_image'];
        $image_name = time() . '_' . basename($profile_image['name']);
        $image_tmp = $profile_image['tmp_name'];
        $image_path = 'images/' . $image_name;

        // Move the uploaded file to the 'images' directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Update the database with the new profile image
            $update_image_sql = "UPDATE Users SET profile_image = ? WHERE user_id = ?";
            $update_image_stmt = $conn->prepare($update_image_sql);
            $update_image_stmt->bind_param("si", $image_name, $user_id);
            $update_image_stmt->execute();
        } else {
            echo "Error uploading image.";
        }
    }

    // Update username, email, and name in the database
    $update_sql = "UPDATE Users SET username = ?, email = ?, name = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $username, $email, $name, $user_id);
    if ($update_stmt->execute()) {
        echo "<p class='message success'>Profile successfully updated!</p>";
    } else {
        echo "<p class='message error'>Error updating profile!</p>";
    }
}
?>

<style>
    /* General Body Styles */
    body {
        font-family: 'Times New Roman', sans-serif;
            background-color: #f8f9fa;
            margin: 40px;
            padding: 40px;
    }

    h1 {
        text-align: center;
        font-size: 2.5em;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        background-color: #fff;
        padding: 40px;
        max-width: 500px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    label {
        font-size: 1.1em;
        color: #555;
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
        width: 100%;
        padding: 12px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        box-sizing: border-box;
        background-color: #f7f7f7;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
        border-color: #3498db;
        background-color: #fff;
    }

    button {
        background-color: #4CAF50;
        color: #fff;
        padding: 14px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
    }

    .message {
        text-align: center;
        margin-top: 20px;
        font-size: 1.1em;
    }

    .message.success {
        color: #4CAF50;
    }

    .message.error {
        color: #f44336;
    }

    /* Profile image preview */
    .profile-image-preview {
        margin-top: 40px;
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 30px;
    }

    header {
        margin: 0;
        padding: 0;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>

<!-- Display the current profile image at the top -->
<div class="profile-image-container">
    <?php if (!empty($user['profile_image'])): ?>
        <img src="images/<?php echo $user['profile_image']; ?>" alt="Profile Image" class="profile-image-preview" id="profile_image_preview">
    <?php endif; ?>
</div>

<h1>Edit Your Profile</h1>

<div class="form-container">
    <form action="edit_profile.php" method="post" enctype="multipart/form-data">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required><br><br>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required><br><br>

        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" onchange="showImagePreview()"><br><br>

        <button type="submit">Update Profile</button>
    </form>
</div>

<script>
// Show the image preview when a new file is selected
function showImagePreview() {
    const fileInput = document.getElementById('profile_image');
    const preview = document.getElementById('profile_image_preview');
    
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function (e) {
            preview.src = e.target.result; // Set the preview image source
        };
        
        reader.readAsDataURL(fileInput.files[0]); // Read the selected file
    }
}
</script>

</body>
</html>
