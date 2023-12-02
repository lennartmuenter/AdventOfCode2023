<?php

$file = fopen("Day1.txt", "r");

$count = 0;

while ($line = fgets($file)) {
    $num = [
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
    $tmp = "";
    $sl = str_split($line);
    for ($j = 0; $j < count($sl); $j++) {
        $tmp .= $sl[$j];
        for ($i = 1; $i < 10; $i++) {
            $line = $tmp = str_replace($num[$i - 1], strval($i).substr($num[$i - 1], -1), $tmp);
        }
    }
    $line = str_split(preg_replace("~\D~", "", $line));
    $line = $line[0] . $line[count($line) - 1];
    $line = intval($line);
    $count += $line;
}

var_dump($count);

fclose($file);
