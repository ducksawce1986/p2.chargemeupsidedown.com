<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- CSS And Javascript -->
		<link rel="stylesheet" href="/css/template.css" type="text/css">
		
	<!-- CSS and Javascript Specific To Controller -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
	</head>

	<body>
			<div class="header">
				<div class="header_links">
				<!-- Menu Options For New Users Vs. Returning Users -->
					<?php if(!$user): ?>
						<a href='/users/signup'>SignUp</a>
					<?php else: ?>
						<a href='/users/logout'>LogOut</a>
					<?php endif; ?>
				</div>
				<h1><a href='/'>ChargeMeUP</a></h1>
			</div>

			<div class="container">
			<!-- Menu Visible To Users Logged In -->
				<?php if($user): ?>
					<ul id ="menu">
						<li><a href='/posts/add'>Speak Up </a></li>
						<li><a href='/posts/'>View Posts </a></li>
						<li><a href='/posts/users'>Follow Users </a></li>
						<li><a href='/users/profile'>My Profile </a></li>
						<li><a href='/users/upload'>Avatar + Stats</a></li>
						<li class="break"></li>
					</ul>
				<?php endif; ?>
				<div class="infobox">
					<?php if(isset($content)) echo $content; ?>
					<?php if(isset($client_files_body)) echo $client_files_body; ?>
				</div>
			</div>

			<div class="footer">
				<p>Charge Me UP's +1 features:</p>
				<ul>
					<li>Ability to Delete a Post</li>
					<li>Ability to Upload a Profile Pic</li>
					<li>Ability to View Date of User Subscription<li>
				</ul>
			</div>
	</body>
</html>