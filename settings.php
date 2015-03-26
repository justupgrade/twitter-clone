<!DOCTYPE html>

<?php
	//modify accont: change password / delete account / add username
	$page_title = "Settings";

	include_once "./classes/User.php";
	//styles, page title
	include "./includes/header.php"; 

	include_once "./connection.php";

	session_start();

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	} else {
		//redirect:
		header('Location: http://localhost/git/twitter-clone/login.php');
		die();
	}

	//change password;
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBtn'])) {
		//delete button clicked...
		$query = "DELETE FROM users WHERE id=".$user->getID();
		$conn->query($query);

		$user = null;
		unset($_SESSION['user']);
		session_destroy();

		echo "Account removed.";

		header('refresh: 2, url=http://localhost/git/twitter-clone/index.php');
		die();
	}
?>
<?php
	include "./includes/nav.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassBtn'])) {
		$password = $_POST['password'];
		$new = $_POST['new'];
		$repeat = $_POST['repeat'];

		if($new != $repeat || strlen(trim($password)) < 4 || strlen(trim($new)) < 4) {
			echo "<p class='invalid-data'> Invalid data! Try again.</p>";
		} else {
			//current password valid?
			$query = "SELECT * FROM users WHERE email='".$user->getEmail()."'";
			$result = $conn->query($query);

			if(!$result) echo invalidDataMsg();
			else {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$hashed = $row['password'];
				$result->close();

				if(password_verify($password, $hashed)) {
					$options = [
						'cost' => 5,
						'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
					];
					$new_hased = password_hash($new, PASSWORD_BCRYPT, $options);

					$query = "UPDATE users SET password='".$new_hased."' WHERE ";
					$query .= "id=" . $user->getID();

					$result = $conn->query($query);
					if(!$result) {
						echo invalidDataMsg();
					} else {
						echo "<p class='success'> Password changed successfully!</p>";
					}
				}
			}
		}
	}

	function invalidDataMsg() {
		return "<p class='failure'> Invalid data. Try again. </p>";
	}


?>
<fieldset>
	<legend>Chnage password</legend>
	<form action='' method='post'>
	<p><pre><label>Current Password:	</label></pre><input type='password' name='password' required></p>
	<p><pre><label>New Password:		</label></pre><input type='password' name='new' required></p>
	<p><pre><label>Repeat Password:		</label></pre><input type='password' name='repeat' required></p>
	<input style='font-weight:bold; background: #16CC32; border: 2px solid green;' type='submit' name='changePassBtn' value='Change!'>
</form>
</fieldset>



<fieldset>
	<legend>Delete Account:</legend>
	<form action='' method='post'>
		<input id='deleteBtn' name='deleteBtn' style='font-weight: bold; background: orange; border: 2px solid red' type='submit' value='Delete'>
		<label> remove your account permanently.</label>
	</form>
</fieldset>

<script>
window.onload = function() {
	var deleteBtn = document.getElementById('deleteBtn');
	deleteBtn.addEventListener('click', onDeleteBtnClick);

	function onDeleteBtnClick(e) {
		
		
		var userResponse = window.confirm("Account will be deleted! Are you sure?");

		if(userResponse) {
			//delete account...
		} else {
			e.preventDefault();
		}
	}
}

</script>