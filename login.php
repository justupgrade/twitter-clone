<?php
	include './classes/User.php';
	include './connection.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['email']) && isset($_POST['password'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = "SELECT * FROM users WHERE email='".$email."'";
			$result = $conn->query($query);

			if(!$result) echo invalidDataMsg();
			else {
				if($result->num_rows > 0) {
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$hashed = $row['password'];

					if(password_verify($password, $hashed)) {
						echo "<p class='success'> Account Created! <small> You'll be redirected in a moment...</small></p>";
						//login:
						session_start();
						$user = new User($row['id'], $email);
						$_SESSION['user'] = $user;
						header("refresh:2, url=http://localhost/git/twitter-clone/index.php");
						die();
					} else {
						 echo invalidDataMsg();
					}
				} else {
					echo invalidDataMsg();
				}
			}
		}
	}

	function invalidDataMsg() {
		return "<p class='failure'> Invalid data. Try again. </p>";
	}
?>


<fieldset>
	<form action='' method='post'>
	<p><pre><label>Email:   </label></pre><input type='text' name='email' required></p>
	<p><pre><label>Password:</label></pre><input type='password' name='password' required></p>
	<input type='submit' value='Send'>
</form>
</fieldset>

<a href='register.php'>Create Account</a>