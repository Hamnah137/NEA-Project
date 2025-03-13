<?php
date_default_timezone_set('Europe/London'); // Replace with your timezone
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Email details
    $to = "your-email@example.com";  // Replace with your email
    $subject = "New Contact Us Message from " . $name;
    $body = "You have received a new message from your website contact form.\n\n".
            "Name: " . $name . "\n".
            "Email: " . $email . "\n\n".
            "Message: \n" . $message;

    // Send email (mail function is simulated here)
    mail($to, $subject, $body);

    // Success message
    $success = "Thank you for reaching out! We'll get back to you soon.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional: External CSS -->
</head>
<style>
/* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Styling */
body {
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Header Styling */
header {
    background-color: #5c6bc0;
    color: white;
    padding: 20px 0;
    text-align: center;
}

header h1 {
    font-size: 2.5em;
    margin: 0;
}

/* Contact Form Section */
.contact-form {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.contact-form h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

/* Form Label and Input Styling */
label {
    display: block;
    font-size: 1.1em;
    margin-bottom: 8px;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
}

textarea {
    resize: vertical;
}

/* Button Styling */
button {
    background-color: #5c6bc0;
    color: white;
    padding: 12px 20px;
    font-size: 1.1em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #3f4c9b;
}

/* Success Message Styling */
.success {
    background-color: #e1f7e1;
    color: #2a6d2b;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #2a6d2b;
    text-align: center;
}

/* Footer Styling */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    margin-top: 40px;
}

footer p {
    font-size: 1em;
    margin: 0;
}
</style>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>

    <section class="contact-form">
        <h2>We'd love to hear from you!</h2>

        <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>

        <form action="contact_us.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>
        <iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Grove%20Park%20Rd%20Wrexham+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://mapswebsite.net/'>google maps html widget</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=0660ed1885ce365d60258b2f6690ad7abf20bdef'></script>
    </section>
<!-- Social Media Text with Emoji Section -->
<section class="social-media">
    <h3>Follow Us:</h3>
    <ul>
        <li>ⓕ Facebook</li>
        <li>𝕏 Twitter</li>
        <li>🅾 Instagram</li>
        <li>🔗 LinkedIn</li>
    </ul>
</section>

    <footer>
    <p>&copy; 2025 My Shopping Website. All rights reserved.</p>
    </footer>
</body>
</html>