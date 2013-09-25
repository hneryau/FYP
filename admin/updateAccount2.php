<?php
	require_once('conn/conn.php');
  mysql_select_db($database_conn, $conn);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Update Project</title>
</head>

<body>

  <?php
		$author_id = $_GET['author_id'];
		$name = $_GET['name'];
		$email = $_GET['email'];
		$tel = $_GET['tel'];
		?>
  <form method="post" action="doUpdateAccount2.php">
    <input type="hidden" name="author_id" value="<?php echo $author_id?>">
    <table class="table table-bordered table-hover">
      <tr>
        <td span="3">User Name : </td>
        <td span="6"><input type="Text" name="name" value="<?php echo $name ?>">
        </td>
      </tr>


      <tr>
        <td>E-Mail : </td>
        <td><input type="Text" name="email" value="<?php echo $email ?>">
        </td>
      </tr>


       <tr>
        <td>Tel. No. : </td>
        <td><input type="Text" name="tel" value="<?php echo $tel ?>">
          </td>
      </tr>


      <tr>
        <td colspan="2"><button type="SUBMIT" class="btn btn-success">Update User</button>
        <button type="reset" class="btn btn-warning">Reset</button></td>
      </tr>


    </table>
  </form>
</body>
</html>
