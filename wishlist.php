<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Add to wishlist
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];

    // Check if the product already exists in the user's wishlist
    $check_sql = "SELECT 1 FROM Wishlist WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='message'>Product already in wishlist!</div>";
    } else {
        // Insert the product into the wishlist
        $sql = "INSERT INTO Wishlist (user_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }

        $stmt->bind_param("ii", $user_id, $product_id);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "<div class='message success'>Product added to wishlist!</div>";
        } else {
            echo "<div class='message error'>Error adding product to wishlist!</div>";
        }
    }
}

// Remove from wishlist
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    
    $sql = "DELETE FROM Wishlist WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $product_id);

    // Execute and check for errors
    if ($stmt->execute()) {
        echo "<div class='message success'>Product removed from wishlist!</div>";
    } else {
        echo "<div class='message error'>Error removing product from wishlist!</div>";
    }
}

// Get wishlist items along with product image
$sql = "SELECT p.product_name, p.price, p.product_id, p.image_path
        FROM Products p 
        JOIN Wishlist w ON p.product_id = w.product_id 
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die('Error executing query: ' . $conn->error);
}

$wishlist_items = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #f8f8f8, #e9ecef);
        }

        h1 {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 30px;
            font-size: 3em;
            margin: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2em;
            color: #333;
            text-align: center;
            margin-top: 40px;
        }

        .message {
            padding: 15px;
            text-align: center;
            margin: 15px 0;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .message.success {
            background-color: #4CAF50;
            color: #fff;
        }

        .message.error {
            background-color: #e74c3c;
            color: #fff;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            margin-top: 40px;
        }

        li {
            background-color: #fff;
            margin: 15px;
            padding: 20px;
            border-radius: 12px;
            width: calc(33% - 30px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        li:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        li img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        li img:hover {
            transform: scale(1.1);
        }

        li .product-details {
            text-align: center;
        }

        li .product-details p {
            font-size: 1.2em;
            color: #555;
            margin: 5px 0;
        }

        li .product-details .price {
            font-size: 1.5em;
            font-weight: bold;
            color: #2c3e50;
        }

        li .product-details a {
            background-color: #1abc9c;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        li .product-details a:hover {
            background-color: #16a085;
        }

        .shop-link {
    margin-top: 120px; /* Increased margin for more space */
    text-align: center;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 40px;
}

.shop-link h2 {
    font-size: 2em;
    color: #333;
}

.shop-link p {
    font-size: 1.2em;
    color: #555;
    margin: 10px 0 20px;
}

.shop-link a {
    background-color: #3498db;
    color: #fff;
    padding: 20px 30px;
    border-radius: 6px;
    font-size: 1.2em;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.shop-link a:hover {
    background-color: #2980b9;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}


        @media screen and (max-width: 768px) {
            li {
                width: calc(50% - 30px);
            }
        }

        @media screen and (max-width: 480px) {
            li {
                width: 100%;
            }

            h1 {
                font-size: 2.5em;
            }
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

    </style>
</head>
<body>

<div class="container">
    <h1>Your Wishlist</h1>

    <?php if (empty($wishlist_items)): ?>
        <p style="text-align: center; font-size: 1.2em; color: #333;">Your wishlist is empty. Start adding some products!</p>
    <?php else: ?>
        <ul>
        <?php foreach ($wishlist_items as $item): ?>
            <li>
                <a href="shop.php?product_id=<?php echo $item['product_id']; ?>">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" 
                         alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                </a>
                <div class="product-details">
                    <p><?php echo htmlspecialchars($item['product_name']); ?></p>
                    <p class="price">$<?php echo htmlspecialchars($item['price']); ?></p>
                    <a href="wishlist.php?remove=<?php echo $item['product_id']; ?>">Remove from Wishlist</a>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="shop-link">
        <h2>Browse the Shop</h2>
        <p>Explore our wide range of products and add more to your wishlist!</p>
        <a href="shop.php">Go to Shop</a>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 My Shopping Website. All rights reserved.</p>
</footer>

</body>
</html>
