<?php
session_start();

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

$total = array_sum(array_column($_SESSION['cart'], 'price'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <p>Total Amount: $<?php echo number_format($total, 2); ?></p>
        <form action="process_payment.php" method="post">
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" name="cardNumber" id="cardNumber" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" name="expiryDate" id="expiryDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" name="cvv" id="cvv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</body>
</html>
