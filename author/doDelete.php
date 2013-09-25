<?php
session_start();
require_once('conn/conn.php');

$question_id = $_POST['question_id'];
$sql4 = "SELECT * FROM QUESTION WHERE question_id = $question_id";
$result4 = mysql_query($sql4, $conn);
$temp4 = mysql_fetch_row($result4);
$id = $temp4[7];
if ($temp4[2]=='MC'){
	$sql2 = "DELETE FROM MC WHERE question_id = $question_id";
	mysql_query($sql2, $conn);
}else if($temp4[2]=='FIB'){
	$sql3 = "DELETE FROM FIB WHERE question_id = $question_id";
	mysql_query($sql3, $conn);
}
$sql = "DELETE FROM QUESTION WHERE question_id = $question_id";
mysql_query($sql, $conn);

?>
