<!-- Code for the placing order -->

<?php
session_start();
require('header.php'); // Include header here
require('db.php'); // Database connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer autoloader (adjust the path as needed)
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$orderId = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if (!$orderId) {
    header('Location: shop.php');
    exit;
}

// Fetch user email from database (assuming orders are linked to users)
$user_id = $_SESSION['user_id']; // Ensure the user is logged in
$query = "SELECT email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_email = $user['email'];  // Correct assignment of user's email

// Email details
$to = $user_email;
$subject = "Order Confirmation - Order #$orderId";
$message = "Dear Customer,\n\nThank you for your order! Your order ID is $orderId.\nWe appreciate your purchase!\n\nBest Regards,\nThe Wardrobe Vault";

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server (e.g., Gmail, your mail provider)
    $mail->SMTPAuth = true;
    $mail->Username = '22129890@cambria.ac.uk'; // SMTP username
    $mail->Password = 'aipg jifj qajw hkzm'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Port to connect to (587 is for TLS, 465 is for SSL)

    // Recipients
    $mail->setFrom('22129890@cambria.ac.uk', 'The Wardrobe Vault'); // Sender's email and name
    $mail->addAddress($to); // Add recipient's email

    // Content
    $mail->isHTML(false); // Set email format to plain text
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Send the email
    $mail->send();
    echo "DEBUG: Email sent successfully.";
} catch (Exception $e) {
    echo "DEBUG: Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .order-success-container {
            width: 60%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 2.5em;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .order-message {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 20px;
        }

        .order-number {
            font-weight: bold;
            font-size: 1.4em;
            color: #333;
        }

        .order-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #2196F3;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #1976D2;
        }

        .order-icon {
            font-size: 3em;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}
    </style>
</head>
<body>

    <div class="order-success-container">
        <div class="order-icon">
            🎉
        </div>
        <h2>Thank You for Your Purchase!</h2>
        <div class="order-message">
            <p>Your order number <span class="order-number">#<?php echo htmlspecialchars($orderId); ?></span> has been placed successfully. 💖</p>
            <p>We've sent you a confirmation email with your order details. 📩</p>
            <p>🛍️ Sit back and relax while we prepare your items for delivery!</p>
        </div>

        <div class="order-buttons">
            <a href="shop.php"><button class="btn btn-primary">Continue Shopping 🛒</button></a>
            <a href="orders.php"><button class="btn btn-secondary">View My Orders 📦</button></a>
        </div>
    </div>

</body>
</html>
