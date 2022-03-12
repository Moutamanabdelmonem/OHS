<?php
session_start();
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
		<title>Simple Provider</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="welcome.php" class="logo"><strong>Simple Provider</strong></a>
									
								</header>

							<!-- Banner -->
									<section>
									<header class="major">
									</header>
									<div class="features" style="justify-content: center;">
										<?php
                                            $emailid=$_REQUEST['emailid'];
														if(isset($emailid))
														{
														$con=mysqli_connect("localhost","root","","ServiceDb");
														if(mysqli_connect_errno()>0)
														{
															echo mysqli_connect_error();
															exit();
														}
	
														$query1="select first_name,last_name,mobile_no,photo,email_id,register_as,vlonteer,status from user_table where email_id=?";
														$stmt1=$con->prepare($query1);
														$stmt1->bind_param("s",$emailid);
														$stmt1->execute();
														$stmt1->store_result();
														if($stmt1->num_rows>0)
														{
															$stmt1->bind_result($fname,$lname,$mobile,$photo,$emailid,$register_as,$vlonteer,$status);
															 while($stmt1->fetch())
															 {
															 	echo '<article style="margin: 0, auto;">';
																	echo '<div class="content" style="padding: 10px">';
																		echo '<h3 align="center">'.strtoupper($fname.' '.$lname).'</h3>';
																		echo '<center>';
																		echo '<img src="uploads/'.$photo.'" width="100px" height="100px" align="center" style="border-radius: 50px;border:1px solid white;" />
																		</center>
																		<p align="center">
																			E-mail :'.$emailid.'<br>
																			Status :'.$status.'<br>
																			Mob No : '.$mobile.'<br>
																			Vlonteer State : '.$vlonteer.'
																		</p>
																		<div style="display:flex;justify-content:  space-evenly">';
																		
																		if ($register_as!='Admin') {
																			if ($status == 'Active') {
																				echo '<a href="huser.php?emailid='.$emailid.'&status='.$status.'" class="primary">Disable</a>';
																			}else {
																				echo '<a href="huser.php?emailid='.$emailid.'&status='.$status.'" class="primary">Active</a>';
																			}
																			echo '<a href="huser.php?emailid='.$emailid.'&delete=delete" class="primary">Delete</a>';
																		}
																	echo '</div>
																	     </div>

																</article>';
															 }
														}
													}
										?>

									
									</div>
								</section>

						</div>
					</div><a href="user.php?"></a>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<?php
							
								include "amenu.php";
							
							?>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
				
			</script>

	</body>
</html>