<!-- Code to send confirmation email on placing order -->

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '22129890@cambria.ac.uk';  // Your Gmail
        $mail->Password   = 'aipg jifj qajw hkzm';  // Use your generated App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('22129890@cambria.ac.uk', 'NEA');
        $mail->addAddress($to); // Recipient's email
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br(htmlspecialchars($message)); // Converts newlines to <br> for better formatting

        $mail->send();

        echo "✅ Email has been sent successfully.<br>";
        return true;
    } catch (Exception $e) {
        echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}<br>";
        return false;
    }
}
?>

