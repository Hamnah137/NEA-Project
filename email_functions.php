<?php
function sendFakeEmail($to, $subject, $message) {
    $logFile = "email_log.txt"; // File to store emails
    $timestamp = date("Y-m-d H:i:s"); // Get current time

    // Format email content
    $emailContent = "=========================\n";
    $emailContent .= "Time: $timestamp\n";
    $emailContent .= "To: $to\n";
    $emailContent .= "Subject: $subject\n";
    $emailContent .= "Message:\n$message\n";
    $emailContent .= "=========================\n\n";

    // Append email to log file
    file_put_contents($logFile, $emailContent, FILE_APPEND);

    return true; // Simulate successful email
}
?>
