<?php
	// session_start();
	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	$sql = "SELECT * FROM AUTHOR WHERE author_id = (SELECT user_id FROM ACCOUNT WHERE login_id = '$login_id')";
	$result  = mysql_query($sql, $conn);
	$result1 = mysql_fetch_row($result);
	$sid = $result1[0];
	$name = $result1[1];
	$email = $result1[2];
	$tel = $result1[3];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Information - Student</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
</head>
<body>
	<form action = "update.php" method = "post" name = "update">
		<table class="table table-striped table-hover">
			<tbody>
			<tr>
				<td><h4>Student ID:</td><td><input style="font-weight: bold;" type = "text" name = "sid" value = "<?php echo $sid ?>" readonly></td>
			</tr>
			<tr>
				<td><h4>Name:</td><td><input style="font-weight: bold;" type = "text" name = "name" value = "<?php echo $name?>" required></td>
			</tr>
			<tr>
				<td><h4>Email:</td><td><input style="font-weight: bold;" type = "email" name = "email" value = "<?php echo $email?>" required></td>
			</tr>
			<tr>
				<td><h4>Telephone:</td><td><input style="font-weight: bold;" type = "text" name = "tel" value = "<?php echo$tel?>" required></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" class="btn btn-success">Submit</button>
				<button type = "reset" class="btn btn-warning">Reset</button>
				<a STYLE="text-decoration:none" role="button" class="btn btn-primary" href="changePassword.html">Change Password</a></td>
			</tr>
			</tbody>
		</table>
	</form>
</body>
</html>