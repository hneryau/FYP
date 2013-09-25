<!doctype html>
<html><head>
<meta charset="utf-8">
		<title>Multi-level Effect Menu Demo</title>
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu-v.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">



ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

</head>

<body>

<?php
	require_once('conn/conn.php');
	$book_id = $_POST['book_id'];
	$query_rs = "select * from CHAPTER WHERE book_id = '$book_id'";
    $result = mysql_query($query_rs, $conn) or die(mysql_error());
    $totalRows_rs = mysql_num_rows($result);
	
	if ($totalRows_rs > 0) {
		?>
        <div id="smoothmenu2" class="ddsmoothmenu-v">
		<ul>
        <?php
            while ($row = mysql_fetch_assoc($result)) {
				$temp = $row['chapter_id']
				?>
                
                <li><a target="bookconbox" href= "ShowChapter.php?chapter_id=<?php echo $row['chapter_id'] ?>">
                <?php echo $row['chapterNo']."  ".$row['chapterName']?> </a>
                
                    
                
                
    <?php
	$query_rs2 = "select * from SECTION WHERE chapter_id = '$temp'";
    $result2 = mysql_query($query_rs2, $conn) or die(mysql_error());
    $totalRows_rs2 = mysql_num_rows($result2);
	
	if ($totalRows_rs2 > 0) {
		?>
		<ul>
        <?php
            while ($row2 = mysql_fetch_assoc($result2)) {
				?>
                
                <li><a target="bookconbox" href= "ShowSection.php?section_id=<?php echo $row2['section_id'] ?>">
                <?php echo $row2['sectionNo']."  ".$row2['sectionName']?> </a></li>
            <?php
			}
            echo "</ul>";
    }	
?>
                
       </li>
				
            <?php
			}
            echo "</ul><br style='clear: left' />";
    }	
?>

</div>

</body>
</html>