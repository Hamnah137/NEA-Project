<?php
session_start();
require('header.php'); // Include the header file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - The Wardrobe Vault</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Custom styles if you have any -->
<style>
    body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}
</style>
</head>
<body>

<div class="container" style="margin-top: 70px;">
    <h1 class="text-center">Your Shopping Cart</h1>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <div class="row">
            <div class="col-md-8">
                <h3>Your Cart Items</h3>
                <?php
                // Loop through each item in the cart
                foreach ($_SESSION['cart'] as $id => $product):
                    // Get the image path from the database (assuming the database stores the image name)
                    $image_path = !empty($product['image']) ? 'images/' . $product['image'] : 'images/default_image.jpg'; // Adjust folder name if necessary
                ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- Display product image -->
                                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-responsive" style="max-height: 150px;">
                                </div>
                                <div class="col-md-6">
                                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                    <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                                    <p><strong>Quantity:</strong> <?php echo $product['quantity']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <!-- Remove button for each item -->
                                    <a href="remove_from_cart.php?id=<?php echo $id; ?>" class="btn btn-danger">Remove Item</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <hr>

                <div class="text-right">
                    <?php
                    // Calculate total price
                    $totalPrice = 0;
                    foreach ($_SESSION['cart'] as $product) {
                        $totalPrice += $product['price'] * $product['quantity'];
                    }
                    ?>
                    <h3><strong>Total Price: $<?php echo number_format($totalPrice, 2); ?></strong></h3>
                </div>

                <div class="text-center">
                    <!-- Proceed to Checkout button -->
                    <a href="checkout.php" class="btn btn-primary btn-lg">Proceed to Checkout</a>
                    <!-- Continue Shopping button -->
                    <a href="shop.php" class="btn btn-default btn-lg">Continue Shopping</a>
                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <p>Your cart is empty.</p>
        </div>
        <div class="text-center">
            <a href="shop.php" class="btn btn-info">Start Shopping</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
