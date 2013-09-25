<?php
require_once('conn/conn.php');
mysql_select_db($database_conn, $conn);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <style>
            img {
                width:50px;
                height:20px;
                margin:20px;
                margin: 0px;
                position: absolute;
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                -o-transition: all 1s ease;
                -ms-transition: all 1s ease;
                transition: all 1s ease;
            }
            img:hover {
                position: absolute;
                z-index: 9999;                
                width:400px;
                height:300px;
            }
        </style>
    </head>

    <body>
        <?php
        $query_rs = 'SELECT * FROM REPORT WHERE type="question"';
        $result = mysql_query($query_rs, $conn) or die(mysql_error());
        $totalRows_rs = mysql_num_rows($result); ?>
        <h1>Report - Questions</h1>
        <table class="table table-bordered table-hover">
    		<tr>
        		<th>Student ID</th>
                <th>Chapter ID</th>
        		<th>Question ID</th>
        		<th>Content</th>
                <th>Snapshot</th>
                <th>Action</th>
            </tr>
            <tbody>
            <?php if ($totalRows_rs > 0) {
            while ($row = mysql_fetch_row($result)) {
                echo"<tr>";
                echo"<td>" . $row[1] . "</td>";
                echo"<td>" . $row[3] . "</td>";
                echo"<td>" . $row[2] . "</td>";
                echo"<td>" . $row[5] . "</td>";
                echo'<td><img src="../student/' . $row[6] . '"></td>';
                ?>
                <td><a href="deleteReport.php?report_id=<?php echo $row[0] ?>">Delete</a></td>
                <?php
                echo"</tr>";
                }
            }
            echo "</tbody></table><br/>";

            $query_rs2 = "SELECT * FROM REPORT WHERE type='other'";
            $result2 = mysql_query($query_rs2, $conn) or die(mysql_error());
            $totalRows_rs2 = mysql_num_rows($result2);
            echo "<h1>Report - Others</h1>"; ?>
            <table class="table table-bordered table-hover">
        		<tr>
        		<th>Student ID</th>
        		<th>Content</th>
                <th>Snapshot</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php if ($totalRows_rs > 0) {
                while ($row2 = mysql_fetch_row($result2)) {
                    echo"<tr>";
                    echo"<td>" . $row2[1] . "</td>";
                    echo"<td>" . $row2[5] . "</td>";
                    echo'<td><img src="../student/' . $row2[6] . '"></td>';
                    ?>
                    <td><a href="deleteReport.php?report_id=<?php echo $row2[0] ?>">Delete</a></td>
                    <?php
                    echo"</tr>";
                }
            }
        echo "</tbody></table><br/>";
        mysql_close($conn);
        ?>
</body>
</html>