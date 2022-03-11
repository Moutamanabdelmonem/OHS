<?php
@session_start();
if(!isset($_SESSION["utype"]) || $_SESSION["utype"]!="Admin")
{
    header("location:index.php");
}
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
									<a href="view_request.php" class="logo"><strong>Simple Provider</strong></a>
									
								</header>

							<!-- Banner -->
								<section>
										<h2 id="elements">View Request Page</h2>
										<hr class="major" />
										<div class="row gtr-200">
											<div class="col-12">
																<label><h3 style="color:green"><?php isset($msg)?print $msg:print "";?><h3></label>
											</div>

											<div class="col-12 col-12-medium">
													<div class="table-wrapper">
														<!-- <form name="f1" method="post" action="view_request.php"> -->
														<?php
														$con=mysqli_connect("localhost","root","","ServiceDb");
														if(mysqli_connect_errno()>0)
														{
															echo mysqli_connect_error();
															exit();
														}
															$query1="select first_name,last_name,mobile_no,email_id,vlonteer,status from user_table order by first_name desc";
														$stmt1=$con->prepare($query1);
									
														$stmt1->execute();
														$stmt1->store_result();
														if($stmt1->num_rows>0)
														{
															$stmt1->bind_result($fname,$lname,$mobile,$emailid,$vlonteer,$status);
															echo '<table class="alt">
															<thead>
																<tr>
																	<td colspan="6" align="right"><b>No of Request :<b></td>
																	<td><b>'.$stmt1->num_rows.'</b></td>
																</tr>
																<tr>
																	<th>
																	No
																	</th>
																	
																	<th>Name</th>
																	<th>Mobile</th>
																	<th>Email</th>
																	<th>Volunteer</th>
																	<th>Status</th>
																</tr>
															</thead>
															<tbody>';
															$i=1;
															 while($stmt1->fetch())
															 {
															 	echo '<tr>';
															 	
																	echo '<td>'.$i.'</td>'; 
																    $i++;
																
																	echo '<td>'.'<a href="user.php/?id='.$emailid.'" style="text-decoration:none;">'.strtoupper($fname.' '.$lname).'</a>'.'</td>
																	<td>'.$mobile.'</td>
																	<td>'.$emailid.'</td>
																	<td>'.$vlonteer.'</td>
																	<td>'.$status.'</td>
																	</tr>';
															 }
															echo '</tbody>
															</table>';
														}
														else
														{
															echo "<h3 style='color:red'>No Request Found</h3>";
														}
														
														?>

															<!-- </form> -->
													</div>

											</div>
										</div>

								</section>

							
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
  							<?php include "amenu.php" ?>
						 
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