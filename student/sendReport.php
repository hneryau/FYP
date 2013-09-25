<?php
	session_start();
	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	$sql = "SELECT * FROM STUDENT WHERE student_id = (SELECT user_id FROM ACCOUNT WHERE login_id = '$login_id')";
	$result  = mysql_query($sql, $conn);
	$result1 = mysql_fetch_row($result);
	$sid = $result1[0];
	$type = $_POST['type'];
	$content = $_POST['content'];
	$target = "snapshot/student".$sid."/"; 
	$sql = "INSERT INTO REPORT (student_id, question_id, type, content, snapshot) values ('$sid',";
	echo "<table align='center'><tr><td><fieldset style='width:250px'><legend>Message</legend>";

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
			echo "The report has been sent!!";
			echo '<br>Click here to <a href="index.html">Back</a>';
			if ($type!="question") {
				$sql=$sql."null,'$type','$content','$target')";
			}else{
				$sql=$sql."'$_POST[qno]','$type','$content','$target')";
			}		
			mysql_query($sql, $conn);
		} 
		else 
		{ 
			echo "Sorry, there was a problem uploading your file."; 
		}
	}		
	

	echo "<p></fieldset></td></tr></table>";
?>