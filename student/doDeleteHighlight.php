<?php
ob_start();
session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);
$sql = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
$result = mysql_query($sql, $conn);
$temp1 = mysql_fetch_row($result);
$user_name = $temp1[1];
$user_id = $temp1[0];
$book_id = $_GET["book_id"];
$serializedHighlights = $_GET["serializedHighlights"];
$sql4 = "SELECT COUNT(*) FROM HIGHLIGHT WHERE book_id = '$book_id' AND student_id='$user_id'";
$result4 = mysql_query($sql4, $conn);
$temp4 = mysql_fetch_row($result4);
echo $temp4[0];

    $sql3 = "DELETE FROM HIGHLIGHT WHERE student_id = '$user_id' AND book_id ='$book_id'";
    @mysql_query($sql3, $conn) or die(mysql_error());
    echo "HIGHLIGHT DELETED!!";
    header("location: showBook.php?book_id=".$book_id);
    
ob_end_flush();
?>
