<?php
require_once('conn/conn.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>        
        <script type="text/javascript">
        function licenseGen(){
            var display = document.getElementById('license');
            var string1 = "abcdefghijklmnopqrstuvwxyz";
            var string2 = "1234567890";
            var string3 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var string4 = string1+string2+string3;
            var license = "";
            for (var i=0; i<10; i++){
                license += string4.charAt(Math.floor(Math.random()*string4.length));
            }
            display.value = license;
        }

        function validate(){
            var t = document.forms["saveLicense"]["license"].value;
            if (t == ""){
                alert("Please click 'Start' button to generate the license.");
                return false; 
            }
        }
        </script>
    </head>

    <body>
        <h1>License Generator</h1>
        <form action="saveLicense.php" method="post" name="saveLicense" onSubmit="return validate();">
            <table class="table table-bordered table-hover">            
        		<tr>
            		<th>License</th>
            		<th>Days</th>
            		<th>Action</th>
                 </tr>
           	    <tr>
               		<td class="span3">
                        <input type="text" id="license" name="license" readonly></input>
                    </td>
            		<td class="span3">
            			<select name="days">
                            <option value="30">30</option>
                            <option value="90">90</option>
                            <option value="180">180</option>
                            <option value="365">365</option>
                        </select>
            		</td>    
            		<td class="span3">
                        <button type="button" class="btn btn-Inverse" name="start" value="start" onclick="licenseGen()">Start</button>
            			<button type="submit" class="btn btn-success" name="submit" value="save">Save</button>
            		</td>   
        		</tr>     
                <?php
                echo "</table></form>";
                mysql_close($conn);
            ?>
    </body>
</html>