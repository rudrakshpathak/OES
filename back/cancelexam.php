<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_GET['id'])){
				if(!empty($_GET['id'])){
					$id = mysql_real_escape_string(htmlentities($_GET['id']));
					$sql_ids = mysql_query("SELECT ids FROM exam WHERE id = $id");
					$ids = mysql_result($sql_ids,0,'ids');
					$idsArray = explode(",",$ids);
					foreach($idsArray as $this_id){
						$sql_ques = mysql_query("UPDATE questions SET done=0 WHERE id = $this_id");
					}
					$sql = mysql_query("DELETE FROM exam WHERE id=$id");
					if($sql) header('Location: ../index.php?srs=exams&msg=Exam+Cancelled!');
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