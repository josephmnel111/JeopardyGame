<?php
include_once 'LoginDB.php';
$csv = 'JEOPARDY_CSV.csv';

$file = file($csv);
$total = count($file);

file_put_contents("Questions.txt", "");
file_put_contents("Answers.txt", "");

$money = array('$200', '$400', '$600', '$800', '$1000');

//$section1 = array();
$error_val = 0;
$nonerror_val = 0;
$rand_num = rand(5000, $total-5000);
while ($nonerror_val == 0) {
    $error_val = 0;
    $questions = array();
    $answers = array();
    for ($i = $rand_num; $i < $rand_num+500; ++$i) { //Get random part of file
        $text_file[$i - $rand_num][0] = str_getcsv($file[$i])[3];
        $text_file[$i - $rand_num][1] = str_getcsv($file[$i])[5];
        $text_file[$i - $rand_num][2] = str_getcsv($file[$i])[6];
    }
    $index1 = 0;
    $index2 = 0;
    $index3 = 0;
    $index4 = 0;
    $index5 = 0;
    $j = 0;
    $val = $text_file[250][0];
    $y = 0;
    for ($i = 0; $i < 250; ++$i) { //Find values before 
        if ($val == $text_file[$i][0]) {
            $questions[$y][0] = $text_file[$i][1];
            $answers[$y][0] = $text_file[$i][2];
            ++$y;
        }
    }
    for ($i = 250; $i < 500; ++$i) { //Find values after
        if ($val == $text_file[$i][0]) {
            $questions[$y][0] = $text_file[$i][1];
            $answers[$y][0] = $text_file[$i][2];
            $index1 = $i;
            ++$y;
        }
    }
    ++$j;
    $val = $text_file[250 +$j][0];
    $y = 0;
    for ($i = 0; $i < 250; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][1] = $text_file[$i][1];
            $answers[$y][1] = $text_file[$i][2];
            ++$y;
        }
    }
    for ($i = 250; $i < 500; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][1] = $text_file[$i][1];
            $answers[$y][1] = $text_file[$i][2];
            $index2 = $i;
            ++$y;
        }
    }
    ++$j;
    $val = $text_file[250 +$j][0];
    $y = 0;
    for ($i = 0; $i < 250; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][2] = $text_file[$i][1];
            $answers[$y][2] = $text_file[$i][2];
            ++$y;
        }
    }
    for ($i = 250; $i < 500; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][2] = $text_file[$i][1];
            $answers[$y][2] = $text_file[$i][2];
            $index3 = $i;
            ++$y;
        }
    }
    ++$j;
    $val = $text_file[250 +$j][0];
    $y = 0;
    for ($i = 0; $i < 250; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][3] = $text_file[$i][1];
            $answers[$y][3] = $text_file[$i][2];
            ++$y;
        }
    }
    for ($i = 250; $i < 500; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][3] = $text_file[$i][1];
            $answers[$y][3] = $text_file[$i][2];
            $index4 = $i;
            ++$y;
        }
    }
    ++$j;
    $val = $text_file[250 +$j][0];
    $y = 0;
    for ($i = 0; $i < 250; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][4] = $text_file[$i][1];
            $answers[$y][4] = $text_file[$i][2];
            ++$y;
        }
    }
    for ($i = 250; $i < 500; ++$i) {
        if ($val == $text_file[$i][0]) {
            $questions[$y][4] = $text_file[$i][1];
            $answers[$y][4] = $text_file[$i][2];
            $index5 = $i;
            ++$y;
        }
    }
    ++$j;
    $break_val = 0;
    for ($i = 0; $i < 5; $i++) {
        for ($k = 0; $k < 5; $k++) {
            if (!isset($questions[$i][$k])) {
                $error_val = -1;
            }
        }
    }
    if ($error_val != -1) {
        $nonerror_val = 1;
    }
    $rand_num = $rand_num + 500;
}
$write_file_questions = fopen('Questions.txt', 'w');
$write_file_answers = fopen('Answers.txt', 'w');
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        fwrite($write_file_questions, $questions[$j][$i]);
        fwrite($write_file_answers, $answers[$j][$i]);
        if (($i != 4) || ($j != 4)) {
            fwrite($write_file_questions, "\r\n"); //Write question and answer files
            fwrite($write_file_answers, "\r\n");
        }
    }
}





