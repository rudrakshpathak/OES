<?php 
	if(!isset($_SESSION['login'])){ header('Location: index.php'); }
	head_part();
?>
		<div class="banner">
			<span id="bname">Online Examination Portal - Administrator</span><span id="show_time"></span>
		</div>
		<div class="scenside">
			<table border="0" width="100%" height="100%">
				<tr vlign="top">
					<td class="aside_td" valign="top">
						<aside id="admin_aside">
							<div id="welcome_msg">
								<?php echo "Welcome ".take_users("name")."!"; ?>
							</div>
							<hr>
							<div class="heading">
								Links
							</div>
							<div class="links_body">
								<a href="index.php?srs=conduct"><div class="link">Conduct Exam</div></a>
								<a href="index.php?srs=exams"><div class="link">View setted Exams</div></a>
								<a href="index.php?srs=insert"><div class="link">Insert Questions</div></a>
								<a href="index.php?srs=approve"><div class="link">Approve/Delete Questions</div></a>
								<a href="index.php?srs=view"><div class="link">View Report</div></a>
								<a href="index.php?srs=add"><div class="link">Add Faculty/Student</div></a>
								<a href="index.php?srs=delete"><div class="link">Delete Faculty/Student</div></a>
								<a href="index.php?srs=cat"><div class="link">Add/Delete Category</div></a>
								<a href="index.php?srs=edit"><div class="link">Account Settings</div></a>
								<a href="back/logout.php"><div class="link">Logout</div></a>
							</div>
						</aside>
					</td>
					<td class="section_td" valign="top">
						<section id="admin_section">
							<?php
							if(isset($_GET['srs'])){
								if(!empty($_GET['srs'])){
									$srs=mysql_real_escape_string(htmlentities($_GET['srs']));
									if($srs=='conduct')	include 'includes/admin/conduct.php';
									else if($srs=='exams')	include 'includes/admin/exams.php';
									else if($srs=='insert') include 'includes/admin/insert.php';
									else if($srs=='approve') include 'includes/admin/approve.php';
									else if($srs=='view') include 'includes/admin/view.php';
									else if($srs=='add') include 'includes/admin/add.php';
									else if($srs=='delete') include 'includes/admin/delete.php';
									else if($srs=='cat') include 'includes/admin/cat.php';
									else if($srs=='edit') include 'includes/admin/edit.php';
									else include 'includes/admin/conduct.php';
								}else include 'includes/admin/conduct.php';
							}else	include 'includes/admin/conduct.php';
							?>
						</section>
					</td>
				</tr>
			</table>
		</div>
	<?php footer_part(); ?>