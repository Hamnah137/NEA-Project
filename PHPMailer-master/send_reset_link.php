<!-- Code to send the link to email to reset passsword -->

<?php
// Include database connection
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Generate a unique token
        $token = bin2hex(random_bytes(50)); // Random 50-byte token
        $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

        // Update token and expiration in the database
        $updateQuery = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE user_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ssi', $token, $expiration, $user_id);
        $stmt->execute();

        // Send the email with the reset link
        $reset_link = "https://yourdomain.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: " . $reset_link;
        $headers = "From: no-reply@yourdomain.com";

        // Send the email
        if (mail($email, $subject, $message, $headers)) {
            echo "An email with the password reset link has been sent.";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        echo "Email not found in our system.";
    }
}
?>
