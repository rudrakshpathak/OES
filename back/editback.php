<?php
	require '../php/core.php';
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		$id = $_SESSION['user_id'];
		// for Admin
		if($role == 1){
			if(isset($_POST['name'])&&!empty($_POST['name'])){
				$name = mysql_real_escape_string(htmlentities($_POST['name']));
				if(strlen($name)<100){
					$oname = take_users("name");
					if($oname == $name){
						header('Location: ../index.php?srs=edit&msg=Nothing+changed');
					}else{
						$sql = mysql_query("UPDATE admin SET name = '$name' WHERE id=$id");
						changed();
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else if(isset($_POST['uname'])&&!empty($_POST['uname'])){
				$uname = mysql_real_escape_string(htmlentities($_POST['uname']));
				if(strlen($uname)<100){
					$ouname = take_users("username");
					if($ouname == $uname){
						header('Location: ../index.php?srs=edit&msg=Nothing+changed');
					}else{
						$check = mysql_query("SELECT username FROM admin WHERE username = '$uname'");
						if(mysql_num_rows($check)<1){
							$sql = mysql_query("UPDATE admin SET username = '$uname' WHERE id=$id");
							changed();
						}else{
							header('Location: ../index.php?srs=edit&msg=Username+not+available');
						}
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else if(isset($_POST['opass'])&&!empty($_POST['opass'])&&isset($_POST['npass'])&&!empty($_POST['npass'])){
				$opass = mysql_real_escape_string(htmlentities($_POST['opass']));
				$npass = mysql_real_escape_string(htmlentities($_POST['npass']));
				if(strlen($npass)<100){
					$ospass = take_users("pass");
					$ohpass = sha1($opass);
					if($ohpass == $ospass){
						$nhpass = sha1($npass);
						$sql = mysql_query("UPDATE admin SET pass = '$nhpass' WHERE id=$id");
						changed();
					}else{
						header('Location: ../index.php?srs=edit&msg=Incorrect Old password');
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else if(isset($_POST['email'])&&!empty($_POST['email'])){
				$email = mysql_real_escape_string(htmlentities($_POST['email']));
				if(strlen($email)<100){
					$oemail = take_users("email");
					if($oemail == $email){
						header('Location: ../index.php?srs=edit&msg=Nothing+changed');
					}else{
						$sql = mysql_query("UPDATE admin SET email = '$email' WHERE id=$id");
						changed();
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else{
				echo "Something went wrong! Please try again later.";
			}
		}else if($role == 2){
			if(isset($_POST['name'])&&!empty($_POST['name'])){
				$name = mysql_real_escape_string(htmlentities($_POST['name']));
				if(strlen($name)<100){
					$oname = take_users("name");
					if($oname == $name){
						header('Location: ../index.php?srs=edit&msg=Nothing+changed');
					}else{
						$sql = mysql_query("UPDATE faculty SET name = '$name' WHERE id=$id");
						changed();
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else if(isset($_POST['opass'])&&!empty($_POST['opass'])&&isset($_POST['npass'])&&!empty($_POST['npass'])){
				$opass = mysql_real_escape_string(htmlentities($_POST['opass']));
				$npass = mysql_real_escape_string(htmlentities($_POST['npass']));
				if(strlen($npass)<100){
					$ospass = take_users("pass");
					$ohpass = sha1($opass);
					if($ohpass == $ospass){
						$nhpass = sha1($npass);
						$sql = mysql_query("UPDATE faculty SET pass = '$nhpass' WHERE id=$id");
						changed();
					}else{
						header('Location: ../index.php?srs=edit&msg=Incorrect Old password');
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else if(isset($_POST['email'])&&!empty($_POST['email'])){
				$email = mysql_real_escape_string(htmlentities($_POST['email']));
				if(strlen($email)<100){
					$oemail = take_users("email");
					if($oemail == $email){
						header('Location: ../index.php?srs=edit&msg=Nothing+changed');
					}else{
						$sql = mysql_query("UPDATE faculty SET email = '$email' WHERE id=$id");
						changed();
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}else{
				echo "Something went wrong! Please try again later.";
			}
		}
		// for Student
		else if($role == 3){
			if(isset($_POST['name'])&&!empty($_POST['name'])&&isset($_POST['email'])&&!empty($_POST['email'])&&isset($_POST['contact'])&&!empty($_POST['contact'])){
				$name = mysql_real_escape_string(htmlentities($_POST['name']));
				$email = mysql_real_escape_string(htmlentities($_POST['email']));
				$contact = mysql_real_escape_string(htmlentities($_POST['contact']));
				if(strlen($name)<100&&strlen($email)<100){
					if(!empty($_POST['opass'])&&!empty($_POST['npass'])){
						$opass = mysql_real_escape_string(htmlentities($_POST['opass']));
						$npass = mysql_real_escape_string(htmlentities($_POST['npass']));
						if(strlen($npass)<100){
							$ospass = take_users("pass");
							$ohpass = sha1($opass);
							if($ohpass == $ospass){
								$nhpass=sha1($npass);
								$sql="UPDATE student SET name='$name', pass='$nhpass', email='$email', contact='$contact' WHERE id=$id";
							}else header("Location: ../index.php?srs=edit&msg=Incorrect+old+password!");
						}else echo "Something went wrong! Please try again later.";
					}else	$sql = "UPDATE student SET name='$name', email='$email', contact='$contact' WHERE id=$id";
					if($ohpass != $ospass) header("Location: ../index.php?srs=edit&msg=Incorrect+old+password!!");
					else
						if(mysql_query($sql)) header("Location: ../index.php?srs=edit&msg=Successfully+Changed!");
						else header("Location: ../index.php?srs=edit&msg=There+was+an+error+please+try+again+later!!");
				}else	echo "Please Mind the maximun length.";
			}else	echo "Something went wrong! Please try again later.";
		}else	echo "Something went wrong! Please try again later.";
	}else echo "Something went wrong! Please try again later.";
	function changed(){
		header("Location: ../index.php?srs=edit&msg=Successfully+Changed!");
	}
?>