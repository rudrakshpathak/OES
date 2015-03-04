<?php 
	if(isset($_SESSION['login'])){ header('Location: index.php'); }
	head_part();
?>
		<div class="banner">
			<span id="bname">Online Examination Portal - Login</span><span id="show_time"></span>
		</div>
		<section id="login_section">
			<article id="login_art">
				<div id="login_head">Login</div>
				<form action="back/login.php" method="post">
					<div id="role_buttons">
						<input type="radio" name="role" id="role1" value="3" class="radio_button" checked="checked"><label for="role1">Student</label>
						<input type="radio" name="role" id="role2" value="1" class="radio_button"><label for="role2">Admin</label>
						<input type="radio" name="role" id="role3" value="2" class="radio_button"><label for="role3">Faculty</label>
					</div>
					<span id="username">Roll number:</span><input type="text" placeholder="Enter Your Roll Number" name="uname" class="input_field" id="username_field" required autofocus autocomplete="off">
					Password: <input type="password" placeholder="Enter Your Password" name="pass" class="input_field" required><br>
					<center><input type="submit" value="Login" class="submit_button"></center>
				</form>
			</article>
		</section>
	<?php footer_part(); ?>