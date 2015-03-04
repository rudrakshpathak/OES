<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_POST['name'])&&isset($_POST['uname'])&&isset($_POST['pass'])&&isset($_POST['email'])&&isset($_POST['semester'])&&isset($_POST['card_no'])&&isset($_POST['branch'])&&isset($_POST['contact'])){
				if(!empty($_POST['name'])&&!empty($_POST['uname'])&&!empty($_POST['pass'])&&!empty($_POST['email'])&&!empty($_POST['semester'])&&!empty($_POST['card_no'])&&!empty($_POST['branch'])&&!empty($_POST['contact'])){
					$name = mysql_real_escape_string(htmlentities($_POST['name']));
					$uname = mysql_real_escape_string(htmlentities($_POST['uname']));
					$pass = mysql_real_escape_string(htmlentities($_POST['pass']));
					$email = mysql_real_escape_string(htmlentities($_POST['email']));
					$semester = mysql_real_escape_string(htmlentities($_POST['semester']));
					$card = mysql_real_escape_string(htmlentities($_POST['card_no']));
					$branch = mysql_real_escape_string(htmlentities($_POST['branch']));
					$contact = mysql_real_escape_string(htmlentities($_POST['contact']));
					if(strlen($name)<100&&strlen($uname)<100&&strlen($pass)<100&&strlen($email)<100&&$semester>0&&$semester<9&&$branch>0&&$branch<11){
						$hpass = sha1($pass);
						$sql_check = mysql_query("SELECT name FROM student WHERE roll = '$uname'");
						if(mysql_num_rows($sql_check)<1){
							$sql = mysql_query("INSERT INTO student(name, roll, pass, email, sem, card_no, branch, contact) VALUES('$name','$uname','$hpass','$email','$semester','$card','$branch','$contact')");
							if($sql) header('Location: ../index.php?srs=add&msg=Successfully+added!');
							else echo "There was a problem. Please try again.";
						}else{
							header('Location: ../index.php?srs=add&msg=Roll+Number+already+exists!');
						}
					}else{
						echo "Mind Maximum length of the fields.";
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