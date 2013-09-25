<?php

	require_once('conn/conn.php');

	session_start();



	$news = $_POST['news'];



	$SQL9= "UPDATE NEWS SET newsContent = '$news' WHERE news_id = 1";

	mysql_query($SQL9, $conn) or die(mysql_error());

?>

<html>

<head>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">

	<link rel="stylesheet" type="text/css" href="css/student.css">

	<meta charset="utf-8">

	<title>Administrator Home Page</title>

</head>

<body>

	<div class="navbar navbar-inverse" style="position: static;">

		<div class="navbar-inner">

			<div class="container">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				</a>

				<a class="brand" href="index.html">Administrator Menu</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">

					<ul class="nav">

						<li><a href="index.html">Home</a></li>

						<li><a href="browseAccount.html">Manage User</a></li>

						<li><a href="browseReport.html">Manage Report</a></li>

						<li class="active"><a href="manageNews.html">Manage Announcement</a></li>

						<li><a href="licenseGen.html">License Generator</a></li>

						<li><a href="viewLicense.html">View Licenses</a></li>

					</ul>

					<ul class="nav pull-right">

						<li><a href="../logout.php">Logout</a></li>

					</ul>

				</div><!-- /.nav-collapse -->

			</div>

		</div><!-- /navbar-inner -->

	</div>

	<div class="container">

		<h1>Manage Announcement Successful!</h1>

	</div>

</body>



</html>