<article id="edit_art">
	<div class="heading">Account settings</div>
	<div class="art_body">
		<table border="0" weight="100%" height="100%" id="edit_table" class="section_table">
			<tr>
				<form action="back/editback.php" method="post">
					<td>Name: </td>
					<td><input type="text" value="<?php echo take_users('name'); ?>" placeholder="Name" name="name" maxlength="100" required></td>
					<td><input type="submit" value="change"></td>
				</form>
			</tr>
			<tr>
				<td>Username: </td>
				<td><?php echo take_users('username'); ?></td>
				<td>(Cannot be changed)</td>
			</tr>
			<tr>
				<form action="back/editback.php" method="post">
					<td>Password: </td>
					<td><input type="password" value="" placeholder="Old Password" name="opass" maxlength="100" required><br>
					<input type="password" value="" placeholder="New Password" name="npass" maxlength="100" required></td>
					<td><input type="submit" value="change"></td>
				</form>
			</tr>
			<tr>
				<form action="back/editback.php" method="post">
					<td>Email: </td>
					<td><input type="email" value="<?php echo take_users('email'); ?>" placeholder="Email Address" name="email" maxlength="100" required></td>
					<td><input type="submit" value="change"></td>
				</form>
			</tr>
		</table>
	</div>
</article>