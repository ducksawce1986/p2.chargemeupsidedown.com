<!DOCTYPE html>

<html>
	
	<head>
		
		<title><?php if(isset($title)) echo $title; ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
		<!-- CSS And Javascript -->
		<link rel="stylesheet" href="/css/template.css" type="text/css">

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   		<script src="js/action.js"></script> 
		
		<!-- CSS and Javascript Specific To Controller -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
	</head>

	<body>
		
		<div class="header">
			
			<div class="header_links">
				
				<!-- Menu Options For New Users Vs. Returning Users -->
				<?php if(!$user): ?>
					
					<a href='/users/signup'>|  SignUp  |</a>
					
					<a href='/users/login'>|  LogIn  |</a>
				
				<?php else: ?>
				
					<a href='/users/login'>|  LogIn  |</a>
				
					<a href='/users/logout'>|  LogOut  |</a>
				
				<?php endif; ?>
			
			</div>
				
				<h1><a href='/'>ChargeMeUP</a></h1>
			
			</div>

			<div class="container">
			
				<!-- Menu Visible To Users Logged In -->
				<?php if($user): ?>
					
					<ul id ="menu">
						
						<li><a href='/posts/add'>Speak Up </a></li>
						
						<li><a href='/posts/users'>Friends to Follow </a></li>
						
						<li><a href='/posts/index'>Comments </a></li>
						
						<li><a href='/users/profile'>My Profile! </a></li>
						
						<li class="break"></li>
					
					</ul>
				
				<?php endif; ?>
				
				<div class="infobox">
					
					<?php if(isset($content)) echo $content; ?>
					
					<?php if(isset($client_files_body)) echo $client_files_body; ?>
				
				</div>

			</div>

			<div class="footer">
				
				<p>Created by Zach Postle for CSCI E-15, December 2013<a href="http://www.p4.chargemeupsidedown.com">| Charge Me Up | http://www.p4.chargemeupsidedown.com |</a></p>
				
				<ul>
				
					<li> Note: All projected earnings are estimates</li>
				
					<li> All venues listed above lie within the Boston metropolitan area</li>
				
				</ul>
			
			</div>
	
	</body>

</html>