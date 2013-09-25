<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
                <?php
				require_once('conn/conn.php');
                $student_id = $_POST['student_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
				$license = $_POST['license'];
				$expiry_date = $_POST['expiry_date'];
				$status = $_POST['status'];
                mysql_select_db($database_conn, $conn);
    			$query_rs = "UPDATE STUDENT set  name='$name' , email='$email', tel='$tel', license='$license', expiry_date='$expiry_date' where student_id='$student_id'";
				$query_rs2 = "UPDATE ACCOUNT set status='$status' where user_id='$student_id'";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
				@mysql_query($query_rs2, $conn) or die(mysql_error());
				echo"<h1>Update User Successful</h1>";
				?>
</body>
</html>