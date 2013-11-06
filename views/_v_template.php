<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
		<!-- JS/CSS file to be applied to every page -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	
		<!-- JS/CSS specific to controller -->
		<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
	</head>

	<body>
		<nav>
			<menu>
					<li><a href='/'>Home</a></li>
				<?php if($user): ?>
					<li><a href='/posts/add'>Add A Post</a></li>
					<li><a href='/posts/'>View Posts</a></li>
					<li><a href='/posts/users'>Follow Users</a></li>
					<li><a href='/users/logout'>Log Out</a></li>
				<?php else: ?>
					<li><a href='/users/signup'>Sign Up</a></li>
					<li><a href='users/login'>Log In</a></li>
				<?php endif; ?>
			</menu>
		</nav>

		<?php if($user): ?>
			You're logged in as <?=$user->first_name?> <?=$user->last_name?>.<br>
		<?php endif; ?>

		<br>

		<?php if(isset($content)) echo $content; ?>

		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</body>
</html>
