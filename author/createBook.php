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
?>

<!doctype html>
<html>
<head>



<meta charset="utf-8">
<title>Create New Book</title>
<script type="text/javascript" src="CreateBookEditor/ckeditor.js"></script>



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

<h1>Create New Book</h1>


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

	<form action="doCreateBook.php" method="post" target="_blank" enctype="multipart/form-data">
		<table align="left" cellspacing="5px" cellpadding="5px">
        <tr>
        <td>
        <b>Book Name: </b>
        </td>
        <td>
        <input name= "bkName" type="textbox" width="480">
        </td>
        </tr>
        <tr>
        <td>
        <b>Book Cover: </b>
        </td>
        <td>
        <input type="file" name="file" id="file">
        </td>
        </tr>
        <tr>
        <td>
        <b>Author: </b>
        </td>
        <td>
        <?php echo $user_name ;?> 
		<input name= "user_id" type="hidden" value=<?php echo $user_id ?> />
        </td>
        </tr>
        
        <tr>
        <td><b>Category: </b></td>
        <td>
        	<SELECT NAME="category">
			<OPTION VALUE="Chinese">Chinese
			<OPTION VALUE="English">English
			<OPTION VALUE="Mathematics">Mathematics
			<OPTION VALUE="History">History
			<OPTION VALUE="Music&Arts">Music & Arts
			<OPTION VALUE="Others">Others
		</SELECT>
        </td>
        </tr>
        

        
        <tr>
        <td><b>Description of Book: </b></td>
        <td>
        <textarea class="ckeditor" cols="80" id="editor1" name="description" rows="10"></textarea>
        </td>
        </tr>
        
        <tr>
        <td>
        <b>Status: </b>
        <td>
        <input type="radio" name ="status" value = "1" autocomplete="default"> Open</input>
        <input type="radio" name ="status" value = "0"> Close</input>
		</textarea>
        </td>
        </tr>
        
        <tr>
        <td>
		<input type="submit" value="Submit">
        </td>
        </tr>
        
        </table>
	</form>
<?php } ?>
    
</body>
</html>