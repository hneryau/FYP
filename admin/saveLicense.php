<?php

	require_once('conn/conn.php');

	$sql="INSERT INTO license VALUES ('$_POST[license]', '$_POST[days]', 1)";

	mysql_query($sql);

	session_start();

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
						<li><a href="manageNews.html">Manage Announcement</a></li>
						<li class="active"><a href="licenseGen.html">License Generator</a></li>
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
		<fieldset class="span6">
			<legend>Message</legend>
			<h3>License has been saved successfully!</h3><br>
			<h4>Click <a href="licenseGen.html">here</a> to continue or <a href="index.html">back</a> to homepage.</h4>
			
		</fieldset>
	<div class="container">
</body>