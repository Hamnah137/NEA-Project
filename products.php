<!-- Code to see what are the products in the website
  Managing products by the admin -->

<?php 
session_start();
require('db.php');

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit();
}

// Handle product deletion
if (isset($_GET['delete_product'])) {
    $product_id = intval($_GET['delete_product']);
    if ($product_id > 0) {
        $delete_wishlist_query = $conn->prepare("DELETE FROM wishlist WHERE product_id = ?");
        $delete_wishlist_query->bind_param("i", $product_id);
        $delete_wishlist_query->execute();

        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }
}

// Fetch products
$product_query = $conn->query("SELECT * FROM products ORDER BY product_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-image: url('images/background.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    color: #fff;
}

.container {
    width: 90%;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.7);
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
}

h1 {
    text-align: center;
    font-size: 2.5em;
    color: #FFD700;
}

a {
    color: #4ABDAC;
    text-decoration: none;
    font-size: 1.1em;
}

a:hover {
    color: #0078ff;
    text-decoration: underline;
}

table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    color: black;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #444;
}

table th {
    background-color: #333;
    color: #FFD700;
}

table td {
    background-color: #fff;
}

table img {
    width: 50px;
    height: auto;
    border-radius: 5px;
}

table tr:hover {
    background-color: #444;
}

button {
    background-color: #4ABDAC;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1.1em;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0078ff;
}

.text-right {
    text-align: right;
    margin-top: 20px;
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
    <h1>Manage Products</h1>
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $product_query->fetch_assoc()) { ?>
                <tr>
                    <td><?= $product['product_id']; ?></td>
                    <td><?= htmlspecialchars($product['name']); ?></td>
                    <td>$<?= number_format($product['price'], 2); ?></td>
                    <td><img src="<?= $product['image_path']; ?>" width="50"></td>
                    <td>
                        <a href="?delete_product=<?= $product['product_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
