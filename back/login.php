<?php
	require '../php/core.php';
	if(isset($_POST['uname'])&&isset($_POST['pass'])&&isset($_POST['role'])){
		$username=@mysql_real_escape_string(htmlentities($_POST['uname']));
		$pass=@mysql_real_escape_string(htmlentities($_POST['pass']));
		$role=@mysql_real_escape_string(htmlentities($_POST['role']));
		if(!empty($username)&&!empty($pass)){
			if(strlen($username)<=100 && strlen($pass)<=100){
				$pass_hash= sha1($pass);
				if($role == 1){
					$query="SELECT id FROM admin WHERE username = '$username' AND pass = '$pass_hash'";
				}else if($role == 2){
					$query="SELECT id FROM faculty WHERE username = '$username' AND pass = '$pass_hash'";
				}else if($role == 3){
					$query="SELECT id FROM student WHERE roll = '$username' AND pass = '$pass_hash'";
				}else{
					die("Try again!");
				}
				$result = @mysql_query($query);
				$mnr=@mysql_num_rows($result);
				if($mnr==1){
					$user_id = @mysql_result($result,0,'id');
					$_SESSION['login']= $role;
					$_SESSION['user_id']= $user_id;
					header('Location: ../index.php');
				}else
					header('Location: ../index.php?msg=Wrong+username+or+password');
			}else
				echo 'You exceed the maximum length';
		}else
			echo 'Enter your Username and Password';
	}else
		echo 'Enter in all fields';
?>