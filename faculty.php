<?php 
	if(!isset($_SESSION['login'])){ header('Location: index.php'); }
	head_part();
	?>
		<div class="banner">
			<span id="bname">Online Examination Portal - Faculty</span><span id="show_time"></span>
		</div>
		<div class="scenside">
			<table border="0" width="100%" height="100%">
				<tr vlign="top">
					<td class="aside_td" valign="top">
						<aside id="faculty_aside">
							<div id="welcome_msg">
								<?php echo "Welcome ".take_users("name")."!"; ?>
							</div>
							<hr>
							<div class="heading">
								Links
							</div>
							<div class="links_body">
								<a href="index.php?srs=insert"><div class="link">Insert Questions</div></a>
								<a href="index.php?srs=edit"><div class="link">Account Settings</div></a>
								<a href="back/logout.php"><div class="link">Logout</div></a>
							</div>
						</aside>
					</td>
					<td class="section_td" valign="top">
						<section id="faculty_section">
							<?php
							if(isset($_GET['srs'])){
								if(!empty($_GET['srs'])){
									$srs=mysql_real_escape_string(htmlentities($_GET['srs']));
									if($srs=='insert') include 'includes/admin/insert.php';
									else if($srs=='edit') include 'includes/faculty/edit.php';
									else include 'includes/admin/insert.php';
								}else include 'includes/admin/insert.php';
							}else	include 'includes/admin/insert.php';
							?>
						</section>
					</td>
				</tr>
			</table>
		</div>
	<?php footer_part(); ?>