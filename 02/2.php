<?php

$file = file('2.txt', FILE_IGNORE_NEW_LINES);

$countFirst = 0;
$countSecond = 0;

foreach ($file as $line) {
    $game = preg_split('/[:;]+/', str_replace(' ', '', $line));
    $values = [
        'id' => 0,
        'red' => 0,
        'green' => 0,
        'blue' => 0,
    ];
    foreach ($game as $round) {
        if (str_contains($round, 'Game')){
            $values['id'] = intval(preg_replace('/\D/', '', $round));
            continue;
        }
        $round = preg_split('/[,]/', $round);
        foreach($round as $color){
            $val = intval(preg_replace('/\D/', '', $color));
            $col = preg_replace('/\d/', '', $color);
            $val > $values[$col] ? $values[$col] = $val : null;
        }
    }
    if($values['red'] <= 12 && $values['green'] <= 13 && $values['blue'] <= 14){
        $countFirst += $values['id'];
    }
    $countSecond += $values['red'] * $values['green'] * $values['blue'];
}

var_dump($countFirst);
var_dump($countSecond);

# Output 1: 2156
# Output 2: 66909