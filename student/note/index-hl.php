<!DOCTYPE html>
<html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="rangyinputs_jquery.min.js"></script>
	<script>	
        $(document).ready(function() {
            var $ta = $("#ta");
            var $startIndex = $("#startIndex"), $endIndex = $("#endIndex");

            function reportSelection() {
                var sel = $ta.getSelection();
                $startIndex.text(sel.start);
                $endIndex.text(sel.end);
            }

            $(document).on("selectionchange", reportSelection);
            $ta.on("keyup input mouseup textInput", reportSelection);

            $ta.focus();

            reportSelection();

            $("input").mousedown(function(e) {
                e.preventDefault();

                switch (this.name) {
                    case "replaceSelectedTextAndCollapse":
                        $ta.replaceSelectedText("**Test**", "collapseToEnd");
                        break;
                    case "replaceSelectedTextAndSelect":
                        $ta.replaceSelectedText("**Test**", "select");
                        break;
                    case "extractSelectedText":
                        alert($ta.extractSelectedText());
                        break;
                    case "surroundSelectedText":
                        $ta.surroundSelectedText("[Before]", "[After]");
                        break;
                    case "collapseToStart":
                        $ta.collapseSelection(true);
                        break;
                    case "collapseToEnd":
                        $ta.collapseSelection(false);
                        break;
                    case "setSelection":
                        $ta.setSelection( +$('#ta_start').val(), +$('#ta_end').val() );
                        break;
                }
                $ta.focus();

                // For IE, which always shifts the focus onto the button
                window.setTimeout(function() {
                    $ta.focus();
                }, 0);
            });
        });
    </script>
    <style type="text/css">
        p.inputcontainer {
            float: left;
            background-color: lightsteelblue;
            border: solid 1px darkblue;
            padding: 0.3125em;
        }
    </style>
</head>
<body>
	<p class="inputcontainer">
    <input type="button" class="unselectable" unselectable="on" name="replaceSelectedTextAndCollapse" value="paste test text">
    <input type="button" class="unselectable" unselectable="on" name="replaceSelectedTextAndSelect" value="paste test text and select">
    <input type="button" class="unselectable" unselectable="on" name="extractSelectedText" value="extract selected text">
    <input type="button" class="unselectable" unselectable="on" name="surroundSelectedText" value="surround selected text">
    <input type="button" class="unselectable" unselectable="on" name="collapseToStart" value="collapse to start">
    <input type="button" class="unselectable" unselectable="on" name="collapseToEnd" value="collapse to end">
    <br>
    Select from <input type="text" id="ta_start" size="3" value="1"> to
    <input type="text" id="ta_end" size="3" value="17">
    <input type="button" class="unselectable" unselectable="on" name="setSelection" value="set selection">

    <br>
    Selection: <b id="startIndex">10</b> to <b id="endIndex">10</b>
    <br>
    <textarea rows="15" cols="80" id="ta">Some test text
That has

Some line breaks, including some trailing ones


</textarea>
</p>
</body>
</html>