<?php 
session_start();
require('header.php'); // Include the header file
require('db.php'); // Ensure this file contains your database connection logic

// Query to fetch products from the database
$query = "SELECT product_id, name, description, price, image_path FROM products"; 
$result = mysqli_query($conn, $query); // Execute the query

// Check if the query was successful
if (!$result) {
    die("Error fetching products: " . mysqli_error($conn));
}
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
</head>
<body>

<div class="video-container">
    <video autoplay muted loop class="background-video">
        <source src="3433669499-preview.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
</div>

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
                <?php 
                // Fetch and display the products
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-4">';
                    echo '<div class="thumbnail">';
                    
                    // Check if image exists and use a fallback
                    $image_path = !empty($row['image_path']) ? $row['image_path'] : 'default_image.jpg';
                    echo '<img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    
                    echo '<div class="caption">';
                    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<p>$' . number_format($row['price'], 2) . '</p>';
                    echo '<p><a href="add_to_cart.php?product_id=' . $row['product_id'] . '&product_name=' . urlencode($row['name']) . '&product_price=' . $row['price'] . '" class="btn btn-primary">Add to Cart</a></p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- ✅ Site Reviews Section -->
        <section class="reviews">
            <h2>What Our Users Say</h2>
            <?php include 'site_reviews_page.php'; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <h3>Leave a Review</h3>
                <?php include 'site_review_form.html'; ?>
            <?php else: ?>
                <p><a href="login.php">Log in</a> to leave a review.</p>
            <?php endif; ?>
        </section>

        <!-- ✅ Product Reviews Section -->
        <section class="product-reviews">
            <h2>Product Reviews</h2>
            <?php include 'product_reviews_page.php'; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <h3>Review a Product</h3>
                <?php include 'product_review_form.html'; ?>
            <?php else: ?>
                <p><a href="login.php">Log in</a> to review a product.</p>
            <?php endif; ?>
        </section>

    </div>
</main>

<footer class="container">
    <p class="text-center">&copy; 2024 My Shopping Website. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>