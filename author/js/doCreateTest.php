<?php 
	require_once('conn/conn.php');
	session_start(); 
	
	$SQL0 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'TEST' LIMIT 0 , 30";
	$result9 =  mysql_query($SQL0, $conn);
	$temp0 = mysql_fetch_row($result9);
	$index = $temp0[0];
	
		
	$chapter_id = $_POST['chapter_id'];
	$book_id = $_POST['book_id'];
	$author_id = $_POST['user_id'];
	$timestr = $_POST_['time'];
	$time = 0+$timestr;
	

                mysql_select_db($database_conn, $conn);
				$query_rs = "insert into TEST values( null , '$chapter_id', '$book_id'  , '$author_id' , '$time' )";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
	
    header("Location: createQuestion.php?book_id=".$book_id."&chapter_id=".$chapter_id."&author_id=".$author_id."&test_id=".$index);
	
    exit;
?>