?>


<!DOCTYPE html>
<html lang = 'en' dir = 'ltr'>
    <head>
        <title>Project 4</title>
        <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.6.0.min.js"> </script>
        <link rel= "stylesheet" href = "styles/PlayGame.css">
        <meta charset = "utf-8">
    </head>
    <body>
        <script type = "text/javascript">
            $(document).ready(function () {
                let val = 0;
                function getAnswer(correct_answer, addition){
                                correct_answer = correct_answer.toLowerCase(); //Convert values to lower case
                                let count = 0;
                                    document.querySelector('#submit_val').addEventListener('click', function () {
                                        let answer_val = document.querySelector('#answer_val').value;
                                        answer_val = answer_val.toLowerCase();
                                        if ((answer_val.includes(correct_answer) || (correct_answer.includes(answer_val))) && (count ==0) && (answer_val.length > 3)) { //For larger strings
                                            let x = document.querySelector('#money_tracker').innerHTML;
                                            x = x.substring(1, x.length);
                                            let y = parseInt(x); //Add balance
                                            y = y + addition;
                                            let z = y.toString();
                                            z = '$' + z;
                                            document.querySelector('#your_answer').innerHTML = "Your answer: " + answer_val;
                                            document.querySelector('#correct_answer').innerHTML = "Correct answer: " + correct_answer;
                                            document.querySelector('#money_tracker').innerHTML = z;
                                            document.querySelector('#money_tracker_send').value = z;
                                        } else if ((answer_val.length <= 3) && (answer_val == correct_answer) && (count == 0)) { //For smaller strings
                                            let x = document.querySelector('#money_tracker').innerHTML;
                                            x = x.substring(1, x.length);
                                            let y = parseInt(x);
                                            y = y + addition;
                                            let z = y.toString();
                                            z = '$' + z;
                                            document.querySelector('#your_answer').innerHTML = answer_val;
                                            document.querySelector('#correct_answer').innerHTML = correct_answer;
                                            document.querySelector('#money_tracker').innerHTML = z;
                                            document.querySelector('#money_tracker_send').value = z;
                                        }else {
                                            document.querySelector('#your_answer').innerHTML = answer_val;
                                            document.querySelector('#correct_answer').innerHTML = "Sorry, the correct answer is: " + correct_answer;
                                        }
                                        val = 0;
                                        ++count;
                                    });
                }
                    $('#1-2').click(function() {
                        if ((!$('#1-2').is(':empty')) && (val == 0)) {//If no question in queue and cell not empty
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){ //Get the questions
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[0];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#1-2').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) { //Get the answers
                                var lines = data.split("\n");
                                let correct_answer = lines[0].substring(0, lines[0].length -1);//For next cell
                                getAnswer(correct_answer, 200);
                            });
                        }
                    });
                    $('#2-2').click(function() {
                        if (!$('#2-2').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[5];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#2-2').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[5].substring(0, lines[5].length -1);//For next cell
                                getAnswer(correct_answer, 200);
                            });
                        }
                    });
                    $('#3-2').click(function() {
                        if (!$('#3-2').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[10];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#3-2').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[10].substring(0, lines[10].length -1);//For next cell
                                getAnswer(correct_answer, 200);
                            });
                        }
                    });
                    $('#4-2').click(function() {
                        if (!$('#4-2').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[15];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#4-2').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[15].substring(0, lines[15].length -1);//For next cell
                                getAnswer(correct_answer, 200);
                            });
                        }
                    });
                    $('#5-2').click(function() {
                        if (!$('#5-2').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[20];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#5-2').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[20].substring(0, lines[20].length -1);//For next cell
                                getAnswer(correct_answer, 200);
                            });
                        }
                    });
                    $('#1-3').click(function() {
                        if (!$('#1-3').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[1];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#1-3').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[1].substring(0, lines[1].length -1);//For next cell
                                getAnswer(correct_answer, 400);
                            });
                        }
                    });
                    $('#2-3').click(function() {
                        if (!$('#2-3').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[6];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#2-3').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[6].substring(0, lines[6].length -1);//For next cell
                                getAnswer(correct_answer, 400);
                            });
                        }
                    });
                    $('#3-3').click(function() {
                        if (!$('#3-3').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[11];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#3-3').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[11].substring(0, lines[11].length -1);//For next cell
                                getAnswer(correct_answer, 400);
                            });
                        }
                    });
                    $('#4-3').click(function() {
                        if (!$('#4-3').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[16];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#4-3').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[16].substring(0, lines[16].length -1);//For next cell
                                getAnswer(correct_answer, 400);
                            });
                        }
                    });
                    $('#5-3').click(function() {
                        if (!$('#5-3').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[21];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#5-3').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[21].substring(0, lines[21].length -1);//For next cell
                                getAnswer(correct_answer, 400);
                            });
                        }
                    });
                    $('#1-4').click(function() {
                        if (!$('#1-4').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[2];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#1-4').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[2].substring(0, lines[2].length -1);//For next cell
                                getAnswer(correct_answer, 600);
                            });
                        }
                    });
                    $('#2-4').click(function() {
                        if (!$('#2-4').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[7];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#2-4').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[7].substring(0, lines[7].length -1);//For next cell
                                getAnswer(correct_answer, 600);
                            });
                        }
                    });
                    $('#3-4').click(function() {
                        if (!$('#3-4').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[12];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#3-4').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[12].substring(0, lines[12].length -1);//For next cell
                                getAnswer(correct_answer, 600);
                            });
                        }
                    });
                    $('#4-4').click(function() {
                        if (!$('#4-4').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[17];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#4-4').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[17].substring(0, lines[17].length -1);//For next cell
                                getAnswer(correct_answer, 600);
                            });
                        }
                    });
                    $('#5-4').click(function() {
                        if (!$('#5-4').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[22];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#5-4').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[22].substring(0, lines[22].length -1);//For next cell
                                getAnswer(correct_answer, 600);
                            });
                        }
                    });
                    $('#1-5').click(function() {
                        if (!$('#1-5').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[3];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#1-5').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[3].substring(0, lines[3].length -1);//For next cell
                                getAnswer(correct_answer, 800);
                            });
                        }
                    });
                    $('#2-5').click(function() {
                        if (!$('#2-5').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[8];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#2-5').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[8].substring(0, lines[8].length -1);//For next cell
                                getAnswer(correct_answer, 800);
                            });
                        }
                    });
                    $('#3-5').click(function() {
                        if (!$('#3-5').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[13];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#3-5').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[13].substring(0, lines[13].length -1);//For next cell
                                getAnswer(correct_answer, 800);
                            });
                        }
                    });
                    $('#4-5').click(function() {
                        if (!$('#4-5').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[18];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#4-5').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[18].substring(0, lines[18].length -1);//For next cell
                                getAnswer(correct_answer, 800);
                            });
                        }
                    });
                    $('#5-5').click(function() {
                        if (!$('#5-5').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[23];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#5-5').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[23].substring(0, lines[23].length -1);//For next cell
                                getAnswer(correct_answer, 800);
                            });
                        }
                    });
                    $('#1-6').click(function() {
                        if (!$('#1-6').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[4];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#1-6').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[4].substring(0, lines[4].length -1);//For next cell
                                getAnswer(correct_answer, 1000);
                            });
                        }
                    });
                    $('#2-6').click(function() {
                        if (!$('#2-6').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[9];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#2-6').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[9].substring(0, lines[9].length -1);//For next cell
                                getAnswer(correct_answer, 1000);
                            });
                        }
                    });
                    $('#3-6').click(function() {
                        if (!$('#3-6').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[14];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#3-6').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[14].substring(0, lines[14].length -1);//For next cell
                                getAnswer(correct_answer, 1000);
                            });
                        }
                    });
                    $('#4-6').click(function() {
                        if (!$('#4-6').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[19];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#4-6').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[19].substring(0, lines[19].length -1);//For next cell
                                getAnswer(correct_answer, 1000);
                            });
                        }
                    });
                    $('#5-6').click(function() {
                        if (!$('#5-6').is(':empty')&& (val == 0)) {
                            document.querySelector('#correct_answer').innerHTML = "";
                            jQuery.get('Questions.txt', function (data){
                                var lines = data.split("\n");
                                document.querySelector('#question_val').innerHTML = lines[24];
                                document.querySelector('#your_answer').innerHTML = "";
                                document.querySelector('#correct_answer').innerHTML = "";
                                document.querySelector('#answer_val').value = "";
                                $('#5-6').html("");
                                val = 1;
                            });
                            jQuery.get('Answers.txt', function (data) {
                                var lines = data.split("\n");
                                let correct_answer = lines[24].substring(0, lines[24].length -1);//For next cell
                                getAnswer(correct_answer, 1000);
                            });
                        }
                    });
            });
        </script>
    <table class = "center_table">
            <tr>
                <td id="1-1"><?php echo($text_file[$index1][0]);?></td>
                <td id="2-1"><?php echo($text_file[$index2][0]);?></td>
                <td id="3-1"><?php echo($text_file[$index3][0]);?></td>
                <td id="4-1"><?php echo($text_file[$index4][0]);?></td>
                <td id="5-1"><?php echo($text_file[$index5][0]);?></td>
            </tr>
            <tr>
                <td id="1-2"><?php echo($money[0]);?></td>
                <td id="2-2"><?php echo($money[0]);?></td>
                <td id="3-2"><?php echo($money[0]);?></td>
                <td id="4-2"><?php echo($money[0]);?></td>
                <td id="5-2"><?php echo($money[0]);?></td>
            </tr>
            <tr>
                <td id="1-3"><?php echo($money[1]);?></td>
                <td id="2-3"><?php echo($money[1]);?></td>
                <td id="3-3"><?php echo($money[1]);?></td>
                <td id="4-3"><?php echo($money[1]);?></td>
                <td id="5-3"><?php echo($money[1]);?></td>
            </tr>
            <tr>
                <td id="1-4"><?php echo($money[2]);?></td>
                <td id="2-4"><?php echo($money[2]);?></td>
                <td id="3-4"><?php echo($money[2]);?></td>
                <td id="4-4"><?php echo($money[2]);?></td>
                <td id="5-4"><?php echo($money[2]);?></td>
            </tr>
            <tr>
                <td id="1-5"><?php echo($money[3]);?></td>
                <td id="2-5"><?php echo($money[3]);?></td>
                <td id="3-5"><?php echo($money[3]);?></td>
                <td id="4-5"><?php echo($money[3]);?></td>
                <td id="5-5"><?php echo($money[3]);?></td>
            </tr>
            <tr>
                <td id="1-6"><?php echo($money[4]);?></td>
                <td id="2-6"><?php echo($money[4]);?></td>
                <td id="3-6"><?php echo($money[4]);?></td>
                <td id="4-6"><?php echo($money[4]);?></td>
                <td id="5-6"><?php echo($money[4]);?></td>
            </tr>
        </table><br><br>
        <div id = 'question_val'></div><br>
        <input id = 'answer_val' type = 'text'></input><br><br>
        <input id = 'submit_val' class = "designButton" type = 'button' value = 'Submit Answer'></input><br>
        <p id = 'money_tracker'>$0</p><br>
        <div id = 'your_answer'></div>
        <div id = 'correct_answer'></div>
        <form action = "HandleScore.php" method = "post">
            <input type = 'hidden' id = 'money_tracker_send' name = 'money_tracker_send' value = '$0'></input>
            <input type = 'submit' class = "designButton" value = 'End Game'></input>
        </form>
    </body>
</html>


