<article>
	<div class="heading">Add Faculty/Students</div>
	<div class="art_body">
	<table border="0" class="section_table" id="add_table">
	<tr><td valign="top">
		<table border="0" weight="100%" height="100%" id="add_fac_table" class="section_table">
			<tr><td align="center" colspan="2">Faculty</td></tr>
			<form action="back/add_fac_back.php" method="post">
				<tr>
					<td>Name: </td>
					<td><input type="text" placeholder="Name" name="name" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Username: </td>
					<td><input type="text" placeholder="Username" name="uname" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" placeholder="Password" name="pass" maxlength="100" required>
				</tr>
				<tr>
					<td>Email: </td>
					<td><input type="email" placeholder="Email Address" name="email" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Contact: </td>
					<td><input type="tel" placeholder="Contact number" name="contact" maxlength="10" required></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" value=" Add " class="submit_button"></td>
				</tr>
			</form>
		</table>
		</td><td valign="top">
		<table border="0" weight="100%" height="100%" id="add_stu_table" class="section_table">
			<tr><td align="center" colspan="2">Student</td></tr>
			<form action="back/add_stu_back.php" method="post">
				<tr>
					<td>Name: </td>
					<td><input type="text" placeholder="Name" name="name" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Roll Number: </td>
					<td><input type="text" placeholder="Roll Number" name="uname" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" placeholder="Password" name="pass" maxlength="100" required>
				</tr>
				<tr>
					<td>Email: </td>
					<td><input type="email" placeholder="Email Address" name="email" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Semester: </td>
					<td>
						<select name="semester" required>
							<option value="">Select Semester</option>
							<option value="1">Semester 1</option>
							<option value="2">Semester 2</option>
							<option value="3">Semester 3</option>
							<option value="4">Semester 4</option>
							<option value="5">Semester 5</option>
							<option value="6">Semester 6</option>
							<option value="7">Semester 7</option>
							<option value="8">Semester 8</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Card Number: </td>
					<td><input type="text" placeholder="Library Card Number" name="card_no" maxlength="100" required></td>
				</tr>
				<tr>
					<td>Branch: </td>
					<td>
						<?php show_branches(); ?>
					</td>
				</tr>
				<tr>
					<td>Contact: </td>
					<td><input type="tel" placeholder="Contact number" name="contact" maxlength="10" required></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" value="Add" class="submit_button"></td>
				</tr>
			</form>
		</table>
		</td>
		</tr>
		</table>
	</div>
</article>