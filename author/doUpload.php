<?php
require_once('conn/conn.php');
  
$allowedExts = array("jpg", "jpeg", "gif", "png","swf");
$extension = end(explode(".", $_FILES["file"]["name"]));


if (($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts))
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
	$path = "http://ebooksystem.cixx6.com/author/upload/".$_FILES["file"]["name"];
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. <br>";
	  
	  echo "File url: ".$path . "<br>";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"]. "<br>";
	mysql_select_db($database_conn, $conn);
	  $authorId = $_POST['authorId'];
	  $type = $_FILES["file"]["type"];
	  $insertValues = "(null , '$authorId' , '$type'  , '$path')";
	  $query_rs = "insert into MULTIMEDIA values $insertValues";
	  @mysql_query($query_rs, $conn) or die(mysql_error());
	  
	  echo "File url: ".$path . "<br>";
      }
	  
    }
  }
else
  {
  echo "Invalid file";
  }
?>