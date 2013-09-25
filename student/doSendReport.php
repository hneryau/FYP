<?php
	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	$sql = "SELECT * FROM STUDENT WHERE student_id = (SELECT user_id FROM ACCOUNT WHERE login_id = '$login_id')";
	$result  = mysql_query($sql, $conn);
	$result1 = mysql_fetch_row($result);
	$sid = $result1[0];
	$type = $_POST['type'];

	$content = $_POST['content'];
	$target = "snapshot/student".$sid."/"; 
	$sql = "INSERT INTO REPORT (student_id, question_id, chapter_id, type, content, snapshot) values ('$sid',";



	echo "<fieldset style='width:250px'><legend>Message</legend>";

	if ($_FILES["file"]["error"] > 0)
	{
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
	if (!(is_dir($target))){
	mkdir("snapshot/");
	mkdir($target);}
	$target=$target.$_FILES['file']['name'];

	if(move_uploaded_file($_FILES['file']['tmp_name'],$target )) 
	{ 
	echo "<h4>The report has been sent!!";
	if ($type!="question") {
		$sql=$sql."null, null,'$type','$content','$target')";
	}else{
		$sql=$sql."'$_POST[qno]', '$_POST[cno]', '$type','$content','$target')";
	}		
	mysql_query($sql, $conn);
	} 
	else 
	{ 
	echo "<h4>Sorry, there was a problem uploading your file."; 
	}
	echo '<br><br><h5>Click here to <a href="index.html">Back</a>';
	}		


	echo "<p></fieldset>"; 
?>