<?php
session_start();
require('db.php');

// Check if admin is logged in by verifying admin credentials
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Add new product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Sanitize inputs and prepare query
    $name = mysqli_real_escape_string($conn, $name);
    $price = mysqli_real_escape_string($conn, $price);

    // Insert the new product into the database
    $query = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
    if (mysqli_query($conn, $query)) {
        echo "<p>Product added successfully!</p>";
    } else {
        echo "<p>Error: Could not add product.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Admin Dashboard</h1>

<!-- Add new product form -->
<h2>Add New Product</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price" required>
    <button type="submit">Add Product</button>
</form>

<!-- Search products form -->
<h2>Search Products</h2>
<form method="GET" action="search.php">
    <input type="text" name="query" placeholder="Search for products...">
    <select name="sort">
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
    <button type="submit">Search</button>
</form>

</body>
</html>
