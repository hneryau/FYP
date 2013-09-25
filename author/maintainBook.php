<?php
	session_start();

	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT user_id, name FROM AUTHOR, ACCOUNT WHERE author_id = user_id and login_id = '$login_id'";
	$result =  mysql_query($sql, $conn);
	$temp1 = mysql_fetch_row($result);
	$user_name = $temp1[1];
	$user_id = $temp1[0];

	$book_id = $_GET['book_id'];
	$sql2 = "SELECT * FROM BOOK WHERE book_id='$book_id'";
	$result2 = mysql_query($sql2, $conn);
	$temp2 = mysql_fetch_row($result2);

	$author_id = $temp2[1];
	$sql3 = "SELECT * FROM AUTHOR WHERE author_id='$author_id'";
	$result3 = mysql_query($sql3, $conn);
	$temp3 = mysql_fetch_row($result3);

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

<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Maintain Book</title>
<script type="text/javascript" src="CreateBookEditor/ckeditor.js"></script>

</head>

<body>

<h1>Maintain Book</h1>

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

	<form action="doMaintainBook.php" method="post" enctype="multipart/form-data">
		<table align="left" cellspacing="5px" cellpadding="5px">
        <tr>
        <td><b>Book Name: </b></td>
        <td><input name= "bkName" type="textbox" width="480" value="<?= $temp2[2] ?>"></td>
        </tr>
        <tr>
        <td><b>Book Cover: </b></td>
        <td><img width="150" src="<?= $temp2[6] ?>"/></td>
        </tr>
        <tr>
        <td></td>
        <td><input type="file" name="file" id="file"></td>
        </tr>
        <tr>
        <td><b>Author: </b></td>
        <td><?= $temp3[1] ?></td>
        </tr>

        <tr>
        <td><b>Category: </b></td>
        <td>
        <?php
        	if($temp2[3]=="Chinese"){
        		$catChi = " selected";
        	}else if($temp2[3]=="English"){
        		$catEng = " selected";
        	}else if($temp2[3]=="Mathematics"){
        		$catMat = " selected";
        	}else if($temp2[3]=="History"){
        		$catHis = " selected";
        	}else if($temp2[3]=="Music&Arts"){
        		$catMus = " selected";
        	}else if($temp2[3]=="Others"){
        		$catOth = " selected";
        	}else{
        		$catOth = " selected";
        	}
        	?>
        	<SELECT NAME="category">
				<OPTION VALUE="Chinese"<?= $catChi ?>>Chinese
				<OPTION VALUE="English"<?= $catEng ?>>English
				<OPTION VALUE="Mathematics"<?= $catMat ?>>Mathematics
				<OPTION VALUE="History"<?= $catHis ?>>History
				<OPTION VALUE="Music&Arts"<?= $catMus ?>>Music & Arts
				<OPTION VALUE="Others"<?= $catOth ?>>Others
			</SELECT>
        </td>
        </tr>
        <tr>
        <td><b>Description of Book: </b></td>
        <td><textarea class="ckeditor" cols="80" id="editor1" name="description" rows="10"><?= $temp2[5] ?></textarea></td>
        </tr>
        <tr>
        <td><b>Status: </b></td>
        <td>
        <?php
        	if($temp2[4]=="1"){
        		$status1 = " checked";
        	}else if($temp2[4]=="0"){
        		$status0 = " checked";
        	}else{
        		$status0 = " checked";
        	}
        ?>
        <input type="radio" name ="status" value = "1"<?= $status1 ?>> Open</input>
        <input type="radio" name ="status" value = "0"<?= $status0 ?>> Close</input>
        <input type="hidden" name="bid" value="<?= $book_id ?>">
        </td>
        </tr>
        <tr>
        <td><input type="submit" value="Submit"></td>
        </tr>
        </table>
	</form>
<?php } ?>

</body>
</html>