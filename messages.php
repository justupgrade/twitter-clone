<!DOCTYPE html>
<?php 
	//new message form:
	//display messages

 	$page_title = "Send Message";

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
	$receiver_email = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['sendMsgBtn'])) { //get user data from session...
			$receiver = $_SESSION['new_user'];
			$receiver_email = $receiver->getEmail();
		} elseif(isset($_POST['sendMessage'])) {
			if(isset($_SESSION['new_user'])) {
				$content = $_POST['content'];
				$receiver = $_SESSION['new_user'];
				sendMessage($conn, $user,$receiver,$content);
			}
		}
	} 

	if(isset($_SESSION['new_user'])) {
		$receiver = $_SESSION['new_user'];
		$receiver_email = $receiver->getEmail();
	}

	include_once "./includes/nav.php";


	function sendMessage($conn, $sender,$receiver,$content) {
		$query = "INSERT INTO messages (sender_id, receiver_id, content) VALUES (";
		$query .= $sender->getID() . "," . $receiver->getID() . ",";
		$query .= "'" . $content . "')";
		
		$result = $conn->query($query);
		if(!$result) {
			echo "Erorr: " . $conn->error;
		} else {
			echo "Message sent!";
		}
	}

	function getAllMessagesSent($conn,$user) {
		$query = "SELECT messages.id as messageID, messages.is_new as is_new, users.email as sender, receivers.email as receiver, messages.content as message ";
		$query .= "FROM messages JOIN users ON messages.sender_id=users.id ";
		$query .= " JOIN users as receivers ON receiver_id=receivers.id WHERE ";
		$query .= " messages.sender_id=" . $user->getID();

		$result = $conn->query($query);
		if(!$result) echo "Error " . $conn->error;

		$messages = array();
		$idx = 0;

		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$message = new Message($row['sender'], $row['receiver'], $row['message'], $row['messageID']);
			$messages[] = $message;
			$msg = $row['message'];
			if(strlen($msg) > 20 ) $msg = substr($msg, 0, 20) . "...";

			$is_new = $row['is_new'];
			if($is_new == true) {
				echo "<form action='message.php' method='post' class='inbox-msg'>";
				echo "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
				echo "<input type='hidden' name='id' value='".$idx ."'>";
			} else {
				echo "<form action='message.php' method='post' class='inbox-msg'>";
				echo "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
				echo "<input type='hidden' name='id' value='".$idx ."'>";
			}

			echo "<input type='hidden' name='receiver' value='false'>";
			echo "</form>";

			$idx++;
		}

		if(count($messages)>0) $_SESSION['msgs'] = $messages;
	}

	function getAllMessages($conn, $user) {
		$query = "SELECT messages.id as messageID, messages.is_new as is_new, users.email as sender, receivers.email as receiver, messages.content as message ";
		$query .= "FROM messages JOIN users ON messages.sender_id=users.id ";
		$query .= " JOIN users as receivers ON receiver_id=receivers.id WHERE ";
		$query .= " messages.receiver_id=" . $user->getID();
		$query .= " ORDER BY is_new DESC";

		$result = $conn->query($query);
		if(!$result) echo "Error " . $conn->error;

		$messages = array();
		$idx = 0;

		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$message = new Message($row['sender'], $row['receiver'], $row['message'], $row['messageID']);
			$messages[] = $message;
			$msg = $row['message'];
			if(strlen($msg) > 20 ) $msg = substr($msg, 0, 20) . "...";

			$is_new = $row['is_new'];
			echo "<form action='message.php' method='post' class='inbox-msg'>";

			if($is_new == true) {
				echo "<input type='submit' class='inbox-msg-input' value='" . $msg . "'>";
			} else {
				echo "<input type='submit' class='inbox-msg-input-not-new' value='" . $msg . "'>";
			}
			echo "<input type='hidden' name='id' value='".$idx ."'>";
			echo "<input type='hidden' name='receiver' value='true'>";
			echo "</form>";

			$idx++;
		}

		if(count($messages)>0) $_SESSION['msgs'] = $messages;
	}
?>
<div class='inbox'> 
	<form action='' method='post' ><input class='inbox-input' type='submit' name='inbox_input' id='inbox_input' value='inbox'></form>
	<form action='' method='post' ><input class='sent-input' type='submit' name='sent_input' id='sent_input' value='sent'></form>
	<?php 

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(isset($_POST['sent_input'])) getAllMessagesSent($conn,$user);
			else getAllMessages($conn, $user);
		} else {
			getAllMessages($conn, $user);
		}

	?>
</div>

<fieldset>
<form method='post' action=''> 
	<label> To: </label> <input type='text' name='receiver' id='receiverID' value='<?php echo $receiver_email; ?>'> <br>
	<textarea cols='30' id='content_text' name='content'></textarea>
	<input  type='submit' value='send' id='submitBtn' name='sendMessage'>
</form>

</fieldset>

<script> 
	//receiver = null -> prevent form onSubmit
	var sumbitBtn = document.getElementById('submitBtn');
	submitBtn.addEventListener('click', onSubmitBtnClick);

	function onSubmitBtnClick(e) {
		var receiver = '<?php echo $receiver->getEmail(); ?>';
		if(receiver.trim() === "") {
			alert('Receiver NULL!');
			e.preventDefault();
		}
		var sender = '<?php echo $user->getEmail(); ?>';

		if(sender.trim() == receiver.trim()) {
			alert('You cannot send message to yourself!');
			e.preventDefault();
		}

		var content = document.getElementById('content_text').value;

		if(content.trim().length < 10 || content.trim().length > 100) {
			alert("Wrong message length!");
			e.preventDefault();
		}

		
	}
</script>
