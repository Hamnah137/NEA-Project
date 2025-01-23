<?php
session_start();

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Re-index the array to maintain proper order
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header("Location: cart_display.php");
exit();
?>

