<?php

session_start();
require_once("conn/conn.php");

// Connect to server and select database.
$link = mysqli_connect("$host", "$username", "$password", "$db_name");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (isset($_SESSION['loggedin'])=='YES') {
    die('<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>You are already logged in!</b> <br> For security purpose, pleaes click <a href=logout.php>HERE</a> to logout first and login again.</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>');
}

$login_id = $_POST['login_id'];
$password = $_POST['password'];

//Prevent SQL-inject. xd
$login_id = stripslashes($login_id);
$password = stripslashes($password);
$login_id = mysqli_real_escape_string($link, $login_id);
$password = mysqli_real_escape_string($link, $password);
$passwordenc = MD5($password);

$sql = "SELECT * FROM ACCOUNT WHERE login_id='$login_id' and password='$passwordenc'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $sql2 = mysqli_query($link, "SELECT * FROM ACCOUNT WHERE login_id='$login_id'");
    $user = mysqli_fetch_row($sql2);


    if ($user[6] == 1) {
        $_SESSION['loggedin'] = 'YES';
        $_SESSION['login_id'] = $login_id;
        if ($user[3] == 'student') {
        	$sql3 = mysqli_query($link, "SELECT * FROM STUDENT WHERE student_id='$user[0]'");
        	$student = mysqli_fetch_row($sql3);
        	$date = date('Y-m-d');
        	if($student[5]<$date){
        		$sql4 = mysqli_query($link, "UPDATE ACCOUNT SET status=0 WHERE user_id='$user[0]'");
        		$_SESSION['loggedin'] = '';
        		$_SESSION['login_id'] = '';
        		echo '<table align="center">
		<tr><td>
			<fieldset style="width:150px">
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Your account is expired!</b><br>Please extend your license first by clicking <a href="extend.html">HERE</a></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
			}else{
            	$stu = "";
            	header("location: student/");
            }
        } elseif ($user[3] == 'author') {
            $aut = "";
            header("location: author/index.html");
        } else {
            $adm = "";
            header("location: admin/index.html");
        }
    } else {
        echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Your account is suspended!</b><br>Please contact the administrator at <a href="mailto:administrator@ebooksystem.cixx6.com?Subject=Report%20suspended%20account">HERE</a>.</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
    }
} else {
    echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Wrong Username or Password!</b><br>Click <a href="index.html">HERE</a> to login again.</td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
    echo '<meta http-equiv=REFRESH CONTENT=5;url=index.html>';
}
?>