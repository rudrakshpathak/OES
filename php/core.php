<?php
	// This file contains all important functions of the site
	
	// Some house keeping stuff
	include 'db.php';
	session_start();
	ob_start();
	
	// Check login or not
	function loggedin(){
		if(isset($_SESSION['login'])&&!empty($_SESSION['login'])){
			return $_SESSION['login'];
		}else{
			return false;
		}
	}

	// Head part of the site
	function head_part(){
		echo '<!Doctype html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>KEC Online Examination Portal</title>
			<link rel="shortcut icon" type="image/png" href="img/logo.png">
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div id="w_page">';
			if(isset($_GET['msg'])&&!empty($_GET['msg'])){
				echo '<div id="msg"><span>'.$_GET['msg'].'</span> <span id="msgX">X</span></div>';
			}
			echo '<header>
					<span id="logo">
						<img src="img/logo.png" alt="Logo">
					</span>
					<span id="head">
						<h1>Krishna Engineering College</h1>
						<h2>College Code - 161 | Approved by AICTE</h2>
					</span>
				</header>';
	}
	
	// Footer part
	function footer_part(){
		echo' </div>
			<script src="js/jquery.js" type="text/javascript"></script>
			<script src="js/main.js" type="text/javascript"></script>
		</body>
		</html>';
	}
	
	// Grab data of the user
	function take_users($what){
		$role = $_SESSION['login'];
		$id = $_SESSION['user_id'];
		if($role == 1)
			$table = "admin";
		else if($role == 2)
			$table = "faculty";
		else
			$table = "student";
		$sql = @mysql_query("SELECT $what FROM $table WHERE id=$id");
		return @mysql_result($sql,0,$what);
	}
	
	// Change time from seconds to understandable format
	function format_time($time){
		$c = date('H',$time);
		if($c < 12)
			$ap = 'AM';
		else
			$ap = 'PM';
		$d = date('d/M/Y',$time);
		$a = date('h:i:s ',$time);
		return $d.' | '.$a.$ap;
	}
	
	// Returning Branch using roll number of a student
	function tell_branch($roll){
		$sql = @mysql_query("SELECT branch FROM student WHERE roll=$roll");
		$branch = @mysql_result($sql,0,'branch');
		return branch_list($branch);
	}
	
	// branch_list is to manage all branches in college
	function branch_list($number){
		switch($number){
			case 1:
				return "CSE";
			break;
			case 2:
				return "ME";
			break;
			case 3:
				return "EE";
			break;
			default:
				return "-";
		}
	}
	
	// Branches in section form
	function show_branches(){
		echo "<select name='branch' required>
			<option value=''>Select Branch</option>";
			for($i=1;branch_list($i)!="-";$i++)
				echo "<option value='".$i."'>".branch_list($i)."</option>";
		echo "</select>";
	}
	
	// returns the category for particular id
	function tell_category($id){
		$sql = @mysql_query("SELECT category FROM category WHERE id = $id");
		return @mysql_result($sql,0,'category');
	}
	
	// returns the category form question id
	function tell_category_from_question_id($id){
		$sql = @mysql_query("SELECT category FROM questions WHERE id = $id");
		$cat = @mysql_result($sql,0,'category');
		return tell_category($cat);
	}
	
	// Show categories in section form
	function show_categories(){
		echo "<select name='category' required>
			<option value=''>Select Category</option>";
			$show_category_sql = @mysql_query("SELECT category FROM category ORDER BY category");
			$i=1;
			while($qr = @mysql_fetch_assoc($show_category_sql)){
				echo "<option value='".$i."'>".$qr['category']."</option>";
				$i++;
			}
		echo "</select>";
	}
	
	// Tells difficulty level according to number
	function tell_diff($number){
		switch($number){
			case 1:
				return "Easy";
			break;
			case 2:
				return "Moderate";
			break;
			case 3:
				return "Difficult";
			break;
		}
	}
	
	// Return result according to the matching answers in percentage
	function tell_result_in_percent($idsArray,$ansArray){
		$corr = array();
		foreach($idsArray as $thisId){
			$sql = mysql_query("SELECT correct FROM questions WHERE id=$thisId");
			$cans = mysql_result($sql,0,'correct');
			array_push($corr,$cans);
		}
		$total = count($idsArray);
		$noca=0;
		for($i=0;$i<$total;$i++){
			if($ansArray[$i]==$corr[$i]) $noca++;
		}
		return floor(($noca/$total)*10000)/100;
	}

	// returns a array of exam_id for a particular category
	function tell_exam_ids($cat){
		$exam_ids = array();
		$sql = mysql_query("SELECT id,ids FROM exam ORDER BY starting_time DESC");
		while($qr = mysql_fetch_assoc($sql)){
			$id = $qr['id'];
			$ids = $qr['ids'];
			$idsArray = explode(",",$ids);
			if(tell_category_from_question_id($idsArray[0])==$cat){
				array_push($exam_ids,$id);
			}
		}
		return $exam_ids;
	}
	
	// number of students passed in a exam
	function nosp($exam_id,$idsArray){
		$nosp = 0;
		$sql_exam = mysql_query("SELECT exam_id,ans FROM report WHERE exam_id=$exam_id");
		while($qrRep = mysql_fetch_assoc($sql_exam)){
			$ans = $qrRep['ans'];
			$ansArray = explode(",",$ans);
			if(tell_result_in_percent($idsArray,$ansArray)>=30) $nosp++;
		}
		return $nosp;
	}
	
	// Show answer sheet
	function show_answer_sheet($idsArray,$ansArray,$stu_id,$eid){
		$i=0;
		foreach($idsArray as $this_id){
			$sql_ques = mysql_query("SELECT * FROM questions WHERE id = $this_id");
			while($ques = mysql_fetch_assoc($sql_ques)){
				$qid=$ques['id'];
				$cor = $ques['correct'];
				echo "<div";
				if($cor==$ansArray[$i]) echo" class='correct'";
				else echo" class='wrong'";
				echo ">";
				echo "<div class='one_question' id='question$qid$eid$stu_id'>".$ques['question']."</div>
				<div class='questionShow'";
					if($cor==$ansArray[$i]) echo" class='correct'";
					echo " id='showquestion$qid$eid$stu_id'><span";
					if($cor==1) echo " class='corrop'";
					else if($ansArray[$i]==1) echo " class='wop'";
					echo">A: ".$ques['option1']."</span><span";
					if($cor==2) echo " class='corrop'";
					else if($ansArray[$i]==2) echo " class='wop'";
					echo">B: ".$ques['option2']."</span><span";
					if($cor==3) echo " class='corrop'";
					else if($ansArray[$i]==3) echo " class='wop'";
					echo">C: ".$ques['option3']."</span><span";
					if($cor==4) echo " class='corrop'";
					else if($ansArray[$i]==4) echo " class='wop'";
					echo">D: ".$ques['option4']."</span>
				</div></div>";
			}
			$i++;
		}
	}
	
?>