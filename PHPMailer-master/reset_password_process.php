<!-- Code to reset the password -->

<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../db.php'); // Adjust this path according to your project structure
date_default_timezone_set('Europe/London'); // Replace with your timezone

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && isset($_POST['new_password'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Validate token and new password are not empty
    if (!empty($token) && !empty($new_password)) {
        // Check the token in the database and validate expiration time
        $query = "SELECT * FROM users WHERE reset_token = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Check if the token has expired
            if (strtotime($user['reset_expires']) > time()) {
                // Token is valid, update the user's password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE user_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param('si', $hashed_password, $user['user_id']);
                $updateStmt->execute();

                echo '<div class="success">Your password has been reset successfully.</div>';
            } else {
                echo '<div class="error">This token has expired. Please request a new password reset.</div>';
            }
        } else {
            echo '<div class="error">Invalid token.</div>';
        }
    } else {
        echo '<div class="error">Please provide a valid token and new password.</div>';
    }
} else {
    echo '<div class="error">No token provided.</div>';
}
?>