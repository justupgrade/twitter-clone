<!DOCTYPE html>
<?php
	
	$page_title = "Post Details";

	include_once "./classes/User.php";
	include_once "./classes/Post.php";
	//styles, page title
	include_once "./includes/header.php";

	include_once "./connection.php";

	session_start();

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		//redirect:
		header('Location: http://localhost/git/twitter-clone/login.php');
		die();
	}

	include_once "./includes/nav.php";

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$postID = $_POST['post_id'];

		$query = "SELECT * FROM posts WHERE id=".$postID;
		$result = $conn->query($query);

		if(!$result) {
			echo "Error: ";
			header('Location: http://localhost/git/twitter-clone/login.php');
			die();
		} else {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$post = new Post($row['id'], $row['title'], $row['content']);
			echo $post->displayPlain();
		}
	}

?>