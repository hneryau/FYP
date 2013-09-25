<?php
	session_start();
	require_once('conn/conn.php');
	$login_id = $_SESSION['login_id'];
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
	$result =  mysql_query($sql, $conn);
	$temp1 = mysql_fetch_row($result);
	$user_name = $temp1[1];
	$user_id = $temp1[0];

	$test_id = $_GET['test_id'];
	$sql2 = "SELECT COUNT(*) FROM QUESTION WHERE test_id=".$test_id ;
	$result2 =  mysql_query($sql2, $conn);
	$temp2 = mysql_fetch_row($result2);
	$numofquestion = $temp2[0];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Do test</title>
<style>
#box {
position: absolute;
  top: 0px;

  margin-left: -100px;
  left: 85%;
	width:180;
	left:800;
}

#testcontent {
	width:800;
}
#question {
	text-align:left;
	vertical-align:top;
	border-bottom:solid;
}
</style>
	<script language="Javascript" type="text/javascript" src="js/jquery-1.4.1.js"></script>
	<script language="Javascript" type="text/javascript" src="js/jquery.lwtCountdown-1.0.js"></script>
	<script language="Javascript" type="text/javascript" src="js/misc.js"></script>

	<link rel="Stylesheet" type="text/css" href="style/dark.css"></link>
<script>
window.onload = function() {

  function getScrollTop() {
    if (typeof window.pageYOffset !== 'undefined' ) {
      return window.pageYOffset;
    }
    
    var d = document.documentElement;
    if (d.clientHeight) {
      return d.scrollTop;
    }

    return document.body.scrollTop;
  }

  window.onscroll = function() {
    var box = document.getElementById('box'),
        scroll = getScrollTop();

    if (scroll <= 28) {
      box.style.top = "30px";
    }
    else {
      box.style.top = (scroll +2) + "px";
    }
  };

};
</script>
</head>

   
<body>
<div id="box">
		<div id="countdown_dashboard">

			<div class="dash hours_dash">
				<span class="dash_title">hours</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash minutes_dash">
				<span class="dash_title">minutes</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash seconds_dash">
				<span class="dash_title">seconds</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

		</div>
        <?php
        $query_rs = "select timelimit from TEST where test_id = '$test_id'";
     		$result5 = mysql_query($query_rs, $conn) or die(mysql_error());
     		$temp5 = mysql_fetch_row($result5);
			$time = $temp5[0];
		?>
        <script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				$('#countdown_dashboard').countDown({
					targetOffset: {
						'day': 		0,
						'month': 	0,
						'year': 	0,
						'hour': 	0,
						'min': 		<?= $time ?>,
						'sec': 		0
					},
					onComplete: function() { document.form1.submit(); }
				});

				$('#email_field').focus(email_focus).blur(email_blur);
				$('#subscribe_form').bind('submit', subscribe_submit);
			});
		</script>
		</div>
<div id = "testcontent">
<?php
		$test_id = $_GET['test_id'];
	 	$sql3 = "select * from QUESTION where test_id = '$test_id'  order by questionNo";
     	$result3 = mysql_query($sql3, $conn) or die(mysql_error());
     	$totalRows_rs = mysql_num_rows($result3);

		echo '<form name="form1"action="doSubmitTest.php" method="post" enctype="multipart/form-data" autocomplete="off">';
		echo '<table id="question">';
		if (mysql_num_rows($result3) > 0)   {
		$i=0;
		while($rows=mysql_fetch_array($result3)){
			$i++;
			$question_id = $rows[0];
			if ($rows[2] == 'MC') {
			$query_rs = "select * from MC where question_id = '$question_id'";
     		$result4 = mysql_query($query_rs, $conn) or die(mysql_error());
     		$temp4 = mysql_fetch_row($result4);
			echo '<tr><td width = "80">'.$rows[1].'</td>';
			echo '<td>'.$temp4[2].'</td></tr>';
			echo '<tr><td width = "80"></td><td>';
			echo '<input type="radio" value="A" name="ans'.$i.'">'.$temp4[3].'</td>';

			echo '<tr><td width = "80"></td><td>';
			echo '<input type="radio" value="B" name="ans'.$i.'">'.$temp4[4].'</td>';

			echo '<tr><td width = "80"></td><td>';
			echo '<input type="radio" value="C" name="ans'.$i.'">'.$temp4[5].'</td>';

			echo '<tr><td width = "80"></td><td>';
			echo '<input type="radio" value="D" name="ans'.$i.'">'.$temp4[6].'</td>';
			echo '<input type="hidden" name="question_id'.$i.'"  value="'.$temp4[1].'">';
			echo '<input type="hidden" name="type'.$i.'"value="MC">';
			} else if ($rows[2] == 'FIB') {
				$query_rs2 = "select * from FIB where question_id = '$question_id'";
				$result5 = mysql_query($query_rs2, $conn) or die(mysql_error());
				$temp5 = mysql_fetch_row($result5);
				echo '<tr><td width = "80">'.$rows[1].'</td>';
				echo '<td>'.$temp5[2].'</td></tr>';
				echo '<tr><td width = "80"></td><td>';
				if($temp5[3]!=NULL){
					echo 'A. <input type="text" name="ansa'.$i.'"></td>';
					echo '<tr><td width = "80"></td><td>';
				}
				if($temp5[4]!=NULL){
					echo 'B. <input type="text" name="ansb'.$i.'"></td>';
					echo '<tr><td width = "80"></td><td>';
				}
				if($temp5[5]!=NULL){
					echo 'C. <input type="text" name="ansc'.$i.'"></td>';
					echo '<tr><td width = "80"></td><td>';
				}
				if($temp5[6]!=NULL){
					echo 'D. <input type="text" name="ansd'.$i.'"></td>';
					echo '<tr><td width = "80"></td><td>';
				}
				echo '<input type="hidden" name="question_id'.$i.'"  value="'.$temp5[1].'">';
				echo '<input type="hidden" name="type'.$i.'"value="FIB">';


			}

		}
		echo '</table><input type="hidden" name="number" value="'.$i.'">'.'<input type="hidden" name="test_id" value="'.$test_id.'">'.'<center><input type="submit" value = "submit"></center></form>';
		}


?>
</div>
</body>
</html>