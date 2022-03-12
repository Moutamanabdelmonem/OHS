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
									<div class="features">
										<?php
                                            $emailid=$_REQUEST['id'];
														if(isset($emailid))
														{
														$con=mysqli_connect("localhost","root","","ServiceDb");
														if(mysqli_connect_errno()>0)
														{
															echo mysqli_connect_error();
															exit();
														}
	
														$query1="select first_name,last_name,mobile_no,photo,email_id,vlonteer,status from user_table where email_id=?";
														$stmt1=$con->prepare($query1);
														$stmt1->bind_param("s",$emailid);
														$stmt1->execute();
														$stmt1->store_result();
														if($stmt1->num_rows>0)
														{
															$stmt1->bind_result($fname,$lname,$mobile,$photo,$emailid,$vlonteer,$status);
															 while($stmt1->fetch())
															 {
															 	echo '<article>';
																	echo '<div class="content" style="padding: 10px">';
																		echo '<h3 align="center">'.strtoupper($fname.' '.$lname).'</h3>';
																		echo '<center>';
																		echo '<img src="uploads/'.$photo.'" width="100px" height="100px" align="center" style="border-radius: 50px;border:1px solid white;" />
																		</center>
																		<p align="center">

																			Mob No : '.$mobile.'<br>
																			State : '.$vlonteer.'
																		</p>
																		<hr>
																	</div>

																</article>';
															 }
														}
													}
										?>

									
									</div>
								</section>

						</div>
					</div>

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

	</body>
</html>