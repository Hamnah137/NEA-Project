<!-- Code for the admin's dashboard where it can add products and by clicking on links can see the products, users and Orders -->

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
        /* Body Styling */
body {
    background-color: #f4f4f4;
    background-image: url('images/background.jpg'); /* Background image */
    background-size: cover; /* Ensure the image covers the entire background */
    background-position: center; /* Center the background image */
    background-attachment: fixed; /* Fix background position when scrolling */
    background-repeat: no-repeat; /* Prevent background image from repeating */
    color: #fff; /* Default text color for consistency */
    font-family: Arial, sans-serif; /* Clean and modern font */
    margin: 0;
    padding: 0;
}

/* Header and Footer Styling */
header, footer {
    background: rgba(0, 0, 0, 0.8); /* Semi-transparent dark background */
    color: #fff; /* White text for strong contrast */
    text-align: center;
    padding: 20px;
    font-weight: bold;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); /* Subtle shadow for depth */
}

/* Container Styling */
.container {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.7); /* Darkened container for readability */
    border-radius: 12px; /* Rounded corners for a softer feel */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); /* Deep shadow for depth */
}

/* Headings Styling */
h1, h2 {
    color: #FFD700; /* Gold text for highlighting headings */
    font-weight: bold;
}

/* Paragraph Styling */
p {
    color: #ddd; /* Light grey for softer contrast and better readability */
    line-height: 1.8; /* Increase line height for better readability */
    font-size: 1.1em; /* Slightly larger text for comfortable reading */
}

/* Link Styling */
a {
    display: block;
            padding: 15px;
            background-color:  0.3s ease, transform 0.2s ease;
            color: white;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

a:hover {
    color: #0078ff; /* Change to blue on hover for interactivity */
    text-decoration: underline;
}

/* Button Styling */
button {
    background-color: #4ABDAC; /* Matching the calming teal */
    color: #fff;
    padding: 12px 25px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #0078ff; /* Change to blue on hover */
    transform: scale(1.05); /* Subtle scaling effect */
}

/* Form and Input Styling */
input, textarea {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 6px;
    border: 1px solid #ddd;
    background-color: #333;
    color: #fff;
    font-size: 1em;
    transition: border-color 0.3s ease;
}

input:focus, textarea:focus {
    border-color: #FFD700; /* Gold border on focus for emphasis */
    outline: none; /* Remove default outline */
}

/* Responsive Design Adjustments */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 15px;
    }

    h1, h2 {
        font-size: 1.8em; /* Adjust heading size on smaller screens */
    }

    p {
        font-size: 1em; /* Adjust paragraph font size for smaller screens */
    }

    button {
        width: 100%; /* Full-width buttons on smaller screens */
    }
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
