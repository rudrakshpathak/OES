<article>
	<div class="heading">Created Exams Schedule</div>
	<div class="art_body" id="view_exams_body">
	<?php
		$currentTime = time();
		$sql = mysql_query("SELECT * FROM exam WHERE starting_time+total_time>$currentTime ORDER BY starting_time");
		echo "Total exams: ".mysql_num_rows($sql);
		while($qr = mysql_fetch_assoc($sql)){
			$id = $qr['id'];
			$ids = $qr['ids'];
			$idsArray = explode(",",$ids);
			$noq = count($idsArray);
			$cat = tell_category_from_question_id($idsArray[0]);
			echo "<table border='0' class='exam_table' width='100%'>
				<tr valign='top'>
					<td width='100px'>Category:</td>
					<td>$cat</td>
					<td width='100px'>";
						if($currentTime<$qr['starting_time']) echo "<a href='back/cancelexam.php?id=".$id."'>Cancel Exam</a>";
						else echo "(On going)";
					echo "</td>
				</tr>
				<tr valign='top'>
					<td width='155px'>Number of questions:</td><td>$noq</td>
				</tr>
				<tr valign='top'>
					<td width='100px'>Starting on:</td><td>".format_time($qr['starting_time'])."</td>
				</tr>
				<tr valign='top'>
					<td width='100px'>Ending on:</td><td>".format_time($qr['total_time']+$qr['starting_time'])." (".$qr['total_time']/60 ." mins)</td>
				</tr>
				<tr valign='top'>
					<td colspan='3'>
						<div class='show_questions_button' id='show$id'>Show/Hide questions</div>
						<div class='questions_list' id='questionshow$id'>";
							foreach($idsArray as $this_id){
								$sql_ques = mysql_query("SELECT * FROM questions WHERE id = $this_id");
								while($ques = mysql_fetch_assoc($sql_ques)){
									echo "Question: ".$ques['question']." (".tell_diff($ques['difficulty']).")<br>
										A: ".$ques['option1']." <br> B: ".$ques['option2']." <br> C: ".$ques['option3']." <br> D: ".$ques['option4']."<br>Option ".$ques['correct']." is correct<br><br><hr><br>";
								}
							}
						echo "</div>
					</td>
				</tr>
			</table>";
		}
	?>
	</div>
</article>