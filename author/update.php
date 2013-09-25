<?php



session_start();

require_once("../conn/conn.php");



// Connect to server and select database.

$link = mysqli_connect("$host", "$username", "$password", "$db_name");

if (mysqli_connect_errno()) {

    printf("Connect failed: %s\n", mysqli_connect_error());

    exit();

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
}



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
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css" media="all">
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

         <h1><a href="index.html">Home Page</a></h1>

         <nav>

            <ul>

               <li><a href="index.html" class="m1">Home</a></li>

               <li class="current"><a href="profile.html" class="m2">Profile</a></li>

               <li><a href="books.html" class="m3">Books and Tests</a></li>

               <li><a href="contact-us.html" class="m4">Contact Us</a></li>

               <li class="last"><a href="about-us.html" class="m5">About Us</a></li>

            </ul>

         </nav>

         <fieldset  id="search-form">

		             <div class="rowElem">

		                <ul>

		                <li><a href="../logout.php">Logout</a></li>

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

            <li><span><a href="createBook.php">Create New Book</a></span></li>

            <li class="last"><span><a href="../mm/index.html">Upload Multi-Media</a></span></li>

         </ul>

      </aside>

      <!-- content -->

      <section id="content">

         <div id="banner">

            <h2>Online<span>E-Book System</span></h2>

         </div>

         <div class="inside">

         		<h2>Profile</h2>

          		<?php
					require_once('conn/conn.php');
					$sid = $_POST['sid'];
					$name = $_POST['name'];
					$email = $_POST['email'];
					$tel = $_POST['tel'];
					$sql = "UPDATE AUTHOR SET name = '$name', email = '$email', tel = '$tel' WHERE author_id = '$sid'";
					if (mysql_query($sql)){
						$result = mysql_affected_rows();
						echo "<table class='table table-bordered'><tr><td><fieldset><legend>Message</legend><h5>";
						if ($result!=0){
							echo "Personal information have been updated!";
						}else{
							echo "No data updated!!";
						}
					}
					else{
						echo "Cannot update!!";
					}
					
					echo "<p><p><a href = 'profile.html'>Back</a></fieldset></td></tr></table>";
				?>

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