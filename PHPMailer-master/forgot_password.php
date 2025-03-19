<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../db.php');
date_default_timezone_set('Europe/London'); // Replace with your timezone

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Validate email is not empty
    if (!empty($email)) {
        // Prepare the SQL query to check if the email exists in the database
        $query = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }

        // Bind the email parameter to the query
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with the provided email exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];

            // Generate a unique reset token
            $token = bin2hex(openssl_random_pseudo_bytes(50)); // Random 50-byte token
            $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

            // Update the user's reset token and expiration time in the database
            $updateQuery = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateQuery);

            if ($updateStmt === false) {
                die('MySQL prepare error: ' . $conn->error);
            }

            // Bind the token, expiration, and user ID parameters to the query
            $updateStmt->bind_param('ssi', $token, $expiration, $user_id);
            $updateStmt->execute();

            // Send the email with the password reset link using PHPMailer
            $reset_link = "http://localhost/NEA%20Project/PHPMailer-master/reset_password.php?token=" . $token;

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();                               // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                 // Set the SMTP server to Gmail (or use your provider)
                $mail->SMTPAuth = true;                        // Enable SMTP authentication
                $mail->Username = '22129890@cambria.ac.uk';      // Your Gmail email address (use a test/dummy email here)
                $mail->Password = 'aipg jifj qajw hkzm';       // Your Gmail email password (or App Password if 2FA enabled)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587;                             // TCP port to connect to

                // Recipients
                $mail->setFrom('no-reply@yourdomain.com', 'Password Reset');  // Use a no-reply dummy email for sending
                $mail->addAddress($email);                     // Add the recipient's email (this can be a fake email for testing)

                // Content
                $mail->isHTML(true);                           // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = '<h1>Password Reset Request</h1>
                                  <p>Dear user,</p>
                                  <p>We received a request to reset your password. Click the link below to reset your password:</p>
                                  <p><a href="' . $reset_link . '">Reset Password</a></p>
                                  <p>If you did not request a password reset, please ignore this email.</p>
                                  <p>Best regards,<br>Your Company Name</p>';

                // Send the email
                $mail->send();
                echo '<div class="success">An email with the password reset link has been sent.</div>';
            } catch (Exception $e) {
                echo '<div class="error">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
            }
        } else {
            echo '<div class="error">No account found with that email address.</div>';
        }
    } else {
        echo '<div class="error">Please enter an email address.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-weight: 300;
      font-size: 14px;
      line-height: 1.6;
      color: #333;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      padding: 20px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    #forgot-password input {
      font: 400 14px/20px Arial, sans-serif;
      width: 100%;
      border: 1px solid #ccc;
      background: #fff;
      margin: 10px 0;
      padding: 10px;
      border-radius: 4px;
    }

    h1 {
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
    }

    #forgot-password {
      background: #fff;
      padding: 20px;
    }

    fieldset {
      border: none;
      margin: 0 0 10px;
      padding: 0;
      width: 100%;
    }

    button {
      cursor: pointer;
      width: 100%;
      border: none;
      background: #28a745;
      color: #fff;
      margin: 10px 0;
      padding: 10px;
      font-size: 16px;
      border-radius: 4px;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #218838;
    }

    .success {
      color: #28a745;
      text-align: center;
      margin-top: 20px;
    }

    .error {
      color: #dc3545;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <form id="forgot-password" action="forgot_password.php" method="post">
      <h1>Forgot Password</h1>

      <fieldset>
        <input placeholder="Enter your email address" name="email" type="email" tabindex="1" required>
      </fieldset>

      <fieldset>
        <button type="submit" name="submit" id="forgot-password-submit">Submit</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
