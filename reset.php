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
$email = $_POST['email'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$password = $_POST['password'];


$sql = "SELECT * FROM ACCOUNT WHERE login_id='$login_id' AND question='$question' AND answer='$answer'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $user = mysqli_fetch_row(mysqli_query($link, $sql));
    if ($user[3] == 'student') {
        $sql2 = "SELECT email FROM STUDENT WHERE student_id='$user[0]'";
    } elseif ($user[3] == 'author') {
        $sql2 = "SELECT email FROM AUTHOR WHERE author_id='$user[0]'";
    } else {
        $sql2 = "SELECT email FROM ADMIN WHERE admin_id='$user[0]'";
    }
    $check = mysqli_fetch_row(mysqli_query($link, $sql2));
    if ($email == "$check[0]") {
        $sql3 = mysqli_query($link, "UPDATE ACCOUNT SET password='$password' WHERE login_id='$login_id'");
        echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Password reset completed!</b><br>Please use your new password to <a href=index.html>login</a> now.</td></tr>
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
					<tr><td><b>Email do not match!</b></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=reset.html>';
    }
} else {
    echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Wrong data! Please make sure to input all the correct data to reset password!</b></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=reset.html>';
}
?>