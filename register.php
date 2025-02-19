<?php
session_start();
require('header.php');
require('db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Handle profile image upload
    $profileImage = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileType = $_FILES['profile_image']['type'];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = 'uploads/profile_images/';
            $profileImage = $uploadDir . basename($fileName);
            if (move_uploaded_file($fileTmpPath, $profileImage)) {
                // Image uploaded successfully
            } else {
                echo "Error uploading profile image.";
            }
        } else {
            echo "Only JPG, PNG, and GIF files are allowed.";
        }
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $query = "INSERT INTO users (username, password, email, profile_image) 
              VALUES ('$username', '$hashedPassword', '$email', '$profileImage')";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Registration successful! You can now log in.</div>";
        // Redirect to login page or set session variables
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - My Shopping Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Custom styles -->
</head>
<body>

<!-- Registration Form -->
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Upload Profile Image:</label>
                            <input type="file" name="profile_image" class="form-control-file" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="container text-center mt-5">
    <p>&copy; 2024 My Shopping Website. All rights reserved.</p>
</footer>

</body>
</html>

