<!-- Code to login -->

<?php
session_start();
require('db.php');
include 'header.php';

// Handle Login Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        // Query to get user from the Users table
        $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id'];

                // Check if the user is an admin
                $stmt_admin = $conn->prepare("SELECT admin_id FROM admins WHERE user_id = ?");
                $stmt_admin->bind_param("i", $user['user_id']);
                $stmt_admin->execute();
                $admin_result = $stmt_admin->get_result();

                if ($admin_result->num_rows === 1) {
                    // User is an admin
                    $admin = $admin_result->fetch_assoc();
                    $_SESSION['admin_id'] = $admin['admin_id']; // Store admin_id session
                    $_SESSION['is_admin'] = true;
                    header('Location: admin_dashboard.php');  // Redirect to admin dashboard
                } else {
                    // Regular user
                    $_SESSION['is_admin'] = false;
                    header('Location: index.php');  // Redirect to user homepage
                }
                exit;
            } else {
                $loginError = "Incorrect username or password.";
            }
        } else {
            $loginError = "Incorrect username or password.";
        }
        $stmt->close();
    } else {
        $loginError = "All fields are required.";
    }
}
?>

<div class="container mt-5 pt-5">
    <?php if (isset($_SESSION['username'])): ?>
        <div class="text-center">
            <h2 class="mb-4">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                <a href="admin_dashboard.php" class="btn btn-success me-2">Admin Dashboard</a>
            <?php else: ?>
                <a href="dashboard.php" class="btn btn-success me-2">User Dashboard</a>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    <?php else: ?>
        <div class="card shadow-sm p-4 border-0 rounded-3">
            <h3 class="text-center mb-4">Login to Your Account</h3>
            <?php if (!empty($loginError)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($loginError); ?>
                </div>
            <?php endif; ?>
            <form method="POST" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="text-center mt-3">
                <a href="PHPMailer-master/forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                </div>
                <div class="text-center mt-3">
                    <a href="register.php" class="text-decoration-none">Don't have an account? Register here</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<style>
    body { padding-top: 80px; background-color: #f8f9fa; }
    .card { max-width: 420px; margin: 0 auto; }
    body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}

</style>
