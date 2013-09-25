<?php
	require_once('conn/conn.php');
        mysql_select_db($database_conn, $conn);
	session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
				if( (!isset($_GET['student_id'])) || ($_GET['student_id']==null) ){
					echo '<a href="browseAccount.php?">
									No student set!!(Back)</a>';
				}else {
  						$query_delete = 'delete from STUDENT
										where student_id='.$_GET['student_id'];
						$query_delete2 = 'delete from ACCOUNT
										where user_id='.$_GET['student_id'];
  						mysql_query($query_delete, $conn) or die(mysql_error());
						mysql_query($query_delete2, $conn) or die(mysql_error());
					echo "<a href=\"browseAccount.php\">".
									"User deleted!</a>";
				}
?>
</body>
</html>