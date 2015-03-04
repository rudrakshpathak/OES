<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_GET['id'])){
				if(!empty($_GET['id'])){
					$id = mysql_real_escape_string(htmlentities($_GET['id']));
					$sql = mysql_query("DELETE FROM category WHERE id=$id");
					if($sql) header('Location: ../index.php?srs=cat&msg=Successfully+delete!');
					else echo "There was a problem. Please try again.";
				}else echo "There was a problem. Please try again.";
			}else if(isset($_POST['cat'])){
				if(!empty($_POST['cat'])){
					$cat = mysql_real_escape_string(htmlentities($_POST['cat']));
					$sql = mysql_query("INSERT INTO category(category) VALUES('$cat')");
					if($sql) header('Location: ../index.php?srs=cat&msg=Successfully+Inserted!');
					else echo "There was a problem. Please try again.";
				}else echo "There was a problem. Please try again.";
			}else echo "Something Went wrong! Please try again later.";
		}else echo "Something Went wrong! Please try again later.";
	}else echo "Something Went wrong! Please try again later.";
?>