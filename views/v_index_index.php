<div id="inner_infobox_left">
	<img class="avatar" src="http://us.123rf.com/400wm/400/400/sergo/sergo1107/sergo110700333/9903129-vector-hand-drawn-studio-microphone-and-stars.jpg" alt = "Charge Up">
	<h2>It's time for you to speak up</h2>
	<br>
</div>

<div id="inner_infobox_right">
	<h1>Welcome To <?=APP_NAME?><?php if($user) echo ' '.$user->first_name; ?></h1>
	<!-- SignIn Is Only Shown If User Is Not Yet Signed In -->
		<?php if(!$user): ?>
			<form method='POST' action='/users/p_login'>
				<table>
					<tr><td>Email</td><td><input type='text' name='email' size="50"></td></tr>
					<tr><td>Password</td><td><input type='password' name='password' size="50"></td></tr>
				</table>
				<br>
			<!-- If There's An Error In Login -->
				<?php if(isset($error)): ?>
					<div class='error'>
						Your login failed. Please try again!
					</div>
					<br>
				<?php endif; ?>
				<input type='submit' value='Log in'>
			</form>
		<?php endif; ?>
</div>
