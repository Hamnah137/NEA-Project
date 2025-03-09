<?php
function sendFakeEmail($to, $reset_token, $timestamp) {
    date_default_timezone_set('Europe/London'); // Set your preferred timezone

    $reset_link = "http://localhost/reset_password.php?token=" . urlencode($reset_token); // Replace localhost if necessary

    // Ensure timestamp is an integer before passing it to date()
    if (!is_numeric($timestamp)) {
        $timestamp = time(); // Fallback to current time if invalid
    }

    $formatted_time = date("Y-m-d H:i:s", (int)$timestamp);

    $message = "Password Reset Request\n\nClick the link below to reset your password:\n" . $reset_link . "\n\nThis link expires in 1 hour.";

    // Log the email instead of sending it
    file_put_contents("email_log.txt", "To: $to\nTime: $formatted_time\nMessage:\n$message\n\n", FILE_APPEND);
}
?>
