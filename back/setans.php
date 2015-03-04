<?php
	include '../php/core.php';
	include '../php/exam_functions.php';
	if(isset($_SESSION['exam'])&&!empty($_SESSION['exam'])&&isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
		$exam_id = $_SESSION['exam'];
		$stu_id = $_SESSION['user_id'];
		if(isset($_POST['option'])&&isset($_GET['number'])){
			$num = mysql_real_escape_string(htmlentities($_GET['number']));
			$val = mysql_real_escape_string(htmlentities($_POST['option']));
			if($val<5||$val>0){
				$cook = get_my_ans();
				$cookArray = explode(",",$cook);
				$noq = count($cookArray);
				$cookArray[$num-1] = $val;
				$ans = join(",",$cookArray);
				$sql_up=mysql_query("UPDATE report SET ans = '$ans' WHERE exam_id = $exam_id AND stu_id=$stu_id");
				$num++;
				if($sql_up) 
					if($num>$noq) header("Location: ../exam.php");
					else header("Location: ../exam.php?question=$num");
				else header('Location: ../exam.php?msg=Problem+in+saving+the+answer.+Please+try+again1!');
			}else header('Location: ../exam.php?msg=Problem+in+saving+the+answer.+Please+try+again!');
		}else header('Location: ../exam.php?msg=Problem+in+saving+the+answer.+Please+try+again!');
	}else header('Location: ../index.php');
?>