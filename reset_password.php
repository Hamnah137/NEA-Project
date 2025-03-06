<?php
require('db.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Update password and clear token
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE user_id = ?");
            $stmt->bind_param("si", $new_password, $user_id);
            $stmt->execute();

            $successMessage = "Your password has been reset. <a href='login.php'>Login here</a>";
        }
    } else {
        die("Invalid or expired token.");
    }
} else {
    die("No token provided.");
}
?>

<div class="container mt-5 pt-5">
    <div class="card shadow-sm p-4 border-0 rounded-3">
        <h3 class="text-center mb-4">Reset Password</h3>
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success"><?= $successMessage; ?></div>
        <?php else: ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
