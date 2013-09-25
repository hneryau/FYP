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
	$sql2 = "SELECT BOOKNAME FROM BOOK WHERE BOOK_ID = '$book_id'"; 
	$result2 =  mysql_query($sql2, $conn);
	$temp2 = mysql_fetch_row($result2);
	$bookname = $temp2[0];
	
	$chapter_id = $_GET['chapter_id'];
	$sql3 = "SELECT CHAPTERNO, CHAPTERNAME FROM CHAPTER WHERE CHAPTER_ID = '$chapter_id'";
	$result3 =  mysql_query($sql3, $conn);
	$temp3 = mysql_fetch_row($result3);
	$chapterno =  $temp3[0];
	$chaptername = $temp3[1];

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
<title>Create Test</title>
</head>

<body>
<h1>Create Test in <?php echo $bookname. " Chapter ". $chapterno." ".$chaptername?></h1>

<form action="doCreateTest.php" method="POST"> 

<table>
<tr>
<td>Book:</td><td><?php echo $bookname?></td> <input name= "book_id" type="hidden" value=<?php echo $book_id ?> />
</tr>
<tr>
<td>Chapter:</td><td><?php echo  $chapterno." ".$chaptername?></td> <input name= "chapter_id" type="hidden" value=<?php echo $chapter_id ?> />
</tr>
<tr>
<td>Author:</td><td><?php echo  $user_name?></td><input name="user_id" type="hidden" value=<?php echo $user_id ?> />
</tr>

	        <tr><td> Time Limit:</td><td>
            <select name="time">
               <option value = "15">15 minutes</option>
               <option value = "30">30 minutes</option>
               <option value = "45">45 minutes</option>
               <option value = "60">1 hour</option>
	       <option value = "75">1 hour 15 minutes</option>
	       <option value = "90">1 hour 30 minutes</option>
             </select>
             </td>
             <input type="Submit" value = "Insert questions to test">
</table>

</form>
</body>
<?php } ?>
</html>