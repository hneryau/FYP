<?php
	require_once('conn/conn.php');
	session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Maintain Book</title>

</head>

<body>
<?php

				$bkName = $_POST['bkName'];
                $authorId = $_POST['user_id'];
                $category = $_POST['category'];
                $description = $_POST['description'];
				$status = $_POST['status'];
				$book_id = $_POST['bid'];

if (empty($_FILES['file']['name'])) {
	$SQL98 = "SELECT * FROM BOOK WHERE book_id = '$book_id'";
	$result98 = mysql_query($SQL98, $conn);
	$temp98 = mysql_fetch_row($result98);
   $path = $temp98[6];
}else{
				function createPath($path) {
    				if (is_dir($path)) return true;
    					$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    					$return = createPath($prev_path);
    					return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}

    			$path="userfile/".$authorId."/".$book_id."/bookcover";
				createPath($path);



				move_uploaded_file($_FILES["file"]["tmp_name"],"userfile/".$authorId."/".$book_id ."/bookcover/".$_FILES["file"]["name"]);


$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");
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
}



                $SQL0= "UPDATE BOOK SET bookName = '$bkName', category = '$category', status = '$status', bookContent = '$description', coverPath = '$path' WHERE book_id = '$book_id'";
    			mysql_query($SQL0, $conn) or die(mysql_error());
				echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td>Maintain Book Successful!</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
				?>

</body>
</html>