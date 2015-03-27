<!DOCTYPE html>
<?php
	$page_title = "User Deatails";

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

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		//VALIDATE?
		if(isset($_POST['showUserDetails'])) {
			$newUser = new User($_POST['id'], $_POST['email']);
			$_SESSION['new_user'] = $newUser;
		}
	}

	if(isset($_SESSION['new_user'])) {
		$newUser = $_SESSION['new_user'];

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			//VALIDATE?
			if(isset($_POST['addFriendBtn'])) {
				$userID = $user->getID();
				$friendID = $newUser->getID();

				addFriend($conn,$userID,$friendID);
			} elseif(isset($_POST['removeFriendBtn'])) {
				$userID = $user->getID();
				$friendID = $newUser->getID();

				removeFriend($conn, $userID, $friendID);
			}
		}
	}
	else {
		//redirect...
		header('Location: http://localhost/git/twitter-clone/index.php');
		die();
	}

	function removeFriend($conn, $uID, $fID) {
		$query = "DELETE FROM friends WHERE (user_id=".$uID. " AND friend_id=".$fID;
		$query .= ") OR (user_id=".$fID ." AND friend_id=" . $uID .")";

		$conn->query($query);

		if(!$conn->query($query)) echo "Error: " .  $conn->error;
	}

	function addFriend($conn,$uID,$fID) {
		$query = "INSERT INTO friends(user_id,friend_id) VALUES (";
		$query .= $uID . "," . $fID . "),(";
		$query .= $fID . "," . $uID . ")";

		if(!$conn->query($query)) echo "Error: " .  $conn->error;
	}

	function alreadyAFriend($conn,$uID,$fID) {
		$query = "SELECT * FROM friends WHERE user_id=".$uID; 
		$result = $conn->query($query);

		if(!$result) echo "Error: " . $conn->error();
		else {
			if($result->num_rows > 0) {
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					if($row['friend_id'] == $fID) return true;
				}
			} else {
				return false;
			}
		}

		return false;
	}

	//display user profile:
	echo "Profile of user: <strong>" . $newUser->getEmail() . "</strong><br>";

	//display posts:
	$query = "SELECT id,title,content FROM posts WHERE posts.user_id=".$newUser->getID();
	$query .= " ORDER BY id DESC";
	$result = $conn->query($query);

	if(!$result) {
		echo "no records...";
	} else {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<form class='post' method='post' action='post.php'>";
			echo "<input name='postBtn' type='submit' value=" . $row['title'] . "><br>";
			echo "<input type='hidden' name='post_id' value='".$row['id']."'>";
			echo "<span>" . $row['content'] . "</span>";
			echo "</form>";
		}
	}
?>

<?php if($user->getID() != $newUser->getID()) {
		echo <<< END
		<form action='messages.php' method='post'>
			<input class='send-msg' type='submit' value='Send Message' name='sendMsgBtn'>
		</form>
END;
	}
	if(!alreadyAFriend($conn,$user->getID(),$newUser->getID()) && $user->getID() != $newUser->getID()) {
		echo <<< END
		<form action='' method='post'>
			<input class='add-friend' type='submit' value='Add Friend' name='addFriendBtn'>
		</form>
END;
	} elseif(alreadyAFriend($conn,$user->getID(),$newUser->getID())) {
		echo <<< END
		<form action='' method='post'>
			<input class='remove-friend' type='submit' value='Remove Friend' name='removeFriendBtn'>
		</form>
END;
	}


?>