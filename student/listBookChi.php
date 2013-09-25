<?php

require_once('conn/conn.php');

mysql_select_db($database_conn, $conn);

?>

<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <title>Untitled Document</title>

        <link rel="stylesheet" href="../table_style/style.css" />
        <script>
		 function open_window(url){
			height = window.screen.availHeight;
			myRef = window.open( url,'My Book','left=0,top=0,width=1050,height=height,toolbar=1,resizable=0');
		}
        </script>
    </head>

    <body>

        <?php

        $query_rs = "select book_id, bookName, category, coverPath, name from BOOK, AUTHOR where AUTHOR.author_id = BOOK.Author_id AND BOOK.category = 'Chinese' AND status = '1'";

        $result = mysql_query($query_rs, $conn) or die(mysql_error());

        $totalRows_rs = mysql_num_rows($result);

        echo "<h1>List of all Book</h1>";

        echo "<table cellpadding='0' cellspacing='0' border='0' id='table' class='sortable'>

		<thead>

				<tr>

                    <th ><h3>Book Cover	</h3></th>

					<th ><h3>Book Name		</h3></th>

                    <th ><h3>Author		</h3></th>

                    <th ><h3>Category		</h3></th>

					<th ><h3>Option		</h3></th>

                </tr>

		</thead><tbody>";



        if ($totalRows_rs > 0) {

            while ($row = mysql_fetch_assoc($result)) {

                echo'<tr>';

                echo'<td><img width="150" src="' . $row["coverPath"] .'"/></td>';

                echo'<td>'. $row["bookName"].'</td>';

				echo'<td>'. $row["name"].'</td>';

				echo'<td>'. $row["category"].'</td>';

                ?>
               <td><a herf="#" onClick="open_window('controlBook.php?book_id=<?php echo $row["book_id"]?>')" > View content</a></td> 
              <?php

                echo'</tr>';

            }

        }

        echo "</tbody></table><br/>";

        ?>





        <div id="controls">

            <div id="perpage">

                <select onchange="sorter.size(this.value)">

                    <option value="5">5</option>

                    <option value="10" selected="selected">10</option>

                    <option value="20">20</option>

                    <option value="50">50</option>

                    <option value="100">100</option>

                </select>

                <span>Entries Per Page</span>

            </div>

            <div id="navigation">

                <img src="../table_style/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1, true)" />

                <img src="../table_style/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />

                <img src="../table_style/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />

                <img src="../table_style/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1, true)" />

            </div>

            <div id="text">Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span></div>

        </div>

        <script type="text/javascript" src="../table_style/script.js"></script>

        <script type="text/javascript">

                            var sorter = new TINY.table.sorter("sorter");

                            sorter.head = "head";

                            sorter.asc = "asc";

                            sorter.desc = "desc";

                            sorter.even = "evenrow";

                            sorter.odd = "oddrow";

                            sorter.evensel = "evenselected";

                            sorter.oddsel = "oddselected";

                            sorter.paginate = true;

                            sorter.currentid = "currentpage";

                            sorter.limitid = "pagelimit";

                            sorter.init("table", 1);

        </script>

    </body>

</html>