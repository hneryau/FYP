<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Book</title>

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu-v.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
<script type="text/javascript" src="http://of.openfoundry.org/javascripts/prototype.js"></script>
<script type="text/javascript" >
window.onload = function ()
{
    window.resizeTo( 1050,window.screen.availHeight )

}
function iframe_auto_height(fid)
{
  var iframe = $(fid);
  var content_height = window.screen.availHeight;
  content_height = content_height < window.screen.availHeight ? window.screen.availHeight: content_height; //set minimal height
  content_height = typeof content_height == 'number' ? content_height+"px" : content_height
  iframe.setStyle({height:content_height});
}

function test(testid, mins){
	if (confirm('Do you want to start the test? '+ mins +' minutes will start to count down after you press "OK".')) {
	window.location.href = "test.php?test_id="+testid;
	}
}
</script>
<style>
body
{
	width:1100px;
	/* Text color */
	color: #333;

	/* Remove the background color to make it transparent */
	background-color: #fff;

	margin: 20px;
}
#menu {
	width: 180px;
}

#bookcon {
	position:absolute;
	margin-left:180px;
	width:920px;
}

</style> 
</head>

<body>

<?php $book_id = $_GET['book_id']?>
<div id="bookcon">
<iframe onload="iframe_auto_height(this);" id="of_module" name="of_module"  width="920"  src="showBook.php?book_id=<?php echo $book_id ?>"  frameborder="1"  style="border:solid; border-width:thin;" >
</iframe>
</div>


<div id="menu">

<?php
	require_once('conn/conn.php');
	$book_id = $_GET['book_id'];
	$query_rs = "select * from CHAPTER WHERE book_id = '$book_id'";
    $result = mysql_query($query_rs, $conn) or die(mysql_error());
    $totalRows_rs = mysql_num_rows($result);
	
	if ($totalRows_rs > 0) {
		?>
        <div id="smoothmenu2" class="ddsmoothmenu-v">
		<ul>
        
        <li><a  target="of_module" href= "showBook.php?book_id=<?php echo $book_id ?>">Book Introduction</a></li>
        <?php
            while ($row = mysql_fetch_assoc($result)) {
				$temp = $row['chapter_id']
				?>
                
                <li><a  target="of_module" href= "showChapter.php?chapter_id=<?php echo $row['chapter_id'] ?>">
                <?php echo $row['chapterNo']."  ".$row['chapterName']?> </a>
<?php     
                
                    
                
                
   
	$query_rs2 = "select * from SECTION WHERE chapter_id = '$temp'";
    $result2 = mysql_query($query_rs2, $conn) or die(mysql_error());
    $totalRows_rs2 = mysql_num_rows($result2);
	
	$query_rs3 = "select * from TEST WHERE chapter_id = '$temp'";
    $result3 = mysql_query($query_rs3, $conn) or die(mysql_error());
    $totalRows_rs3 = mysql_num_rows($result3);
	if ($totalRows_rs2>0 || $totalRows_rs3 > 0){
	echo "<ul>";
	if ($totalRows_rs2 > 0) {
            while ($row2 = mysql_fetch_assoc($result2)) {
				?>
                
                <li><a target="of_module" href= "showSection.php?section_id=<?php echo $row2['section_id'] ?>">
                <?php echo $row2['sectionNo']."  ".$row2['sectionName']?> </a></li>
            <?php
			}
			
            
    }	
	if ($totalRows_rs3 > 0) {
            while ($row3 = mysql_fetch_assoc($result3)) {
				?>
                
                <li><a  href= "#" onClick="test(<?php echo $row3['test_id'].','.$row3['timelimit']?> )">
                <?php echo "Chapter test (".$row3['timelimit']."mins)"?> </a></li>
            <?php
			}
			
            
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