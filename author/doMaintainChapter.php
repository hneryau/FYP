<?php
	require_once('conn/conn.php');
	session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Maintain Chapter</title>

</head>

<body>
<?php

                $chapter_id = $_POST['cid'];
				$chNo = $_POST['chNo'];
				$chName = $_POST['chName'];
                $chapterContent = $_POST['content'];

				$SQL9= "UPDATE CHAPTER SET chapterNo = '$chNo', chapterName = '$chName', chapterContent = '$chapterContent' WHERE chapter_id = '$chapter_id'";
				mysql_query($SQL9, $conn) or die(mysql_error());
				echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td>Maintain Chapter Successful!</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
				?>

</body>
</html>