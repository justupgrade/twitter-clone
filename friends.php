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

	$query = "SELECT friend_id FROM friends WHERE user_id=".$user->getID();
	$result = $conn->query($query);
	if(!$result) echo "Error...";
	else {
		$rows = $result->num_rows;
		if($rows > 0) {
			echo "<div id='users-info'> Friends: </div>";
			for($i = 0; $i < $rows; $i++) {
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$friend_id = $row['friend_id'];


				displayFriend($conn,$friend_id);
			}
		}
	}

	function displayFriend($conn, $friend_id) {
		$query = "SELECT * FROM users WHERE id=".$friend_id;
		$result = $conn->query($query);

		
		echo "<div class='friend-search'>";

		if(!$result) echo "Error: " . $conn->error;
		else {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				echo "<form method='post' action='user.php'>";
				echo "<input name='showUserDetails' type='submit' class='friend-email' value='" . $row['email'] . "'>";
				echo "<input type='hidden' name='id' value='".$row['id']."'>";
				echo "<input type='hidden' name='email' value='".$row['email']."'>";
				echo "</form>";
			}
		}

		echo "</div>";
	}
	
?>
