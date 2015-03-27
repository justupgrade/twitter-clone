<!DOCTYPE html>
<?php
	$page_title = "Message Details";

	include_once "./classes/User.php";
	include_once "./classes/Message.php";
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
		$id = $_POST['id'];
		$receiver = $_POST['receiver'];

		$message = $_SESSION['msgs'][$id];
		$_SESSION['current_msg'] = $message;

		if($receiver == 'true') {
			$query = "UPDATE messages SET is_new=FALSE WHERE id=".$message->getID();
			if(!$conn->query($query)) echo "Error: " . $conn->error;
		}
		

	} elseif(isset($_SESSION['current_msg'])) {
		$message = $_SESSION['current_msg'];
	} else {
		header('Location: http://localhost/git/twitter-clone/index.php');
		die();
	}
?>

<label><pre>From: 	<strong><?php echo $message->getSender(); ?></strong> </label></pre>
<label><pre>To:	<strong><?php echo $message->getReceiver(); ?></strong></label></pre>
<div id='msg-details'> <?php echo $message->getMessage(); ?> </div>