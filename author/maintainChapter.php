<?php
	session_start();

	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	mysql_select_db($database_conn, $conn);

	$chapter_id = $_GET['chapter_id'];
	$sql0 = "SELECT * FROM CHAPTER WHERE chapter_id='$chapter_id'";
	$result0 = mysql_query($sql0, $conn);
	$temp0 = mysql_fetch_row($result0);

	$sql1 = "SELECT * FROM BOOK WHERE book_id='$temp0[1]'";
	$result1 = mysql_query($sql1, $conn);
	$temp1 = mysql_fetch_row($result1);

	$sql2 = "SELECT * FROM AUTHOR WHERE author_id='$temp0[2]'";
	$result2 = mysql_query($sql2, $conn);
	$temp2 = mysql_fetch_row($result2);
?>

<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Maintain Chapter</title>
<script type="text/javascript" src="CreateBookEditor/ckeditor.js"></script>

<link rel="stylesheet" href="Create.css">

</head>

<body>
<?php
if (isset($_SESSION['loggedin'])!= 'YES') {
		echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td><b>Please login first!</b><br>Click <a href="../index.html">HERE</a> to login.</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
	}
	else {
?>

<h1>Maintain Chapter</h1>

<table>
<form action="doUpload.php" method="post" enctype="multipart/form-data" target="new">
	<tr>
	<thead><font color="red">Supported Formats</font></thead>
	</tr>
	<tr>
	<td><b>Picture: </b></td>
	<td>.jpg , .jpeg , .gif , .png</td>
	</tr>
	<tr>
	<td><b>Flash: </b></td>
	<td>.swf</td>
	</tr>
	<tr></tr>
	<tr>
	<td><label for="file"><b>File Name: </b></label></td>
	<td><input type="file" name="file" id="file"></td>
	</tr>
	<tr>
	<td><input type="submit" name="submit" value="Upload"></td>
	</tr>
</form>
</table>

	<form action="doMaintainChapter.php" method="post" enctype="multipart/form-data">
		<table align="left" cellspacing="5px" cellpadding="5px">
        <tr>
        <td><b>Chapter No.: </b></td>
        <td><input name= "chNo" type="textbox" width="480" value="<?= $temp0[3] ?>"></td>
        </tr>
        <tr>
        <td><b>Chapter Name: </b></td>
        <td><input name= "chName" type="textbox" width="480" value="<?= $temp0[4] ?>"></td>
        </tr>
        <tr>
        <td><b>Author: </b></td>
        <td><?= $temp2[1] ?></td>
        </tr>
        <tr>
        <td><b>Book Name: </b></td>
        <td><?= $temp1[2] ?><input name="cid" type="hidden" value="<?= $chapter_id ?>"></td>
        </tr>
        <tr>
        <td><b>Chapter Content: </b></td>
        <td><textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10"><?= $temp0[5] ?></textarea></td>
        </tr>
        <tr>
        <td><input type="submit" value="Submit"></td>
        </tr>
        </table>
	</form>
<?php } ?>

</body>
</html>