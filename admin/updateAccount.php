<?php 
	require_once('conn/conn.php');
  mysql_select_db($database_conn, $conn);
  $student_id = $_GET['student_id'];
  $name = $_GET['name'];
  $email = $_GET['email'];
  $tel = $_GET['tel'];
  $license = $_GET['license'];
  $expiry_date = $_GET['expiry_date'];
  $status = $_GET['status'];?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Update Project</title>
</head>

<body>
  <form method="post" action="doUpdateAccount.php">
    <input type="hidden" name="student_id" value="<?php echo $student_id?>">
    <table class="table table-bordered table-hover">
      <tr>
        <td>User Name : </td>
        <td><input type="Text" name="name" value="<?php echo $name ?>">
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
        <td>License : </td>
        <td><input type="Text" name="license" value="<?php echo $license ?>">
          </td>
      </tr>
      
      
      
      <tr>
        <td>Expiry Date: </td>
        <td><input type="Text" name="expiry_date" value="<?php echo $expiry_date ?>">
          </td>
      </tr>
      
            <tr>
        <td>Status: </td>
        <td>
            <input type="radio" name="status" id="active" value="1">
            Active
            <input type="radio" name="status" id="suspended" value="0">
            Suspended
        </td>
      </tr>
        <script>
        var status = "<?php echo $status; ?>";
        if (status!=0) {
          document.getElementById("active").checked = true;
          document.getElementById("suspended").checked = false;
        } else{
          document.getElementById("suspended").checked = true;
          document.getElementById("active").checked = false;
        }
        </script>
      
      
      <tr>
        <td colspan="2"><button type="SUBMIT" class="btn btn-success">Update User</button>
          <button type="reset" class="btn btn-warning">Reset</button></td>
      </tr>
      
      
    </table>
  </form>
</body>
</html>
