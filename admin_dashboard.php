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

// Handle adding new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = 'uploads/' . basename($image);

    if (!empty($name) && !empty($price)) {
        if (move_uploaded_file($image_tmp, $image_path)) {
            $stmt = $conn->prepare("INSERT INTO products (name, price, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sds", $name, $price, $image_path);
            $stmt->execute();
        }
    }
}

// Handle user deletion
if (isset($_GET['delete_user'])) {
    $user_id = intval($_GET['delete_user']);
    if ($user_id > 0) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }
}

// Fetch products
$product_query = $conn->query("SELECT * FROM products ORDER BY product_id DESC");

// Fetch orders
$order_query = $conn->query("SELECT orders.*, orderdetails.*, products.name AS product_name, products.image_path FROM orders JOIN orderdetails ON orders.order_id = orderdetails.order_id JOIN products ON orderdetails.product_id = products.product_id ORDER BY orders.order_date DESC");

$orders = [];
while ($order = $order_query->fetch_assoc()) {
    $order_id = $order['order_id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'order_id' => $order['order_id'],
            'user_id' => $order['user_id'],
            'total' => $order['total'],
            'order_date' => $order['order_date'],
            'items' => [],
            'calculated_total' => 0
        ];
    }
    $item_price = $order['quantity'] * $order['price'];
    $orders[$order_id]['items'][] = [
        'product_name' => $order['product_name'],
        'quantity' => $order['quantity'],
        'price' => $order['price'],
        'item_total' => $item_price,
        'image_path' => $order['image_path']
    ];
    $orders[$order_id]['calculated_total'] += $item_price;
}

// Fetch users
$user_query = $conn->query("SELECT user_id, username, email FROM users ORDER BY user_id ASC");
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .product-image {
            width: 120px;
            height: auto;
            border-radius: 5px;
        }
        .order-table {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fafafa;
        }
        .order-table th, .order-table td {
            border-bottom: 1px solid #ddd;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #007BFF;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>
    <h2>Total Registered Users: <?= $total_users; ?></h2>
    
    <nav>
        <ul>
            <li><a href="users.php">View Users</a></li>
            <li><a href="products.php">View Products</a></li>
            <li><a href="orders_admin.php">View Orders</a></li>
        </ul>
    </nav>
    
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>
</div>
</body>
</html>
