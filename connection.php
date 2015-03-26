<?php
	$host = 'localhost';
	$user = 'justupgrade';
	$pass = 'test';
	$db = 'twitter_clone';

	$conn = new mysqli($host,$user,$pass,$db);
	if($conn->connect_error) die("Connection error: " . $conn->connect_error);
?>
