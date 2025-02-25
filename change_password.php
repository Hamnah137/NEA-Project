<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user info
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if current password matches the one in the database
    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            // Update the password in the database
            $update_sql = "UPDATE Users SET password = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            if ($update_stmt->execute()) {
                echo "<p class='message success'>Password successfully updated!</p>";
            } else {
                echo "<p class='message error'>Error updating password!</p>";
            }
        } else {
            echo "<p class='message error'>New passwords do not match!</p>";
        }
    } else {
        echo "<p class='message error'>Current password is incorrect!</p>";
    }
}
?>

<style>
    /* General Body Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h1 {
        text-align: center;
        font-size: 2.5em;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        background-color: #fff;
        padding: 40px;
        max-width: 500px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-size: 1.1em;
        color: #555;
        display: block;
        margin-bottom: 10px;
    }

    input[type="password"] {
        width: 100%;
        padding: 12px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        box-sizing: border-box;
        background-color: #f7f7f7;
    }

    input[type="password"]:focus {
        border-color: #3498db;
        background-color: #fff;
    }

    button {
        background-color: #4CAF50;
        color: #fff;
        padding: 14px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
    }

    .message {
        text-align: center;
        margin-top: 20px;
        font-size: 1.1em;
    }

    .message.success {
        color: #4CAF50;
    }

    .message.error {
        color: #f44336;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>

<h1>Change Your Password</h1>

<form action="change_password.php" method="post">
    <label for="current_password">Current Password</label>
    <input type="password" name="current_password" id="current_password" required><br><br>

    <label for="new_password">New Password</label>
    <input type="password" name="new_password" id="new_password" required><br><br>

    <label for="confirm_password">Confirm New Password</label>
    <input type="password" name="confirm_password" id="confirm_password" required><br><br>

    <button type="submit">Change Password</button>
</form>

</body>
</html>
