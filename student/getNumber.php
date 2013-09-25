<?php

require_once('conn/conn.php');

$bid=$_GET["bid"];

$cid=$_GET["cid"];

if (!empty($bid)) {

	$sql="SELECT chapter_id, chapterNo, chapterName FROM CHAPTER WHERE book_id = '".$bid."'";

	$result = mysql_query($sql,$conn);

	echo "<option value = ''>Select a chapter</option>";

	while($row = mysql_fetch_row($result))
	{
	echo "<option value ='$row[0]'>$row[1]. $row[2]</option>";
	}

}
if (empty($bid)) {

	$sql="SELECT question_id, questionNo FROM QUESTION WHERE chapter_id = '".$cid."' ORDER BY questionNo";

	$result = mysql_query($sql,$conn);

	echo "<option value = ''>Select a question</option>";

	while($row = mysql_fetch_row($result))
	{
	echo "<option value ='$row[0]'>$row[1]</option>";
	}

}

mysql_close($conn);
?>