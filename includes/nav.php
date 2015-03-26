<body>
	<div id="welcome-cont"> <?php echo isset($user) ? "Hello, " . $user->getEmail() : "..." ?> </div>
	<?php
		if($page_title != "Logout") {
			echo <<< 'END'
			<div id="logout-cont"><a href='logout.php'>Logout</a></div>
	
			<nav>
				<ul>
					<li><a href='index.php'>Home</a></li>
					<li><a href='friends.php'>Friends</a></li>
					<li><a href='settings.php'>Settings</a></li>
				</ul>
			</nav>
END;
		}
	echo "<hr>";
	?>