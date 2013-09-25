<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
                <?php
				require_once('conn/conn.php');
                $author_id = $_POST['author_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                mysql_select_db($database_conn, $conn);
    			$query_rs = "UPDATE AUTHOR set  name='$name' , email='$email', tel='$tel' where author_id='$author_id'";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
				echo"<h1>Update User Successful</h1>";
				?>
</body>
</html>