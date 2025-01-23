<?php
require('db.php');
$query = $_GET['query'];
$sort = $_GET['sort'];

$sort_query = $sort === 'price_asc' ? 'ORDER BY price ASC' : 'ORDER BY price DESC';
$sql = "SELECT * FROM products WHERE name LIKE '%$query%' $sort_query";
$result = mysqli_query($conn, $sql);

while ($product = mysqli_fetch_assoc($result)) {
    echo "<p>{$product['name']} - $ {$product['price']}</p>";
}
?>
