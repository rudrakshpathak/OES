<?php
	include 'php/core.php';
	// including file according to login session
	if($login = loggedin()){
		if($login == 1) include 'admin.php';
		else if($login == 2) include 'faculty.php';
		else if($login == 3) include 'student.php';
		else echo "Something went wrong. Try again later.";
	}else	include 'login.php';
?>