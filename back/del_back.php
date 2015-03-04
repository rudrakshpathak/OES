<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_GET['del'])&&isset($_GET['id'])){
				if(!empty($_GET['del'])&&!empty($_GET['id'])){
					$del = mysql_real_escape_string(htmlentities($_GET['del']));
					$id = mysql_real_escape_string(htmlentities($_GET['id']));
					if($del == 1){
						$sql = mysql_query("DELETE FROM faculty WHERE id=$id");
					}else{
						$sql = mysql_query("DELETE FROM student WHERE id=$id");
					}
					if($sql) header('Location: ../index.php?srs=delete&msg=Successfully+delete!');
					else echo "There was a problem. Please try again.";
				}else{
					echo "Field cannot be empty.";
				}
			}else{
				echo "Something Went wrong! Please try again later.";
			}
		}else{
			echo "Something Went wrong! Please try again later.";
		}
	}else{
		echo "Something Went wrong! Please try again later.";
	}
?>