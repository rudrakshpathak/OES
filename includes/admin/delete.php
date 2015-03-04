<article>
	<div class="heading">Delete</div>
	<div class="art_body">
	<table border="0" class="section_table" id="del_table">
	<tr><td valign="top">
		<table border="0" weight="100%" height="100%" id="del_fac_table" class="section_table" cellspacing="0px">
			<tr><td align="center" colspan="3">Faculty</td></tr>
			<?php
				$sql = mysql_query("SELECT * FROM faculty ORDER BY name");
				while($qr = mysql_fetch_assoc($sql)){
					$id = $qr['id'];
					echo "<tr>
						<td>Name: </td>
						<td>".$qr['name']."</td>						
						<td rowspan='4' class='last_row' valign='top'><a href='back/del_back.php?del=1&id=$id'>delete</a></td>
					</tr>
					<tr>
						<td>Username: </td>
						<td>".$qr['username']."</td>
					</tr>
					<tr>
						<td>Email: </td>
						<td>".$qr['email']."</td>
					</tr>
					<tr>
						<td class='last_row'>Contact: </td>
						<td class='last_row'>".$qr['contact']."</td>
					</tr>";
				}
			?>
		</table>
		</td><td valign="top">
		<table border="0" weight="100%" height="100%" id="del_stu_table" class="section_table" cellspacing="0px">
			<tr><td align="center" colspan="3">Student</td></tr>
			<?php
				$sql = mysql_query("SELECT * FROM student ORDER BY name");
				while($qr = mysql_fetch_assoc($sql)){
					$id = $qr['id'];
					echo "<tr>
						<td>Name: </td>
						<td>".$qr['name']."</td>						
						<td rowspan='7' class='last_row' valign='top'><a href='back/del_back.php?del=2&id=$id'>delete</a></td>
					</tr>
					<tr>
						<td>Roll number: </td>
						<td>".$qr['roll']."</td>
					</tr>
					<tr>
						<td>Email: </td>
						<td>".$qr['email']."</td>
					</tr>
					<tr>
						<td>Contact: </td>
						<td>".$qr['contact']."</td>
					</tr>
					<tr>
						<td>Semester: </td>
						<td>".$qr['sem']."</td>
					</tr>
					<tr>
						<td>ID Card number: </td>
						<td>".$qr['card_no']."</td>
					</tr>
					<tr>
						<td class='last_row'>Branch: </td>
						<td class='last_row'>".tell_branch($qr['roll'])."</td>
					</tr>
					";
				}
			?>
		</table>
		</td>
		</tr>
		</table>
	</div>
</article>