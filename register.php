<?php
	require('db.php');

	// If the values are posted, insert them into the database.
	if (isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Handle image upload
		if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
			$target_dir = "uploads/";  // Directory to store uploaded files
			$target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// Check if file is an image
			if (getimagesize($_FILES["profile_image"]["tmp_name"]) !== false) {
				// Move the uploaded file to the target directory
				if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
					$image_path = $target_file; // Save the file path in the database
				} else {
					$image_path = ''; // If the upload failed
				}
			} else {
				$image_path = ''; // Not an image file
			}
		} else {
			$image_path = ''; // No file uploaded
		}

		// Insert user into the database with the image path
		$sql = "INSERT INTO users (username, password, email, profile_image)
		VALUES ('$username', '$password', '$email', '$image_path')";

		if (mysqli_query($conn, $sql)) {
			echo "<center><h3>New record created successfully!<br/>Click here to <a href='login.php'>Login</a></h3></center>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>

<html>
<head>
	<?php include 'header.php'; ?>
	<meta name="robots" content="noindex" />
</head>
<body>

<div class="container">
	<form class="form-signin" method="POST" enctype="multipart/form-data">
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
		<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<h2 class="form-signin-heading">Please Register</h2>

		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">@</span>
			<input type="text" name="username" class="form-control" placeholder="Username" required>
		</div>

		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

		<label for="profile_image" class="sr-only">Profile Image</label>
		<input type="file" name="profile_image" id="profile_image" class="form-control">

		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
</div>

</body>
</html>
