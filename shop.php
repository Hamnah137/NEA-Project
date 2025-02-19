<?php
session_start(); // Start session for user login checks
include 'header.php'; // Include the header
include 'db.php'; // Database connection

// Fetch products from the database
$query = "SELECT product_id, name, description, price, image_path FROM products";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    die("Error fetching products: " . mysqli_error($conn)); // Show error message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Browse Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .product {
            width: 30%;
            margin: 10px;
            box-sizing: border-box;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Our Products</h1>

        <!-- Product container for horizontal layout -->
        <div class="product-container"> <!-- Wrap the products inside this div -->
            <?php
            while ($product = mysqli_fetch_assoc($result)) {
                $product_name = htmlspecialchars($product['name']);
                $product_description = htmlspecialchars($product['description']);
                $price = htmlspecialchars($product['price']);
                $image_path = htmlspecialchars($product['image_path']);
                ?>

                <div class="product">
                    <?php if (!empty($image_path)) { ?>
                        <img src="<?php echo $image_path; ?>" alt="<?php echo $product_name; ?>" class="product-image">
                    <?php } ?>

                    <h3><?php echo $product_name; ?></h3>
                    <p><?php echo $product_description; ?></p>
                    <p><strong>Price:</strong> $<?php echo $price; ?></p>

                    <div class="button-group">
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $price; ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                        </form>

                        <a href="product_details.php?id=<?php echo $product['product_id']; ?>" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            <?php } ?>
        </div> <!-- End of product-container -->
    </div>
</body>
</html>
