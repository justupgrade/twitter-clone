<!DOCTYPE html>
<?php
	$page_title = "Logout";

	//styles, page title
	//include "./includes/header.php"; 

	//include "./includes/nav.php";

	session_start();
	session_destroy();

	echo "Logged out successfully!";

	header("refresh: 2, url=http://localhost/git/twitter-clone/index.php");
?>