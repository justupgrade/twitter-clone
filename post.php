<!DOCTYPE html>
<?php
	
	$page_title = "Post Details";

	include_once "./classes/User.php";
	include_once "./classes/Post.php";
	include_once "./classes/Comment.php";
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

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postBtn'])) { //no post clicked? refreshed?
		$postID = $_POST['post_id'];

		$query = "SELECT * FROM posts WHERE id=".$postID;
		$result = $conn->query($query);

		if(!$result) { //no result...
			echo "Error: ";
			header('Location: http://localhost/git/twitter-clone/login.php');
			die();
		} else {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$post = new Post($row['id'], $row['title'], $row['content']);
			$_SESSION['last_post'] = $post;
			echo $post->displayPlain();

			loadComments($conn,$post->getID(),$user->getID());
		}

		//add comment form:
		echo Comment::displayCommentForm();
		
	} elseif( isset($_SESSION['last_post']) ) {
		$post = $_SESSION['last_post'];
		echo $post->displayPlain();
		loadComments($conn,$post->getID(),$user->getID());
		echo Comment::displayCommentForm();
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addComment'])) {
		$user = $_SESSION['user'];
		$content = $_POST['content'];
		addComment($conn, $post->getID(), $content, $user->getID());
	}

	function loadComments($conn, $postID, $userID) {
		$query = "SELECT comments.commented_on, comments.content, users.email ";
		$query .= " FROM comments LEFT JOIN users ON comments.user_id=users.id WHERE ";
		//$query .= " WHERE users.id=".$userID." AND 
		$query .= "comments.post_id=".$postID;
		$query .= " ORDER BY commented_on DESC";

		$result = $conn->query($query);

		if(!$result) {
			echo $conn->error;
		} else {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$comment = new Comment($row['commented_on'], $row['email'], $row['content']);
				//$comments[] = $comment;
				echo $comment->displayPlain();
			}

		}
	}

	
	function addComment($conn, $postID, $content, $userID) {
		$query = "INSERT INTO comments (post_id,commented_on,content,user_id) ";
		$query .= " VALUES( " . $postID . ",";
		$query .= " NOW(), ";
		$query .= "'" . $content . "',";
		$query .= $userID . ")";

		$result = $conn->query($query);
		if(!$result) {
			echo "Error";
		} else {
			//loadComments($conn,$postID,$userID );
			header('Location: http://localhost/git/twitter-clone/post.php');
		}
	}

?>