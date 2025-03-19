<!-- Code for the "Contact Us" page -->

<?php
include('header.php'); 
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
    font-family: Times New Roman, sans-serif;
}

/* Body Styling */
body {
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Header Styling */
header {
    color: white;
    padding: 70px 0;
    text-align: center;
}

/* Contact Info Section */
.contact-info {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.contact-info h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.contact-info p {
    text-align: center;
    font-size: 1.2em;
    color: #666;
}

/* Map Styling */
iframe {
    width: 100%;
    max-width: 800px;
    height: 400px;
    border: 0;
    margin: 20px auto;
    display: block;
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

body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}

</style>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>
    <section class="contact-info">
        <h2>Get in Touch</h2>
        <p>If you have any questions, feel free to check the contact information in the footer below!</p>

        <!-- Google Map Embed -->
        <iframe src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Grove%20Park%20Rd%20Wrexham+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
    </section>

<?php require('footer.php'); // Include the footer file ?>
</body>
</html>
