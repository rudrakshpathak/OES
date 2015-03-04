<?php
	require '../php/core.php';	
	if(isset($_SESSION['login'])&&isset($_SESSION['user_id'])){
		$role = $_SESSION['login'];
		if($role == 1){
			if(isset($_POST['category'])&&isset($_POST['no_of_questions'])&&isset($_POST['diff'])&&isset($_POST['date'])&&isset($_POST['time'])&&isset($_POST['total_time'])){
				if(!empty($_POST['category'])&&!empty($_POST['no_of_questions'])&&!empty($_POST['diff'])&&!empty($_POST['date'])&&!empty($_POST['time'])&&!empty($_POST['total_time'])){
					$category = mysql_real_escape_string(htmlentities($_POST['category']));
					$noq = mysql_real_escape_string(htmlentities($_POST['no_of_questions']));
					$diff = mysql_real_escape_string(htmlentities($_POST['diff']));
					$date = mysql_real_escape_string(htmlentities($_POST['date']));
					$time = mysql_real_escape_string(htmlentities($_POST['time']));
					$totalTime = mysql_real_escape_string(htmlentities($_POST['total_time']));
					if(strlen($category)<11&&$noq<=300&&$noq>=10&&$diff<5&&$diff>0&&$totalTime<=180){
						$currentTime = time();
						$settedTime = toDataTime($date,$time);
						$totalTime *= 60;
						$tillTime = $totalTime+$settedTime;
						if($currentTime<$settedTime){
							$sql_str = "SELECT id FROM exam WHERE (starting_time<$settedTime AND (starting_time+total_time)>$settedTime) OR (starting_time<$tillTime AND (starting_time+total_time)>$tillTime)";
							$sql_check = mysql_query($sql_str);
							if($sql_check){
								if(mysql_num_rows($sql_check)==0){
									if($diff == 4){
										$sql = mysql_query("SELECT id FROM questions WHERE approve=1 AND category= $category ORDER BY RAND() LIMIT $noq");
									}else $sql = mysql_query("SELECT id FROM questions WHERE approve=1 AND difficulty = $diff AND category= $category AND done=0 ORDER BY RAND() LIMIT $noq");
									if($sql){
										if(mysql_num_rows($sql)==$noq){
											$ids = "";
											while($qr = mysql_fetch_assoc($sql)){
												$id = $qr['id'];
												$update_sql = mysql_query("UPDATE questions SET done = 1 WHERE id = $id");
												if($update_sql){
													$ids .= $id.",";
												}else{
													die("There was an error! Please Try again later.");
												}
											}
											$ids = substr($ids,0,-1);
											$sql_setExam= mysql_query("INSERT INTO exam(ids, total_time, starting_time) VALUES('$ids',$totalTime,$settedTime)");
											if($sql_setExam) header('Location: ../index.php?srs=conduct&msg=Exam+setted!');
											else header('Location: ../index.php?srs=conduct&msg=There+was+an+error.+Please+try+again+later.');
										}else{
											$mnr = mysql_num_rows($sql);
											$err="There+are+only+$mnr+questions+in+this+category+and+difficulty";
											header('Location: ../index.php?srs=conduct&msg='.$err);
										}
									}else{
										header('Location: ../index.php?srs=conduct&msg=There+was+an+error.+Please+try+again+later.');
									}
								}else{
									header('Location: ../index.php?srs=conduct&msg=There+is+already+an+exam+in+this+time+interval!');
								}
							}else{
								header('Location: ../index.php?srs=conduct&msg=There+was+an+error.+Please+try+again+later.');
							}
						}else{
							header('Location: ../index.php?srs=conduct&msg=You+really+want+to+set+exam+in+past?');
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
	function toDataTime($date,$time){
		$date_arr = explode('-',$date);
		$y = $date_arr[0];
		$m = $date_arr[1];
		$d = $date_arr[2];
		$time_arr = explode(':',$time);
		$h = $time_arr[0];
		$i = $time_arr[1];
		$str = $m."/".$d."/".$y." ".$h.":".$i;
		return strtotime($str);
	}
?>