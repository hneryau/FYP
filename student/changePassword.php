<?php

	require_once('conn/conn.php');
	if(@$_REQUEST["Submit"]=="Update")
	{
		$sql="update ACCOUNT set password = md5('$_REQUEST[newpassword]') where login_id='$_SESSION[login_id]'";
		mysql_query($sql);
		header("Location:changePassword.html?msg=updated");
	}

?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
	<script>
	function validate()
	{

		var formName=document.frm;

		if (formName.newpassword.value.length < 6 && formName.newpassword.value.length>0)
		{
			document.getElementById("newpassword_label").innerHTML='Password must be more than 6 char length';
			formName.newpassword.focus();
			return false;
		}
		else
		{
			document.getElementById("newpassword_label").innerHTML='';
		}

		if(formName.newpassword.value == "")
		{
			document.getElementById("newpassword_label").innerHTML='Please Enter New Password';
			formName.newpassword.focus();
			return false;
		}
		else
		{
			document.getElementById("newpassword_label").innerHTML='';
		}


		if(formName.cpassword.value == "")
		{
			document.getElementById("cpassword_label").innerHTML='Enter ConfirmPassword';
			formName.cpassword.focus();
			return false;
		}
		else
		{
			document.getElementById("cpassword_label").innerHTML='';
		}


		if(formName.newpassword.value != formName.cpassword.value)
		{
			document.getElementById("cpassword_label").innerHTML='Passwords Missmatch';
			formName.cpassword.focus()
			return false;
		}
		else
		{
			document.getElementById("cpassword_label").innerHTML='';
		}
	}
	</script>

</HEAD>
<BODY>
	<form action="changePassword.html" method="post" name="frm" id="frm" onSubmit="return validate();">
		<table class="table table-bordered" style="table-layout: fixed;">
			<tbody>
				<tr>
					<td class="span3"><label><h4>New Password:</h4></label></td>
					<td class="span6"><input type="password" name="newpassword" id="newpassword" size="20" autocomplete="off"/>&nbsp; <label id="newpassword_label" class="level_msg"></td>
				</tr>
				<tr>
					<td class="span3"><label><h4>Confirm Password:</h4></label></td>
					<td class="span6"><input type="password" name="cpassword" id="cpassword" size="20" autocomplete="off">&nbsp; <label id="cpassword_label" class="level_msg"></td>
				</tr>

				<?php if(@$_REQUEST["msg"]=="updated") { ?>				
				<tr>
					<td class="span9" colspan="2"><h5>Password has been changed successfully.</h5></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="2" align="center"><button class="btn btn-success" type="submit" name="Submit" value="Update" onSubmit="return validate();"/>Update</button>
						<button class="btn btn-warning" type="reset" name="Reset" onSubmit="return validate();"/>Reset</button></td>
				</tr>
			</tbody>
		</table>
	</form>
</BODY>
</HTML>