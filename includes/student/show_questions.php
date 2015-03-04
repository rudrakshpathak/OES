<?php
	if(!isset($_SESSION['login'])||!isset($_SESSION['exam'])){ header('Location: index.php'); }
	$exam_id = $_SESSION['exam'];
	$idsArray = get_ques_arr();
	$noq = count($idsArray);
	$sTime = starting_time();
	$eTime = ending_time();
	set_time();
	check_time();
	set_ans_in_db();
	$answers = get_my_ans();
	$ansArray = explode(",",$answers);
?>
<!Doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>KEC Online Examination</title>
	<link rel="shortcut icon" type="image/png" href="img/logo.png">
	<link rel="stylesheet" type="text/css" href="css/exam.css">
</head>
	<body>
		<div id="w_page">
			<table border="0" width="100%" id="main_table" cellspacing="0">
				<tr>
					<td width="22%" height="50" colspan="3" id="header">
						<span id="heading">KEC Online Examination</span><span id="m_countdown">Time Left: <span id="countdown"></span></span>
					</td>
				</tr>
				<tr>
					<td id="ques_list_td">
						<div id="question_list">
							<?php
								for($i=0;$i<$noq;$i++){
									$thisId = $idsArray[$i];
									echo "<a href='exam.php?question=".($i+1)."'><div class='ques_in_list";
									if($ansArray[$i]!=0) echo " done";
									echo "'><b>".($i+1).")</b>&nbsp;&nbsp;".get_question($thisId)."</div></a>";
								}
							?>
						</div>
					</td>
					<td valign="top" id="question_td">
						<div id="question">
							<?php
								if(isset($_GET['question'])&&!empty($_GET['question'])){
									$ques = mysql_real_escape_string(htmlentities($_GET['question']));
									show_question($ques);
								}else{
									for($i=1;$i<=$noq;$i++){
										if($ansArray[$i-1]==0) break;
									}
									if($i>$noq) echo "<a href='back/timeover.php'>Finish Exam</a>";
									else show_question($i);
								}
							?>
						</div>
					</td>
					<td width="300" id="side" valign="top">
						<div id="side_block">
							<?php
								echo "Exam Category: ".tell_category_from_question_id($idsArray[0])."<hr>";
								echo "Staring Time: ".show_time($sTime)."<br>";
								echo "Ending Time: ".show_time($sTime+$eTime)."<hr>";
								echo "Roll Number: ".take_users('roll')."<hr>";
								echo "Name: ".take_users('name')."<hr>";
								echo "Semester: ".take_users('sem')."<hr>";
								echo "Card ID: ".take_users('card_no')."<hr>";
								echo "Email: ".take_users('email')."<hr>";
								echo "Contact: ".take_users('contact')."<hr>";
								echo "<a href='back/timeover.php'>Finish Exam</a>";
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/cookie.js" type="text/javascript"></script>
		<script src="js/exam.js" type="text/javascript"></script>
	</body>
</html>
