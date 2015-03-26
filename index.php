<!DOCTYPE html>
<?php
	$page_title = "Home";

	include_once "./classes/User.php";
	//styles, page title
	include_once "./includes/header.php"; 

	session_start();

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		//redirect:
		header('Location: http://localhost/git/twitter-clone/login.php');
		die();
	}

	include_once "./includes/nav.php";
	//user posts section
	include_once "./includes/user_post_section.php";
	//friends posts section
	include_once "./includes/firends_posts_section.php";
	//footer
	include_once "./includes/footer.php";

?>
