<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if(!isset($_SESSION["utype"]) || $_SESSION["utype"]!="Consumer")
{
header("location:Signin.php");
}
$con=mysqli_connect("localhost","root","","ServiceDb");
if(mysqli_connect_errno()>0)
{
	echo mysqli_connect_error();
	exit();
}
if(isset($_POST["sbbtn"]))
{
	$emailid=$_SESSION["emailid"];
	$pemailid=$_POST["pemailid"];
	$pname=$_POST["pname"];
	$sid=$_POST["sid"];
	$fdate=$_POST["fdate"];
	$tdate=$_POST["tdate"];
	$vlonteer=$_POST["vlonteer"];
	$rdate=date("Y-m-d");
	$rtime=date("h:i:s");
	$status="Pending";
	
	$query="insert into service_request(consumer_emailid,provider_emailid,service_id,fdate,tdate,request_date,request_time,status,vlonteer) values(?,?,?,?,?,?,?,?,?)";
	$stmt=$con->prepare($query);
	$stmt->bind_param("sssssssss",$emailid,$pemailid,$sid,$fdate,$tdate,$rdate,$rtime,$status,$vlonteer);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->affected_rows>0)
	{
		$msg="Request is Sent...";
		unset($emailid);
		unset($pemailid);
		unset($pname);
		unset($sid);
		unset($_SESSION["type"]);
			
	}
	else
	{
		$msg="Request is not Sent..."."<br>";
		echo $con->error;
	}
	$con->close();
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
									<a href="index.html" class="logo"><strong>Simple Provider</strong></a>
									
								</header>

							<!-- Banner -->
								<section>
										<h2 id="elements">Service Booking Page</h2>
										<hr class="major" />
										<div class="row gtr-200">
											

											<div class="col-6 col-12-medium">
													<form method="post" action="service_booking.php">
														<div class="row gtr-uniform">
															<div class="col-12">
																<label><h3 style="color:green"><?php isset($msg)?print $msg:print "";?><h3></label>
															</div>
															<div class="col-12">
																<label>Provider Email id</label>
																<input type="text" name="pemailid" id="pemailid" value='<?php isset($_REQUEST["eid"])?print $_REQUEST["eid"]:print ""; ?>' readonly="" required="" placeholder="Provider Email id" />
															</div>
															<!-- Break -->
															<div class="col-12">
																<label>Provider Name</label>
																<input type="text" name="pname" id="pname" value='<?php isset($_REQUEST["pname"])?print $_REQUEST["pname"]:print ""; ?>' readonly="" required="" placeholder="Provider Name" />
															</div>
																<!-- Break -->
															<div class="col-12">
																<label>Service Id</label>
																<input type="text" name="sid" id="sid" value='<?php isset($_REQUEST["sid"])?print $_REQUEST["sid"]:print ""; ?>' readonly="" required="" placeholder="Service Id" />
															</div>
														
															<!-- Break -->
															<div class="col-12">
																<label>Service Type</label>
																<input type="text" name="stype" id="stype" value='<?php isset($_SESSION["type"])?print $_SESSION["type"]:print ""; ?>' readonly="" required="" placeholder="Service Type" />
															</div>
															<!-- Break -->


															<div class="col-12">
																<label>Work From Date</label>
																<input type="date" name="fdate" id="fdate" value="" required="" placeholder="Work From Date" />
															</div>
															<!-- Break -->
															
															<div class="col-12">
																<label>Work To Date</label>
																<input type="date" name="tdate" id="tdate" value="" required="" placeholder="Work To Date" />
															</div>
															<!-- Break -->
															<?php
																$con1=mysqli_connect("localhost","root","","ServiceDb");
																if(mysqli_connect_errno()>0)
																{
																	echo mysqli_connect_error();
																	exit();
																}
																if (isset($_REQUEST["eid"])) {
																	$e11id=$_REQUEST["eid"];
																}
																else {
																	$e11id=NULL;
																}
																$query1="select vlonteer from  user_table where email_id=? and Register_as='Provider'";
																$stmt1=$con1->prepare($query1);
																$stmt1->bind_param("s",$e11id);
																$stmt1->execute();
																$stmt1->store_result();
																if($stmt1->num_rows>0)
																{
																	$stmt1->bind_result($voln);
																	$stmt1->fetch();
																	if ($voln == "Vlonteer") {
																		echo '<div class="col-12" id="vlonteerX" style="display:block">';
																	}else {
																		echo '<div class="col-12" id="vlonteerX" style="display:none">';
																	}
																}
																else {
																	echo '<div class="col-12" id="vlonteerX" style="display:none">';
																}
																$con1->close();
															?>
																	<div class="col-3 col-12-small">
																				<label>Vlonteer :</label>
																			</div>
																			<div class="col-3 col-12-small">
																				<input type="radio" id="vlonteer" name="vlonteer" value="Vlonteer" checked="">
																				<label for="vlonteer">Vlonteer</label>
																			</div>
																			<div class="col-3 col-12-small">
																				<input type="radio" id="non-vlonteer" name="vlonteer" value="Normal">
																				<label for="non-vlonteer">Just Normal</label>
																			</div>
																		</div>
															
														
															
															<div class="col-12">
																<ul class="actions">
																	<li><input type="submit" name="sbbtn" value="Book Service" class="primary" /></li>
																	<li><input type="reset" value="Reset" /></li>
																</ul>
															</div>

															
														</div>
													</form>

													
													

											

											</div>
										</div>

								</section>

							
						</div>
					</div>

				<!-- Sidebar -->
				<div id="sidebar">
						<div class="inner">

							<?php include "cmenu.php"; ?>

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