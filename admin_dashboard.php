<?php
session_start();
require('db.php');

// Check if admin
if ($_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Add new product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
    mysqli_query($conn, $query);
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price" required>
    <button type="submit">Add Product</button>
</form>
<form method="GET" action="search.php">
    <input type="text" name="query" placeholder="Search for products...">
    <select name="sort">
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
    <button type="submit">Search</button>
</form>
