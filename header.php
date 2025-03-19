<!-- Code of the header of the website -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wardrobe Vault</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
    <style>
        /* Full-Screen Video Background */
        .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure video covers the screen */
        z-index: -1; /* Ensure it stays behind all content */
        display: none; /* Hide by default */
        }
        /* Show video only on the homepage */
        body.home-page .video-background {
        display: block; /* Show video only on homepage */
        }

        /* Header Styling */
        .navbar {
            background-color: #343a40; /* Dark background for professionalism */


@@ -55,78 +71,68 @@
            padding-top: 70px; /* Adjust this value based on navbar height */
        }
    </style>
</head>
<body class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'home-page' : ''; ?>">

<!-- Video Background -->
<video class="video-background" autoplay muted loop>
<source src="3433669499-preview.mp4" type="video/mp4">
Your browser does not support HTML5 video.
</video>











<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">The Wardrobe Vault</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact Us</a>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <span class="badge" id="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span> Cart
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS and dependencies (for responsive features) -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for cart icon -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>