<?php
	session_start();

	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];

	$sql = "SELECT * FROM NEWS WHERE news_id = 1";
	$result = mysql_fetch_row(mysql_query($sql, $conn));
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>E-Book System</title>
</head>
<body>
	<?= $result[1] ?>
</body>
</html>