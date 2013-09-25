<?php
	require_once('../conn/conn.php');
	$login_id = $_SESSION['login_id'];
	$sql = "SELECT * FROM AUTHOR WHERE author_id = (SELECT user_id FROM ACCOUNT WHERE login_id = '$login_id')";
	$result  = mysql_query($sql, $conn);
	$result1 = mysql_fetch_row($result);
	$sid = $result1[0];
	$name = $_POST['name'];
	$ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], ".")+1);
	$type = $_FILES["file"]["type"];
	$desc = $_POST['desc'];
	$target = "multimedia/"; 
	$sql = "INSERT INTO MULTIMEDIA (author_id, type, path, description) values ('$sid',";

	echo "<table class='table table-bordered'><tr><td><fieldset><legend>Message</legend><h5>";

	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} else {
		if (!(is_dir($target))) {
			mkdir($target);
		}

		$target=$target.'author_'.$sid.'/';

		if (!(is_dir($target))) {
			mkdir($target);
		}

		$target=$target.$name.'.'.$ext;

		if (file_exists($target)) {
			echo "File have been exist.";
		} else {
			if(move_uploaded_file($_FILES['file']['tmp_name'],$target )){ 			
				$sql=$sql."'$type','$target','$desc')";		
				mysql_query($sql, $conn);
				echo "The media has been uploaded!!";
			} else { 
				echo "Sorry, there was a problem uploading your file."; 
			}	
		}		
	}

	echo "</fieldset></td></tr></table>";

?>