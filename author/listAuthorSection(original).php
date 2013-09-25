<?php

session_start();

require_once("../conn/conn.php");

// Connect to server and select database.

$link = mysqli_connect("$host", "$username", "$password", "$db_name");

if (mysqli_connect_errno()) {

    printf("Connect failed: %s\n", mysqli_connect_error());

    exit();

}

if (isset($_SESSION['loggedin'])!= 'YES') {
		echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td><b>Please login first!</b><br>Click <a href="../index.html">HERE</a> to login.</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
	}
	else {

$login_id = $_SESSION['login_id'];


$sql3 = mysqli_query($link, "SELECT user_id FROM ACCOUNT WHERE login_id='$login_id'");

$id = mysqli_fetch_row($sql3);



$sql = mysqli_query($link, "SELECT name FROM AUTHOR WHERE author_id='$id[0]'");

$result = mysqli_fetch_row($sql);

$name = $result[0];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<title>E-Book System Home Page</title>

<meta charset="utf-8">

<meta name="description" content="This is the E-Book System developed by TSE CHI FUNG, CHOW YIK WAI and AU KA SHING.">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">

<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="../table_style/style.css" />

<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>

<script type="text/javascript" src="js/cufon-yui.js"></script>

<script type="text/javascript" src="js/cufon-replace.js"></script>

<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>

<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>

<script type="text/javascript" src="js/script.js"></script>

<!--[if lt IE 7]>

     <link rel="stylesheet" href="css/ie/ie6.css" type="text/css" media="screen">

     <script type="text/javascript" src="js/ie_png.js"></script>

     <script type="text/javascript">

        ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');

     </script>

<![endif]-->

<!--[if lt IE 9]>

  	<script type="text/javascript" src="js/html5.js"></script>

  <![endif]-->

</head>

<body id="page1">

<div class="wrap">

   <!-- header -->

   <header>

      <div class="container">

         <nav>

            <ul>

               <li class="current"><a href="index.html" class="m1">Home</a></li>

               <li><a href="profile.html" class="m2">Profile</a></li>

               <li class="last"><a href="books.html" class="m3">Books and Tests</a></li>

            </ul>

         </nav>

         <fieldset  id="search-form">

		             <div class="rowElem">

		                <ul>

		                <li><a href="/logout.php">Logout</a></li>

		                </ul>

		                </div>

            </fieldset>

      </div>

   </header>

   <div class="container">

      <!-- aside -->

      <aside>

	        <h2>Account <span>Information</span></h2>

	  	           <ul class="news">

	  	              <li><h4>Name:</h4>

	  	                <b><?= $name ?></b></li>

	  	            </ul>

         <br><br>

         <h3>Author Menu</h3>

         <ul class="categories">

		             <li><span><a href="mybooks.html">View My Book</a></span></li>

		             <li><span><a target="_blank" href="createBook.php">Create New Book</a></span></li>

		             <li><span><a href="mm/index.html">Upload Multi-Media</a></span></li>

                 <li class="last"><span><a href="mm/editMedia.php">Edit Multi-Media</a></span></li>

         </ul>

      </aside>

      <!-- content -->

      <section id="content">

         <div class="inside">

          		<h2>My <span>books</span></h2>

          		<?php
				if(!isset($_SESSION)){
    				session_start();
				}	
			
				require_once('conn/conn.php');
				$login_id = $_SESSION['login_id'];
				mysql_select_db($database_conn, $conn);
				$sql = "SELECT user_id, name FROM AUTHOR, ACCOUNT WHERE author_id = user_id and login_id = '$login_id'";
				$result =  mysql_query($sql, $conn);
				$temp1 = mysql_fetch_row($result);
				$user_name = $temp1[1];
				$user_id = $temp1[0];
				
				$chapter_id=$_GET['chapter_id'];
			        $query_rs = "select * from SECTION where chapter_id= '$chapter_id'";
			        $result = mysql_query($query_rs, $conn) or die(mysql_error());
			        $totalRows_rs = mysql_num_rows($result);
			        echo "<h1>Section in the book</h1>";
			        echo"<table cellpadding='0' cellspacing='0' border='0' id='table' class='sortable'>
					<thead>
					<tr>
					<th><h3>Book ID</h3></th>
					<th><h3>Section No.</h3></th>
					<th><h3>Section Name</h3></th>
			     	</tr>
					</thead><tbody>";
					
			        if ($totalRows_rs > 0) {
			            while ($row = mysql_fetch_assoc($result)) {
			                echo"<tr>";
			                echo"<td>" . $row['chapter_id'] . "</td>";
			                echo"<td>" . $row['sectionNo'] . "</td>";
			                echo"<td>" . $row['sectionName'] . "</td>";
			                ?>
			           
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

         </div>

      </section>

   </div>

</div>

<!-- footer -->

<footer>

</footer>

<script type="text/javascript"> Cufon.now(); </script>

</body>
<?php } ?>
</html>