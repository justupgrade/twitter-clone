<?php
	include_once './classes/User.php';
	include_once './connection.php';

	$id = $_SESSION['user']->getID();


	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['title']) && isset($_POST['content'])) {
			$title = $_POST['title'];
			$content = $_POST['content'];

			$query = "INSERT INTO posts (title,content,user_id) VALUES (";
			$query .= "'".$title."',";
			$query .= "'".$content."',";
			$query .= $id . ")";

			$result = $conn->query($query);
			if(!$result) {
				//error...
			} 
		}
	}



	//display all posts:
	$query = "SELECT id,title,content FROM posts WHERE posts.user_id=".$id;
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


<fieldset>
	<legend>Add Post</legend>
	<form action='' method='post'>
		<pre><p><label>Title:</label>	<input type='text' name='title' required></p></pre>
		<pre><label>Content:</label>
	<textarea name='content' cols='100' rows='5'></textarea></pre>
		<input type='submit' value='Send'>
	</form>
</fieldset>