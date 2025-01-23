<?php
session_start();

// Dummy payment logic (you can integrate a payment gateway here)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart']); // Clear the cart
    header('Location: payment_success.php');
    exit();
}
?>
