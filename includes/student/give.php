<article id="give_art">
	<div class="art_body">
		<?php
			$currentTime = time();
			$check_exam_sql = mysql_query("SELECT * FROM exam where starting_time+total_time > $currentTime ORDER BY starting_time LIMIT 1");
			if($check_exam_sql){
				if(mysql_num_rows($check_exam_sql)){
					$id = mysql_result($check_exam_sql,0,'id');
					$st = mysql_result($check_exam_sql,0,'starting_time');
					$timeLeft = $st-$currentTime;
					if($timeLeft>0){
						echo "Exam will begin in soon.<br><br>Please reload the page after ".ceil($timeLeft/60)." minutes.";
					}else{
						$_SESSION['exam'] = $id;
						echo "<a href='exam.php'>Start Exam</a>";
					}
				}else{
					echo "No scheduled Exam!";
				}
			}else{
				echo "There was a problem! Please try again!";
			}
		?>
	</div>
</article>