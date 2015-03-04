<article>
	<div class="heading">Approve/Delete questions</div>
	<div class="art_body" id="app_body">
	<?php
		$sql = mysql_query("SELECT * FROM questions ORDER BY time DESC");
		echo "Total questions: ".mysql_num_rows($sql);
		while($qr = mysql_fetch_assoc($sql)){
			$id = $qr['id'];
			$cat = $qr['category'];
			$diff = $qr['difficulty'];
			$app = $qr['approve'];
			echo "<table border='0' class='app_table' width='100%'>
				<tr valign='top'>
					<td width='100px'>Question:</td><td>".$qr['question']."</td>
					<td rowspan='5' width='100px'>
						";
						if(!$app) echo "<a href='back/approveback.php?id=".$id."&to=1'>Approve</a><br>";
						else echo "Approved<br>";
						echo "<a href='back/approveback.php?id=".$id."&to=2'>Delete</a>
					</td>
				</tr>
				<tr valign='top'>
					<td>
						Options:</td><td>1. ".$qr['option1']."<br>2. ".$qr['option2']."<br>3. ".$qr['option3']."<br>4. ".$qr['option4']."</td>
				</tr>
				<tr valign='top'>
					<td>
						Category:</td><td>".tell_category($cat)."</td>
				</tr>
				<tr valign='top'>
					<td>Difficulty:</td><td>".tell_diff($diff)."</td>
				</tr>
			</table>";
		}
	?>
	</div>
</article>