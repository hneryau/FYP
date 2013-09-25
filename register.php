<?php

session_start();
require_once("conn/conn.php");

// Connect to server and select database.
$link = mysqli_connect("$host", "$username", "$password", "$db_name");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$login_idreg = $_POST['login_idreg'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$license = $_POST['license'];
$passwordreg = $_POST['passwordreg'];
$passwordregenc = MD5($passwordreg);
$question = $_POST['question'];
$answer = $_POST['answer'];


$sql = "SELECT * FROM LICENSE WHERE license='$license' AND status=1";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $sql7 = "SELECT * FROM ACCOUNT WHERE login_id='$login_idreg'";
    $result2 = mysqli_query($link, $sql7);
    $count2 = mysqli_num_rows($result2);
    if ($count2 == 1) {
        echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td><b>Login ID already in used.
                   <br>Please use another Login ID!</b></td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html#toregister>';
    } else {
		$sql10 = mysqli_query($link,"SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'u317987573_ebsystem' AND TABLE_NAME = 'ACCOUNT'");
		$sql10_row = mysqli_fetch_row($sql10);
		$user_id = $sql10_row[0];
		if (!is_dir("userfile/'$user_id'")) {
    		mkdir("userfile/'$user_id'");
		}
        $sql2 = mysqli_query($link, "INSERT INTO ACCOUNT(login_id, password, question, answer) VALUES('$login_idreg', '$passwordregenc', '$question', '$answer')");
        $sql3 = mysqli_query($link, "SELECT user_id FROM ACCOUNT WHERE login_id='$login_idreg'");
        $id = mysqli_fetch_row($sql3);
        $sql4 = mysqli_query($link, $sql);
        $daysrow = mysqli_fetch_row($sql4);
        $days = $daysrow[1];
        $newdays = mktime(0, 0, 0, date("m"), date("d") + $days, date("Y"));
        $daysinsert = date("Y-m-d", $newdays);
        $sql5 = mysqli_query($link, "INSERT INTO STUDENT(student_id, name, email, tel, license, expiry_date) VALUES('$id[0]', '$name', '$email', '$tel', '$license', '$daysinsert')");
        $sql6 = mysqli_query($link, "UPDATE LICENSE SET status=0 WHERE license='$license'");
        $_SESSION['name'] = $name;
        $_SESSION['daysinsert'] = $daysinsert;
        echo 'Welcome ' . $_SESSION['name'] . '.
                <br>Your expiry date is ' . $_SESSION['daysinsert'] . '.
                <br>Click <a href=index.html>here</a> to login!';
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