<!-- Code to show product details -->

<?php
session_start();
include 'header.php'; 
include 'db.php'; 

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$product_id) {
    echo "<p>Invalid product.</p>";
    exit;
}

// Fetch product details
$query = "SELECT * FROM products WHERE product_id = '$product_id'";
$product_result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($product_result);

// Fetch reviews with profile images
$reviews_query = "SELECT r.comment, r.rating, u.username, u.profile_image 
                  FROM product_reviews r 
                  JOIN users u ON r.user_id = u.user_id 
                  WHERE r.product_id = '$product_id'";
$reviews_result = mysqli_query($conn, $reviews_query);

if (!$reviews_result) {
    die("Error fetching reviews: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            background-color: #f4f4f9;
            background-image: url('images/background.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
        }
        .product-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        .product-description {
            flex: 1;
            margin-right: 30px;
            font-size: 1.2em;
            color: #555;
        }
        .price {
            font-size: 1.5em;
            color: #e67e22;
            font-weight: bold;
        }
        .review-section {
            margin-top: 40px;
        }
        .review {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid #e67e22;
        }
        .review-content {
            flex: 1;
        }
        .reviewer {
            font-weight: bold;
            color: #333;
        }
        .star-rating {
            display: flex;
        }
        .star-rating span {
            font-size: 1.5em;
            color: #f39c12;
            margin-right: 5px;
        }
        .btn {
            display: inline-block;
            background-color: #e67e22;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
        }
        .btn:hover {
            background-color: #d35400;
        }
        .login-msg {
            font-size: 1.1em;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="product-info">
            <div class="product-description">
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <p class="price">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
            </div>
            <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
        </div>

        <!-- Reviews Section -->
        <div class="review-section">
            <h2>Customer Reviews</h2>
            <?php while ($review = mysqli_fetch_assoc($reviews_result)) { ?>
                <div class="review">
                    <!-- Display Profile Image -->
                    <img src="images/<?php echo htmlspecialchars($review['profile_image'] ? $review['profile_image'] : 'default_image.svg'); ?>" 
     alt="Profile Image" 
     class="profile-image">


                    <div class="review-content">
                        <p class="reviewer"><?php echo htmlspecialchars($review['username']); ?>:</p>
                        <div class="star-rating">
                            <?php
                            $rating = $review['rating'];
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $rating ? '★' : '☆';
                            }
                            ?>
                        </div>
                        <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                    </div>
                </div>
            <?php } ?>

            <!-- Leave a Review Button -->
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="submit_review.php?product_id=<?php echo $product['product_id']; ?>" class="btn">Leave a Review</a>
            <?php } else { ?>
                <p class="login-msg">Login to leave a review. <a href="login.php">Login Here</a></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
