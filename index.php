<!-- Code for the "home page" of the website -->

<?php 
// Set the timezone
date_default_timezone_set('Europe/London'); // Replace with your timezone
session_start();
require('header.php'); // Include the header file
require('db.php'); // Ensure this file contains your database connection logic

// Query to fetch products from the database
$query = "SELECT * FROM Products WHERE featured = 1"; 
$result = mysqli_query($conn, $query); // Execute the query

// Query to fetch reviews from the database, including the user's name
$reviews_query = "SELECT site_reviews.site_review_id, site_reviews.rating, site_reviews.comment, site_reviews.created_at, 
                         users.username, users.profile_image 
                  FROM site_reviews
                  JOIN users ON site_reviews.user_id = users.user_id
                  ORDER BY site_reviews.created_at DESC";
$reviews_result = mysqli_query($conn, $reviews_query);

// Check if the query was successful
if (!$result || !$reviews_result) {
    die("❌ Error fetching data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wardrobe Vault</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Body and Main Layout */
        body {
            font-family: 'Times New Roman', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        header {
            margin: 0;
            padding: 0;
        }

        .navbar-nav {
            float: right;
        }

        .main-content {
            margin-top: 0;
        }

        .video-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .background-video {
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        main {
            padding: 20px;
        }

        /* Enhanced Product Section */
        .container {
            text-align: center;
        }

        .container h3 {
            font-size: 32px;
            font-weight: 500;
            color: #rgba(180, 29, 29, 0.1);
        }

        .products h2, .reviews h2 {
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: bold;
            color: #999;
        }

        .products .row {
            margin-top: 20px;
            justify-content: center;
        }

        .thumbnail {
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .thumbnail:hover {
            transform: scale(1.05);
        }

        .thumbnail img {
            width: 100%;
            max-width: 250px;
            border-radius: 5px;
        }

        .caption {
            background-color: #fff;
            padding: 15px;
            border-radius: 0 0 5px 5px;
        }

        .caption h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .caption p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .caption .btn {
            font-size: 14px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color:rgba(104, 141, 179, 0.54);
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        /* Enhanced Review Section */
        .reviews {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .reviews .review {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .reviews .review p {
            font-size: 16px;
            color: #333;
        }

        .reviews .review p small {
            font-size: 18px;
            color: #888;
        }
        .profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 2px solid #007bff;
        }
        
        .review-header {
    display: flex;
    align-items: center;
    gap: 10px;
        }


        /* Enhanced Review Submission Form */
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        form .form-group {
            margin-bottom: 15px;
        }

        form .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        form .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        form .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 16px;
            padding: 10px 20px;
            cursor: pointer;
        }

        form .btn-primary:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        /* Star Rating */
        .stars {
            display: inline-block;
            direction: rtl;
            font-size: 25px;
        }

        .stars input {
            display: none;
        }

        .stars label {
            color: #d3d3d3;
            cursor: pointer;
        }

        .stars input:checked ~ label {
            color: #ffbc00;
        }

        .stars label:hover,
        .stars label:hover ~ label {
            color: #ffbc00;
        }
    </style>
</head>
<body>

<main>
    <div class="container">
        <div class="text-center">
            <?php if (isset($_SESSION['username'])): ?>
                <h3>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
            <?php else: ?>
                <h3><strong>Welcome to The Wardrobe Vault</strong> — Affordable fashion with a purpose. Discover quality products while supporting peace, knowledge, and kindness.</h3>
                <p>New user? Please <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
            <?php endif; ?>
        </div>

        <!-- Products Section -->
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
                    echo '<p><a href="wishlist.php?add=' . $row['product_id'] . '" class="btn btn-warning">Add to Wishlist ❤️</a></p>';
                    echo '<p><a href="product_details.php?id=' . $row['product_id'] . '" class="btn btn-secondary">View Details</a></p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Site Reviews Section -->
        <section class="reviews">
    <h2>What Our Users Say About Us</h2>
    <?php 
    while ($row = mysqli_fetch_assoc($reviews_result)) {
        $rating = (int)$row['rating'];
        $profile_image = !empty($row['profile_image']) ? 'images/' . htmlspecialchars($row['profile_image']) : 'images/default_image.svg';
        
        echo '<div class="review">';
        echo '<div class="review-header">';
        echo '<img src="' . $profile_image . '" alt="Profile Image" class="profile-img">';
        echo '<p><strong>' . htmlspecialchars($row['username']) . ' - Rating: ';
        for ($i = 0; $i < 5; $i++) {
            echo '<span class="glyphicon glyphicon-star' . ($i < $rating ? '' : '-empty') . '"></span>';
        }
        echo '</strong></p>';
        echo '</div>'; // Close review-header
        echo '<p>' . htmlspecialchars($row['comment']) . '</p>';
        echo '<p><small>' . date('F j, Y, g:i a', strtotime($row['created_at'])) . '</small></p>';
        echo '</div>';
    }
    ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <h3>Leave a Site Review</h3>
                <form action="submit_review.php" method="POST">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <div class="stars">
                            <input type="radio" name="rating" value="5" id="star5"><label for="star5">★</label>
                            <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                            <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                            <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                            <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="comment" rows="4" class="form-control" placeholder="Write your review..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            <?php else: ?>
                <p>Please <a href="login.php">login</a> to leave a review.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

</body>
</html>
<?php require('footer.php'); // Include the footer file ?>