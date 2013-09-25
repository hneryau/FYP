<?php
	session_start();
	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
	$result =  mysql_query($sql, $conn);
	$temp1 = mysql_fetch_row($result);
	$user_name = $temp1[1];
	$user_id = $temp1[0];
	
	$SQL0 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'SUBMISSION'";
	$result9 =  mysql_query($SQL0, $conn);
	$temp0 = mysql_fetch_row($result9);
	$index = $temp0[0];
	
	
	$total = $_POST['number'];
	$test_id = $_POST['test_id'];
	date_default_timezone_set('Asia/Hong_Kong');
	$date = date('Y-m-d H:i:s');
	$date1 = $date."";
	echo $date1;
	$sql2 = "INSERT INTO SUBMISSION VALUES (NULL, '$user_id', '$test_id', '$date1', 0)";
	@mysql_query($sql2, $conn) or die(mysql_error());
	
	

	
	
for ($i=1; $i<=$total; $i++){
	
	$SQL6 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'S_QUESTION'";
	$result6 =  mysql_query($SQL6, $conn);
	$temp6 = mysql_fetch_row($result6);
	$index6 = $temp6[0];
	
	$type = $_POST['type'.$i];
	$question_id = $_POST['question_id'.$i];
	
	if ($type == 'MC') {
		$sql3 = "INSERT INTO S_QUESTION VALUES (NULL, '$index', '$question_id', '$type', NULL, NULL)";
		@mysql_query($sql3, $conn) or die(mysql_error());
	
		$answer = $_POST['ans'.$i];
		$sql7 = "INSERT INTO S_MC VALUES (NULL, '$index6', '$answer' )";
		@mysql_query($sql7, $conn) or die(mysql_error());
	} else if ($type == 'FIB'){
		$sql4 = "INSERT INTO S_QUESTION VALUES (NULL, '$index', '$question_id', '$type', NULL, NULL)";
		@mysql_query($sql4, $conn) or die(mysql_error());
	
		$answerA = $_POST['ansa'.$i];
		$answerB = $_POST['ansb'.$i];
		$answerC = $_POST['ansc'.$i];
		$answerD = $_POST['ansd'.$i];
		$sql8 = "INSERT INTO S_FIB VALUES (NULL, '$index6', '$answerA', '$answerB', '$answerC', '$answerD')";
		@mysql_query($sql8, $conn) or die(mysql_error());
	}

}


echo 'Submit test sucessful!<br><a href="mark.php?submission_id='.$index.'">Mark Test</a>';

?>