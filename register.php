<!DOCTYPE html>
<?php 
	include './includes/header.php'; 
	include './classes/User.php';
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repeat'])) {
			$password = $_POST['password'];
			$email = $_POST['email'];
			$repeat = $_POST['repeat'];

			if($password != $repeat || strlen(trim($password)) < 4) {
				echo "<p class='invalid-data'> Invalid data! Try again.</p>";
			} else {
				//add to db
				$options = [
					'cost' => 5,
					'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
				];
				$hased = password_hash($password, PASSWORD_BCRYPT, $options);

				include 'connection.php';
				$query = 'INSERT INTO users (email,password) ';
				$query .= "VALUES ('".$email."',";
				$query .= "'" . $hased . "')";

				$result = $conn->query($query);


				if($result){
					echo "<p class='success'> Account Created! <small> You'll be redirected in a moment...</small></p>";
					//login:
					session_start();
					$id = $result->insert_id;
					$user = new User($id, $email);
					$_SESSION['user'] = $user;
					header("refresh:2, url=http://localhost/git/twitter-clone/index.php");
					die();
				} 
				else echo "<p class='failure'> Error! Try again! </p>";
			}
		}
	}
?>
<fieldset>
	<legend>Create Account</legend>
	<form action='' method='post'>
	<p><pre><label>Email:  		 	</label></pre><input type='text' name='email' required></p>
	<p><pre><label>Password:		</label></pre><input type='password' name='password' required></p>
	<p><pre><label>Repeat Password:	</label></pre><input type='password' name='repeat' required></p>
	<input type='submit' value='Create!'>
</form>
</fieldset>