<!-- Code for the connection with database -->

<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "db_1";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	?>