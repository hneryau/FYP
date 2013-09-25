<?php
	$section_id = $_GET["section_id"];
	session_start();
	require_once('conn/conn.php');
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT * FROM SECTION WHERE section_id = '$section_id'";
	$result =  mysql_query($sql, $conn);
	$temp1 = mysql_fetch_row($result);
	$description = $temp1[5];
	$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);
$sql19 = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
$result = mysql_query($sql19, $conn);
$temp2 = mysql_fetch_row($result);
$user_name = $temp2[1];
$user_id = $temp2[0];
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="highlight/rangy-core.js"></script>
        <script type="text/javascript" src="highlight/rangy-cssclassapplier.js"></script>
        <script type="text/javascript" src="highlight/rangy-highlighter.js"></script>
        <script type="text/javascript" src="highlight/rangy-selectionsaverestore.js"></script>
        <script type="text/javascript" src="highlight/rangy-serializer.js"></script>
        <script type="text/javascript" src="highlight/rangy-textrange.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script language="Javascript" type="text/javascript" src="js/onscroll.js"></script>
        <link rel="Stylesheet" type="text/css" href="css/onscroll.css"></link>
        <script type="text/javascript">

<?php
$sql18 = "SELECT * FROM HIGHLIGHT WHERE student_id = '$user_id' AND section_id = $section_id";
$result18 = mysql_query($sql18, $conn);
if (mysql_num_rows($result18) >0) {
$temp3 = mysql_fetch_row($result18);
$position = $temp3[5];
$color = $temp3[6];
} else {
$color = "#80ffff";
}
?>
            var serializedHighlights = "<?php echo $position ?>";
            var highlighter;
            var initialDoc;


            $(document).ready(function() {

                $(".notes").draggable({
                    containment: "#book",
                    scroll: false,
                    start: function(e, ui) {
                    },
                    resize: function(e, ui) {
                    },
                    stop: function(e, ui) {
                    }
                });
                $(".notes").resizable({
                    alsoResize: "#texta" + i,
                    start: function(e, ui) {
                    },
                    resize: function(e, ui) {
                    },
                    stop: function(e, ui) {
                    }
                });
                rangy.init();
                highlighter = rangy.createHighlighter();
                highlighter.addClassApplier(rangy.createCssClassApplier("highlight", {
                    ignoreWhiteSpace: true,
                    tagNames: ["span", "a"]
                }));

                highlighter.addClassApplier(rangy.createCssClassApplier("note", {
                    ignoreWhiteSpace: true,
                    elementTagName: "a",
                    elementProperties: {
                        href: "#",
                        onclick: function() {
                            var highlight = highlighter.getHighlightForElement(this);
                            if (window.confirm("Delete this note (ID " + highlight.id + ")?")) {
                                highlighter.removeHighlights([highlight]);
                            }
                            return false;
                        }
                    }
                }));

                if (serializedHighlights) {
                    highlighter.deserialize(serializedHighlights);
                }

            });


            function highlightSelectedText() {
                highlighter.highlightSelection("highlight");
            }

            function noteSelectedText() {
                highlighter.highlightSelection("note");
            }

            function removeHighlightFromSelectedText() {
                highlighter.unhighlightSelection();
            }

            function highlightScopedSelectedText() {
                highlighter.highlightSelection("highlight", null, "summary");
            }

            function noteScopedSelectedText() {
                highlighter.highlightSelection("note", null, "summary");
            }



            function loadHighlight(button) {


                serializedHighlights =
                        button.form.elements["serializedHighlights"].value = highlighter.serialize();
                button.form.submit();
            }
            function color() {
                $('.highlight').css('background-color', $("#color").val());
            }
            var i = 0;

