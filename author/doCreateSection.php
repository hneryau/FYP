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
                $chapter_id = $_POST['chapter_id'];
                $authorId = $_POST['user_id'];
				$seNo = $_POST['seNo'];
				$seName = $_POST['seName'];
                $content = $_POST['content'];

				
                $insertValues = " ( null , '$chapter_id' , '$authorId' , '$seNo' , '$seName', '$content' ) ";
                mysql_select_db($database_conn, $conn);
    			$query_rs = "insert into SECTION values $insertValues";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
				echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td>Create Section Successful</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
echo '<meta http-equiv=REFRESH CONTENT=3;url=index.html>';				?> 

</body>
</html>