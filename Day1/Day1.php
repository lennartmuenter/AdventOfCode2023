<?php

function findNumber($line)
{
    $line = preg_replace('/\D/', '', $line);
    $numbers = str_split($line);
    return intval($numbers[0] . $numbers[count($numbers) - 1]);
}

$file = file('Day1.txt', FILE_IGNORE_NEW_LINES);

$countFirst = 0;
$countSecond = 0;

foreach ($file as $line) {
    $abc = [
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
    ];

    $countFirst += findNumber($line);
    foreach ($abc as $key => $val) {
        $line = str_replace($val, $val.strval($key + 1).$val, $line);
    }
    $countSecond += findNumber($line);
}

var_dump($countFirst);
var_dump($countSecond);