<?php
	include_once "./classes/User.php";

	session_start();

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		echo "Logged in as: " . $user->getEmail();
	} else {
		//redirect:
		header('Location: http://localhost/www/template/login.php');

	}
?>
