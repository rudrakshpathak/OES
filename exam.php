<?php
	include 'php/core.php';
	include 'php/exam_functions.php';
	$time = time();
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		if($_SESSION['login']==3){
			if(isset($_SESSION['exam'])&&!empty($_SESSION['exam'])){
				include 'includes/student/show_questions.php';
			}else	echo header('Location: index.php');
		}else	echo header('Location: index.php');
	}else	echo header('Location: index.php');
?>
