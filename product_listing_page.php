<?php
require('db.php'); // Ensure this contains the database connection logic
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Shop Products</h1>
        <div class="row">
            <?php
            // Fetch and display products
            $result = $db->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '   <div class="thumbnail">';
                echo '       <img src="'.$row['image_url'].'" alt="'.$row['name'].'">';
                echo '       <div class="caption">';
                echo '           <h3>'.$row['name'].'</h3>';
                echo '           <p>$'.$row['price'].'</p>';
                echo '           <p><a href="add_to_cart.php?product_id='.$row['id'].'&product_name='.urlencode($row['name']).'&product_price='.$row['price'].'" class="btn btn-primary">Add to Cart</a></p>';
                echo '       </div>';
                echo '   </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>

