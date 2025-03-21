<?php
$myNum = 777;
$answer = $myNum;

$answer += 2;
$answer *= 2;
$answer -= 2;
$answer /= 2;
$answer -= $myNum;

echo 'Ответ: ', $answer;