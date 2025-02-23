<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Your custom styles -->
    <style>
        /* Header Styling */
        .navbar {
            background-color: #343a40; /* Dark background for professionalism */
        }
        .navbar-brand {
            color: #fff !important;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar-nav .nav-item .nav-link {
            color: #fff !important;
            font-size: 18px;
            padding: 10px 15px;
        }
        .navbar-nav .nav-item .nav-link:hover {
            background-color: #007bff;
            color: #fff !important;
            border-radius: 5px;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .cart-icon {
            position: relative;
        }

        .cart-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 50%;
        }

        /* Body padding to prevent header overlap */
        body {
            padding-top: 70px; /* Adjust this value based on navbar height */
        }

        /* Video Background */
        .video-container {
            display: none; /* Default: Hide the video */
        }

        .home-page .video-container {
            display: block;
        }
    </style>
</head>
<body>

<!-- Check if it's the home page, and if so, show the video -->
<?php if (basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
    <div class="video-container">
        <video autoplay muted loop class="background-video">
            <source src="3433669499-preview.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    </div>
<?php endif; ?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">My Shopping Website</a>
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
                    <a class="nav-link" href="#about">About Us</a>
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
