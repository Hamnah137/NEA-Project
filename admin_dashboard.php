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
        // Debugging the product ID
        echo "Attempting to delete product ID: " . $product_id;

        // First, delete related entries in the wishlist table
        $delete_wishlist_query = $conn->prepare("DELETE FROM wishlist WHERE product_id = ?");
        $delete_wishlist_query->bind_param("i", $product_id);
        $delete_wishlist_query->execute();

        // Then, delete the product from the products table
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                echo "Product deleted successfully!";
            } else {
                echo "Error: Product could not be deleted. No rows affected.";
            }
        } else {
            // Output error if the query failed
            echo "SQL Error: " . $stmt->error;
        }
    }
}

// Handle adding new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $image = $_FILES['image']['name']; // Get image file name
    $image_tmp = $_FILES['image']['tmp_name']; // Get temporary file path
    $image_path = 'uploads/' . basename($image); // Set the upload path

    if (!empty($name) && !empty($price)) {
        // Move uploaded image to the 'uploads' directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Insert product into the database
            $stmt = $conn->prepare("INSERT INTO products (name, price, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sds", $name, $price, $image_path);
            $stmt->execute();
        }
    }
}

// Fetch products
$product_query = $conn->query("SELECT * FROM products ORDER BY product_id DESC");

// Fetch orders and their details, joining with the products table to get product names
$order_query = $conn->query("
    SELECT orders.*, orderdetails.*, products.name AS product_name 
    FROM orders
    JOIN orderdetails ON orders.order_id = orderdetails.order_id
    JOIN products ON orderdetails.product_id = products.product_id
    ORDER BY orders.order_date DESC
");

$orders = [];
while ($order = $order_query->fetch_assoc()) {
    // Group orders by order ID and associate products with the order
    $order_id = $order['order_id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'order_id' => $order['order_id'],
            'user_id' => $order['user_id'],
            'total' => $order['total'],
            'order_date' => $order['order_date'],
            'items' => [],
            'calculated_total' => 0 // Variable to calculate the total price of the order
        ];
    }
    $item_price = $order['quantity'] * $order['price']; // Calculate price per item (quantity * price)
    $orders[$order_id]['items'][] = [
        'product_name' => $order['product_name'],
        'quantity' => $order['quantity'],
        'price' => $order['price'],
        'item_total' => $item_price // Add the item total
    ];
    $orders[$order_id]['calculated_total'] += $item_price; // Add to the calculated total for the order
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Product List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $product_query->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['product_id']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td>$<?= number_format($row['price'], 2); ?></td>
                <td><img src="<?= $row['image_path']; ?>" alt="<?= $row['name']; ?>" class="product-image"></td>
                <td>
                    <a href="?delete_product=<?= $row['product_id']; ?>" class="delete-btn">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Orders</h2>
    <?php foreach ($orders as $order_id => $order): ?>
        <div class="order-table">
            <h3>Order ID: <?= htmlspecialchars($order['order_id']); ?></h3>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
                <?php foreach ($order['items'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']); ?></td>
                        <td><?= htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?= number_format($item['price'], 2); ?></td>
                        <td>$<?= number_format($item['item_total'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="total-price">Total Order Price: $<?= number_format($order['calculated_total'], 2); ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
