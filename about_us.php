<!-- The code for the about us pafe of the website -->
 
<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <style>
body {
    background-color: #f4f4f4; 
    background-image: url('images/background.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed;
    background-repeat: no-repeat; 
    color: #fff; /* Default text color for consistency */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header, footer {
    background: rgba(0, 0, 0, 0.8); /* Semi-transparent dark background for clarity */
    color: #fff; /* White text for strong contrast */
    text-align: center;
    padding: 20px;
    font-weight: bold;
}

.container {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.7); /* Darkened container for improved readability */
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
}

h1, h2 {
    color: #FFD700; /* Gold text for highlighting headings */
}

p {
    color: #ddd; /* Light grey for softer contrast and better readability */
    line-height: 1.8;
}

a {
    color: #4ABDAC; /* Calming teal for links */
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #0078ff;
    text-decoration: underline;
}

  </style>
</head>
<body>
  <header>
    <h1>About Us</h1>
  </header>

  <div class="container">
    <div class="section">
      <h2>Our Mission</h2>
      <p>At The Wardrobe Vault, we strive to provide affordable and accessible products that bring peace, knowledge, and kindness to everyone. We believe in the power of books, quality products, and customer service to make a difference in people's lives.</p>
    </div>

    <div class="section">
      <h2>Our Values</h2>
      <p>We are committed to promoting kindness, sustainability, and accessibility. We aim to create a community where everyone can access quality resources without financial barriers, ensuring that knowledge and positivity are available to all.</p>
    </div>

    <div class="section">
      <h2>Contact Us</h2>
      <p>If you have any questions or need assistance, feel free to reach out to us. We are here to help!</p>
      <p>Email: <a href="mailto:support@wardrobevault.com">support@wardrobevault.com</a></p>
      <p>Phone: +44 1234 567890</p>
      <p>Address: 123 Grove Park Rd, Wrexham, United Kingdom</p>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 The Wardrobe Vault. All rights reserved.</p>
  </footer>
</body>
</html>
