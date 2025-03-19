<!-- Code for the shop page where every product is -->

<?php
session_start(); // Start session for user login checks
include 'header.php'; // Include the header
include 'db.php'; // Database connection

// Handle search and filter
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$sort_by = isset($_GET['sort_by']) ? mysqli_real_escape_string($conn, $_GET['sort_by']) : 'name';
$order = isset($_GET['order']) ? mysqli_real_escape_string($conn, $_GET['order']) : 'ASC';

// Build the SQL query with conditions
$query = "SELECT product_id, name, description, price, image_path FROM products WHERE name LIKE '%$search_query%'";

if ($category_filter) {
    $query .= " AND category = '$category_filter'";
}

// Pagination
$products_per_page = 9;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;
$query .= " LIMIT $offset, $products_per_page";

$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    die("Error fetching products: " . mysqli_error($conn)); // Show error message
}

// Fetch total products for pagination
$total_query = "SELECT COUNT(*) FROM products WHERE name LIKE '%$search_query%'".($category_filter ? " AND category = '$category_filter'" : "");
$total_result = mysqli_query($conn, $total_query);
$total_products = mysqli_fetch_row($total_result)[0];
$total_pages = ceil($total_products / $products_per_page);

// Handle Wishlist Action
if (isset($_POST['add_to_wishlist'])) {
    if (isset($_SESSION['user_id'])) {  // Check if user is logged in
        $user_id = $_SESSION['user_id'];  // Assuming user ID is stored in session
        $product_id = $_POST['product_id'];

        // Check if the product is already in the wishlist
        $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // Add product to the wishlist
            $add_query = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
            if (mysqli_query($conn, $add_query)) {
                echo "Product added to wishlist!";
            } else {
                echo "Error adding product to wishlist: " . mysqli_error($conn);
            }
        } else {
            echo "This product is already in your wishlist.";
        }
    } else {
        echo "Please log in to add products to your wishlist.";
    }
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
        /* Reset styles for minimal design */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Times New Roman', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

h1 {
    font-size: 2.5rem;
    margin: 40px 0;
    text-align: center;
    color: #007BFF;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Filter, Search, and Sort Container */
.filter-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 40px;
}

.filter-container input,
.filter-container select,
.filter-container button {
    padding: 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    width: 180px;
    background-color: #fff;
    transition: border-color 0.3s ease;
}

.filter-container input:focus,
.filter-container select:focus,
.filter-container button:focus {
    border-color: #007BFF;
    outline: none;
}

.filter-container button {
    background-color: #007BFF;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.filter-container button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Product Layout */
.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    gap: 30px;
}

.product {
    width: 30%;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    transition: transform 0.3s ease;
}

.product:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.product:hover img {
    transform: scale(1.05);
}

.product-container .product {
    width: 30%; /* Keeps 3 products per row */
}

/* Flexbox adjustment for centering products when there are less than 3 */
.product-container .product:nth-child(3n+1),
.product-container .product:nth-child(3n+2) {
    margin-left: 0;
}

.product-container .product:nth-last-child(-n+2) {
    margin-left: auto;
    margin-right: auto;
}

.product p {
    font-size: 0.95rem;
    color: #666;
    margin-bottom: 15px;
}

.product .price {
    font-size: 1.1rem;
    font-weight: bold;
    color: #007BFF;
    margin-bottom: 20px;
}

/* Common Button Style */
.button {
    padding: 12px 20px;
    font-size: 1rem;
    background-color: #007BFF;
    color: white;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    margin-top: 10px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.button-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 40px;
}

.pagination a {
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.pagination a.active {
    background-color: #0056b3;
    font-weight: bold;
}

.pagination a:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .product-container {
        justify-content: space-between;
    }

    .product {
        width: 45%;
    }

    .filter-container {
        flex-direction: column;
        align-items: center;
    }

    .filter-container input,
    .filter-container select,
    .filter-container button {
        width: 100%;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.8rem;
    }

    .product {
        width: 100%;
    }

    .pagination {
        flex-direction: column;
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
    <div class="container">
        <h1>Our Products</h1>

        <!-- Filter, Search, and Sort Options -->
        <div class="filter-container">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search Products" value="<?php echo $search_query; ?>">
                <select name="category">
                    <option value="">All Categories</option>
                    <option value="women" <?php echo $category_filter == 'women' ? 'selected' : ''; ?>>Women</option>
                    <option value="men" <?php echo $category_filter == 'men' ? 'selected' : ''; ?>>Men</option>
                    <option value="kids" <?php echo $category_filter == 'kids' ? 'selected' : ''; ?>>Kids</option>
                </select>
                <select name="order">
                    <option value="ASC" <?php echo $order == 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="DESC" <?php echo $order == 'DESC' ? 'selected' : ''; ?>>Descending</option>
                </select>
                <button type="submit">Apply</button>
            </form>
        </div>

        <!-- Product Container -->
        <div class="product-container">
            <?php while ($product = mysqli_fetch_assoc($result)) { ?>
                <div class="product">
                    <?php if (!empty($product['image_path'])) { ?>
                        <img src="<?php echo $product['image_path']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php } ?>
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                    <div class="button-group">
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                            <button type="submit" name="add_to_cart" class="button">Add to Cart</button>
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button type="submit" name="add_to_wishlist" class="button">Add to Wishlist</button>
                        </form>
                        <a href="product_details.php?id=<?php echo $product['product_id']; ?>" class="button">View Details</a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_query); ?>&category=<?php echo urlencode($category_filter); ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>
</body>
<!-- Footer -->
<footer>
    <p>&copy; 2025 The Wardrobe Vault. All rights reserved.</p>
</footer>
</html>
