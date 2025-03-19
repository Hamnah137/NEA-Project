<!-- Code to register in the website -->

<?php
session_start();
require('header.php');
require('db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $confirm_email = mysqli_real_escape_string($conn, $_POST['confirm_email']);

    // Validate email and password match
    if ($email !== $confirm_email) {
        echo "<div class='alert alert-danger'>⚠️ Email addresses do not match.</div>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<div class='alert alert-danger'>⚠️ Passwords do not match.</div>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Hash the confirm password (although not needed to store, just for the process)
    $hashedConfirmPassword = password_hash($confirm_password, PASSWORD_DEFAULT);

    // Handle profile image upload
    $profileImage = null;
    if (isset($_FILES['profile_image'])) {
        $uploadError = $_FILES['profile_image']['error'];
        if ($uploadError === 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileTmpPath = $_FILES['profile_image']['tmp_name'];
            $fileName = $_FILES['profile_image']['name'];
            $fileType = $_FILES['profile_image']['type'];
            $fileSize = $_FILES['profile_image']['size'];

            // ✅ File size check (10MB limit)
            if ($fileSize <= 10 * 1024 * 1024) {
                if (in_array($fileType, $allowedTypes)) {
                    $uploadDir = 'images/'; // Ensure this is 'images/'
                    echo "Upload Directory: " . $uploadDir; // Debugging line
                    $filePath = uniqid() . '-' . basename($fileName);  // Store only the file name
                    echo "File Path: " . $filePath; // Debugging line
                    if (move_uploaded_file($fileTmpPath, $uploadDir . $filePath)) {
                        $profileImage = $filePath;
                    } else {
                        echo "<div class='alert alert-danger'>⚠️ Error uploading profile image.</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>⚠️ Only JPG, PNG, and GIF files are allowed.</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>⚠️ File size exceeds 10MB limit.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>⚠️ File upload error code: $uploadError.</div>";
        }
    }

    // Insert data into the database
    $query = "INSERT INTO users (name, username, password, email, confirm_email, confirm_password, profile_image) 
              VALUES ('$name','$username', '$hashedPassword', '$email', '$confirm_email', '$hashedConfirmPassword', '$profileImage')";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>✅ Registration successful! You can now <a href='login.php'>log in</a>.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - The Wardrobe Vault</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}
/* Footer Styling */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    margin-top: 40px;
}

footer p {
    font-size: 1em;
    margin: 0;
}
</style>
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
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_email">Confirm Email:</label>
                            <input type="email" name="confirm_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Upload Profile Image:</label>
                            <input type="file" name="profile_image" class="form-control-file" accept="image/*">
                            <small class="form-text text-muted">Max file size: 10MB.</small>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="container text-center mt-5">
    <p>&copy; 2024 The Wardrobe Vault. All rights reserved.</p>
</footer>

<!-- JavaScript to check file size before submitting the form -->
<script>
    document.querySelector("form").onsubmit = function(e) {
        var fileInput = document.querySelector('input[type="file"]');
        var file = fileInput.files[0];
        var maxSize = 6291456; // 6MB in bytes
        if (file && file.size > maxSize) {
            e.preventDefault();
            alert("File size exceeds the 6 MB limit. Please upload a smaller file.");
        }
    };
</script>

</body>
</html>
