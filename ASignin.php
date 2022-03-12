<?php
@session_start();
$con = mysqli_connect("localhost", "root", "", "ServiceDb");
if (mysqli_connect_errno() > 0) {
	echo mysqli_connect_error();
	exit();
}

if (isset($_POST["sbbtn"])) {
	$emailid = $_POST["emailid"];
	$pass = $_POST["pass"];

	// THE NEW CODE IS HERE
	// if (($emailid == 'admin@admin') && ($pass == 'password')) {
	// 	header("location:admin.php");
	// }
	// END
	
	$utype = "Admin";
	$status = 'Active';
	$query = "select first_name,middle_name,last_name,photo,mobile_no from user_table where status=? and email_id=? and password=? and Register_As=?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("ssss", $status, $emailid, $pass, $utype);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($fname, $mname, $lname, $img, $mno);
		$stmt->fetch();
		$_SESSION["emailid"] = $emailid;
		$_SESSION["name"] = $lname . " " . $mname . " " . $fname;
		$_SESSION["utype"] = $utype;
		$_SESSION["img"] = $img;
		$_SESSION["mno"] = $mno;
		header("location:admin.php");
		
	} else {
		$msg = "Invalid Emailid or Password...";
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
					<h2 id="elements">Sign In Page</h2>
					<hr class="major" />
					<div class="row gtr-200">


						<div class="col-6 col-12-medium">
							<form method="post" action="asignin.php">
								<div class="row gtr-uniform">

									<div class="col-12">
										<label>
											<h3 style="color:green"><?php isset($msg) ? print $msg : print ""; ?><h3>
										</label>
									</div>

									<div class="col-12">
										<label>Email Id :</label>
										<input type="email" name="emailid" id="emailid" value="" required="" placeholder="Email id" />
									</div>
									<!-- Break -->

									<div class="col-12">
										<label>Password</label>
										<input type="password" name="pass" id="pass" value="" required="" placeholder="Password (Atleast 8 Characters)" />
										<div style="text-align: right;">
											<a href="Verify.php">Forgot Password</a>
										</div>
									</div>
									<!-- Break -->

									<div class="col-12">
										<ul class="actions">
											<li><input type="submit" name="sbbtn" value="Login" class="primary" /></li>
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

				<?php include "amenu.php"; ?>


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