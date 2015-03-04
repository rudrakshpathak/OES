<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_GET['to'])&&isset($_GET['id'])){
				if(!empty($_GET['to'])&&!empty($_GET['id'])){
					$to = mysql_real_escape_string(htmlentities($_GET['to']));
					$id = mysql_real_escape_string(htmlentities($_GET['id']));
					if($to == 1){
						$sql = mysql_query("UPDATE questions SET approve = 1 WHERE id=$id");
						if($sql) header('Location: ../index.php?srs=approve&msg=Approved!');
						else echo "There was a problem. Please try again.";
					}else{
						$sql = mysql_query("DELETE FROM questions WHERE id=$id");
						if($sql) header('Location: ../index.php?srs=approve&msg=Deleted!');
						else echo "There was a problem. Please try again.";
					}
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