<?php 
	if(!isset($_SESSION['login'])){ header('Location: index.php'); }
	head_part();
?>
		<div class="banner">
			<span id="bname">Online Examination Portal - Student</span><span id="show_time"></span>
		</div>
		<div class="scenside">
			<table border="0" width="100%" height="100%">
				<tr vlign="top">
					<td class="aside_td" valign="top">
						<aside id="student_aside">
							<div id="welcome_msg">
								<?php echo "Welcome ".take_users("name")."!"; ?>
							</div>
							<hr>
							<div class="heading">
								Links
							</div>
							<div class="links_body">
								<a href="index.php?srs=give"><div class="link">Give Exams</div></a>
								<a href="index.php?srs=edit"><div class="link">Account Settings</div></a>
								<a href="index.php?srs=view"><div class="link">View result</div></a>
								<a href="back/logout.php"><div class="link">Logout</div></a>
							</div>
						</aside>
					</td>
					<td class="section_td" valign="top">
						<section id="student_section">
							<?php
							if(isset($_GET['srs'])){
								if(!empty($_GET['srs'])){
									$srs=mysql_real_escape_string(htmlentities($_GET['srs']));
									if($srs=='give') include 'includes/student/give.php';
									else if($srs=='edit') include 'includes/student/edit.php';
									else if($srs=='view') include 'includes/student/view.php';
									else include 'includes/student/give.php';
								}else include 'includes/student/give.php';
							}else	include 'includes/student/give.php';
							?>
						</section>
					</td>
				</tr>
			</table>
		</div>
	<?php footer_part(); ?>