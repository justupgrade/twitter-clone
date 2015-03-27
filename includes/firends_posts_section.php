<?php
	include_once './classes/User.php';
	include_once './connection.php';

	$userID = $_SESSION['user']->getID();

	//get friend id:
	$query = "SELECT friend_id FROM friends WHERE user_id=".$userID;
	$result = $conn->query($query);

	if(!$result) echo "Error : " . $conn->error();
	else
	{
		$rows = $result->num_rows;
		if($rows > 0) {
			for($i = 0; $i < $rows; $i++) {
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$fID = $row['friend_id'];

				displayPosts($conn, $fID);
			}
		}
	}

	function displayPosts($conn, $fID) {
		$query = "SELECT posts.id as id,title,content,email FROM posts JOIN users ON users.id=posts.user_id ";
		$query .= " WHERE users.id=".$fID;
		$query .= " ORDER BY id DESC";

		$result = $conn->query($query);

		if(!$result) {
			echo "error..." . $conn->error;
		} else {
			$count=0;
			//
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if($count===0) echo "<p> Posts by <strong>" . $row['email'] . ":</strong></p>";
				echo "<form class='post' method='post' action='post.php'>";
				echo "<input name='postBtn' type='submit' value=" . $row['title'] . "><br>";
				echo "<input type='hidden' name='post_id' value='".$row['id']."'>";
				echo "<span>" . $row['content'] . "</span>";
				echo "</form>";
				$count++;
			}
		}
	}

?>