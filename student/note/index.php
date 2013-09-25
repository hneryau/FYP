<!DOCTYPE html>
<html class="ui-widget-content">
    <head>
        <title>Sticky Notes Demo</title>
        <script type="text/javascript" src="script/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="script/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="script/jquery.stickynotes.js"></script>
        <link rel="stylesheet" href="css/form.css" type="text/css">
        <link rel="stylesheet" href="css/jquery.stickynotes.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui-1.7.2.custom.css" type="text/css">
        <script type="text/javascript" charset="utf-8">
            jQuery(document).ready(function() {
                var options = {                
                };
                jQuery("#notes").stickyNotes(options);
            });
        </script>
    </head>
    <body style="cursor: auto;">
        <div id="notes" style="width:80%;height:80%;">
        </div>
        <script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script> 
    </body>
</html>
