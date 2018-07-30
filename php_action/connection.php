<?php
	// Create connection
	$conn = mysqli_connect("127.0.0.1", "root", "", "evaluation_system");
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>
