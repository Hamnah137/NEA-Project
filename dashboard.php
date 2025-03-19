<!-- Code for user's profile -->

<?php
// Set the timezone
date_default_timezone_set('Europe/London'); // Replace with your timezone
session_start();
include('header.php');
include('db.php'); // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user information from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE user_id = ?"; // Assuming 'user_id' is the correct column name

// Check if the prepare statement works
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    // Print out the error if prepare fails
    die('MySQL prepare error: ' . $conn->error);
}

// Bind the user_id parameter
$stmt->bind_param("i", $user_id);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if there was an issue fetching the result
if (!$result) {
    die('Error fetching result: ' . $conn->error);
}

$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit();
}

// Display user details
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Times New Roman', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 36px;
        }

        main {
            width: 80%;
            max-width: 1100px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            animation: fadeIn 1s ease-in-out;
        }

        .user-profile {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .profile-card {
            display: flex;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 900px;
            background-color: #fff;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .profile-card .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            transition: transform 0.3s ease;
        }

        .profile-card .profile-img:hover {
            transform: scale(1.1);
        }

        .profile-card .details {
            padding: 20px;
            max-width: 600px;
            flex-grow: 1;
        }

        .profile-card .details p {
            font-size: 18px;
            margin: 10px 0;
        }

        .profile-card .details strong {
            font-weight: bold;
        }

        /* Stylish 'Your Actions' Section */
        .user-actions {
            text-align: center;
            margin-top: 40px;
        }

        .user-actions h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: 600;
        }

        .user-actions ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .user-actions li {
            margin: 15px 0;
            width: 250px;
        }

        .user-actions li a {
            display: block;
            padding: 15px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-actions li a:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .user-actions li a:active {
            transform: translateY(2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .edit-profile-btn {
            margin-top: 30px;
            padding: 14px 25px;
            font-size: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-profile-btn:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: #fff;
            font-size: 16px;
            margin-top: 60px;
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            main {
                width: 90%;
            }

            .profile-card {
                flex-direction: column;
                text-align: center;
            }

            .profile-card .profile-img {
                margin-bottom: 20px;
            }

            .user-actions h2 {
                font-size: 24px;
            }

            .user-actions li a {
                font-size: 16px;
            }
        }
        body {
    background-image: url('images/background.jpg'); /* Path to your image */
    background-size: cover; /* Ensures the image covers the whole screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed while scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}

    </style>
</head>
<body>

<main>
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>

    <div class="user-profile">
        <div class="profile-card">
            <img src="images/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" class="profile-img">
            <div class="details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Joined on:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
            </div>
        </div>
    </div>

    <section class="user-actions">
        <h2>Your Actions</h2>
        <ul>
            <li><a href="edit_profile.php">Edit Profile</a></li>
            <li><a href="orders.php">View Order History</a></li>
            <li><a href="reviews.php">Your Reviews</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li><a href="wishlist.php">Your Wishlist</a></li>
        </ul>
    </section>
</main>

<?php require('footer.php'); // Include the footer file ?>

</body>
</html>

<?php
// Close database connection
$stmt->close();
$conn->close();
?>
