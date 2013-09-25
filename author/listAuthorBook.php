<?php
	// session_start();

	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT user_id, name FROM AUTHOR, ACCOUNT WHERE author_id = user_id and login_id = '$login_id'";
	$result =  mysql_query($sql, $conn);
	$temp1 = mysql_fetch_row($result);
	$user_name = $temp1[1];
	$user_id = $temp1[0];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>All of my book</title>
<link rel="stylesheet" href="../table_style/style.css" />
</head>
<body>
        <?php
        $query_rs = "select * from BOOK where author_id= '$user_id'";
        $result = mysql_query($query_rs, $conn) or die(mysql_error());
        $totalRows_rs = mysql_num_rows($result);
        echo"<table cellpadding='0' cellspacing='0' border='0' id='table' class='sortable'>
		<thead>
		<tr>
		<th><h3>Book ID</h3></th>
		<th><h3>Book Name</h3></th>
		<th><h3>Category</h3></th>
		<th colspan='3'><h3>Action</h3></th>
     	</tr>
		</thead><tbody>";

        if ($totalRows_rs > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                echo"<tr>";
                echo"<td>" . $row['book_id'] . "</td>";
                echo'<td><a target="_blank" href="../student/controlBook.php?book_id='.$row['book_id'].'"/>'.$row["bookName"].'</td>';
                echo"<td>" . $row['category'] . "</td>";
                ?>
            <td><a href="listAuthorChapter.php?book_id=<?php echo $row['book_id'] ?>">Show Chapters</a></td>
            <td><a target='_blank' href="createChapter.php?book_id=<?php echo $row['book_id'] ?>">Create Chapters</a></td>
            <td><a target='_blank' href="maintainBook.php?book_id=<?= $row['book_id'] ?>">Maintain Book</a></td>
            <?php
            echo"</tr>";
        }
    }
    echo "</tbody></table><br/>";
?>

	<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entries Per Page</span>
		</div>
		<div id="navigation">
			<img src="../table_style/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="../table_style/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="../table_style/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="../table_style/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span></div>
	</div>
	<script type="text/javascript" src="../table_style/script.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
  </script>
</body>
</html>