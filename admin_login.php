<?php
session_start();
require('db.php');

// Check if the admin is already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: admin_dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if admin exists
    $query = "SELECT * FROM admins WHERE user_id = (SELECT user_id FROM Users WHERE username = '$username')";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    // Verify password
    if ($admin && password_verify($password, $admin['password'])) {
        // Set session variable to log in the admin
        $_SESSION['admin_id'] = $admin['admin_id'];
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo "<p>Invalid username or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<h1>Admin Login</h1>

<form method="POST" action="admin_login.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
