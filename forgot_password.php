<?php
session_start();
require('db.php');
include 'email_functions.php'; // Include the email logging function

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        // Generate a fake password reset token
        $reset_token = bin2hex(random_bytes(16)); 
        $reset_link = "https://yourwebsite.com/reset-password.php?token=$reset_token";

        // Email details
        $to = $email;
        $subject = "Password Reset Request";
        $message = "Dear User,\n\nClick the link below to reset your password:\n$reset_link\n\nIf you didn't request this, please ignore this email.\n\nBest Regards,\nYour Website Team";

        // Log the email
        sendFakeEmail($to, $subject, $message);

        echo "Password reset email simulated! Check `email_log.txt`.";
    } else {
        echo "Please enter a valid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
