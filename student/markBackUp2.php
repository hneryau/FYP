<?php

require_once('conn/conn.php');
$login_id = $_SESSION['login_id'];
mysql_select_db($database_conn, $conn);
$submission_id = $_GET['submission_id'];

$sql0 = "SELECT test_id FROM SUBMISSION WHERE submission_id = '$submission_id'";
$result0 = mysql_query($sql0, $conn) or die(mysql_error());
$temp0 = mysql_fetch_row($result0);
$test_id = $temp0[0];

$sql1 = "SELECT * FROM S_QUESTION WHERE submission_id = '$submission_id'";
$result1 = mysql_query($sql1, $conn) or die(mysql_error());

if (mysql_num_rows($result1) > 0) {
    $score = 0;

    $isCorrect = "";
    while ($row = mysql_fetch_array($result1)) {
        $tempscore = 0;
        if ($row[3] == 'MC') {
            $sql12 = "SELECT S_QUESTION.s_question_id, QUESTION.question_id, s_answer, answer, score, correct, incorrect FROM S_MC, MC, S_QUESTION, QUESTION WHERE S_QUESTION.question_id = QUESTION.question_id AND S_MC.s_question_id = S_QUESTION.s_question_id AND MC.question_id = QUESTION.question_id AND S_QUESTION.s_question_id = $row[0]";
            $result12 = mysql_query($sql12, $conn) or die(mysql_error());
            $row12 = mysql_fetch_row($result12);
            if ($row12[2] == $row12[3]) {
                $correct = $row12[5] + 1;
                $sql5 = "UPDATE QUESTION SET correct = '$correct' WHERE question_id = '$row12[1]'";
                $isCorrect = "correct";
                @mysql_query($sql5, $conn) or die(mysql_error());
            } else {
                $incorrect = $row12[6] + 1;
                $sql6 = "UPDATE QUESTION SET incorrect = '$incorrect' WHERE question_id = '$row12[1]'";
                $isCorrect = "incorrect";
                @mysql_query($sql6, $conn) or die(mysql_error());
            }

            $sql7 = "UPDATE S_QUESTION set isCorrect = '$isCorrect' WHERE s_question_id = '$row12[0]'";
            @mysql_query($sql7, $conn) or die(mysql_error());
        } else if ($row[3] == 'FIB') {
            $sql21 = "SELECT S_QUESTION.s_question_id, QUESTION.question_id, s_answerA, s_answerB, s_answerC, s_answerD, answerA, answerB, answerC, answerD, invAnsA, invAnsB, invAnsC, invAnsD, score, correct, incorrect, ansAScore, ansBScore, ansCScore, ansDScore, csA, csB, csC, csD, partialMark FROM S_FIB, FIB, S_QUESTION, QUESTION WHERE S_QUESTION.question_id = QUESTION.question_id AND S_FIB.s_question_id = S_QUESTION.s_question_id AND FIB.question_id = QUESTION.question_id AND S_QUESTION.s_question_id = $row[0]";
            $result21 = mysql_query($sql21, $conn) or die(mysql_error());
            $row21 = mysql_fetch_row($result21);
            $answerA = explode("&&", $row21[6]);
            $answerB = explode("&&", $row21[7]);
            $answerC = explode("&&", $row21[8]);
            $answerD = explode("&&", $row21[9]);
            $countA = count($answerA);
            $countB = count($answerB);
            $countC = count($answerC);
            $countD = count($answerD);
            $pm = $row21[25];

            //New
            $fanswer[] = new fanswer();
            $fanswer[] = new fanswer();
            $fanswer[] = new fanswer();
            $fanswer[] = new fanswer();
            $fanswer[1]->answer = explode("&&", $row21[6]);
            $fanswer[2]->answer = explode("&&", $row21[7]);
            $fanswer[3]->answer = explode("&&", $row21[8]);
            $fanswer[4]->answer = explode("&&", $row21[9]);
            $fanswer[1]->invertable = $row21[10];
            $fanswer[2]->invertable = $row21[11];
            $fanswer[3]->invertable = $row21[12];
            $fanswer[4]->invertable = $row21[13];
            $fanswer[1]->ansscore = $row21[17];
            $fanswer[2]->ansscore = $row21[18];
            $fanswer[3]->ansscore = $row21[19];
            $fanswer[4]->ansscore = $row21[20];
            $fanswer[1]->cs = $row21[21];
            $fanswer[2]->cs = $row21[22];
            $fanswer[3]->cs = $row21[23];
            $fanswer[4]->cs = $row21[24];


            $invertable = new arrayObject();
            $uninvertable = new arrayObject();


            for ($i = 1; $i < 5; $i++) {
                if ($fanswer [$i]->invertable == 1) {
                    $invertable[] = $fanswer[$i];
                } else if ($fanswer [$i]->invertable == 0) {
                    $uninvertable[] = $fanswer [$i];
                }
            }

            $correctA = "YES";
            $correctB = "YES";
            $correctC = "YES";
            $correctD = "YES";


            if (count($invertable) != 0) {

                for ($i = 0; $i < count($invertable); $i++) {
                    for ($k = 0; $k < count($invertable[$i]->answer); $k++) {
                        echo A;
                        if ($invertable[$i]->answer[$k] != $row21[2]) {
                            if (strcasecmp($invertable[$i]->answer[$k], $row21[2]) == 0 && $invertable[$i]->cs == 0 && $invertable[$i]->status == "unuse") {
                                echo '4th statment is ran <br>';
                                $correctA = "YES";
                                $invertable[$i]->status = "used";
                                break 2;
                            } else {
                                echo '1st statment is ran' . $invertable[$i]->answer[$k] . '!=' . $row21[2] . '<br>';
                                $correctA = "NO";
                            }
                        } else if ($invertable[$i]->answer[$k] == $row21[2] && $invertable[$i]->status == "used") {
                            echo '2nd statment is ran <br>';
                            $correctA = "NO";
                        } else if ($invertable[$i]->answer[$k] == $row21[2] && $invertable[$i]->status == "unuse") {
                            echo '3rd statment is ran <br>';
                            $correctA = "YES";
                            $invertable[$i]->status = "used";
                            break 2;
                        }
                    }
                }
                echo '0' . $invertable[0]->status . '<br>';
                echo '1' . $invertable[1]->status . '<br>';
                echo '2' . $invertable[2]->status . '<br>';
                echo '3' . $invertable[3]->status . '<br>';
                echo $correctA . '<br><br>';
                echo $correctB . '<br><br>';
                echo $correctC . '<br><br>';
                echo $correctD . '<br><br>';

                for ($i = 0; $i < count($invertable); $i++) {
                    for ($k = 0; $k < count($invertable[$i]->answer); $k++) {
                        echo B;
                        if ($invertable[$i]->answer[$k] != $row21[3]) {
                            if (strcasecmp($invertable[$i]->answer[$k], $row21[3]) == 0 && $invertable[$i]->cs == 0 && $invertable[$i]->status == "unuse") {
                                echo '4th statment is ran <br>';
                                $correctB = "YES";
                                $invertable[$i]->status = "used";
                                break 2;
                            } else {
                                echo '1st statment is ran' . $invertable[$i]->answer[$k] . '!=' . $row21[2] . '<br>';
                                $correctB = "NO";
                            }
                        } else if ($invertable[$i]->answer[$k] == $row21[3] && $invertable[$i]->status == "used") {
                            echo '2nd statment is ran <br>';
                            $correctB = "NO";
                        } else if ($invertable[$i]->answer[$k] == $row21[3] && $invertable[$i]->status == "unuse") {
                            echo '3rd statment is ran <br>';
                            $correctB = "YES";
                            $invertable[$i]->status = "used";
                            break 2;
                        }
                    }
                }

                echo '0' . $invertable[0]->status . '<br>';
                echo '1' . $invertable[1]->status . '<br>';
                echo '2' . $invertable[2]->status . '<br>';
                echo '3' . $invertable[3]->status . '<br>';
                echo $correctA . '<br><br>';
                echo $correctB . '<br><br>';
                echo $correctC . '<br><br>';
                echo $correctD . '<br><br>';


                for ($i = 0; $i < count($invertable); $i++) {
                    for ($k = 0; $k < count($invertable[$i]->answer); $k++) {
                        echo C;
                        if ($invertable[$i]->answer[$k] != $row21[4]) {
                            if (strcasecmp($invertable[$i]->answer[$k], $row21[4]) == 0 && $invertable[$i]->cs == 0 && $invertable[$i]->status == "unuse") {
                                echo '4th statment is ran <br>';
                                $correctC = "YES";
                                $invertable[$i]->status = "used";
                                break 2;
                            } else {
                                echo '1st statment is ran' . $invertable[$i]->answer[$k] . '!=' . $row21[2] . '<br>';
                                $correctC = "NO";
                            }
                        } else if ($invertable[$i]->answer[$k] == $row21[4] && $invertable[$i]->status == "used") {
                            echo '2nd statment is ran <br>';
                            $correctC = "NO";
                        } else if ($invertable[$i]->answer[$k] == $row21[4] && $invertable[$i]->status == "unuse") {
                            echo '3rd statment is ran <br>';
                            $correctC = "YES";
                            $invertable[$i]->status = "used";
                            break 2;
                        }
                    }
                }

                echo '0' . $invertable[0]->status . '<br>';
                echo '1' . $invertable[1]->status . '<br>';
                echo '2' . $invertable[2]->status . '<br>';
                echo '3' . $invertable[3]->status . '<br>';
                echo $correctA . '<br><br>';
                echo $correctB . '<br><br>';
                echo $correctC . '<br><br>';
                echo $correctD . '<br><br>';

                for ($i = 0; $i < count($invertable); $i++) {
                    for ($k = 0; $k < count($invertable[$i]->answer); $k++) {
                        echo D;
                        if ($invertable[$i]->answer[$k] != $row21[5]) {
                            if (strcasecmp($invertable[$i]->answer[$k], $row21[5]) == 0 && $invertable[$i]->cs == 0 && $invertable[$i]->status == "unuse") {
                                echo '4th statment is ran <br>';
                                $correctD = "YES";
                                $invertable[$i]->status = "used";
                                break 2;
                            } else {
                                echo '1st statment is ran' . $invertable[$i]->answer[$k] . '!=' . $row21[2] . '<br>';
                                $correctD = "NO";
                            }
                        } else if ($invertable[$i]->answer[$k] == $row21[5] && $invertable[$i]->status == "used") {
                            echo '2nd statment is ran <br>';
                            $correctD = "NO";
                        } else if ($invertable[$i]->answer[$k] == $row21[5] && $invertable[$i]->status == "unuse") {
                            echo '3rd statment is ran <br>';
                            $correctD = "YES";
                            $invertable[$i]->status = "used";
                            break 2;
                        }
                    }
                }
            }

            echo '0' . $invertable[0]->status . '<br>';
            echo '1' . $invertable[1]->status . '<br>';
            echo '2' . $invertable[2]->status . '<br>';
            echo '3' . $invertable[3]->status . '<br>';
            echo $correctA . '<br><br>';
            echo $correctB . '<br><br>';
            echo $correctC . '<br><br>';
            echo $correctD . '<br><br>';



            if ($row21[10] == 0) {
                for ($i = 0; $i < $countA; $i++) {
                    if ($row21[2] != $answerA[$i]) {
                        $correctA = "NO";
                    } else {
                        $correctA = "YES";
                        break;
                    }
                }
            }
            if ($row21[11] == 0) {
                for ($i = 0; $i < $countB; $i++) {
                    if ($row21[3] != $answerB[$i]) {
                        $correctB = "NO";
                    } else {
                        $correctB = "YES";
                        break;
                    }
                }
            }
            if ($row21[12] == 0) {
                for ($i = 0; $i < $countC; $i++) {
                    if ($row21[4] != $answerC[$i]) {
                        $correctC = "NO";
                    } else {
                        $correctC = "YES";
                        break;
                    }
                }
            }
            if ($row21[13] == 0) {
                for ($i = 0; $i < $countD; $i++) {
                    if ($row21[5] != $answerD[$i]) {
                        $correctD = "NO";
                    } else {
                        $correctD = "YES";
                        break;
                    }
                }
            }
        }
        echo $correctA . '<br><br>';
        echo $correctB . '<br><br>';
        echo $correctC . '<br><br>';
        echo $correctD . '<br><br>';
        echo 'PM=' . $pm;
        if ($pm == '0' || $row[3] == "MC") {
            echo c;
            if ($correctA == "YES" && $correctB == "YES" && $correctC == "YES" && $correctD == "YES") {
                if ($row[3] == 'MC') {
                    $tempscore = $row12[4];
                    $score = $score + $row12[4];
                } else if ($row[3] == 'FIB') {
                    $tempscore = $row21[14];
                    $score = $score + $row21[14];
                }
                $correct = $row21[15] + 1;
                $sql22 = "UPDATE QUESTION SET correct = '$correct' WHERE question_id = '$row21[1]'";
                $isCorrect = "correct";
                mysql_query($sql22, $conn) or die(mysql_error());
            }
        } else if ($pm == '1') {
            for ($i = 0; $i < count($invertable); $i++) {
                if ($invertable[$i]->status == "used") {
                    $tempscore += $invertable[$i]->ansscore;
                    $score += $invertable[$i]->ansscore;
                    $incorrect = $row21[16] + 1;
                    $sql28 = "UPDATE QUESTION SET incorrect = '$incorrect' WHERE question_id = '$row21[1]'";
                    if ($correctA == "YES" && $correctB == "YES" && $correctC == "YES" && $correctD == "YES") {
                        $isCorrect = "correct";
                    } else if ($correctA == "NO" && $correctB == "NO" && $correctC == "NO" && $correctD == "NO") {
                        $isCorrect = "incorrect";
                    }
                    else
                        $isCorrect = "partial Correct";
                    mysql_query($sql28, $conn) or die(mysql_error());
                }
            }
        } else {
            $incorrect = $row21[16] + 1;
            $sql23 = "UPDATE QUESTION SET incorrect = '$incorrect'  WHERE question_id = '$row21[1]'";
            $isCorrect = "incorrect";
            mysql_query($sql23, $conn) or die(mysql_error());
        }
        $sql24 = "UPDATE S_QUESTION set isCorrect = '$isCorrect' , s_score ='$tempscore' WHERE s_question_id = '$row21[0]'";
        mysql_query($sql24, $conn) or die(mysql_error());
        echo 'Question mark finish<br>';
        echo '<br>Score: ' . $score . '<br>';
    }
}
echo '<br>Final Score: ' . $score . '<br>';
$sql4 = "UPDATE SUBMISSION SET score = '$score' where submission_id = '$submission_id'";
@mysql_query($sql4, $conn) or die(mysql_error());

class fanswer {

    var $question;
    var $answer;
    var $invertable;
    var $ansscore;
    var $cs;
    var $status = "unuse";
    var $iscorrect;

}

?>