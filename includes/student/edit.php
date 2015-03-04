<article id="edit_art">
	<div class="heading">Account settings</div>
	<div class="art_body">
		<form action="back/editback.php" method="post">
		<table border="0" weight="100%" height="100%" id="edit_table" class="section_table">
			<tr>
				<td>Name: </td>
				<td><input type="text" value="<?php echo take_users('name'); ?>" placeholder="Name" name="name" maxlength="100" required></td>
			</tr>
			<tr>
				<td>Roll Number: </td>
				<td><?php echo take_users('roll'); ?></td>
				<td>(Cannot be changed)</td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" placeholder="Old Password" name="opass" maxlength="100"><br>
				<input type="password" placeholder="New Password" name="npass" maxlength="100"></td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><input type="email" value="<?php echo take_users('email'); ?>" placeholder="Email Address" name="email" maxlength="100" required></td>
			</tr>
			<tr>
				<td>Contact: </td>
				<td><input type="tel" value="<?php echo take_users('contact'); ?>" placeholder="Contact Number" name="contact" maxlength="100" required></td>
			</tr>
			<tr>
				<td>Semester: </td>
				<td><?php echo "Semester ".take_users('sem'); ?></td>
				<td>(Cannot be changed)</td>
			</tr>
			<tr>
				<td>Card Number: </td>
				<td><?php echo take_users('card_no'); ?></td>
				<td>(Cannot be changed)</td>
			</tr>
			<tr>
				<td>Branch: </td>
				<td><?php echo tell_branch(take_users('roll')); ?></td>
				<td>(Cannot be changed)</td>
			</tr>
			<tr>
				<td colspan="3" class="submit_td"><input type="submit" value="change" class="submit_button"></td>
			</tr>
		</table>
	</div>
</article>