<?php
// Include database connection
include('../db.php');
date_default_timezone_set('Europe/London'); // Replace with your timezone

// Check if the token is provided in the URL
if (!isset($_GET['token'])) {
    die('No token provided.');
}

$token = $_GET['token'];

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
        // Token is valid, show reset password form
        echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Reset Password</title>
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

                  form input {
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

                  form {
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

                  .error {
                    color: #dc3545;
                    text-align: center;
                    margin-top: 20px;
                  }
                </style>
              </head>
              <body>
                <div class="container">
                  <form method="POST" action="reset_password_process.php">
                    <h1>Reset Password</h1>
                    <input type="hidden" name="token" value="' . htmlspecialchars($token) . '" />
                    <input type="password" name="new_password" placeholder="Enter New Password" required />
                    <button type="submit">Reset Password</button>
                  </form>
                </div>
              </body>
              </html>';
    } else {
        echo '<div class="error">This token has expired. Please request a new password reset.</div>';
    }
} else {
    echo '<div class="error">Invalid token.</div>';
}
?>
