<?php


$link = mysqli_connect("$host", "$username", "$password", "$db_name");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
<html>
<head>
    <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/c/video.js"></script>
	<title>Author - Maintain MultiMedia</title>
<script>
	function check_submit(){
		var x=document.getElementById("file");
		var d=document.getElementById("desc");
		var n=document.getElementById("name");
		if(x.value=="" || x.value==null){
			alert('Please select a file');
			return false;
		}
		else if(""==n.value){
			alert('Please input the name');		
			return false;
		}
		else if(""==d.value){
			alert('Please input the description');		
			return false;
		}
		else  if(x.files.item(0).size>157286400){
            alert("File size is limited to 150MB ");
            return false;
        }
	}
	
	function check_file(){		
        str=document.getElementById('file').value.toUpperCase();
        suffix=".OGG";
        suffix2=".MP4";
		// suffix3=".RMVB";
		// suffix4=".AVI";
        if(!(str.indexOf(suffix, str.length - suffix.length) !== -1||
             str.indexOf(suffix2, str.length - suffix2.length) !== -1)
    //          ||
			 // str.indexOf(suffix3, str.length - suffix3.length) !== -1||
			 // str.indexOf(suffix4, str.length - suffix4.length) !== -1)
        	){
				alert('File type not allowed,\nAllowed file: *.ogg,*.mp4');		
        		document.getElementById('file').value='';
        }
    }

</script>
</head>
<body>

<form action="createVideo.html" method="post" name="CreateVideo" enctype="multipart/form-data" onsubmit="return check_submit()";>
	<table class="table table-condensed">		
		<tbody>
		<tr>
			<td>
				<label for="name"><br><h4>Name:</label>
				<input type="text" name="name" id="name">
			</td>
			<td>
				<label for="desc"><br><h4>Description:</label>
				<input type="text" name="desc" id="desc">
			</td>
		</tr>
		<tr>
			<td><br><input type="file" name="file" id="file" accept=".mp4,.ogg" onchange="check_file()"><br><h4>Allowed type: (*.ogg/*.mp4/*)<br>Maximum size:150MB</td>
		</tr>
		<tr><td><br><button type="submit" class="btn btn-success">Submit</button>
				<button type="reset" class="btn btn-warning">Reset</button></td>
		</tr>
		</tbody>
	</table>
</form>

</body>
</html>