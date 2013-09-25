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

	$chapter_id = $_GET['chapter_id'];
	$sql = "SELECT * FROM CHAPTER WHERE chapter_id = '$chapter_id'";
	$result =  mysql_query($sql, $conn);
	$temp8 = mysql_fetch_row($result);
	$chapterName = $temp8[4];
	$sql = "SELECT * FROM SECTION WHERE chapter_id = '$chapter_id'";
	$result = mysql_query($sql, $conn);
	$count = mysql_num_rows($result);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create New Section</title>
<script type="text/javascript" src="CreateBookEditor/ckeditor.js"></script>

<link rel="stylesheet" href="Create.css">



</head>

<body>


<h1>Create New Section</h1>


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

	<form action=<?php echo "doCreateSection.php?chapter_id=".$chapter_id ?> method="post" target="_blank">
		<table align="left" cellspacing="5px" cellpadding="5px">
        
        <tr>
        <td>
        <b>Section No.: </b>
        </td>
        <td>    
        	<input name= "seNo" type="hidden" value="<?php echo ++$count?>">
        	<?php echo $count?>  
        </td>
        </tr>
        
        <tr>
        <td>
        <b>Section Name: </b>
        </td>
        <td>
        <input name= "seName" type="textbox" width="480">
        </td>
        </tr>   
        
        <tr>
        <td>
        <b>Author: </b> 
        </td>
        <td>
        <?php echo $user_name ?> <input name= "user_id" type="hidden" value=<?php echo $user_id ?> />
        </td>
        </tr>
        
        <tr>
        <td>
        <b>Chapter Name: </b>
        </td>
        <td>
        <?php echo $chapterName ?> <input  name = "chapter_id" type="hidden" width="480" value=<?php echo $chapter_id ?> />
        </td>
        </tr>
        
        <tr>
        <td>
        <b>Section Content: </b>
	</td>
        <td>
                <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10"></textarea>
        </td>
        </tr>
        

        
        <tr>
        <td>
		<input type="submit" value="Submit">
        </td>
        </tr>
        
        </table>
	</form>

    
</body>
<?php } ?>
</html>