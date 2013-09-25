<?php

session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);


$user_id = $_POST["user_id"];
$book_id = $_POST["book_id"];
$chapter_id = $_POST["chapter_id"];
$section_id = $_POST["section_id"];
$number = $_POST["index"];
$html = $_POST["html"];
echo "user_id = ".$user_id;
echo "book_id = ".$book_id;
echo "index = ".$number;


if ($book_id != NULL) {
    $sql4 = "SELECT COUNT(*) FROM NOTES WHERE book_id = '$book_id' AND student_id='$user_id'";
    $result4 = mysql_query($sql4, $conn);
    $temp4 = mysql_fetch_row($result4);
} else if ($chapter_id != NULL) {
    $sql4 = "SELECT COUNT(*) FROM NOTES WHERE chapter_id = '$chapter_id' AND student_id='$user_id'";
    $result4 = mysql_query($sql4, $conn);
    $temp4 = mysql_fetch_row($result4);
} else if ($section_id != NULL) {
    $sql4 = "SELECT COUNT(*) FROM NOTES WHERE section_id = '$section_id' AND student_id='$user_id'";
    $result4 = mysql_query($sql4, $conn);
    $temp4 = mysql_fetch_row($result4);
}


if ($temp4[0] < 1) {
    $sql3 = "INSERT INTO NOTES VALUES (NULL, '$user_id', '$section_id', '$chapter_id', '$book_id', '$html', $number)";
    mysql_query($sql3, $conn) or die(mysql_error());
    echo "Note SAVED!!";

} else {

	
	if ($book_id != NULL) {
    $SQL2 = "UPDATE NOTES SET content='$html', number = '$number' WHERE student_id = '$user_id' AND book_id = '$book_id'";
    mysql_query($SQL2, $conn) or die(mysql_error());
    echo "Notes UPDATED!!";
    } else if ($chapter_id != NULL) {
    $SQL2 = "UPDATE NOTES SET content='$html', number = '$number' WHERE student_id = '$user_id' AND chapter_id = '$chapter_id'";
    mysql_query($SQL2, $conn) or die(mysql_error());
    echo "Notes UPDATED!!";
    } else if ($section_id != NULL) {
    $SQL2 = "UPDATE NOTES SET content='$html', number = '$number' WHERE student_id = '$user_id' AND section_id = '$section_id'";
    mysql_query($SQL2, $conn) or die(mysql_error());
    echo "Notes UPDATED!!";
    }
}


?>
