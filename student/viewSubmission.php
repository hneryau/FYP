<?php
session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);
$sql = "SELECT user_id, name FROM STUDENT, ACCOUNT WHERE student_id = user_id and login_id = '$login_id'";
$result = mysql_query($sql, $conn);
$temp1 = mysql_fetch_row($result);
$user_name = $temp1[1];
$user_id = $temp1[0];
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>View Submission</title>
        <style>
            #submission {
                text-align:left;
                width:750px;
            }
            #question {
                text-align:left;
                width:inherit;
                border-bottom:solid;
                border-bottom-color:#006;
            }
        </style>
    </head>

    <link rel="Stylesheet" type="text/css" href="style/main.css"></link>

    <body>

        <div id="submission">
<?php
$submission_id = $_GET['submission_id'];
$sql1 = "SELECT * FROM S_QUESTION WHERE submission_id = '$submission_id'";
$result1 = mysql_query($sql1, $conn) or die(mysql_error());




if (mysql_num_rows($result1) > 0) {
    $submission_id = $_GET['submission_id'];
    $sql6 = "SELECT score FROM SUBMISSION WHERE submission_id = '$submission_id'";
    $result6 = mysql_query($sql6, $conn) or die(mysql_error());
    $row6 = mysql_fetch_row($result6);
	
	$sql31 = "SELECT totalScore FROM TEST, SUBMISSION where submission_id = '$submission_id' AND TEST.test_id = SUBMISSION.test_id";
	$result31 = mysql_query($sql31, $conn) or die(mysql_error());
    $row31 = mysql_fetch_row($result31);
	
    echo "<h2>Student Name :" . $user_name . "</h2>";
    echo "<h2>Total Score : " . $row6[0] . "/". $row31[0]."</h2>";

    $i = 0;
    while ($rows = mysql_fetch_array($result1)) {
		$i++;
        echo '<div id = question>';
        $s_question_id = $rows[0];

        if ($rows[3] == 'MC') {
            $sql2 = "SELECT QUESTION.questionNo, MC.content, choiceA, choiceB, choiceC, choiceD, s_answer, s_score, score, isCorrect FROM S_MC, MC, QUESTION, S_QUESTION WHERE S_MC.s_question_id = S_QUESTION.s_question_id AND S_QUESTION.question_id = QUESTION.question_id AND QUESTION.question_id = MC.question_id AND S_QUESTION.s_question_id = '$s_question_id'";
            $result4 = mysql_query($sql2, $conn) or die(mysql_error());
            $temp4 = mysql_fetch_row($result4);
            $questionNo = $temp4[0];
            $content = $temp4[1];
            $choiceA = $temp4[2];
            $choiceB = $temp4[3];
            $choiceC = $temp4[4];
            $choiceD = $temp4[5];
            $s_answer = $temp4[6];
            $s_score = $temp4[7];
            $score = $temp4[8];
            $iscorrect = $temp4[9];

            echo $questionNO . $content . '<br>';


            if ($s_answer == "A") {
                echo 'A<input type="radio" checked name="sa'.$i.'" disabled="disabled"/>';
            } else {
                echo'A<input type="radio" name="sa'.$i.'" disabled="disabled"/>';
            }
            echo $choiceA . '<br>';

            if ($s_answer == "B") {
                echo 'B<input type="radio" checked  name="sa'.$i.'" disabled="disabled"/>';
            } else {
                echo'B<input type="radio" name="sa'.$i.'" disabled="disabled"/>';
            }
            echo $choiceB . '<br>';

            if ($s_answer == "C") {
                echo 'C<input type="radio" checked  name="sa'.$i.'" disabled="disabled"/>';
            } else {
                echo'C<input type="radio"  name="sa'.$i.'" disabled="disabled"/>';
            }
            echo $choiceC . '<br>';

            if ($s_answer == "D") {
                echo 'D<input type="radio" checked name="sa'.$i.'" disabled="disabled"/>';
            } else {
                echo'D<input type="radio" disabled="disabled" name="sa'.$i.'";/>';
            }
            echo $choiceD . '<br>';

           





            if ($rows[4] == 'correct') {
                echo '<img src="images/correct.png" width="90">';
            } else if ($rows[4] == 'incorrect') {
                echo '<img src="images/incorrect.png" width="90">';
			} else if ($rows[4] == 'partial correct') {
                echo '<img src="images/pcorrect.png" width="90">';
			}

            echo '<h2>Score :' . $s_score . '/' . $score . '</h1>';
        } else if ($rows[3] == 'FIB') {
            $sql2 = "SELECT QUESTION.questionNo, FIB.question, s_answerA, s_answerB, s_answerC, s_answerD, answerA, answerB, answerC, answerD, s_score, score, isCorrect FROM S_FIB, FIB, QUESTION, S_QUESTION WHERE S_FIB.s_question_id = S_QUESTION.s_question_id AND S_QUESTION.question_id = QUESTION.question_id AND QUESTION.question_id = FIB.question_id AND S_QUESTION.s_question_id = '$s_question_id'";
            $result4 = mysql_query($sql2, $conn) or die(mysql_error());
            $temp4 = mysql_fetch_row($result4);

            $content = $temp4[1];
            $sanswerA = $temp4[2];
            $sanswerB = $temp4[3];
            $sanswerC = $temp4[4];
            $sanswerD = $temp4[5];
            $s_score = $temp4[10];
            $score = $temp4[11];
            $iscorrect = $temp4[12];
            echo $content . '<br>';
            if ($temp4[6] != NULL)
                echo 'A<input type="text" value="' . $sanswerA . '"readonly/>' . '<br>';
            if ($temp4[7] != NULL)
                echo 'B<input type="text" value="' . $sanswerB . '"readonly/>' . '<br>';
            if ($temp4[8] != NULL)
                echo 'C<input type="text" value="' . $sanswerC . '"readonly/>' . '<br>';
            if ($temp4[9] != NULL)
                echo 'D<input type="text" value="' . $sanswerD . '"readonly/>' . '<br>';

          

            if ($rows[4] == 'correct') {
                echo '<img src="images/correct.png" width="90">';
            } else if ($rows[4] == 'incorrect') {
                echo '<img src="images/incorrect.png" width="90">';
			} else if ($rows[4] == 'partial correct') {
                echo '<img src="images/pcorrect.png" width="90">';
			}
            echo '<h2>Score :' . $s_score . '/' . $score . '</h1>';
        }
        echo '</div>';
    }
}
?>

        </div>
    </body>
</html>