<?php
require('db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $reset_token = bin2hex(random_bytes(16));
        $update_query = "UPDATE users SET reset_token = '$reset_token' WHERE email = '$email'";
        mysqli_query($conn, $update_query);

        $reset_link = "http://yourwebsite.com/reset_password.php?token=$reset_token";
        mail($email, "Password Reset", "Click here to reset your password: $reset_link");

        echo "Reset link sent to your email.";
    } else {
        echo "No account found with that email.";
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Send Reset Link</button>
</form>
