<?php
if(isset($_POST["sbbtn"]))
{
$emailid=$_POST["emailid"];
$nm=$_POST["nm"];
$mm=$_POST["msg"];
require 'PHPMailerAutoload.php';
$mail=new PHPMailer(); //CREATE NEW OBJECT
$mail->IsSMTP(); //ENABLE SMTP
//$mail->SMTPDebug=0; //DEBUG :1=ERRORS AND MESSAGE ,2=MESSAGE ONLY
$mail->SMTPAuth=true; //AUTHENTICATION ENABLE
$mail->SMTPSecure='tls'; //tls //SECURE TRANSFER ENABLED
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->Username='householdservice20@gmail.com';
$mail->Password='ohsp2020#';
$mail->setFrom('householdservice20@gmail.com','Household Service Portal');
//$mail->addReplyTo('email','name');
$mail->Subject="Contact Messsage From ".$nm;
$mail->Body=$mm." <br>From,<br>Name : ".$nm.",<br>Emailid: ".$emailid;
$mail->addAddress("meetigandhi002@gmail.com");
//$mail->addCC('');
//$mail->addBCC('');
$mail->WordWrap=50;
//$mail->addAttachment('/file.doc');
//$mail->addAttachment('/img.jpg','new.jpg');
$mail->isHTML(true);
if(!$mail->send())
{
$msg='Mail error: '.$mail->ErrorInfo;
}
else
{
$msg='Message is Sent!..';
}
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
		<title>Online HouseHold Service Portal</title>
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
									<a href="index.php" class="logo"><strong>Household</strong> Service Portal</a>
									
								</header>

							<!-- Banner -->
								<section>
									<header class="major">
										<h2>Contact Us</h2>
									</header>
										<div class="row gtr-200">
											<div class="col-6 col-12-medium">
												<section>
												<ul class="contact">
													<li class="icon solid fa-envelope"><a href="mailto:meetigandhi002@gmail.com">meetigandhi002@gmail.com</a></li>
													<li class="icon solid fa-phone">+91 81418 65603</li>
													<li class="icon solid fa-home">302/P.Maneklal (Tirth) Complex,<br />Jalvihar Society,<br />Station Road,<br />Dahod-389151</li>
												</ul>
												</section>
											</div>
											<div class="col-6 col-12-medium">
													<form method="post" action="">
														<div class="row gtr-uniform">
															<div class="col-12">
																<label><h3 style="color:green"><?php isset($msg)?print $msg:print "";?><h3></label>
															</div>
															<div class="col-12">
																<label>Email Id :</label>
																<input type="email" name="emailid" id="emailid" value="" required="" placeholder="Email id" />
															</div>
															<!-- Break -->
														
															<div class="col-12">
																<label>Name :</label>
																<input type="text" name="nm" id="nm" value="" required="" placeholder="Name" />
															</div>
															<!-- Break -->
															<!-- Break -->

															<div class="col-12">
																<label>Message :</label>
																<textarea name="msg" id="msg" placeholder="Enter Your Message" rows="5"></textarea>
															</div>
															<!-- Break -->	
															
															<!-- Break -->
															
															<div class="col-12">
																<ul class="actions">
																	<li><input type="submit" name="sbbtn" value="Send" class="primary" /></li>
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

							
							<!-- Menu -->
							<?php include "menu.php"; ?>

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