<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Times New Roman', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f7fa;
      color: #333;
      background-image: url('images/background.jpg'); /* Path to your image */
      background-size: cover; /* Ensures the image covers the whole screen */
      background-position: center; /* Centers the image */
      background-attachment: fixed; /* Keeps the image fixed while scrolling */
      background-repeat: no-repeat; /* Prevents the image from repeating */
    }

    h1, h2 {
      text-align: center;
      color: #333;
      margin-bottom: 10px;
    }

    h1 {
      font-size: 36px;
    }

    main {
      width: 80%;
      max-width: 1100px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 40px;
      animation: fadeIn 1s ease-in-out;
    }

    .section {
      margin-bottom: 30px;
    }

    .section h2 {
      color: #FFD700; /* Gold text for headings */
    }

    .section p {
      color: black;
      line-height: 1.8;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: #343a40;
      color: #fff;
      font-size: 16px;
      margin-top: 60px;
    }

    /* Animations */
    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      main {
        width: 90%;
      }

      .section h2 {
        font-size: 24px;
      }

      .section p {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>About Us</h1>
  </header>

  <main>
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
  </main>

  <footer>
    <p>&copy; 2025 The Wardrobe Vault. All rights reserved.</p>
  </footer>
</body>
</html>
