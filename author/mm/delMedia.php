<?php
	require_once('../conn/conn.php');
	$path = $_GET['path'];
	if (file_exists($path)){
		if(unlink($path)===true){		
			$query_delete = 'delete from MULTIMEDIA where media_id='.$_GET['media_id'];
			mysql_query($query_delete, $conn) or die(mysql_error());			
		}
		else{
			echo "File does not exist.";
		}
	}
	echo "<table class='table table-bordered'><tr><td><fieldset><legend>Message</legend><h5>
				The media has deleted!
		</fieldset></td></tr></table>"
	?>