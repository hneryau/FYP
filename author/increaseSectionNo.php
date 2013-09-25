<?php

	require_once("conn/conn.php");

	$section_id = $_POST['sid'];
	$chapter_id = $_POST['cid'];
	$section_no = $_POST['sno'];



	$sql = mysql_query("SELECT * FROM SECTION WHERE chapter_id = '$chapter_id'", $conn);
	
	$max = mysql_num_rows($sql); 


	if ($section_no >= $max){

	}else{

	$sql2 = mysql_query("SELECT section_id FROM SECTION WHERE chapter_id = '$chapter_id' AND sectionNo = '$section_no'+1", $conn);

	$result = mysql_fetch_row($sql2);

	$temp = $result[0];

	// echo "SID=".$section_id.", Temp=".$temp.", CID=".$chapter_id.", SNO=".$section_no.", max=".$max.",Section NO +1:".($section_no+1).",section NO -1:".($section_no);

	mysql_query("UPDATE SECTION SET sectionNo = '$section_no'+1 WHERE section_id = '$section_id'", $conn);
	mysql_query("UPDATE SECTION SET sectionNo = '$section_no' WHERE section_id = '$temp'", $conn);
	}


?>