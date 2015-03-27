<!DOCTYPE html>
<?php //load all users ?>
<?php
	$page_title = "Users";

	include_once "./classes/User.php";
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

	$query = "SELECT * FROM users ";
	$result = $conn->query($query);

	echo "<div id='users-info'> Users: </div>";
	echo "<div class='user-search'>";

	if(!$result) echo "Error: " . $conn->error;
	else {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<form method='post' action='user.php'>";
			echo "<input name='showUserDetails' type='submit' class='user-email' value='" . $row['email'] . "'>";
			echo "<input type='hidden' name='id' value='".$row['id']."'>";
			echo "<input type='hidden' name='email' value='".$row['email']."'>";
			echo "</form>";
		}
	}

	echo "</div>";

?>