<?php
$sql24 = "SELECT * FROM NOTES WHERE student_id = '$user_id' AND section_id = '$section_id'";
$result24 = mysql_query($sql24, $conn);
$temp24 = mysql_fetch_row($result24);
$savedNotes = $temp24[5];
?>

            i = "<?php echo $temp24[6]; ?>";


            function updateim(i) {
                var text = document.getElementById('texta' + i).value;
                $("#texta" + i).text(text);
            }
            function deleteNotes(i) {
                $("#note" + i).remove();
            }


            function addNewNotes() {
                i++;
                $(function() {
                    $("#book2")
                            .append("<div style='top: "+document.body.scrollTop+"px;' class='notes' id='note" + i + "'><textarea name='texta" + i + "' onKeyUp='updateim(" + i + ")' class='texta' id='texta" + i + "'></textarea><input type='button' onclick='deleteNotes(" + i + ")' value='Delete Notes' >");
                    $(".notes").draggable({
                        containment: "#book",
                        scroll: false,
                        start: function(e, ui) {
                        },
                        resize: function(e, ui) {
                        },
                        stop: function(e, ui) {
                        }
                    });
                    $(".notes").resizable({
                        alsoResize: "#texta" + i,
                        start: function(e, ui) {
                        },
                        resize: function(e, ui) {
                        },
                        stop: function(e, ui) {
                        }
                    });
                });
            }

            function saveNotes() {
                var user_id = "<?php echo $user_id ?>";
                var section_id = "<?php echo $section_id ?>";
                var html = document.getElementById('book2').innerHTML;
                var index = i;
                $.post("saveNotes.php", {user_id: user_id, section_id: section_id, html: html, index: index});
            }


            function saveHighlight2() {
                var user_id = "<?php echo $user_id ?>";
                var section_id = "<?php echo $section_id ?>";
                var color = document.getElementById('color').value;
                var highlight = highlighter.serialize();
                $.get("saveHighlight.php", {user_id: user_id, section_id: section_id, serializedHighlights: highlight, color: color});
            }

            function saveAll() {
                saveNotes();
                saveHighlight2();
                alert("Save successfully!");
                setTimeout("reload()", 1000);
            }

            function resetPage() {
                var user_id = "<?php echo $user_id ?>";
                var section_id = "<?php echo $section_id ?>";
                if (confirm('Do you want to reset this page?')) {
                    $.get("resetPage.php", {user_id: user_id, section_id: section_id});
                    setTimeout('reload()' , 1000);
                }

            }

 function reload() {
	        self.location.reload(true);
 }

        </script> 

        <title>BOOK</title>


        <style type="text/css">

            .texta {

                resize: inherit;

                width: inherit;

                height:inherit;

				background-color:transparent;

            }

            .notes { 

                width:150px;

                height:80px;

                padding-top:2px;

                padding-left: 2px;

                padding-bottom: 20px;

                padding-right: 9px;

                text-align: right;

                border: solid;

                border-width: 1px;

                position:absolute;

            }

            .highlight {

                background-color: <?php echo $color; ?>;

            }





            #summary {

                border: dotted orange 1px;

            }

            body {

                width:900px;



                color: #333;

            }

            #book {

                position:absolute;

                left:0px;

                top:0px;

                width:800px;
				height:auto;
				border-right:solid;
				border-right-color:#006;
				border-right-width:thin;
				border-left:solid;
				border-left-color:#006;
				border-left-width:thin;

            }

            #book2 {

                position:absolute;

                left:0px;

                top:0px;

                width:800px;

				



            }

            #box {
				alignment-adjust:right;
                position:absolute;
                left:810px;
                top:0px;
                width:80px;
            }

            #total {

                width:900;

            }

            .btn {

                text-align: left;

                width:80px;

            }

        </style>

    </head>


    <body>
        <div id="total">

            <div id="box">
                <h3>Tools</h3>
                <h4>Add</h4>
                <input class="btn" type="color" id="color" onChange="color()" value="<?php echo $color; ?>">
                <input class="btn" type="button" ontouchstart="highlightSelectedText();" onclick="highlightSelectedText();" value="Highlight">
                <input class="btn" type="button" onClick="addNewNotes()" value="Notes">
                <input class="btn" type="button" ontouchstart="removeHighlightFromSelectedText();" onclick="removeHighlightFromSelectedText();" value="Remove">
                <input class="btn" type="button" onClick="saveAll()" value="Save All">
                <input class="btn" type="button" onClick="resetPage()" value="Reset Page">
                <br>

            </div>
            <div id="book">
            	
                <?php echo  $description ?>
            </div>
            <div id="book2">
                <?php echo $savedNotes ?>
            </div>
        </div>
    </body>
</html>