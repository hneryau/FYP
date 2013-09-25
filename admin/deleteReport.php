<?php
require_once('conn/conn.php');
mysql_select_db($database_conn, $conn);
session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
        if ((!isset($_GET['report_id'])) || ($_GET['report_id'] == null)) {
            echo '<a href="browseReport.php?">No report set!!(Back)</a>';
        } else {
            $report = $_GET['report_id'];
            $query_delete = "delete from REPORT where report_id=$report";
            mysql_query($query_delete, $conn) or die(mysql_error());
            echo '<a href="browseReport.php">Report deleted!</a>';
        }
        ?>
    </body>
</html>