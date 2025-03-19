<!-- Code to identify the user -->

<?php
	session_start();
	if(!isset($_SESSION['username'])){
	   header("Location:login.php");
	}
	?>