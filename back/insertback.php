<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		$id = $_SESSION['user_id'];
		if(isset($_POST['question'])&&isset($_POST['option1'])&&isset($_POST['option2'])&&isset($_POST['option3'])&&isset($_POST['option4'])&&isset($_POST['correct'])&&isset($_POST['category'])&&isset($_POST['diff'])){
			if(!empty($_POST['question'])&&!empty($_POST['option1'])&&!empty($_POST['option2'])&&!empty($_POST['option3'])&&!empty($_POST['option4'])&&!empty($_POST['correct'])&&!empty($_POST['category'])&&!empty($_POST['diff'])){
				$question = mysql_real_escape_string(htmlentities($_POST['question']));
				$option1 = mysql_real_escape_string(htmlentities($_POST['option1']));
				$option2 = mysql_real_escape_string(htmlentities($_POST['option2']));
				$option3 = mysql_real_escape_string(htmlentities($_POST['option3']));
				$option4 = mysql_real_escape_string(htmlentities($_POST['option4']));
				$correct = mysql_real_escape_string(htmlentities($_POST['correct']));
				$category = mysql_real_escape_string(htmlentities($_POST['category']));
				$diff = mysql_real_escape_string(htmlentities($_POST['diff']));
				if(strlen($question)<=1000&&strlen($option1)<=200&&strlen($option2)<=200&&strlen($option3)<=200&&strlen($option4)<=200&&$correct<5&&$correct>0&&$diff<4&&$diff>0){		
					$time = time();
					if($role == 1){
						$app = 1;
					}else if($role == 2){
						$app = 0;
					}else{
						die("Something Went wrong! Please try again later.");
					}
					$sql = mysql_query("INSERT INTO questions(question,option1,option2,option3,option4,correct,category,difficulty,approve,time,done) VALUES('$question','$option1','$option2','$option3','$option4',$correct,$category,$diff,$app,$time,0)");
					if($sql) header('Location: ../index.php?srs=insert&msg=Inserted+successfully');
					else header('Location: ../index.php?srs=insert&msg=There+was+a+problem+try+again+later');
				}else
					echo "Something Went wrong! Please try again later.";
			}else
				echo "Something Went wrong! Please try again later.";
		}else
			echo "Something Went wrong! Please try again later.";
	}else
		echo "Something Went wrong! Please try again later.";
?>