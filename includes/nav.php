<body>
	<div id="welcome-cont"> <?php echo $user->getEmail(); ?> </div>
	<div id="logout-cont"><a href='logout.php'>Logout</a></div>
	<nav>
		<ul>
			<li><a href='index.php'>Home</a></li>
			<li><a href='friends.php'>Friends</a></li>
			<li><a href='settings.php'>Settings</a></li>
		</ul>
	</nav>
	<hr>