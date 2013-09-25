<?php
require_once('conn/conn.php');
mysql_select_db($database_conn, $conn);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>        
    </head>

    <body>
        <?php
        $query_rs = "select * from STUDENT, ACCOUNT where STUDENT.student_id = ACCOUNT.user_id";
        $result = mysql_query($query_rs, $conn) or die(mysql_error());
        $totalRows_rs = mysql_num_rows($result); ?>
        <h1>Manage Students</h1>
        <table class="table table-bordered table-hover">            
		<tr>
    		<th>Student ID</th>
    		<th>Student Name</th>
    		<th>E-Mail</th>
    		<th>Tel</th>
    		<th>License</th>
    		<th>Expiry Date</th>
    		<th>Status</th>
            <th>Action</th>
         </tr>
        <?php if ($totalRows_rs > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                echo"<tr>";
                echo"<td>" . $row['student_id'] . "</td>";
                echo"<td>" . $row['name'] . "</td>";
                echo"<td>" . $row['email'] . "</td>";
                echo"<td>" . $row['tel'] . "</td>";
                echo"<td>" . $row['license'] . "</td>";
                echo"<td>" . $row['expiry_date'] . "</td>";
                echo"<td>" . $row['status'] . "</td>";
                ?>
            <td><a href="updateAccount.html?student_id=<?php echo $row['student_id'] ?>&name=<?php echo $row['name'] ?>&email=<?php echo $row['email'] ?>&tel=<?php echo $row['tel'] ?>&license=<?php echo $row['license'] ?>&expiry_date=<?php echo $row['expiry_date'] ?>&status=<?php echo $row['status'] ?>">Update</a></td>
            <td><a href="deleteAccount.php?student_id=<?php echo $row['student_id'] ?>">Delete</a></td>
            <?php
            echo"</tr>";
        }
    }
    echo "</table><br/>";

    $query_rs2 = "select * from AUTHOR, ACCOUNT where AUTHOR.author_id = ACCOUNT.user_id";
    $result2 = mysql_query($query_rs2, $conn) or die(mysql_error());
    $totalRows_rs2 = mysql_num_rows($result2);  ?>
    <h1>Manage Authors</h1>
    <table class="table table-bordered table-hover">
		<tr>
		<th>Author ID</th>
		<th>Author Name</th>
		<th>E-Mail</th>
		<th>Tel</th>
        <th>Action</th>
     </tr>
    <?php if ($totalRows_rs > 0) {
        while ($row2 = mysql_fetch_assoc($result2)) {
            echo"<tr>";
            echo"<td>" . $row2['author_id'] . "</td>";
            echo"<td>" . $row2['name'] . "</td>";
            echo"<td>" . $row2['email'] . "</td>";
            echo"<td>" . $row2['tel'] . "</td>   ";
            ?>
            <td><a href="updateAccount2.html?author_id=<?php echo $row2['author_id'] ?>&name=<?php echo $row2['name'] ?>&email=<?php echo $row2['email'] ?>&tel=<?php echo $row2['tel'] ?>">Update</a></td>
            <td><a href="deleteAccount2.html?student_id=<?php echo $row2['author_id'] ?>">Delete</a></td>
            <?php
            echo"</tr>";
        }
    }
    echo "</table><br/>";
    mysql_close($conn);
    ?>

</body>
</html>