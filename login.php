<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST') {

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