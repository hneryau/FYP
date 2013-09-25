<?php

require_once('conn/conn.php');

// session_start();

?>

<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <title>Manage Announcement</title>

        <script type="text/javascript" src="/author/CreateBookEditor/ckeditor.js"></script>

    </head>



    <body>

        <?php

        $query_rs = "select * from NEWS where news_id = 1";

        $result = mysql_query($query_rs, $conn) or die(mysql_error());

        $result2 = mysql_fetch_row($result);

        ?>

        <h1>Manage Announcement</h1>

        <form action = "doManageNews.php" method = "post">

        <table class="table table-bordered table-hover">

       	<tr>

   		<td><textarea class="ckeditor" cols="80" id="editor1" name="news" rows="10"><?= $result2[1] ?></textarea></td>

		</tr>

		<td><button type="submit" class="btn btn-success">Save</button></td>

		</tr>

		</table>

		</form>



</body>

</html>