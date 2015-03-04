<article>
	<div class="heading">Exam Reports</div>
	<div class="art_body" id="view_exams_report">
	<?php
		$sql_cat = mysql_query("SELECT * FROM category");
		while($qrCat = mysql_fetch_assoc($sql_cat)){
			$catId= $qrCat['id'];
			echo "<div class='catBar' id='catBar$catId'>".$qrCat['category']."</div>";
			echo "<div class='catBarShow' id='showcatBar$catId'>";
				$exam_ids = tell_exam_ids($qrCat['category']);
				if(count($exam_ids)>0){
					echo "Total exams: ".count($exam_ids);
					foreach($exam_ids as $eid){
						$sql_ex=mysql_query("SELECT * FROM exam WHERE id = $eid ORDER BY starting_time");
						while($qre=mysql_fetch_assoc($sql_ex)){
							$ids=$qre['ids'];
							$idsArray=explode(",",$ids);
							$noq=count($idsArray);
							$sql_exam=mysql_query("SELECT stu_id,ans FROM report WHERE exam_id=$eid");
							echo "<div class='examBar' id='examBar$eid'>
								<div>".nosp($eid,$idsArray)." passed out of ".mysql_num_rows($sql_exam)."</div>
								<div>".format_time($qre['starting_time'])." (".$qre['total_time']/60 ." Mins)</div>
								<div>$noq questions</div></div>
								<div class='examBarShow' id='showexamBar$eid'>";
								while($qrRep=mysql_fetch_assoc($sql_exam)){
									$stu_id=$qrRep['stu_id'];
									$ans=$qrRep['ans'];
									$ansArray=explode(",",$ans);
									$sql_stu = mysql_query("SELECT id,name,roll FROM student WHERE id=$stu_id");
									echo "<div class='stuBar' id='stuBar$stu_id$eid'><div>Name: ".mysql_result($sql_stu,0,'name');
									echo " (Roll No. ".mysql_result($sql_stu,0,'roll').")</div>";
									echo "<div>Result: ".tell_result_in_percent($idsArray,$ansArray)."%</div>  
									</div>
									<div class='showstuBar' id='showstuBar$stu_id$eid'>";
										show_answer_sheet($idsArray,$ansArray,$stu_id,$eid);
									echo "</div>";
								}
							echo "</div>";
						}
					}
				}else echo "No Exam Conducted.";
			echo"</div>";
		}
	?>
	</div>
</article>