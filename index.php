<!DOCTYPE html>
<?php
	$page_title = "Home";

	include_once "./classes/User.php";
	//styles, page title
	include "./includes/header.php"; 

	session_start();

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		//redirect:
		header('Location: http://localhost/git/twitter-clone/login.php');

	}

	include "./includes/nav.php";
	//user posts section
	include "./includes/user_post_section.php";
	//friends posts section
	include "./includes/firends_posts_section.php";
	//footer
	include "./includes/footer.php";

?>
