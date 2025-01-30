<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Full-Screen Background Video -->
    <div class="video-container">
        <video class="background-video" autoplay loop muted>
            <source src="3505912471-preview.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="orders.php">Orders</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>You are now logged in.</p>
    </div>

</body>
</html>

