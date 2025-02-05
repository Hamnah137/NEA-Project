<?php
include 'header.php';
// Start the Session
session_start();
require('db.php');

// If the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Assigning posted values to variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Checking the values are existing in the database
    $query = "SELECT * FROM users WHERE username='$username' and password='$password'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);

    // If the posted values match the database values, create a session for the user
    if ($count == 1) {
        // Fetch user info, including user_id
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row['user_id'];  // Store user_id in the session
    } else {
        // If login credentials don't match, show an error message
        $fmsg = "Invalid Login Credentials.";
    }
}

// If the user is logged in, greet them
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hi " . $username . "!";
    echo " You are now logged in.";
    echo "<br><a href='index.php'> Home</a><a href='dashboard.php'> Dashboard</a><a href='logout.php'> Logout</a>";
} else {
    // Display login form if not logged in
?>
    <html>
    <head>
        <title>User Login Using PHP & MySQL</title>
        <meta name="robots" content="noindex" />
    </head>
    <body>
    <div class="container">
        <form class="form-signin" method="POST">
            <?php if(isset($fmsg)) { ?>
                <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div>
            <?php } ?>
            <h2 class="form-signin-heading">Please Login</h2>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">@</span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
        </form>
    </div>
    </body>
    </html>
<?php } ?>
