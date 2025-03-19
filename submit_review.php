<!-- Code for submitting reviews -->

<?php
session_start();
require('db.php'); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>Error: You must be logged in to submit a review.</p>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $user_id = $_SESSION['user_id'];
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $review = isset($_POST['comment']) ? mysqli_real_escape_string($conn, $_POST['comment']) : '';

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        echo "<p>❌ Error: Please select a valid rating between 1 and 5.</p>";
        exit;
    }

    // Check if it's a product review
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);

        $query = "INSERT INTO product_reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("❌ Database Error (Prepare): " . $conn->error);
        }

        $stmt->bind_param("iiis", $product_id, $user_id, $rating, $review);

        if ($stmt->execute()) {
            header("Location: product_details.php?id=" . $product_id);
            exit;
        } else {
            echo "❌ Error submitting product review: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Site review section
        $query = "INSERT INTO site_reviews (user_id, rating, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("❌ Database Error (Prepare): " . $conn->error);
        }

        $stmt->bind_param("iis", $user_id, $rating, $review);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "❌ Error submitting site review: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-size: 1.1em;
            color: #555;
            display: block;
            margin-bottom: 10px;
        }
        .stars {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .star {
            font-size: 2.5em;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .star.selected {
            color: #f39c12;
        }
        .stars input {
            display: none;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .submit-btn {
            background-color: #e67e22;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #d35400;
        }
        .error-message {
            color: red;
            font-size: 1.2em;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Submit Your Review</h1>

    <!-- Review Form -->
    <form action="submit_review.php<?php echo isset($_GET['product_id']) ? '?product_id=' . $_GET['product_id'] : ''; ?>" method="POST">
        <div class="form-group">
            <label for="rating">Rating:</label>
            <div class="stars">
                <input type="radio" name="rating" value="1" id="star1">
                <label for="star1" class="star">&#9733;</label>

                <input type="radio" name="rating" value="2" id="star2">
                <label for="star2" class="star">&#9733;</label>

                <input type="radio" name="rating" value="3" id="star3">
                <label for="star3" class="star">&#9733;</label>

                <input type="radio" name="rating" value="4" id="star4">
                <label for="star4" class="star">&#9733;</label>

                <input type="radio" name="rating" value="5" id="star5">
                <label for="star5" class="star">&#9733;</label>
            </div>
        </div>

        <div class="form-group">
            <label for="review">Your Comment:</label>
            <textarea id="review" name="review" rows="5" required></textarea>
        </div>

        <input type="hidden" name="product_id" value="<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : ''; ?>">

        <div class="form-group">
            <button type="submit" class="submit-btn">Submit Review</button>
        </div>
    </form>
</div>

<script>
    // JavaScript for star rating selection
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            stars.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('star' + (index + 1)).checked = true;
        });
    });
</script>

</body>
</html>
