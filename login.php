<?php
include 'header.php';
session_start();
require('db.php');

// If the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // User's entered password

    // Fetch the user from the database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);

    // If the username exists, verify the password
    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Check if the entered password matches the hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct, create session for the user
            $_SESSION['username'] = $row['username'];  // Store the username
            $_SESSION['user_id'] = $row['user_id'];    // Store the user_id
            header('Location: index.php'); // Redirect to home or another page
            exit;
        } else {
            $fmsg = "Invalid Login Credentials."; // Incorrect password
        }
    } else {
        $fmsg = "Invalid Login Credentials."; // User not found
    }
}

// If the user is logged in, greet them
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hi " . $username . "! You are now logged in.";
    echo "<br><a href='index.php'> Home</a><a href='dashboard.php'> Dashboard</a><a href='logout.php'> Logout</a>";
} else {
    // Display login form if not logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your Website</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJr+pqxF6bRt6l0dX9jjpKmjnu9lccjGGXpG9F/YoOXl2GKm9zHg2DdAcKh0" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding-top: 50px;
        }
        .form-signin-heading {
            margin-bottom: 20px;
            text-align: center;
        }
        .btn {
            font-size: 16px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <form class="form-signin" method="POST">
        <?php if (isset($fmsg)) { ?>
            <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div>
        <?php } ?>
        
        <h2 class="form-signin-heading">Please Login</h2>
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
        </div>

        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Enter Password" required>
        </div>

        <button class="btn btn-lg btn-primary btn-block w-100" type="submit">Login</button>
        <a class="btn btn-lg btn-outline-secondary btn-block w-100 mt-3" href="register.php">Register</a>
    </form>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybF+G12bXzQikC3S2b7eGTkwA1P6JXf6UMuZrEw6a1VqW9Hif" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0k8Fc5wmXytJvX6BtbAT0FuP2ftM8xt6bx6l6Erfmy8Zb+5G" crossorigin="anonymous"></script>

</body>
</html>
<?php } ?>
