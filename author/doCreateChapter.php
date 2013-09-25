<?php 
	require_once('conn/conn.php');
	session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
                <?php
				
                $book_id = $_POST['book_id'];
                $authorId = $_POST['user_id'];
				$chNo = $_POST['chNo'];
				$chName = $_POST['chName'];
                $content = $_POST['content'];

				
                $insertValues = " ( null , '$book_id' , '$authorId' , '$chNo' , '$chName', '$content' ) ";
                mysql_select_db($database_conn, $conn);
    			$query_rs = "insert into CHAPTER values $insertValues";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
				echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td>Create chapter sucessful!</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
				?> 

</body>
</html>