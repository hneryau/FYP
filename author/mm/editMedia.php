<?php 
    require_once("../conn/conn.php");
    $login_id = $_SESSION['login_id'];
    $sql = "SELECT * FROM MULTIMEDIA where author_id = (SELECT user_id FROM ACCOUNT WHERE login_id = '$login_id') order by media_id";
    $result  = mysql_query($sql, $conn) or die(mysql_error());
?>
<html>
<head>
    <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <title>Author - Edit MultiMedia</title>
    <script>
    function playVideo(value)
    {
        var video = document.getElementById("my_video_1");
        var link = document.getElementById("my_video_1_html5_api");
        link.setAttribute("src", value);
        video.load();
    }    

    function show_confirm() {
        var reply = confirm("Are you sure?");
        if(reply==true){
            return true;
        }
        else{
            return false;
        }  
    }
    </script>
</head>
<body>


    <table class="table table-bordered table-striped">
        <thead >
            <tr class="success">
                <th>Media ID</th>
                <th>Path</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($result1 = mysql_fetch_array($result)){ ?>
            <tr class>
                <td><?php echo $result1[0]; ?></td>
                <td><?php echo $result1[3]; ?></td>
                <td><?php echo $result1[4]; ?></td>
                <td><button class="btn btn-success" name="playVideo" value="<?php echo $result1[3]; ?>" onclick="playVideo(this.value)">Play</button>
                <a href="delMedia.html?media_id=<?php echo $result1[0];?>&path=<?php echo $result1[3];?>" onclick="return show_confirm();">                  
                    <button class="btn btn-danger" name="delMedia">Delete</button>
                 </a> </td>
            </tr>
            <?php ;} ?>
        </tbody>
    </table>

   <div style="position:absolute; height:50%; width:50%">
        <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="400" height="300" poster="my_video_poster.png" data-setup="{}">  
            <source id="link" src="" type="video/mp4">
        </video>
    </div>


</body>
</html>