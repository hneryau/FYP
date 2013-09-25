<?php

	require_once("conn/conn.php");

	$chapter_id = $_POST['cid'];
	$book_id = $_POST['bid'];
	$chapter_no = $_POST['cno'];


	$sql = mysql_query("SELECT * FROM CHAPTER WHERE book_id = '$book_id'", $conn);

	
	$max = mysql_num_rows($sql); 


	if ($chapter_no >= $max){

	}else{

	$sql2 = mysql_query("SELECT chapter_id FROM CHAPTER WHERE book_id = '$book_id' AND chapterNo = '$chapter_no'+1", $conn);

	$result = mysql_fetch_row($sql2);

	$temp = $result[0];

	// echo "SID=".$section_id.", Temp=".$temp.", CID=".$chapter_id.", SNO=".$section_no.", max=".$max.",Section NO +1:".($section_no+1).",section NO -1:".($section_no);

	mysql_query("UPDATE CHAPTER SET chapterNo = '$chapter_no'+1 WHERE chapter_id = '$chapter_id'", $conn);
	mysql_query("UPDATE CHAPTER SET chapterNo = '$chapter_no' WHERE chapter_id = '$temp'", $conn);
	}


?>