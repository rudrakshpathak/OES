<?php	
// Initialize variables

// Get question array from exam id
function get_ques_arr(){
	$id = $_SESSION['exam'];
	$exam_id_sql = mysql_query("SELECT ids FROM exam WHERE id= $id");
	$ids = mysql_result($exam_id_sql,0,'ids');
	return explode(",",$ids);
}

// Get question from question_id
function get_question($id){
	$get_ques_sql = mysql_query("SELECT question FROM questions WHERE id= $id");
	return mysql_result($get_ques_sql,0,'question');
}

// Get exam starting time
function starting_time(){
	$exam_id = $_SESSION['exam'];
	$sTime = mysql_query("SELECT starting_time FROM exam WHERE id= $exam_id");
	return mysql_result($sTime,0,'starting_time');
}

// Get exam ending time
function ending_time(){
	$exam_id = $_SESSION['exam'];
	$eTime = mysql_query("SELECT total_time FROM exam WHERE id= $exam_id");
	return mysql_result($eTime,0,'total_time');
}

// Set time cookie
function set_time(){
	$exam_id = $_SESSION['exam'];
	if(!isset($_COOKIE['time'])){
		$sTime = starting_time();
		$eTime = ending_time();
		setcookie('time', $sTime + $eTime, $sTime + $eTime);
	}
}

// Check if time is not completed
function check_time(){
	$exam_id = $_SESSION['exam'];
	$time = time();
	$sTime = starting_time();
	$eTime = ending_time();
	if($sTime+$eTime<$time) header('Location: back/timeover.php');
}

// Set answer in database
function set_ans_in_db(){
	$exam_id = $_SESSION['exam'];
	$stu_id = $_SESSION['user_id'];
	$sql = mysql_query("SELECT ans FROM report WHERE exam_id = $exam_id AND stu_id = $stu_id");
	if(mysql_num_rows($sql)==0){
		$arr = get_ques_arr();
		$no = count($arr);
		$ans = "";
		for($i=0;$i<$no-1;$i++){
			$ans .= "0,";
		}
		$ans .= "0";
		$inSql = mysql_query("INSERT INTO report(exam_id,stu_id,ans) VALUES('$exam_id','$stu_id','$ans')");
		if($inSql) return true;
		else return false;
	}
}

// function to get answer list in string from database
function get_my_ans(){
	$exam_id = $_SESSION['exam'];
	$stu_id = $_SESSION['user_id'];
	$sql = mysql_query("SELECT ans FROM report WHERE exam_id = $exam_id AND stu_id = $stu_id");
	if(mysql_num_rows($sql)==1)	return mysql_result($sql,0,'ans');
}

// Show Time
function show_time($time){
	$c = date('H',$time);
	if($c < 12)
		$ap = 'AM';
	else
		$ap = 'PM';
	$a = date('h:i:s ',$time);
	return $a.$ap;
}

// Show question From number
function show_question($number){
	$exam_id = $_SESSION['exam'];
	$idsArray = get_ques_arr();
	$id = $idsArray[$number-1];
	$full_ques_sql = mysql_query("SELECT question,option1,option2,option3,option4 FROM questions WHERE id= $id");
	if($full_ques_sql){
		echo "Q$number) ".mysql_result($full_ques_sql,0,'question');
		$option1 = mysql_result($full_ques_sql,0,'option1');
		$option2 = mysql_result($full_ques_sql,0,'option2');
		$option3 = mysql_result($full_ques_sql,0,'option3');
		$option4 = mysql_result($full_ques_sql,0,'option4');
		echo "<br><br>
			<form action='back/setans.php?number=$number' method='POST' id='question_form'>
					<div id='ques_options'>
						<input type='radio' name='option' id='option1' value='1' class='option_button' required>
						<label for='option1'>A) $option1</label><br><br><br>
						<input type='radio' name='option' id='option2' value='2' class='option_button' required>
						<label for='option2'>B) $option2</label><br><br><br>
						<input type='radio' name='option' id='option3' value='3' class='option_button' required>
						<label for='option3'>C) $option3</label><br><br><br>
						<input type='radio' name='option' id='option4' value='4' class='option_button' required>
						<label for='option4'>D) $option4</label>
					</div>
					<div id='submit_div'><input type='submit' value='Save'></div>
			</form>
		";
	}else{
		echo "There was some problem! Please try again.";
	}
}

	
?>