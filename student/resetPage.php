<?php

session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);
$sql = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
$result = mysql_query($sql, $conn);
$temp1 = mysql_fetch_row($result);
$user_name = $temp1[1];
$user_id = $temp1[0];

$serializedHighlights = $_GET["serializedHighlights"];
$sql4 = "SELECT COUNT(*) FROM HIGHLIGHT WHERE book_id = '$book_id' AND student_id='$user_id'";
$result4 = mysql_query($sql4, $conn);
$temp4 = mysql_fetch_row($result4);
echo $temp4[0];

$book_id = $_GET["book_id"];
$chapter_id = $_GET["chapter_id"];
$section_id = $_GET["section_id"];

   if ($book_id != NULL) {
    $sql3 = "DELETE FROM HIGHLIGHT WHERE student_id = '$user_id' AND book_id ='$book_id'";
    @mysql_query($sql3, $conn) or die(mysql_error());
		
	$sql4 = "DELETE FROM NOTES WHERE student_id = '$user_id' AND book_id ='$book_id'";
    @mysql_query($sql4, $conn) or die(mysql_error());
    } else if ($chapter_id != NULL) {
    $sql3 = "DELETE FROM HIGHLIGHT WHERE student_id = '$user_id' AND chapter_id ='$chapter_id'";
    @mysql_query($sql3, $conn) or die(mysql_error());
		
	$sql4 = "DELETE FROM NOTES WHERE student_id = '$user_id' AND chapter_id ='$chapter_id'";
    @mysql_query($sql4, $conn) or die(mysql_error());
    } else if ($section_id != NULL) {
    $sql3 = "DELETE FROM HIGHLIGHT WHERE student_id = '$user_id' AND section_id ='$section_id'";
    @mysql_query($sql3, $conn) or die(mysql_error());
		
	$sql4 = "DELETE FROM NOTES WHERE student_id = '$user_id' AND section_id ='$section_id'";
    @mysql_query($sql4, $conn) or die(mysql_error());
    }
	



?>
