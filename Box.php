<?php
include "base.php";
?>
<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<link rel="shortcut icon" href="box.ico" type="image/x-icon">
	<head>
		<title>Foodbox</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Foodbox</a></h1>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
						<?php
							if($_SESSION['Unlocked'] == "True")
							{
								echo "<h3>Box has been unlocked</h3>";
								$_SESSION['Unlocked'] = "False";
                                echo "<a href='Box.php'>Close Box</a>";
							}
							elseif(!empty($_POST['Pin']))
							{
								$pin = mysqli_real_escape_string($dbcon, $_POST['Pin']);
								$box_id = 3333;
								//$box_id = $_SESSION['Box_id'];
								
								$check_volunteer = mysqli_query($dbcon, "SELECT * FROM Delivery 
																		 WHERE Pin = '".$pin."' AND Box_ID = '".$box_id."'");
								
								if(mysqli_num_rows($check_volunteer) == 1)
								{
									$_SESSION['Unlocked'] = "True";
									date_default_timezone_set('america/chicago');
									$registereddatetime = date("Y\-m\-d H\:i\:s");
									$updatename = mysqli_query($dbcon, "UPDATE Delivery SET Pickup_DateTime='".$registereddatetime."' 
																		WHERE Pin='".$pin."' AND Box_ID='".$box_id."' AND Pickup_DateTime='0000-00-00 00:00:00'");
									
									echo "<meta http-equiv='refresh' content='0;Box.php'/>";
								}
								else
								{
									echo "<h1>Wrong Pin Entered</h1>";
									echo "<meta http-equiv='refresh' content='2;Box.php'/>";
								}
							}
							else
							{?>
								<h2>Enter your code</h2>
								<form action="Box.php" method="post">
									<input type="number" name="Pin" min="1111" max="9999" /><br />
									<br />
									<input type="submit" name="checkform" value="Submit" />
								</form>
							<?php
							}
						?>
						<br/>
						</header>
					</article>
				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Foodbox</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>