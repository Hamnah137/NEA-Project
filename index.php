<?php
session_start();
require('header.php'); // Include the header file
?>
<?php
require('db.php'); // Ensure this file contains your database connection logic
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Custom styles if you have any -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Video</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="video-container">
        <video autoplay muted loop class="background-video">
            <source src="https://www.shutterstock.com/video/clip-3433669499-successful-rich-girl-running-stairs-fashion-boutique" type="video/mp4">
            <!-- Fallback message for unsupported browsers -->
            Your browser does not support HTML5 video.
        </video>
    </div>



<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@400;700&display=swap" rel="stylesheet">
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">My Shopping Website</a>
                </div>


                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="#contact">About us</a></li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <li><a href="dashboard.php"> Dashboard</a></li>
                            <li><a href="logout.php"> Logout</a></li>
                        <?php else: ?>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <div class="container" style="margin-top: 70px;">
            <div class="text-center">
                <?php if (isset($_SESSION['username'])): ?>
                    <h3>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                <?php else: ?>
                    <h3>Welcome to My Shopping Website!</h3>
                    <p>New user? Please <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
                <?php endif; ?>
            </div>


            <section class="products">
                <h2>Featured Products</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="https://aidashoreditch.co.uk/cdn/shop/files/EWC409_1_600x.jpg?v=1727880838" alt="Product 1">
                            <div class="caption">
                                <h3>RED JUMPER WITH A SWAN</h3>
                                <p>$19.99</p>
<p><a href="add_to_cart.php?product_id=1&product_name=Product%201&product_price=19.99" class="btn btn-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="https://aidashoreditch.co.uk/cdn/shop/products/CMC379_GREEN_FLAT_600x.jpg?v=1664882952" alt="Product 2">
                            <div class="caption">
                                <h3>GREEN HOODIE</h3>
                                <p>$29.99</p>
<p><a href="add_to_cart.php?product_id=2&product_name=Product%202&product_price=29.99" class="btn btn-primary">Add to Cart</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="https://aidashoreditch.co.uk/cdn/shop/files/EWC365_5_600x.jpg?v=1726246127" alt="Product 3">
                            <div class="caption">
                                <h3>BLUE DENIM JACKET</h3>
                                <p>$39.99</p>
                                <p><a href="add_to_cart.php?product_id=3&product_name=Product%203&product_price=39.99" class="btn btn-primary">Add to Cart</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="https://aidashoreditch.co.uk/cdn/shop/files/EWC365_5_600x.jpg?v=1726246127" alt="Product 3">
                            <div class="caption">
                                <h3>Product 4</h3>
                                <p>$49.99</p>
                                <p><a href="add_to_cart.php?product_id=4&product_name=Product%204&product_price=49.99" class="btn btn-primary">Add to Cart</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Video</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop class="background-video">
            <source src="3433669499-preview.mp4" type="video/mp4">
            <!-- Fallback message for unsupported browsers -->
            Your browser does not support HTML5 video.
        </video>
    </div>
</body>


    <footer class="container">
        <p class="text-center">&copy; 2024 My Shopping Website. All rights reserved.</p>
    </footer>
</html>

