<?php
session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];

$test_id = $_GET['test_id'];
$sql2 = "SELECT COUNT(*) FROM QUESTION WHERE test_id='$test_id'";
$result2 = mysql_query($sql2, $conn);
$temp2 = mysql_fetch_row($result2);
$numofquestion = $temp2[0];

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Maintain Question</title>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="CreateQuestionEditor/ckeditor.js"></script>
        <link rel="stylesheet" href="Create.css">
        <script>
            function totalise(a) {
                var ansascore = parseInt(document.getElementById('ansascore' + a).value);
                var ansbscore = parseInt(document.getElementById('ansbscore' + a).value);
                var anscscore = parseInt(document.getElementById('anscscore' + a).value);
                var ansdscore = parseInt(document.getElementById('ansdscore' + a).value);
                var result = document.getElementById('mark' + a);
                result.value = ansascore + ansbscore + anscscore + ansdscore;
            }

            function partialmark(a) {
                var checkbox = document.getElementById('partialmark' + a);
                var ansascore = document.getElementById('ansascore' + a);
                var ansbscore = document.getElementById('ansbscore' + a);
                var anscscore = document.getElementById('anscscore' + a);
                var ansdscore = document.getElementById('ansdscore' + a);
                var result = document.getElementById('mark' + a);
                if (checkbox.checked == true) {
                    result.setAttribute('readonly');

                    ansascore.style.visibility = 'visible';
                    ansbscore.style.visibility = 'visible';
                    anscscore.style.visibility = 'visible';
                    ansdscore.style.visibility = 'visible';

                }
                if (checkbox.checked == false) {
                    result.removeAttribute('readonly');
                    ansascore.style.visibility = 'hidden';
                    ansbscore.style.visibility = 'hidden';
                    anscscore.style.visibility = 'hidden';
                    ansdscore.style.visibility = 'hidden';
                }
            }

            function deleteq(questionid) {
            	var question_id = questionid;

				if (confirm('Are you sure you want to delete this question? \nAll the unsaved changes will be lost.')) {
				      $.post("doDelete.php", {question_id : question_id});
				      setTimeout('reload()', 1000);
                		}else{
                		}
	    }
	    
	    function reload() {
	        parent.window.location.reload(true);
	    }
        </script>
    </head>
    <body>
    <h1>Maintain Test</h1>
           <form name="form1"action="doMaintainQ.php" method="post">
            	<div>
                <div>
                <?php
				            $test_id = $test_id;
				            $sql3 = "select * from QUESTION where test_id = '$test_id'  order by questionNo";
				            $result3 = mysql_query($sql3, $conn) or die(mysql_error());
				            $sql98 = "SELECT * FROM TEST WHERE test_id = $test_id";
				            $result98 = mysql_query($sql98, $conn) or die(mysql_error());
				            $temp98 = mysql_fetch_row($result98);
				            $timelimit = $temp98[4];
				            $bookid = $temp98[2];
				            $chapterid = $temp98[1];
				            $authorid = $temp98[3];
				            $sql97 = "SELECT * FROM BOOK WHERE book_id = $bookid";
				            $result97 = mysql_query($sql97, $conn) or die(mysql_error());
				            $temp97 = mysql_fetch_row($result97);
				            $bookname = $temp97[2];
				            $sql96 = "SELECT * FROM CHAPTER WHERE chapter_id = $chapterid";
				            $result96 = mysql_query($sql96, $conn) or die(mysql_error());
				            $temp96 = mysql_fetch_row($result96);
				            $chaptername = $temp96[4];
				            $sql95 = "SELECT * FROM AUTHOR WHERE author_id = $authorid";
							$result95 = mysql_query($sql95, $conn) or die(mysql_error());
							$temp95 = mysql_fetch_row($result95);
				            $authorname = $temp95[1];
            ?>
                	<table><tr>
					</tr>
					<tr>
					<td><b>Book: </b></td>
					<td><?= $bookname ?></td>
					</tr>
					<tr>
					<td><b>Chapter: </b></td>
					<td><?= $chaptername ?></td>
					</tr>
					<tr>
					<td><b>Author: </b></td>
					<td><?= $authorname ?></td>
					</tr>
					<tr>
					<td><b>Time Limit: </b></td>
					<td>
					<?php
						if($timelimit == 15){
							$timelimit15 = ' selected';
						}else if($timelimit == 30){
							$timelimit30 = ' selected';
						}else if($timelimit == 45){
							$timelimit45 = ' selected';
						}else if($timelimit == 60){
							$timelimit60 = ' selected';
						}else if($timelimit == 75){
							$timelimit75 = ' selected';
						}else if($timelimit == 90){
							$timelimit90 = ' selected';
						}else{
							$timelimit15 = ' selected';
						}
					?>
					<select name="time">
               			<option value = "15"<?= $timelimit15 ?>>15 minutes</option>
               			<option value = "30"<?= $timelimit30 ?>>30 minutes</option>
               			<option value = "45"<?= $timelimit45 ?>>45 minutes</option>
               			<option value = "60"<?= $timelimit60 ?>>1 hour</option>
	       				<option value = "75"<?= $timelimit75 ?>>1 hour 15 minutes</option>
	       				<option value = "90"<?= $timelimit75 ?>>1 hour 30 minutes</option>
             		</select>
             		</td>
					</tr></table>
                </div><br>
                    <?php
                    $test_id = $test_id;
                    if (mysql_num_rows($result3) > 0) {
                        $i = 0;
                        $total = mysql_num_rows($result3);
                        echo '<input type="hidden" name="test_id" value="' . $test_id . '">';
                        echo '<input type="hidden" name="total" value="' . $total . '">';
                        while ($row = mysql_fetch_array($result3)) {
                            if ($row[2] == 'MC') {
                                $sql4 = "SELECT * FROM MC WHERE question_id = '$row[0]'";
                                $resul4 = mysql_query($sql4, $conn) or die(mysql_error());
                                $result4 = mysql_fetch_row($resul4);
                                $i++;
                                echo '<div class="question" id="question' . $i . '">';
                                echo 'Question Number: <input type="number" name="qn' . $i . '" value="' . $row[1] . '" ><br>';
                                echo 'Question Content: <br><textarea class="ckeditor"name="editor' . $i . '">' . $result4[2] . '</textarea><br>';
                                echo '<table><th>Answer</th><th width="30">Choice</th>';
                                if ($result4[7] == 'A') {
                                    echo '<tr><td align="center"><input type="radio" value="A" name="ans' . $i . '" checked></td><td><input type="text" name ="choicea' . $i . '" value="' . $result4[3] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="B" name="ans' . $i . '"></td><td><input type="text" name ="choiceb' . $i . '" value="' . $result4[4] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="C" name="ans' . $i . '"></td><td><input type="text" name ="choicec' . $i . '" value="' . $result4[5] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="D" name="ans' . $i . '"></td><td><input type="text" name ="choiced' . $i . '" value="' . $result4[6] . '"></td></tr>';
                                    echo '<tr><td align="center">Question Score: </td><td><input type="text" value="' . $row[9] . '" name="mark' . $i . '"></td></tr></table><input type="hidden" name="qid'.$i.'" value="' . $row[0] . '"><input type="hidden" name="type' . $i . '" value="MC"></div><br><input value="Remove Question" type = "button" onClick="deleteq('. $row[0] .', type'. $i .')"><br>';
                                } else if ($result4[7] == 'B') {
                                    echo '<tr><td align="center"><input type="radio" value="A" name="ans' . $i . '"></td><td><input type="text" name ="choicea' . $i . '" value="' . $result4[3] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="B" name="ans' . $i . '" checked></td><td><input type="text" name ="choiceb' . $i . '" value="' . $result4[4] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="C" name="ans' . $i . '"></td><td><input type="text" name ="choicec' . $i . '" value="' . $result4[5] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="D" name="ans' . $i . '"></td><td><input type="text" name ="choiced' . $i . '" value="' . $result4[6] . '"></td></tr>';
                                    echo '<tr><td align="center">Question Score: </td><td><input type="text" value="' . $row[9] . '" name="mark' . $i . '"></td></tr></table><input type="hidden" name="qid'.$i.'" value="' . $row[0] . '"><input type="hidden" name="type' . $i . '" value="MC"></div><br><input value="Remove Question" type = "button" onClick="deleteq('. $row[0] .', type'. $i .')"><br>';
                                } else if ($result4[7] == 'C') {
                                    echo '<tr><td align="center"><input type="radio" value="A" name="ans' . $i . '"></td><td><input type="text" name ="choicea' . $i . '" value="' . $result4[3] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="B" name="ans' . $i . '"></td><td><input type="text" name ="choiceb' . $i . '" value="' . $result4[4] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="C" name="ans' . $i . '" checked></td><td><input type="text" name ="choicec' . $i . '" value="' . $result4[5] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="D" name="ans' . $i . '"></td><td><input type="text" name ="choiced' . $i . '" value="' . $result4[6] . '"></td></tr>';
                                    echo '<tr><td align="center">Question Score: </td><td><input type="text" value="' . $row[9] . '" name="mark' . $i . '"></td></tr></table><input type="hidden" name="qid'.$i.'" value="' . $row[0] . '"><input type="hidden" name="type' . $i . '" value="MC"></div><br><input value="Remove Question" type = "button" onClick="deleteq('. $row[0] .', type'. $i .')"><br>';
                                } else if ($result4[7] == 'D') {
                                    echo '<tr><td align="center"><input type="radio" value="A" name="ans' . $i . '"></td><td><input type="text" name ="choicea' . $i . '" value="' . $result4[3] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="B" name="ans' . $i . '"></td><td><input type="text" name ="choiceb' . $i . '" value="' . $result4[4] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="C" name="ans' . $i . '"></td><td><input type="text" name ="choicec' . $i . '" value="' . $result4[5] . '"></td></tr>';
                                    echo '<tr><td align="center"><input type="radio" value="D" name="ans' . $i . '" checked></td><td><input type="text" name ="choiced' . $i . '" value="' . $result4[6] . '"></td></tr>';
                                    echo '<tr><td align="center">Question Score: </td><td><input type="text" value="' . $row[9] . '" name="mark' . $i . '"></td></tr></table><input type="hidden" name="qid'.$i.'" value="' . $row[0] . '"><input type="hidden" name="type' . $i . '" value="MC"></div><br><input value="Remove Question" type = "button" onClick="deleteq('. $row[0] .', type'. $i .')"><br>';
                                } else {
                                    echo 'Question Error!</div>';
                                }
                            } else if ($row[2] == 'FIB') {
                                $sql5 = "SELECT * FROM FIB WHERE question_id = '$row[0]'";
                                $resul5 = mysql_query($sql5, $conn) or die(mysql_error());
                                $result5 = mysql_fetch_row($resul5);
                                $i++;
                                echo '<div class="question" id="question' . $i . '">';
                                echo 'Question Number: <input type="number" name="qn' . $i . '" value="' . $row[1] . '" ><br>';
                                echo 'Question Content: <br><b><font color="red">You may use (A), (B), (C), (D) as the answer blanks.</font></b><br>';
                                echo '<textarea class="ckeditor"name="editor' . $i . '">' . $result5[2] . '</textarea>';
                                echo '<b><font color="red">If the answer has alternative answer(s), use "&&" to separate each answer in the text box. Eg. "color&&colour" </font></b><br>';
                                if ($result5[7] == '1') {
                                    $invchecka = ' checked';
                                } else {
                                    $invchecka = '';
                                }
                                if ($result5[8] == '1') {
                                    $invcheckb = ' checked';
                                } else {
                                    $invcheckb = '';
                                }
                                if ($result5[9] == '1') {
                                    $invcheckc = ' checked';
                                } else {
                                    $invcheckc = '';
                                }
                                if ($result5[10] == '1') {
                                    $invcheckd = ' checked';
                                } else {
                                    $invcheckd = '';
                                }
                                if ($result5[11] == '1') {
                                    $cschecka = ' checked';
                                } else {
                                    $cschecka = '';
                                }
                                if ($result5[12] == '1') {
                                    $cscheckb = ' checked';
                                } else {
                                    $cscheckb = '';
                                }
                                if ($result5[13] == '1') {
                                    $cscheckc = ' checked';
                                } else {
                                    $cscheckc = '';
                                }
                                if ($result5[14] == '1') {
                                    $cscheckd = ' checked';
                                } else {
                                    $cscheckd = '';
                                }
                                if ($result5[19] == '1') {
                                    $pm = ' checked';
                                    $pma = $result5[15];
                                    $pmb = $result5[16];
                                    $pmc = $result5[17];
                                    $pmd = $result5[18];
                                    $show = 'visible';
                                    $readonly = ' readonly';
                                } else {
                                    $pm = '';
                                    $pma = '1';
                                    $pmb = '1';
                                    $pmc = '1';
                                    $pmd = '1';
                                    $show = 'hidden';
                                    $readonly = '';
                                }
                                echo '<br>Partial Mark? <input type="checkbox" name="partialmark' . $i . '" id="partialmark' . $i . '" onChange="partialmark(' . $i . ' ) "' . $pm . '>';
                                echo '<br><table>';
                                echo '<th width="100">Answer</th><th></th><th width="30">Answer Score</th>';
                                echo '<tr><td align="center">A</td><td><textarea name="answera' . $i . '">' . $result5[3] . '</textarea></td><td><input style="visibility:' . $show . '" type="number" name="ansascore' . $i . '" id="ansascore' . $i . '" value ="' . $pma . '" onChange="totalise(' . $i . ' ) "></td><td><input type="checkbox" name="inva' . $i . '" value="inva' . $i . '"' . $invchecka . '>Reversible?<input type="checkbox" name="csa' . $i . '"' . $cschecka . '>Case Sensitive?</td></tr>';
                                echo '<tr><td align="center">B</td><td><textarea name="answerb' . $i . '">' . $result5[4] . '</textarea></td><td><input style="visibility:' . $show . '" type="number" name="ansbscore' . $i . '" id="ansbscore' . $i . '" value ="' . $pmb . '" onChange="totalise(' . $i . ' ) "></td><td><input type="checkbox" name="invb' . $i . '" value="invb' . $i . '"' . $invcheckb . '>Reversible?<input type="checkbox" name="csb' . $i . '"' . $cscheckb . '>Case Sensitive?</td></tr>';
                                echo '<tr><td align="center">C</td><td><textarea name="answerc' . $i . '">' . $result5[5] . '</textarea></td><td><input style="visibility:' . $show . '" type="number" name="anscscore' . $i . '" id="anscscore' . $i . '" value ="' . $pmc . '" onChange="totalise(' . $i . ' ) "></td><td><input type="checkbox" name="invc' . $i . '" value="invc' . $i . '"' . $invcheckc . '>Reversible?<input type="checkbox" name="csc' . $i . '"' . $cscheckc . '>Case Sensitive?</td></tr>';
                                echo '<tr><td align="center">D</td><td><textarea name="answerd' . $i . '">' . $result5[6] . '</textarea></td><td><input style="visibility:' . $show . '" type="number" name="ansdscore' . $i . '" id="ansdscore' . $i . '" value ="' . $pmd . '" onChange="totalise(' . $i . ' ) "></td><td><input type="checkbox" name="invd' . $i . '" value="invd' . $i . '"' . $invcheckd . '>Reversible?<input type="checkbox" name="csd' . $i . '"' . $cscheckd . '>Case Sensitive?</td></tr>';
                                echo '<tr><td align="center">Question Score: </td><td> <input type="number" value ="' . $row[9] . '" id ="mark' . $i . '" name ="mark' . $i . '"' . $readonly . '></td></tr>';
                                echo '</table><input type="hidden" name="qid'.$i.'" value="' . $row[0] . '"><input type="hidden" name="type' . $i . '" value="FIB"><br><input value="Remove Question" type = "button" onClick="deleteq('. $row[0] .', type'. $i .')"></div><br>';
                            }
                        }
                    }
                    ?>
                </div>
                <table><tr><td><input type="submit" value="Submit"></td><td><input type="button" value="Add Question" onclick="window.open('createQuestion.php?book_id=<?= $bookid ?>&chapter_id=<?= $chapterid ?>&author_id=<?= $authorid ?>&test_id=<?= $test_id ?>');"></td>
            </form>
            <br>

    </body>
</html>