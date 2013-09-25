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




$total = $_POST['total'];
$test_id = $_GET['test_id'];
$sql99 = "SELECT * FROM TEST WHERE test_id = $test_id";
$result99 = mysql_query($sql99, $conn);
$temp99 = mysql_fetch_row($result99);
$totalScore = $temp99[5];

for ($i=1; $i<=$total; $i++){
	$type = $_POST['type'.$i];
	if ($type == 'MC') {
		$qn = $_POST['qn'.$i ];
		$content = $_POST['editor'.$i];
		$choiceA = $_POST['choicea'.$i];
		$choiceB = $_POST['choiceb'.$i];
		$choiceC = $_POST['choicec'.$i];
		$choiceD = $_POST['choiced'.$i];
		$test_id = $_GET['test_id'];
		$ans= $_POST['ans'.$i];
		$score = $_POST['mark'.$i];
		$book_id = $_GET['book_id'];
		$chapter_id = $_GET['chapter_id'];
		$totalScore += $score;
		
		$SQL0 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'QUESTION'";
		$result9 =  mysql_query($SQL0, $conn);
		$temp0 = mysql_fetch_row($result9);
		$index = $temp0[0];
		
		$SQL1 = "INSERT INTO QUESTION VALUES(NULL, '$qn', '$type', NULL, '$chapter_id', '$book_id', NULL, '$test_id', '$user_id', '$score', 0, 0)";
		@mysql_query($SQL1, $conn) or die(mysql_error());
		$SQL2 = "INSERT INTO MC VALUES(NULL, '$index', '$content', '$choiceA', '$choiceB', '$choiceC', '$choiceD', '$ans')";
		@mysql_query($SQL2, $conn) or die(mysql_error());
		
	} else if ($type =='FIB') {
		
		$qn = $_POST['qn'.$i ];
		$question = $_POST['editor'.$i];
		$answerA = $_POST['answera'.$i];
		$answerB = $_POST['answerb'.$i];
		$answerC = $_POST['answerc'.$i];
		$answerD = $_POST['answerd'.$i];
		$scoreA = $_POST['ansascore'.$i];
		$scoreB = $_POST['ansbscore'.$i];
		$scoreC = $_POST['anscscore'.$i];
		$scoreD = $_POST['ansdscore'.$i];
		$score = $_POST['mark'.$i];
		$totalScore += $score;
		if (isset($_POST['partialmark'.$i])){
			$pm = 1;
		} else {
			$pm = 0;
		};
		
		
		if (isset($_POST['inva'.$i])){
			$invAnsA = 1;
		} else {
			$invAnsA = 0;
		};
		if (isset($_POST['invb'.$i])){
			$invAnsB = 1;
		} else {
			$invAnsB = 0;
		};
		if (isset($_POST['invc'.$i])){
			$invAnsC = 1;
		} else {
			$invAnsC = 0;
		};
		if (isset($_POST['invd'.$i])){
			$invAnsD = 1;
		} else {
			$invAnsD = 0;
		};
		
		if (isset($_POST['csa'.$i])){
			$csAnsA = 1;
		} else {
			$csAnsA = 0;
		};
		if (isset($_POST['csb'.$i])){
			$csAnsB = 1;
		} else {
			$csAnsB = 0;
		};
		if (isset($_POST['csc'.$i])){
			$csAnsC = 1;
		} else {
			$csAnsC = 0;
		};
		if (isset($_POST['csd'.$i])){
			$csAnsD = 1;
		} else {
			$csAnsD = 0;
		};
		

		$test_id = $_GET['test_id'];
		
		$book_id = $_GET['book_id'];
		$chapter_id = $_GET['chapter_id'];
		
		$SQL0 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'QUESTION'";
		$result9 =  mysql_query($SQL0, $conn);
		$temp0 = mysql_fetch_row($result9);
		$index = $temp0[0];
		
		$SQL1 = "INSERT INTO QUESTION VALUES(NULL, '$qn', '$type', NULL, '$chapter_id', '$book_id', NULL, '$test_id', '$user_id', '$score', 0, 0)";
		@mysql_query($SQL1, $conn) or die(mysql_error());
		$SQL2 = "INSERT INTO FIB VALUES(NULL, '$index', '$question', '$answerA', '$answerB', '$answerC', '$answerD', '$invAnsA', '$invAnsB', '$invAnsC', '$invAnsD', '$csAnsA', '$csAnsB', '$csAnsC', '$csAnsD', '$scoreA', '$scoreB', '$scoreC', '$scoreD', '$pm')";
		@mysql_query($SQL2, $conn) or die(mysql_error());	
		
		
	} else {
		echo "";
	}
	$sql28 = "UPDATE TEST SET totalScore = '$totalScore' WHERE test_id='$test_id'";
    mysql_query($sql28, $conn) or die(mysql_error());	
}
echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td>Create test sucessful!</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';

?>