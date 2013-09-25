<?php

session_start();
require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];


$total = $_POST['total'];

for ($i = 1; $i <= $total; $i++) {
    $type = $_POST['type' . $i];
    if ($type == 'MC') {
        $qn = $_POST['qn' . $i];
        $content = $_POST['editor' . $i];
        $choiceA = $_POST['choicea' . $i];
        $choiceB = $_POST['choiceb' . $i];
        $choiceC = $_POST['choicec' . $i];
        $choiceD = $_POST['choiced' . $i];
        $test_id = $_POST['test_id'];
        $question_id = $_POST['qid' . $i];
        $ans = $_POST['ans' . $i];
        $score = $_POST['mark' . $i];
        $totalScore += $score;

        $SQL0 = "UPDATE QUESTION SET questionNo = '$qn', score = '$score' WHERE question_id='$question_id'";
        mysql_query($SQL0, $conn) or die(mysql_error());
        $SQL1 = "UPDATE MC SET content = '$content', choiceA = '$choiceA', choiceB = '$choiceB', choiceC = '$choiceC', choiceD = '$choiceD', answer = '$ans' WHERE question_id = '$question_id'";
        mysql_query($SQL1, $conn) or die(mysql_error());
    } else if ($type == 'FIB') {

        $qn = $_POST['qn' . $i];
        $question = $_POST['editor' . $i];
        $answerA = $_POST['answera' . $i];
        $answerB = $_POST['answerb' . $i];
        $answerC = $_POST['answerc' . $i];
        $answerD = $_POST['answerd' . $i];
        $scoreA = $_POST['ansascore' . $i];
        $scoreB = $_POST['ansbscore' . $i];
        $scoreC = $_POST['anscscore' . $i];
        $scoreD = $_POST['ansdscore' . $i];
        $score = $_POST['mark' . $i];
        $totalScore += $score;
        if (isset($_POST['partialmark' . $i])) {
            $pm = 1;
        } else {
            $pm = 0;
        };

        if (isset($_POST['inva' . $i])) {
            $invAnsA = 1;
        } else {
            $invAnsA = 0;
        };
        if (isset($_POST['invb' . $i])) {
            $invAnsB = 1;
        } else {
            $invAnsB = 0;
        };
        if (isset($_POST['invc' . $i])) {
            $invAnsC = 1;
        } else {
            $invAnsC = 0;
        };
        if (isset($_POST['invd' . $i])) {
            $invAnsD = 1;
        } else {
            $invAnsD = 0;
        };

        if (isset($_POST['csa' . $i])) {
            $csAnsA = 1;
        } else {
            $csAnsA = 0;
        };
        if (isset($_POST['csb' . $i])) {
            $csAnsB = 1;
        } else {
            $csAnsB = 0;
        };
        if (isset($_POST['csc' . $i])) {
            $csAnsC = 1;
        } else {
            $csAnsC = 0;
        };
        if (isset($_POST['csd' . $i])) {
            $csAnsD = 1;
        } else {
            $csAnsD = 0;
        };


        $test_id = $_POST['test_id'];
        $question_id = $_POST['qid' . $i];

        $SQL2 = "UPDATE QUESTION SET questionNo = '$qn', score = '$score' WHERE question_id='$question_id'";
        mysql_query($SQL2, $conn) or die(mysql_error());
        $SQL3 = "UPDATE FIB SET question = '$question', answerA = '$answerA', answerB = '$answerB', answerC = '$answerC', answerD = '$answerD', invAnsA = '$invAnsA', invAnsB = '$invAnsB', invAnsC = '$invAnsC', invAnsD = '$invAnsD', csA = '$csAnsA', csB = '$csAnsB', csC = '$csAnsC', csD = '$csAnsD', ansAScore = '$scoreA', ansBScore = '$scoreB', ansCScore = '$scoreC', ansDScore = '$scoreD', partialMark = '$pm' WHERE question_id = '$question_id'";
        mysql_query($SQL3, $conn) or die(mysql_error());
    } else {
        echo "Maintain Question Error!";
    }
    $timelimit = $_POST['time'];
    $SQL4 = "UPDATE TEST SET totalScore = '$totalScore', timelimit = '$timelimit' WHERE test_id='$test_id'";
    mysql_query($SQL4, $conn) or die(mysql_error());
}
echo '<table align="center">
	<tr><td>
		<fieldset>
		<legend>Process</legend>
		<table align="center">
			<tr><td>Maintain Test sucessful!</td></tr>
		</table>
		</fieldset>
	</td></tr>
</table>';
?>