<?php

session_start();
require_once("conn/conn.php");

// Connect to server and select database.
$link = mysqli_connect("$host", "$username", "$password", "$db_name");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$login_id = $_POST['login_id'];
$license = $_POST['license'];


$sql = "SELECT * FROM LICENSE WHERE license='$license' AND status=1";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $sql3 = mysqli_query($link, "SELECT user_id FROM ACCOUNT WHERE login_id='$login_id'");
    $count2 = mysqli_num_rows($sql3);
    if ($count2 == 1) {
        $id = mysqli_fetch_row($sql3);
        $sql2 = mysqli_query($link, "SELECT expiry_date FROM STUDENT WHERE student_id='$id[0]'");
        $olddaterow = mysqli_fetch_row($sql2);
        $olddate = $olddaterow[0];
        $sql4 = mysqli_query($link, $sql);
        $daysrow = mysqli_fetch_row($sql4);
        $days = $daysrow[1];
        $daysinsert = date("Y-m-d", strtotime($olddate. "+ $days day"));
        $sql5 = mysqli_query($link, "UPDATE STUDENT SET expiry_date='$daysinsert' WHERE student_id='$id[0]'");
        $sql6 = mysqli_query($link, "UPDATE LICENSE SET status=0 WHERE license='$license'");
        $sql7 = mysqli_query($link, "UPDATE ACCOUNT SET status=1 WHERE login_id='$login_id'");
        $_SESSION['name'] = $name;
        $_SESSION['daysinsert'] = $daysinsert;
        echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td>Your expiry date is ' . $_SESSION['daysinsert']. '<br>Click <a href=index.html>here</a> to login!</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
    } else {
        echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Wrong login ID!</b></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
    }
} else {
    echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Wrong License!</b></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
}
?>