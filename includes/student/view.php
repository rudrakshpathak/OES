<article>
	<div class="heading">Exam Reports</div>
	<div class="art_body" id="view_exams_report">
	<?php
		$currentTime = time();
		$stu_id = $_SESSION['user_id'];
		$check_exam_sql = mysql_query("SELECT * FROM exam where starting_time+total_time > $currentTime ORDER BY starting_time LIMIT 1");
		if(mysql_num_rows($check_exam_sql)){
			$st = mysql_result($check_exam_sql,0,'starting_time');
			$tt = mysql_result($check_exam_sql,0,'total_time');
			$timeLeft = $st+$tt-$currentTime;
			echo "You have to wait till the exam over!!<br>";
			echo floor($timeLeft/60)." minuets left !!";
		}else{
			$sql = mysql_query("SELECT exam_id, ans FROM report WHERE stu_id=$stu_id ORDER BY id DESC");
			echo "Total exams: ".mysql_num_rows($sql);
			while($qr = mysql_fetch_assoc($sql)){
				$id = $qr['exam_id'];
				$ans = $qr['ans'];
				$ansArray = explode(",",$ans);
				$sql_exam = mysql_query("SELECT ids,starting_time,total_time FROM exam WHERE id = $id");
				while($qre = mysql_fetch_assoc($sql_exam)){
					$ids = $qre['ids'];
					$idsArray = explode(",",$ids);
					$noq = count($idsArray);
					$cat = tell_category_from_question_id($idsArray[0]);
					echo "<table border='0' class='exam_table' width='100%'>
						<tr valign='top'>
							<td width='100px'>Category:</td>
							<td>$cat ($noq Questions)</td>
						</tr>
						<tr valign='top'>
							<td width='100px'>Time:</td><td>".format_time($qre['starting_time'])." (".$qre['total_time']/60 ." Mins)</td>
						</tr>
						<tr valign='top'>
							<td width='100px'>Result:</td><td>".tell_result_in_percent($idsArray,$ansArray)."%</td>
						</tr>
						<tr valign='top'>
							<td colspan='2'>
								<div class='show_questions_button' id='show$id'>Show/Hide questions</div>
								<div class='questions_list' id='questionshow$id'>";
									show_answer_sheet($idsArray,$ansArray,$stu_id,$id);
								echo "</div>
							</td>
						</tr>
					</table>";
				}
			}
		}
	?>
	</div>
</article>