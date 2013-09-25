<?php 
	require_once('conn/conn.php');
	session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>
                <?php
				function createPath($path) {
    				if (is_dir($path)) return true;
    					$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    					$return = createPath($prev_path);
    					return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}
				
                $bkName = $_POST['bkName'];
                $authorId = $_POST['user_id'];
                $category = $_POST['category'];
                $description = $_POST['description'];
				$status = $_POST['status'];
				
				$SQL0 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'BOOK'";
				$result9 =  mysql_query($SQL0, $conn);
				$temp0 = mysql_fetch_row($result9);
				$book_id = $temp0[0];
				$path="userfile/".$authorId."/".$book_id."/bookcover";
				createPath($path);
				
				
				
				move_uploaded_file($_FILES["file"]["tmp_name"],"userfile/".$authorId."/".$book_id ."/bookcover/".$_FILES["file"]["name"]);
				
				
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));


if (in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	$path = "http://www.ebooksystem.cixx6.com/author/userfile/".$authorId."/".$book_id ."/bookcover/".$_FILES["file"]["name"];
    if (file_exists("userfile/".$authorId."/".$book_id ."/bookcover/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. <br>";
	  
	  echo "File url: ".$path . "<br>";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],"userfile/".$authorId."/".$book_id ."/bookcover/".$_FILES["file"]["name"]);
      echo "Stored in: " . "userfile/".$authorId."/".$book_id ."/bookcover/" . $_FILES["file"]["name"]. "<br>";
	  echo "File url: ".$path . "<br>";
      }
	  
    }
  }
  

				
				
                $insertValues = " ( null , '$authorId', '$bkName'  , '$category' , '$status', '$description', '$path' ) ";
                mysql_select_db($database_conn, $conn);
    			$query_rs = "insert into BOOK values $insertValues";
    			@mysql_query($query_rs, $conn) or die(mysql_error());
				echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td>Create book sucessful!</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
				?> 

</body>
</html>